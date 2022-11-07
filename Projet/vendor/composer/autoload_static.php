<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit83aa12df9e8be0d0559174892b2120ee
{
    public static $prefixLengthsPsr4 = array (
        'i' => 
        array (
            'iutnc\\netVOD\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'iutnc\\netVOD\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit83aa12df9e8be0d0559174892b2120ee::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit83aa12df9e8be0d0559174892b2120ee::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit83aa12df9e8be0d0559174892b2120ee::$classMap;

        }, null, ClassLoader::class);
    }
}
