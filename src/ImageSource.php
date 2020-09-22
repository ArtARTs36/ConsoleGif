<?php

namespace ArtARTs36\ConsoleGif;

use ArtARTs36\ConsoleGif\Elements\Color;

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

    public function destroy(): self
    {
        imagedestroy($this->resource);

        return $this;
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
}
