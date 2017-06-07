<?php

namespace Gaufrette;

/**
<<<<<<< HEAD
 * Interface for the filesystem adapters
=======
 * Interface for the filesystem adapters.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
interface Adapter
{
    /**
<<<<<<< HEAD
     * Reads the content of the file
     *
     * @param string $key
     *
     * @return string|boolean if cannot read content
=======
     * Reads the content of the file.
     *
     * @param string $key
     *
     * @return string|bool if cannot read content
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function read($key);

    /**
<<<<<<< HEAD
     * Writes the given content into the file
=======
     * Writes the given content into the file.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $key
     * @param string $content
     *
<<<<<<< HEAD
     * @return integer|boolean The number of bytes that were written into the file
=======
     * @return int|bool The number of bytes that were written into the file
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function write($key, $content);

    /**
<<<<<<< HEAD
     * Indicates whether the file exists
     *
     * @param string $key
     *
     * @return boolean
=======
     * Indicates whether the file exists.
     *
     * @param string $key
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function exists($key);

    /**
<<<<<<< HEAD
     * Returns an array of all keys (files and directories)
=======
     * Returns an array of all keys (files and directories).
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @return array
     */
    public function keys();

    /**
<<<<<<< HEAD
     * Returns the last modified time
     *
     * @param string $key
     *
     * @return integer|boolean An UNIX like timestamp or false
=======
     * Returns the last modified time.
     *
     * @param string $key
     *
     * @return int|bool An UNIX like timestamp or false
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function mtime($key);

    /**
<<<<<<< HEAD
     * Deletes the file
     *
     * @param string $key
     *
     * @return boolean
=======
     * Deletes the file.
     *
     * @param string $key
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function delete($key);

    /**
<<<<<<< HEAD
     * Renames a file
=======
     * Renames a file.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $sourceKey
     * @param string $targetKey
     *
<<<<<<< HEAD
     * @return boolean
=======
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function rename($sourceKey, $targetKey);

    /**
<<<<<<< HEAD
     * Check if key is directory
     *
     * @param string $key
     *
     * @return boolean
=======
     * Check if key is directory.
     *
     * @param string $key
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function isDirectory($key);
}
