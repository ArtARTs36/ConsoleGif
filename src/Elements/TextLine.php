<?php

namespace ArtARTs36\ConsoleGif\Elements;

class TextLine
{
    public $text;

    public $color;

    public $size;

    public function __construct(string $text, Color $color, int $size)
    {
        $this->text = $text;
        $this->color = $color;
        $this->size = $size;
    }

    public function addChar(string $char): self
    {
        $this->text .= $char;

        return $this;
    }

    public function reset(): self
    {
        $this->text = '';

        return $this;
    }

    public function copy(bool $saveText = true): TextLine
    {
        return new static($saveText ? $this->text : '', $this->color, $this->size);
    }
}
