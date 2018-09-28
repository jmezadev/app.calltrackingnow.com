<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit011d67528db743bbc7072b2fb1d20d8e
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SmartUI\\' => 8,
        ),
        'C' => 
        array (
            'Common\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SmartUI\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/smartui',
        ),
        'Common\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/common',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/app',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit011d67528db743bbc7072b2fb1d20d8e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit011d67528db743bbc7072b2fb1d20d8e::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit011d67528db743bbc7072b2fb1d20d8e::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}