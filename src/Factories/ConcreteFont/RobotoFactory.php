<?php

namespace ArtARTs36\ConsoleGif\Factories\ConcreteFont;

use ArtARTs36\ConsoleGif\Elements\Font;

class RobotoFactory extends BasedFactory
{
    public function regular(): Font
    {
        return $this->createFont('Roboto-Regular.ttf');
    }
}
