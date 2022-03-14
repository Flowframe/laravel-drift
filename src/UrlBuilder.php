<?php

namespace Flowframe\Drift;

use Illuminate\Support\Facades\URL;

class UrlBuilder
{
    public function url(string $configName, string $path, array $manipulations = []): string
    {
        if (! isset($manipulations['encode'])) {
            $manipulations['encode'] = 'webp';
        }

        $encodedManipulations = app(ManipulationsTransformer::class)->encode($manipulations);

        return URL::signedRoute('__images.manipulate', [
            $configName,
            $encodedManipulations,
            $path,
        ]);
    }
}
