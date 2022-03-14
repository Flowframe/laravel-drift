# Laravel Drift

Optimize images on the fly.

## Installation

You can install the package via composer:

```
composer require flowframe/laravel-drift
```

## Usage

Simply install the package, and register a configuration in `AppServiceProvider@boot`:

```php
use Flowframe\Drift\Config;
use Flowframe\Drift\DriftManager;
use Flowframe\Drift\CachingStrategies\FilesystemCachingStrategy;

/** @var DriftManager $drift */
$drift = app(DriftManager::class);

$drift->registerConfig(new Config(
    name: 'my-config-name', // Will be used in the slug
    filesystemDisk: 'filesystems-disk-name', // Local, public or s3 for example
    cachingStrategy: FilesystemCachingStrategy::class, // Create your own or use the defaults like FilesystemCachingStrategy or NullCachingStrategy
));
```

### Image URLs

To generate an image URL use the `\Flowframe\Drift\UrlBuilder` like so:

```php
use Flowframe\Drift\UrlBuilder;

/** @var UrlBuilder $builder */
$builder = app(UrlBuilder::class);

$image = $builder->url('my-config-name', 'example.png', [
    'resize' => [1920, 1080],
    'encode' => 'webp', // The fallback encoding will be webp
]);
```

You can use most of [Intervention Image's](https://image.intervention.io/v2/usage/overview#editing-images) methods, simply use the method name as key and set the argument as value. Have more than one argument? Use an array instead like in the example above.

### Blade Component

```blade
<x-drift::image
    class="w-full aspect-[16/9] object-cover"
    config="my-config-name"
    path="example.png"
    :manipulations="[
        'encode' => ['jpeg', 50],
        'greyscale' => true,
    ]"
/>
```
