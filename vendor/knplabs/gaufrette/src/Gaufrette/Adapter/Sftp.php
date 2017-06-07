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
     * Constructor
     *
     * @param \Ssh\Sftp $sftp      An Sftp instance
     * @param string    $directory The distant directory
     * @param boolean   $create    Whether to create the remote directory if it
=======
     * @param \Ssh\Sftp $sftp      An Sftp instance
     * @param string    $directory The distant directory
     * @param bool      $create    Whether to create the remote directory if it
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *                             does not exist
     */
    public function __construct(SftpClient $sftp, $directory = null, $create = false)
    {
<<<<<<< HEAD
        $this->sftp      = $sftp;
        $this->directory = $directory;
        $this->create    = $create;
    }

    /**
     * {@inheritDoc}
=======
        $this->sftp = $sftp;
        $this->directory = $directory;
        $this->create = $create;
    }

    /**
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function read($key)
    {
        $this->initialize();

        $content = $this->sftp->read($this->computePath($key));

        return $content;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function rename($sourceKey, $targetKey)
    {
        $sourcePath = $this->computePath($sourceKey);
        $targetPath = $this->computePath($targetKey);

<<<<<<< HEAD
        $this->ensureDirectoryExists(dirname($targetPath), true);
=======
        $this->ensureDirectoryExists(\Gaufrette\Util\Path::dirname($targetPath), true);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744

        return $this->sftp->rename($sourcePath, $targetPath);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function write($key, $content)
    {
        $this->initialize();

        $path = $this->computePath($key);
<<<<<<< HEAD
        $this->ensureDirectoryExists(dirname($path), true);
=======
        $this->ensureDirectoryExists(\Gaufrette\Util\Path::dirname($path), true);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        $numBytes = $this->sftp->write($path, $content);

        return $numBytes;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
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
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function isDirectory($key)
    {
        $this->initialize();

        $url = $this->sftp->getUrl($this->computePath($key));

        return is_dir($url);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function keys()
    {
        $this->initialize();
        $results = $this->sftp->listDirectory($this->directory, true);
        $files = array_map(array($this, 'computeKey'), $results['files']);

        $dirs = array();
        foreach ($files as $file) {
<<<<<<< HEAD
            if ('.' !== dirname($file)) {
                $dirs[] = dirname($file);
=======
            if ('.' !== $dirname = \Gaufrette\Util\Path::dirname($file)) {
                $dirs[] = $dirname;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            }
        }

        $keys = array_merge($files, $dirs);
        sort($keys);

        return $keys;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function mtime($key)
    {
        $this->initialize();

        return filemtime($this->sftp->getUrl($this->computePath($key)));
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
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
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function delete($key)
    {
        $this->initialize();

        return unlink($this->sftp->getUrl($this->computePath($key)));
    }

    /**
<<<<<<< HEAD
     * Computes the key from the specified path
=======
     * Computes the key from the specified path.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
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
     * Computes the path for the specified key
=======
     * Computes the path for the specified key.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $key
     *
     * @return string
     */
    protected function computePath($key)
    {
<<<<<<< HEAD
        return $this->directory . '/' . ltrim($key, '/');
    }

    /**
     * Performs the adapter's initialization
=======
        return $this->directory.'/'.ltrim($key, '/');
    }

    /**
     * Performs the adapter's initialization.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
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
     * Ensures the specified directory exists
     *
     * @param string  $directory The directory that we ensure the existence
     * @param boolean $create    Whether to create it if it does not exist
=======
     * Ensures the specified directory exists.
     *
     * @param string $directory The directory that we ensure the existence
     * @param bool   $create    Whether to create it if it does not exist
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
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
        
=======

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        // make sure we don't leak the resource
        if (is_resource($resource)) {
            closedir($resource);
        }
    }

    /**
<<<<<<< HEAD
     * Creates the specified directory and its parents
     *
     * @param string $directory The directory to create
     *
     * @return boolean TRUE on success, or FALSE on failure
=======
     * Creates the specified directory and its parents.
     *
     * @param string $directory The directory to create
     *
     * @return bool TRUE on success, or FALSE on failure
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    protected function createDirectory($directory)
    {
        return $this->sftp->mkdir($directory, 0777, true);
    }
}
