<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd519995838db71c3b1d30a6ef56a6013
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '65fec9ebcfbb3cbb4fd0d519687aea01' => __DIR__ . '/..' . '/danielstjules/stringy/src/Create.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Stringy\\' => 8,
        ),
        'I' => 
        array (
            'Icewind\\Streams\\Tests\\' => 22,
            'Icewind\\Streams\\' => 16,
            'Icewind\\SMB\\Test\\' => 17,
            'Icewind\\SMB\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Stringy\\' => 
        array (
            0 => __DIR__ . '/..' . '/danielstjules/stringy/src',
        ),
        'Icewind\\Streams\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/icewind/streams/tests',
        ),
        'Icewind\\Streams\\' => 
        array (
            0 => __DIR__ . '/..' . '/icewind/streams/src',
        ),
        'Icewind\\SMB\\Test\\' => 
        array (
            0 => __DIR__ . '/..' . '/icewind/smb/tests',
        ),
        'Icewind\\SMB\\' => 
        array (
            0 => __DIR__ . '/..' . '/icewind/smb/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'I' => 
        array (
            'Imagine' => 
            array (
                0 => __DIR__ . '/..' . '/imagine/imagine/lib',
            ),
        ),
        'G' => 
        array (
            'Gaufrette' => 
            array (
                0 => __DIR__ . '/..' . '/knplabs/gaufrette/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd519995838db71c3b1d30a6ef56a6013::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd519995838db71c3b1d30a6ef56a6013::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd519995838db71c3b1d30a6ef56a6013::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
