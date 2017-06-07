<?php

namespace Gaufrette\Util;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Checksum utils
=======
 * Checksum utils.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * Checksum utils
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author  Antoine Hérault <antoine.herault@gmail.com>
 */
class Checksum
{
    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Returns the checksum of the given content
=======
     * Returns the checksum of the given content.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Returns the checksum of the given content
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
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
<<<<<<< HEAD
     * Returns the checksum of the specified file
=======
     * Returns the checksum of the specified file.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Returns the checksum of the specified file
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
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
