<?php

namespace Flowframe\Drift\CachingStrategies;

use Flowframe\Drift\Config;
use Flowframe\Drift\Contracts\CachingStrategy;
use Intervention\Image\Image;

class NullCachingStrategy implements CachingStrategy
{
    public function validate(string $path, string $signature, Config $config): bool
    {
        return false;
    }

    public function resolve(string $path, string $signature, Config $config): string
    {
        return '';
    }

    public function cache(string $path, string $signature, Image $image, Config $config): void
    {
    }
}
