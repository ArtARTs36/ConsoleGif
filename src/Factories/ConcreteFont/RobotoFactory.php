<?php

namespace ArtARTs36\ConsoleGif\Factories\ConcreteFont;

use ArtARTs36\ConsoleGif\Elements\Font;

class RobotoFactory extends BasedFactory
{
    public function regular(): Font
    {
        return new Font($this->path('Roboto-Regular.ttf'));
    }
}
