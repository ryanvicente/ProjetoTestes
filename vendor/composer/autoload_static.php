<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita1d9b68b0b9734d57502a108f960d8de
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Config\\' => 7,
            'Cocur\\Slugify\\' => 14,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/Config',
        ),
        'Cocur\\Slugify\\' => 
        array (
            0 => __DIR__ . '/..' . '/cocur/slugify/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita1d9b68b0b9734d57502a108f960d8de::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita1d9b68b0b9734d57502a108f960d8de::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita1d9b68b0b9734d57502a108f960d8de::$classMap;

        }, null, ClassLoader::class);
    }
}
