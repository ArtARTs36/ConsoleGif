<?php

namespace ArtARTs36\ConsoleGif\Factories\ConcreteFont;

use ArtARTs36\ConsoleGif\Elements\Font;

class RobotronFactory extends BasedFactory
{
    public function dotMatrix(): Font
    {
        return $this->createFont('RobotronDotMatrix.ttf');
    }
}
