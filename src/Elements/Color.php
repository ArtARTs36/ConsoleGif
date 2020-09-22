<?php

namespace ArtARTs36\ConsoleGif\Elements;

use ArtARTs36\ConsoleGif\ImageSource;

class Color
{
    private $red;

    private $blue;

    private $green;

    public function __construct(int $red, int $green, int $black)
    {
        $this->red = $red;
        $this->blue = $black;
        $this->green = $green;
    }

    public static function createBlack(): Color
    {
        return new static(0, 0, 0);
    }

    public static function createWhite(): Color
    {
        return new static(255, 255, 255);
    }

    public static function createGreen(): Color
    {
        return new static(0, 255, 000);
    }

    public function red(): int
    {
        return $this->red;
    }

    public function blue(): int
    {
        return $this->blue;
    }

    public function green(): int
    {
        return $this->green;
    }

    /**
     * @param ImageSource $image
     * @return int
     */
    public function allocate(ImageSource $image): int
    {
        return imagecolorallocate($image->resource(), $this->red, $this->green, $this->blue);
    }
}
