@props([
    'config',
    'path',
    'manipulations' => [],
])

<img
    src="{{ app(\Flowframe\Drift\UrlBuilder::class)->url($config, $path, $manipulations) }}"
    {{ $attributes }}
>
