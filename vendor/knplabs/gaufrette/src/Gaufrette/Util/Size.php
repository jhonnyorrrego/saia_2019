<?php

namespace Gaufrette\Util;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Utility class for file sizes
=======
 * Utility class for file sizes.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * Utility class for file sizes
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 */
class Size
{
    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Returns the size in bytes from the given content
     *
     * @param string $content
     *
     * @return integer
<<<<<<< HEAD
=======
     * Returns the size in bytes from the given content.
     *
     * @param string $content
     *
     * @return int
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @todo handle the case the mbstring is not loaded
     */
    public static function fromContent($content)
    {
        // Make sure to get the real length in byte and not
        // accidentally mistake some bytes as a UTF BOM.
        return mb_strlen($content, '8bit');
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Returns the size in bytes from the given file
     *
     * @param string $filename
     *
     * @return string
<<<<<<< HEAD
=======
     * Returns the size in bytes from the given file.
     *
     * @param string $filename
     *
     * @return int
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public static function fromFile($filename)
    {
        return filesize($filename);
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======

    /**
     * Returns the size in bytes from the given resource.
     *
     * @param resource $handle
     *
     * @return string
     */
    public static function fromResource($handle)
    {
        $cStat = fstat($handle);
        // if the resource is a remote file, $cStat will be false
        return $cStat ? $cStat['size'] : 0;
    }
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
}
