<?php

namespace Flowframe\Drift;

use Illuminate\Support\ServiceProvider;

class DriftServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'drift');
    }
}
