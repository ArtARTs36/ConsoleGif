<?php

namespace ArtARTs36\ConsoleGif\Factories\ConcreteFont;

use ArtARTs36\ConsoleGif\Elements\Font;

abstract class BasedFactory
{
    protected $dir;

    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    protected function path(string $font): string
    {
        return $this->dir . DIRECTORY_SEPARATOR . $font;
    }

    protected function createFont(string $path): Font
    {
        return new Font(static::path($path));
    }
}
