<?php

namespace ArtARTs36\ConsoleGif\Animator;

use GifCreator\GifCreator;

class Animator
{
    protected $driver;

    protected $frames;

    protected $endPaused = null;

    public function __construct(GifCreator $driver)
    {
        $this->driver = $driver;
    }

    public function add(array $frames)
    {
        $this->frames = $frames;

        return $this;
    }

    public function endPaused(int $ms): self
    {
        $this->endPaused = $ms;

        return $this;
    }

    public function anim(): string
    {
        $frames = $this->frames;

        if ($this->endPaused !== null) {
            $frames = array_merge($frames, $this->getPausedFrames());
        }

        return $this->driver->create($frames, array_fill(0, count($frames), 1), 5);
    }

    protected function getPausedFrames(): array
    {
        return array_map(function () {
            return end($this->frames);
        }, range(0, $this->endPaused));
    }
}
