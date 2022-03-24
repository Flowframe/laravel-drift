<?php

namespace Flowframe\Drift\Http\Controllers;

use Flowframe\Drift\DriftManager;
use Flowframe\Drift\ManipulationsTransformer;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImagesController
{
    public function __construct(
        public DriftManager $driftManager,
        public ManipulationsTransformer $manipulationsTransformer,
    ) {
    }

    public function __invoke(
        string $configName,
        string $manipulations,
        string $path,
    ): Response {
        $signature = request('signature');

        /** @var \Flowframe\Drift\Config|null $config */
        $config = $this->driftManager
            ->configs()
            ->firstWhere('name', $configName);

        abort_if(
            is_null($config),
            Response::HTTP_NOT_FOUND,
            'Config not found',
        );

        /** @var \Flowframe\Drift\Contracts\CachingStrategy $cachingStrategy */
        $cachingStrategy = new $config->cachingStrategy();

        if ($cachingStrategy->validate($path, $signature, $config)) {
            $cachedImage = $cachingStrategy->resolve($path, $signature, $config);

            $image = Image::make($cachedImage);

            $image->encode((string) str($image->mime())->afterLast('/'));

            return response((string) $image)->header('Content-Type', $image->mime());
        }

        abort_unless(
            Storage::disk($config->filesystemDisk)->exists($path),
            Response::HTTP_NOT_FOUND,
            'Image not found',
        );

        $image = Image::make(
            Storage::disk($config->filesystemDisk)->get($path),
        );

        foreach ($this->manipulationsTransformer->decode($manipulations) as $method => $arguments) {
            is_array($arguments)
                ? $image->{$method}(...$arguments)
                : $image->{$method}($arguments);
        }

        $cachingStrategy->cache($path, $signature, $image, $config);

        return response((string) $image)->header('Content-Type', $image->mime());
    }
}
