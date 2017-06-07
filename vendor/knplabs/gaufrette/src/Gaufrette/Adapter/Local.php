<?php

namespace Gaufrette\Adapter;

use Gaufrette\Util;
use Gaufrette\Adapter;
use Gaufrette\Stream;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
use Gaufrette\Adapter\StreamFactory;
use Gaufrette\Exception;

/**
 * Adapter for the local filesystem
<<<<<<< HEAD
=======


/**
 * Adapter for the local filesystem.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
class Local implements Adapter,
                       StreamFactory,
                       ChecksumCalculator,
                       SizeCalculator,
                       MimeTypeProvider
{
    protected $directory;
    private $create;
    private $mode;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Constructor
     *
     * @param string  $directory Directory where the filesystem is located
     * @param boolean $create    Whether to create the directory if it does not
     *                            exist (default FALSE)
     * @param integer $mode      Mode for mkdir
<<<<<<< HEAD
=======
     * @param string $directory Directory where the filesystem is located
     * @param bool   $create    Whether to create the directory if it does not
     *                          exist (default FALSE)
     * @param int    $mode      Mode for mkdir
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @throws RuntimeException if the specified directory does not exist and
     *                          could not be created
     */
    public function __construct($directory, $create = false, $mode = 0777)
    {
        $this->directory = Util\Path::normalize($directory);

        if (is_link($this->directory)) {
            $this->directory = realpath($this->directory);
        }

        $this->create = $create;
        $this->mode = $mode;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function read($key)
    {
        return file_get_contents($this->computePath($key));
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function write($key, $content)
    {
        $path = $this->computePath($key);
<<<<<<< HEAD
<<<<<<< HEAD
        $this->ensureDirectoryExists(dirname($path), true);
=======
        $this->ensureDirectoryExists(\Gaufrette\Util\Path::dirname($path), true);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $this->ensureDirectoryExists(dirname($path), true);
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

        return file_put_contents($path, $content);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function rename($sourceKey, $targetKey)
    {
        $targetPath = $this->computePath($targetKey);
<<<<<<< HEAD
<<<<<<< HEAD
        $this->ensureDirectoryExists(dirname($targetPath), true);
=======
        $this->ensureDirectoryExists(\Gaufrette\Util\Path::dirname($targetPath), true);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $this->ensureDirectoryExists(dirname($targetPath), true);
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

        return rename($this->computePath($sourceKey), $targetPath);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function exists($key)
    {
        return file_exists($this->computePath($key));
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function keys()
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

        try {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator(
                    $this->directory,
                    \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::UNIX_PATHS
                ),
                \RecursiveIteratorIterator::CHILD_FIRST
            );
        } catch (\Exception $e) {
<<<<<<< HEAD
<<<<<<< HEAD
            $files = new \EmptyIterator;
=======
            $files = new \EmptyIterator();
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
            $files = new \EmptyIterator;
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        }

        $keys = array();
        foreach ($files as $file) {
            $keys[] = $this->computeKey($file);
        }
        sort($keys);

        return $keys;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function mtime($key)
    {
        return filemtime($this->computePath($key));
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function delete($key)
    {
        if ($this->isDirectory($key)) {
            return rmdir($this->computePath($key));
        }

        return unlink($this->computePath($key));
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  string  $key
     * @return boolean
=======
     * @param string $key
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @param  string  $key
     * @return boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function isDirectory($key)
    {
        return is_dir($this->computePath($key));
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function createStream($key)
    {
        return new Stream\Local($this->computePath($key));
    }

    /**
     * {@inheritdoc}
     */
    public function checksum($key)
    {
        return Util\Checksum::fromFile($this->computePath($key));
    }

    /**
     * {@inheritdoc}
     */
    public function size($key)
    {
        return Util\Size::fromFile($this->computePath($key));
    }

    /**
     * {@inheritdoc}
     */
    public function mimeType($key)
    {
        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);

        return $fileInfo->file($this->computePath($key));
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Computes the key from the specified path
=======
     * Computes the key from the specified path.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Computes the key from the specified path
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $path
     *
     * return string
     */
    public function computeKey($path)
    {
        $path = $this->normalizePath($path);

        return ltrim(substr($path, strlen($this->directory)), '/');
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Computes the path from the specified key
=======
     * Computes the path from the specified key.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Computes the path from the specified key
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $key The key which for to compute the path
     *
     * @return string A path
     *
     * @throws OutOfBoundsException If the computed path is out of the
     *                              directory
<<<<<<< HEAD
<<<<<<< HEAD
     * @throws RuntimeException If directory does not exists and cannot be created
=======
     * @throws RuntimeException     If directory does not exists and cannot be created
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @throws RuntimeException If directory does not exists and cannot be created
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    protected function computePath($key)
    {
        $this->ensureDirectoryExists($this->directory, $this->create);

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        return $this->normalizePath($this->directory . '/' . $key);
    }

    /**
     * Normalizes the given path
<<<<<<< HEAD
=======
        return $this->normalizePath($this->directory.'/'.$key);
    }

    /**
     * Normalizes the given path.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $path
     *
     * @return string
     */
    protected function normalizePath($path)
    {
        $path = Util\Path::normalize($path);

        if (0 !== strpos($path, $this->directory)) {
            throw new \OutOfBoundsException(sprintf('The path "%s" is out of the filesystem.', $path));
        }

        return $path;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Ensures the specified directory exists, creates it if it does not
     *
     * @param string  $directory Path of the directory to test
     * @param boolean $create    Whether to create the directory if it does
     *                            not exist
<<<<<<< HEAD
=======
     * Ensures the specified directory exists, creates it if it does not.
     *
     * @param string $directory Path of the directory to test
     * @param bool   $create    Whether to create the directory if it does
     *                          not exist
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @throws RuntimeException if the directory does not exists and could not
     *                          be created
     */
    protected function ensureDirectoryExists($directory, $create = false)
    {
        if (!is_dir($directory)) {
            if (!$create) {
                throw new \RuntimeException(sprintf('The directory "%s" does not exist.', $directory));
            }

            $this->createDirectory($directory);
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Creates the specified directory and its parents
=======
     * Creates the specified directory and its parents.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Creates the specified directory and its parents
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $directory Path of the directory to create
     *
     * @throws InvalidArgumentException if the directory already exists
     * @throws RuntimeException         if the directory could not be created
     */
    protected function createDirectory($directory)
    {
        $created = mkdir($directory, $this->mode, true);

        if (!$created) {
            if (!is_dir($directory)) {
                throw new \RuntimeException(sprintf('The directory \'%s\' could not be created.', $directory));
            }
        }
    }
}
