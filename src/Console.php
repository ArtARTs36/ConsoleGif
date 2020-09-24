<?php

namespace ArtARTs36\ConsoleGif;

use ArtARTs36\ConsoleGif\Animator\Animator;
use ArtARTs36\ConsoleGif\Builders\ImageBuilder;
use ArtARTs36\ConsoleGif\Elements\Color;
use ArtARTs36\Str\Facade\Str;
use GifCreator\GifCreator;

class Console
{
    private $lines = [];

    private $builder;

    private $animator;

    private $user;

    private $background;

    public function __construct(ImageBuilder $builder, Animator $animator)
    {
        $this->builder = $builder->background(Color::createBlack());
        $this->animator = $animator->endPaused(20);
        $this->background = Color::createBlack();
    }

    public static function bySize(int $width, int $height): Console
    {
        return new static(new ImageBuilder($width, $height), new Animator(new GifCreator()));
    }

    public function addLine(string $text): self
    {
        $this->lines[] = $text;

        return $this;
    }

    public function setBackground(Color $color): self
    {
        $this->background = $color;

        return $this;
    }

    public function addLines(array $lines): self
    {
        array_push($this->lines, ...array_values($lines));

        return $this;
    }

    public function save(string $path): bool
    {
        $parts = [];

        $color = Color::createWhite();

        foreach ($this->lines as $line) {
            $this->user !== null && $this->builder->textLine($this->user, $color);

            foreach (Str::chars($line) as $char) {
                $parts[] = $this
                    ->builder
                    ->background($this->background)
                    ->addChar($char, $color)
                    ->buildWhile()
                    ->resource();
            }

            $this->builder->downLineIfExists();
        }

        return file_put_contents($path, $this->animator->add($parts)->anim()) === true;
    }

    public function setUser(string $text): self
    {
        $this->user = $text;

        return $this;
    }
}
