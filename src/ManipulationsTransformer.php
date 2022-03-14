<?php

namespace Flowframe\Drift;

class ManipulationsTransformer
{
    public function encode(array $optimizations): string
    {
        return base64_encode(
            json_encode($optimizations),
        );
    }

    public function decode(string $optimizations): array
    {
        return json_decode(
            base64_decode($optimizations),
            true,
        );
    }
}
