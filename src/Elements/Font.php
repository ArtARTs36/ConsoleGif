<?php

namespace ArtARTs36\ConsoleGif\Elements;

class Font
{
    protected $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
