<?php

namespace Gaufrette\Util;

/**
<<<<<<< HEAD
 * Path utils
 *
 * @package Gaufrette
=======
 * Path utils.
 *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 * @author  Antoine Hérault <antoine.herault@gmail.com>
 */
class Path
{
    /**
<<<<<<< HEAD
     * Normalizes the given path
=======
     * Normalizes the given path.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $path
     *
     * @return string
     */
    public static function normalize($path)
    {
<<<<<<< HEAD
        $path   = str_replace('\\', '/', $path);
        $prefix = static::getAbsolutePrefix($path);
        $path   = substr($path, strlen($prefix));
        $parts  = array_filter(explode('/', $path), 'strlen');
=======
        $path = str_replace('\\', '/', $path);
        $prefix = static::getAbsolutePrefix($path);
        $path = substr($path, strlen($prefix));
        $parts = array_filter(explode('/', $path), 'strlen');
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        $tokens = array();

        foreach ($parts as $part) {
            switch ($part) {
                case '.':
                    continue;
                case '..':
                    if (0 !== count($tokens)) {
                        array_pop($tokens);
                        continue;
                    } elseif (!empty($prefix)) {
                        continue;
                    }
                default:
                    $tokens[] = $part;
            }
        }

<<<<<<< HEAD
        return $prefix . implode('/', $tokens);
    }

    /**
     * Indicates whether the given path is absolute or not
     *
     * @param string $path A normalized path
     *
     * @return boolean
=======
        return $prefix.implode('/', $tokens);
    }

    /**
     * Indicates whether the given path is absolute or not.
     *
     * @param string $path A normalized path
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public static function isAbsolute($path)
    {
        return '' !== static::getAbsolutePrefix($path);
    }

    /**
<<<<<<< HEAD
     * Returns the absolute prefix of the given path
=======
     * Returns the absolute prefix of the given path.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $path A normalized path
     *
     * @return string
     */
    public static function getAbsolutePrefix($path)
    {
        preg_match('|^(?P<prefix>([a-zA-Z]+:)?//?)|', $path, $matches);

        if (empty($matches['prefix'])) {
            return '';
        }

        return strtolower($matches['prefix']);
    }
<<<<<<< HEAD
=======

    /**
     * Wrap native dirname function in order to handle only UNIX-style paths
     *
     * @param string $path
     *
     * @return string
     *
     * @see http://php.net/manual/en/function.dirname.php
     */
    public static function dirname($path)
    {
        return str_replace('\\', '/', \dirname($path));
    }
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
}
