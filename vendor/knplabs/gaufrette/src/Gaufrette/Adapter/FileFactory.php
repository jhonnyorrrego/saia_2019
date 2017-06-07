<?php

namespace Gaufrette\Adapter;

use Gaufrette\Filesystem;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Interface for the file creation class
=======
 * Interface for the file creation class.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * Interface for the file creation class
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
interface FileFactory
{
    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Creates a new File instance and returns it
=======
     * Creates a new File instance and returns it.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Creates a new File instance and returns it
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string     $key
     * @param Filesystem $filesystem
     *
     * @return File
     */
    public function createFile($key, Filesystem $filesystem);
}
