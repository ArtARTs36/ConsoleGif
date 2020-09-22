<?php

namespace ArtARTs36\ConsoleGif;

use ArtARTs36\ConsoleGif\Elements\Color;
use ArtARTs36\ConsoleGif\Elements\Font;
use ArtARTs36\ConsoleGif\Elements\TextLine;

class ImageSource
{
    private $resource;

    public function __construct(int $width, int $height)
    {
        $this->resource = imagecreatetruecolor(...func_get_args());
    }

    public function toPng(string $path): self
    {
        imagepng($this->resource, $path);

        return $this;
    }

    public function destroy(): void
    {
        imagedestroy($this->resource);
    }

    /**
     * @return resource
     */
    public function resource()
    {
        return $this->resource;
    }

    public function fill(int $x, int $y, Color $color): self
    {
        imagefill($this->resource, $x, $y, $color->allocate($this));

        return $this;
    }

    public function printTextLine(TextLine $line, int $xPos, int $yPos, Font $font): void
    {
        imagettftext(
            $this->resource,
            $line->size,
            0,
            $xPos,
            $yPos,
            $line->color->allocate($this),
            $font->getPath(),
            $line->text
        );
    }
}
