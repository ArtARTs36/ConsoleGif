<?php

namespace ArtARTs36\ConsoleGif\Elements;

class Font
{
    protected $path;

    public function __construct(string $path)
    {
        $this->existsOrFail($path);

        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    protected function existsOrFail(string $path): void
    {
        if (! file_exists($path)) {
            throw new \LogicException("File {$path} not found!");
        }
    }
}
