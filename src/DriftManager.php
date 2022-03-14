<?php

namespace Flowframe\Drift;

use Illuminate\Support\Collection;

class DriftManager
{
    protected static array $configs = [];

    public function registerConfig(Config $config): self
    {
        static::$configs[] = $config;

        return $this;
    }

    public function configs(): Collection
    {
        return collect(static::$configs);
    }
}
