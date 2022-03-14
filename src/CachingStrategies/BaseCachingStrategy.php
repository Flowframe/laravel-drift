<?php

namespace Flowframe\Drift\CachingStrategies;

use Flowframe\Drift\Config;
use Intervention\Image\Image;

abstract class BaseCachingStrategy
{
    abstract public function validate(string $path, string $signature, Config $config): bool;

    abstract public function resolve(string $path, string $signature, Config $config): string;

    abstract public function cache(string $path, string $signature, Image $image, Config $config): void;
}
