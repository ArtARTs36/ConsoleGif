<?php

namespace ArtARTs36\ConsoleGif\Builders;

use ArtARTs36\ConsoleGif\Elements\Color;
use ArtARTs36\ConsoleGif\Elements\Font;
use ArtARTs36\ConsoleGif\Elements\TextLine;
use ArtARTs36\ConsoleGif\Factories\FontFactory;
use ArtARTs36\ConsoleGif\ImageSource;

class ImageBuilder
{
    /** @var TextLine[] */
    private $textLines = [];

    private $source;

    private $lastLinePosition = 0;

    private $width;

    private $height;

    private $font;

    public function __construct(int $width, int $height, Font $font = null)
    {
        [$this->width, $this->height] = [$width, $height];
        $this->source = $this->createSource();
        $this->font = $font ?? FontFactory::system()->consolas();
    }

    public function background(Color $color): self
    {
        $this->source->fill(0, 0, $color);

        return $this;
    }

    public function textLine(string $text, Color $color, int $size = 12): self
    {
        $this->textLines[] = new TextLine($text, $color, $size);

        return $this;
    }

    public function addChar(string $char, Color $color, bool $withSpace = false): self
    {
        if (! empty($this->textLines)) {
            end($this->textLines)
                ->addChar($withSpace ? ' ' . $char : $char);
        } else {
            $this->textLines[] = new TextLine($char, $color, 12);
        }

        return $this;
    }

    public function build(string $path): bool
    {
        foreach ($this->textLines as $line) {
            $this->printTextLine($line);
        }

        $this
            ->source
            ->toPng($path)
            ->destroy();

        return file_exists($path);
    }

    public function buildWhile(): ImageSource
    {
        $lastLinePosition = $this->lastLinePosition;

        foreach ($this->textLines as $line) {
            $this->printTextLine($line);
        }

        $source = $this->source;

        $this->source = $this->createSource();

        $this->lastLinePosition = $lastLinePosition;

        return $source;
    }

    public function downLineIfExists(): self
    {
        if (empty($this->textLines)) {
            return $this;
        }

        $this->textLines[] = end($this->textLines)->copy(false);

        return $this;
    }

    final protected function createSource(): ImageSource
    {
        return new ImageSource($this->width, $this->height);
    }

    private function printTextLine(TextLine $line): void
    {
        $this->lastLinePosition += $line->size + ($line->size / 2);

        $this->source->printTextLine($line, 2, $this->lastLinePosition, $this->font);
    }
}
