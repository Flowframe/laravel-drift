<?php

namespace Flowframe\Drift\CachingStrategies;

use Flowframe\Drift\Config;
use Intervention\Image\Image;

class NullCachingStrategy extends BaseCachingStrategy
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
