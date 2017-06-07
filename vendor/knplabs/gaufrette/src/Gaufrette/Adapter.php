<?php

namespace Gaufrette;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Interface for the filesystem adapters
=======
 * Interface for the filesystem adapters.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * Interface for the filesystem adapters
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
interface Adapter
{
    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Reads the content of the file
     *
     * @param string $key
     *
     * @return string|boolean if cannot read content
<<<<<<< HEAD
=======
     * Reads the content of the file.
     *
     * @param string $key
     *
     * @return string|bool if cannot read content
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function read($key);

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Writes the given content into the file
=======
     * Writes the given content into the file.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Writes the given content into the file
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $key
     * @param string $content
     *
<<<<<<< HEAD
<<<<<<< HEAD
     * @return integer|boolean The number of bytes that were written into the file
=======
     * @return int|bool The number of bytes that were written into the file
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @return integer|boolean The number of bytes that were written into the file
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function write($key, $content);

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Indicates whether the file exists
     *
     * @param string $key
     *
     * @return boolean
<<<<<<< HEAD
=======
     * Indicates whether the file exists.
     *
     * @param string $key
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function exists($key);

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Returns an array of all keys (files and directories)
=======
     * Returns an array of all keys (files and directories).
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Returns an array of all keys (files and directories)
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @return array
     */
    public function keys();

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Returns the last modified time
     *
     * @param string $key
     *
     * @return integer|boolean An UNIX like timestamp or false
<<<<<<< HEAD
=======
     * Returns the last modified time.
     *
     * @param string $key
     *
     * @return int|bool An UNIX like timestamp or false
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function mtime($key);

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Deletes the file
     *
     * @param string $key
     *
     * @return boolean
<<<<<<< HEAD
=======
     * Deletes the file.
     *
     * @param string $key
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function delete($key);

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Renames a file
=======
     * Renames a file.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Renames a file
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $sourceKey
     * @param string $targetKey
     *
<<<<<<< HEAD
<<<<<<< HEAD
     * @return boolean
=======
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @return boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function rename($sourceKey, $targetKey);

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Check if key is directory
     *
     * @param string $key
     *
     * @return boolean
<<<<<<< HEAD
=======
     * Check if key is directory.
     *
     * @param string $key
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function isDirectory($key);
}
