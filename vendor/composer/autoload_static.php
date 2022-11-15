<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1ce614929cbbf3e7a00a1db8c8defd55
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1ce614929cbbf3e7a00a1db8c8defd55::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1ce614929cbbf3e7a00a1db8c8defd55::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1ce614929cbbf3e7a00a1db8c8defd55::$classMap;

        }, null, ClassLoader::class);
    }
}
