<?php

namespace Gaufrette\Util;

/**
<<<<<<< HEAD
 * Checksum utils
=======
 * Checksum utils.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author  Antoine Hérault <antoine.herault@gmail.com>
 */
class Checksum
{
    /**
<<<<<<< HEAD
     * Returns the checksum of the given content
=======
     * Returns the checksum of the given content.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $content
     *
     * @return string
     */
    public static function fromContent($content)
    {
        return md5($content);
    }

    /**
<<<<<<< HEAD
     * Returns the checksum of the specified file
=======
     * Returns the checksum of the specified file.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $filename
     *
     * @return string
     */
    public static function fromFile($filename)
    {
        return md5_file($filename);
    }
}
