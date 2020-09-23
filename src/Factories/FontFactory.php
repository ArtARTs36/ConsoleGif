<?php

namespace ArtARTs36\ConsoleGif\Factories;

use ArtARTs36\ConsoleGif\Factories\ConcreteFont\RobotoFactory;
use ArtARTs36\ConsoleGif\Factories\ConcreteFont\RobotronFactory;
use ArtARTs36\ConsoleGif\Factories\ConcreteFont\SystemFactory;

class FontFactory
{
    protected static $dir = __DIR__ . '/../../resources/fonts/';

    protected static $factories = [
        RobotoFactory::class,
        RobotronFactory::class,
        SystemFactory::class,
    ];

    public static function robotto(): RobotoFactory
    {
        return new RobotoFactory(static::getDir());
    }

    public static function robotron(): RobotronFactory
    {
        return new RobotronFactory(static::getDir());
    }

    public static function system(): SystemFactory
    {
        return new SystemFactory(static::getDir());
    }

    public static function getDir(): string
    {
        return realpath(static::$dir);
    }

    public static function getNames(): array
    {
        $names = [];

        foreach (static::$factories as $factory) {
            $reflection = new \ReflectionClass($factory);

            $family = explode("\\", $reflection->getName());
            $family = str_replace('Factory', '', end($family));

            foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->getName() === '__construct') {
                    continue;
                }

                $names[$reflection->getName()]['fonts'][] = $method->getName();
            }

            $names[$reflection->getName()]['family'] = $family;
        }

        return $names;
    }
}
