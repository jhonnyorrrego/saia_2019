<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Ssh\Sftp as SftpClient;

class Sftp implements Adapter,
                      ChecksumCalculator
{
    protected $sftp;
    protected $directory;
    protected $create;
    protected $initialized = false;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Constructor
     *
     * @param \Ssh\Sftp $sftp      An Sftp instance
     * @param string    $directory The distant directory
     * @param boolean   $create    Whether to create the remote directory if it
<<<<<<< HEAD
=======
     * @param \Ssh\Sftp $sftp      An Sftp instance
     * @param string    $directory The distant directory
     * @param bool      $create    Whether to create the remote directory if it
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *                             does not exist
     */
    public function __construct(SftpClient $sftp, $directory = null, $create = false)
    {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $this->sftp      = $sftp;
        $this->directory = $directory;
        $this->create    = $create;
    }

    /**
     * {@inheritDoc}
<<<<<<< HEAD
=======
        $this->sftp = $sftp;
        $this->directory = $directory;
        $this->create = $create;
    }

    /**
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function read($key)
    {
        $this->initialize();

        $content = $this->sftp->read($this->computePath($key));

        return $content;
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
        $sourcePath = $this->computePath($sourceKey);
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

        return $this->sftp->rename($sourcePath, $targetPath);
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
        $this->initialize();

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
        $numBytes = $this->sftp->write($path, $content);

        return $numBytes;
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
        $this->initialize();

        $url = $this->sftp->getUrl($this->computePath($key));
        clearstatcache();

        return file_exists($url);
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
    public function isDirectory($key)
    {
        $this->initialize();

        $url = $this->sftp->getUrl($this->computePath($key));

        return is_dir($url);
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
        $this->initialize();
        $results = $this->sftp->listDirectory($this->directory, true);
        $files = array_map(array($this, 'computeKey'), $results['files']);

        $dirs = array();
        foreach ($files as $file) {
<<<<<<< HEAD
<<<<<<< HEAD
            if ('.' !== dirname($file)) {
                $dirs[] = dirname($file);
=======
            if ('.' !== $dirname = \Gaufrette\Util\Path::dirname($file)) {
                $dirs[] = $dirname;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
            if ('.' !== dirname($file)) {
                $dirs[] = dirname($file);
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            }
        }

        $keys = array_merge($files, $dirs);
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
        $this->initialize();

        return filemtime($this->sftp->getUrl($this->computePath($key)));
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
    public function checksum($key)
    {
        $this->initialize();

        if ($this->exists($key)) {
            return md5_file($this->sftp->getUrl($this->computePath($key)));
        }

        return false;
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
        $this->initialize();

        return unlink($this->sftp->getUrl($this->computePath($key)));
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
     * @return string
     */
    public function computeKey($path)
    {
        if (0 !== strpos($path, $this->directory)) {
            throw new \OutOfBoundsException(sprintf('The path \'%s\' is out of the filesystem.', $path));
        }

        return ltrim(substr($path, strlen($this->directory)), '/');
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Computes the path for the specified key
=======
     * Computes the path for the specified key.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Computes the path for the specified key
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $key
     *
     * @return string
     */
    protected function computePath($key)
    {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        return $this->directory . '/' . ltrim($key, '/');
    }

    /**
     * Performs the adapter's initialization
<<<<<<< HEAD
=======
        return $this->directory.'/'.ltrim($key, '/');
    }

    /**
     * Performs the adapter's initialization.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * It will ensure the root directory exists
     */
    protected function initialize()
    {
        if ($this->initialized) {
            return;
        }

        $this->ensureDirectoryExists($this->directory, $this->create);
        $this->initialized = true;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Ensures the specified directory exists
     *
     * @param string  $directory The directory that we ensure the existence
     * @param boolean $create    Whether to create it if it does not exist
<<<<<<< HEAD
=======
     * Ensures the specified directory exists.
     *
     * @param string $directory The directory that we ensure the existence
     * @param bool   $create    Whether to create it if it does not exist
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @throws RuntimeException if the specified directory does not exist and
     *                          could not be created
     */
    protected function ensureDirectoryExists($directory, $create = false)
    {
        $url = $this->sftp->getUrl($directory);

        $resource = @opendir($url);
        if (false === $resource && (!$create || !$this->createDirectory($directory))) {
            throw new \RuntimeException(sprintf('The directory \'%s\' does not exist and could not be created.', $directory));
        }
<<<<<<< HEAD
<<<<<<< HEAD
        
=======

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        // make sure we don't leak the resource
        if (is_resource($resource)) {
            closedir($resource);
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Creates the specified directory and its parents
     *
     * @param string $directory The directory to create
     *
     * @return boolean TRUE on success, or FALSE on failure
<<<<<<< HEAD
=======
     * Creates the specified directory and its parents.
     *
     * @param string $directory The directory to create
     *
     * @return bool TRUE on success, or FALSE on failure
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    protected function createDirectory($directory)
    {
        return $this->sftp->mkdir($directory, 0777, true);
    }
}
