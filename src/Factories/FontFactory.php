<?php

namespace ArtARTs36\ConsoleGif\Factories;

use ArtARTs36\ConsoleGif\Factories\ConcreteFont\RobotoFactory;

class FontFactory
{
    protected static $dir = __DIR__ . '/../../resources/fonts/';

    public static function robotto(): RobotoFactory
    {
        return new RobotoFactory(static::getDir());
    }

    public static function getDir(): string
    {
        return realpath(static::$dir);
    }
}
