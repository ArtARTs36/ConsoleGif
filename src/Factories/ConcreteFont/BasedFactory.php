<?php

namespace ArtARTs36\ConsoleGif\Factories\ConcreteFont;

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
}
