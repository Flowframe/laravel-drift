<?php

namespace Flowframe\Drift\CachingStrategies;

use Flowframe\Drift\Config;
use Flowframe\Drift\Contracts\CachingStrategy;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;

class FilesystemCachingStrategy implements CachingStrategy
{
    public function validate(string $path, string $signature, Config $config): bool
    {
        return Storage::exists("__images-cache/{$path}/{$signature}");
    }

    public function resolve(string $path, string $signature, Config $config): string
    {
        return Storage::get("__images-cache/{$path}/{$signature}");
    }

    public function cache(string $path, string $signature, Image $image, Config $config): void
    {
        Storage::put("__images-cache/{$path}/{$signature}", (string) $image);
    }
}
