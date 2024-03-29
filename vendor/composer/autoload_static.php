<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7aa78c3fa985e602fe441cb578aa6819
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PayPal' => 
            array (
                0 => __DIR__ . '/..' . '/paypal/rest-api-sdk-php/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7aa78c3fa985e602fe441cb578aa6819::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7aa78c3fa985e602fe441cb578aa6819::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit7aa78c3fa985e602fe441cb578aa6819::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
