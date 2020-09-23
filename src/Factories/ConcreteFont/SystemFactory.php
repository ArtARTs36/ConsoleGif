<?php

namespace ArtARTs36\ConsoleGif\Factories\ConcreteFont;

use ArtARTs36\ConsoleGif\Elements\Font;

class SystemFactory extends BasedFactory
{
    public function consolas(): Font
    {
        return $this->createFont('Consolas.ttf');
    }
}
