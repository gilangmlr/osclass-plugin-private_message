<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6e348756ab65e48165164d04214aae81
{
    public static $files = array (
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Ramsey\\Uuid\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ramsey\\Uuid\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/uuid/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6e348756ab65e48165164d04214aae81::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6e348756ab65e48165164d04214aae81::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
