<?php

namespace Gaufrette;

use Gaufrette\Adapter\ListKeysAware;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * A filesystem is used to store and retrieve files
=======
 * A filesystem is used to store and retrieve files.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * A filesystem is used to store and retrieve files
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
class Filesystem
{
    protected $adapter;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Contains File objects created with $this->createFile() method
=======
     * Contains File objects created with $this->createFile() method.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Contains File objects created with $this->createFile() method
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @var array
     */
    protected $fileRegister = array();

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Constructor
     *
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @param Adapter $adapter A configured Adapter instance
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Returns the adapter
=======
     * Returns the adapter.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Returns the adapter
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @return Adapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Indicates whether the file matching the specified key exists
     *
     * @param string $key
     *
     * @return boolean TRUE if the file exists, FALSE otherwise
     */
    public function has($key)
    {
<<<<<<< HEAD
=======
     * Indicates whether the file matching the specified key exists.
     *
     * @param string $key
     *
     * @return bool TRUE if the file exists, FALSE otherwise
     *
     * @throws \InvalidArgumentException If $key is invalid
     */
    public function has($key)
    {
        self::assertValidKey($key);

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        return $this->adapter->exists($key);
    }

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
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @return boolean                  TRUE if the rename was successful
     * @throws Exception\FileNotFound   when sourceKey does not exist
     * @throws Exception\UnexpectedFile when targetKey exists
     * @throws \RuntimeException        when cannot rename
     */
    public function rename($sourceKey, $targetKey)
    {
<<<<<<< HEAD
=======
     * @return bool TRUE if the rename was successful
     *
     * @throws Exception\FileNotFound    when sourceKey does not exist
     * @throws Exception\UnexpectedFile  when targetKey exists
     * @throws \RuntimeException         when cannot rename
     * @throws \InvalidArgumentException If $sourceKey or $targetKey are invalid
     */
    public function rename($sourceKey, $targetKey)
    {
        self::assertValidKey($sourceKey);
        self::assertValidKey($targetKey);

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $this->assertHasFile($sourceKey);

        if ($this->has($targetKey)) {
            throw new Exception\UnexpectedFile($targetKey);
        }

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        if (! $this->adapter->rename($sourceKey, $targetKey)) {
            throw new \RuntimeException(sprintf('Could not rename the "%s" key to "%s".', $sourceKey, $targetKey));
        }

        if($this->isFileInRegister($sourceKey)) {
<<<<<<< HEAD
=======
        if (!$this->adapter->rename($sourceKey, $targetKey)) {
            throw new \RuntimeException(sprintf('Could not rename the "%s" key to "%s".', $sourceKey, $targetKey));
        }

        if ($this->isFileInRegister($sourceKey)) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            $this->fileRegister[$targetKey] = $this->fileRegister[$sourceKey];
            unset($this->fileRegister[$sourceKey]);
        }

        return true;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Returns the file matching the specified key
     *
     * @param string  $key    Key of the file
     * @param boolean $create Whether to create the file if it does not exist
     *
     * @throws Exception\FileNotFound
<<<<<<< HEAD
=======
     * Returns the file matching the specified key.
     *
     * @param string $key    Key of the file
     * @param bool   $create Whether to create the file if it does not exist
     *
     * @throws Exception\FileNotFound
     * @throws \InvalidArgumentException If $key is invalid
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @return File
     */
    public function get($key, $create = false)
    {
<<<<<<< HEAD
<<<<<<< HEAD
=======
        self::assertValidKey($key);

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        if (!$create) {
            $this->assertHasFile($key);
        }

        return $this->createFile($key);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Writes the given content into the file
     *
     * @param string  $key                 Key of the file
     * @param string  $content             Content to write in the file
     * @param boolean $overwrite           Whether to overwrite the file if exists
     * @throws Exception\FileAlreadyExists When file already exists and overwrite is false
     * @throws \RuntimeException           When for any reason content could not be written
     *
     * @return integer The number of bytes that were written into the file
     */
    public function write($key, $content, $overwrite = false)
    {
<<<<<<< HEAD
=======
     * Writes the given content into the file.
     *
     * @param string $key       Key of the file
     * @param string $content   Content to write in the file
     * @param bool   $overwrite Whether to overwrite the file if exists
     *
     * @throws Exception\FileAlreadyExists When file already exists and overwrite is false
     * @throws \RuntimeException           When for any reason content could not be written
     * @throws \InvalidArgumentException   If $key is invalid
     *
     * @return int The number of bytes that were written into the file
     */
    public function write($key, $content, $overwrite = false)
    {
        self::assertValidKey($key);

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        if (!$overwrite && $this->has($key)) {
            throw new Exception\FileAlreadyExists($key);
        }

        $numBytes = $this->adapter->write($key, $content);

        if (false === $numBytes) {
            throw new \RuntimeException(sprintf('Could not write the "%s" key content.', $key));
        }

        return $numBytes;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Reads the content from the file
     *
     * @param  string                 $key Key of the file
     * @throws Exception\FileNotFound when file does not exist
     * @throws \RuntimeException      when cannot read file
<<<<<<< HEAD
=======
     * Reads the content from the file.
     *
     * @param string $key Key of the file
     *
     * @throws Exception\FileNotFound    when file does not exist
     * @throws \RuntimeException         when cannot read file
     * @throws \InvalidArgumentException If $key is invalid
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @return string
     */
    public function read($key)
    {
<<<<<<< HEAD
<<<<<<< HEAD
=======
        self::assertValidKey($key);

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $this->assertHasFile($key);

        $content = $this->adapter->read($key);

        if (false === $content) {
            throw new \RuntimeException(sprintf('Could not read the "%s" key content.', $key));
        }

        return $content;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Deletes the file matching the specified key
     *
     * @param string $key
     * @throws \RuntimeException when cannot read file
     *
     * @return boolean
     */
    public function delete($key)
    {
<<<<<<< HEAD
=======
     * Deletes the file matching the specified key.
     *
     * @param string $key
     *
     * @throws \RuntimeException         when cannot read file
     * @throws \InvalidArgumentException If $key is invalid
     *
     * @return bool
     */
    public function delete($key)
    {
        self::assertValidKey($key);

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $this->assertHasFile($key);

        if ($this->adapter->delete($key)) {
            $this->removeFromRegister($key);
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            return true;
        }

        throw new \RuntimeException(sprintf('Could not remove the "%s" key.', $key));
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Returns an array of all keys
=======
     * Returns an array of all keys.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Returns an array of all keys
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @return array
     */
    public function keys()
    {
        return $this->adapter->keys();
    }

    /**
     * Lists keys beginning with given prefix
<<<<<<< HEAD
<<<<<<< HEAD
     * (no wildcard / regex matching)
=======
     * (no wildcard / regex matching).
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * (no wildcard / regex matching)
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * if adapter implements ListKeysAware interface, adapter's implementation will be used,
     * in not, ALL keys will be requested and iterated through.
     *
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  string $prefix
=======
     * @param string $prefix
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @param  string $prefix
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @return array
     */
    public function listKeys($prefix = '')
    {
        if ($this->adapter instanceof ListKeysAware) {
            return $this->adapter->listKeys($prefix);
        }

        $dirs = array();
        $keys = array();

        foreach ($this->keys() as $key) {
            if (empty($prefix) || 0 === strpos($key, $prefix)) {
                if ($this->adapter->isDirectory($key)) {
                    $dirs[] = $key;
                } else {
                    $keys[] = $key;
                }
            }
        }

        return array(
            'keys' => $keys,
<<<<<<< HEAD
<<<<<<< HEAD
            'dirs' => $dirs
=======
            'dirs' => $dirs,
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
            'dirs' => $dirs
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        );
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Returns the last modified time of the specified file
     *
     * @param string $key
     *
     * @return integer An UNIX like timestamp
     */
    public function mtime($key)
    {
<<<<<<< HEAD
=======
     * Returns the last modified time of the specified file.
     *
     * @param string $key
     *
     * @return int An UNIX like timestamp
     *
     * @throws \InvalidArgumentException If $key is invalid
     */
    public function mtime($key)
    {
        self::assertValidKey($key);

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $this->assertHasFile($key);

        return $this->adapter->mtime($key);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Returns the checksum of the specified file's content
=======
     * Returns the checksum of the specified file's content.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Returns the checksum of the specified file's content
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $key
     *
     * @return string A MD5 hash
<<<<<<< HEAD
<<<<<<< HEAD
     */
    public function checksum($key)
    {
=======
     *
     * @throws \InvalidArgumentException If $key is invalid
     */
    public function checksum($key)
    {
        self::assertValidKey($key);

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     */
    public function checksum($key)
    {
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $this->assertHasFile($key);

        if ($this->adapter instanceof Adapter\ChecksumCalculator) {
            return $this->adapter->checksum($key);
        }

        return Util\Checksum::fromContent($this->read($key));
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Returns the size of the specified file's content
     *
     * @param string $key
     *
     * @return integer File size in Bytes
     */
    public function size($key)
    {
<<<<<<< HEAD
=======
     * Returns the size of the specified file's content.
     *
     * @param string $key
     *
     * @return int File size in Bytes
     *
     * @throws \InvalidArgumentException If $key is invalid
     */
    public function size($key)
    {
        self::assertValidKey($key);

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $this->assertHasFile($key);

        if ($this->adapter instanceof Adapter\SizeCalculator) {
            return $this->adapter->size($key);
        }

        return Util\Size::fromContent($this->read($key));
    }

    /**
     * Gets a new stream instance of the specified file.
     *
     * @param $key
<<<<<<< HEAD
<<<<<<< HEAD
     * @return Stream|Stream\InMemoryBuffer
     */
    public function createStream($key)
    {
=======
     *
     * @return Stream|Stream\InMemoryBuffer
     *
     * @throws \InvalidArgumentException If $key is invalid
     */
    public function createStream($key)
    {
        self::assertValidKey($key);

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @return Stream|Stream\InMemoryBuffer
     */
    public function createStream($key)
    {
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        if ($this->adapter instanceof Adapter\StreamFactory) {
            return $this->adapter->createStream($key);
        }

        return new Stream\InMemoryBuffer($this, $key);
    }

    /**
     * Creates a new file in a filesystem.
     *
     * @param $key
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @return File
     */
    public function createFile($key)
    {
        if(false === $this->isFileInRegister($key)) {
<<<<<<< HEAD
=======
     *
     * @return File
     *
     * @throws \InvalidArgumentException If $key is invalid
     */
    public function createFile($key)
    {
        self::assertValidKey($key);

        if (false === $this->isFileInRegister($key)) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            if ($this->adapter instanceof Adapter\FileFactory) {
                $this->fileRegister[$key] = $this->adapter->createFile($key, $this);
            } else {
                $this->fileRegister[$key] = new File($key, $this);
            }
        }

        return $this->fileRegister[$key];
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Get the mime type of the provided key
=======
     * Get the mime type of the provided key.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Get the mime type of the provided key
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $key
     *
     * @return string
<<<<<<< HEAD
<<<<<<< HEAD
     */
    public function mimeType($key)
    {
=======
     *
     * @throws \InvalidArgumentException If $key is invalid
     */
    public function mimeType($key)
    {
        self::assertValidKey($key);

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     */
    public function mimeType($key)
    {
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $this->assertHasFile($key);

        if ($this->adapter instanceof Adapter\MimeTypeProvider) {
            return $this->adapter->mimeType($key);
        }

        throw new \LogicException(sprintf(
            'Adapter "%s" cannot provide MIME type',
            get_class($this->adapter)
        ));
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Checks if matching file by given key exists in the filesystem
=======
     * Checks if matching file by given key exists in the filesystem.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Checks if matching file by given key exists in the filesystem
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * Key must be non empty string, otherwise it will throw Exception\FileNotFound
     * {@see http://php.net/manual/en/function.empty.php}
     *
     * @param string $key
     *
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @throws Exception\FileNotFound   when sourceKey does not exist
     */
    private function assertHasFile($key)
    {
        if (! empty($key) && ! $this->has($key)) {
<<<<<<< HEAD
=======
     * @throws Exception\FileNotFound when sourceKey does not exist
     */
    private function assertHasFile($key)
    {
        if (!$this->has($key)) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            throw new Exception\FileNotFound($key);
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Checks if matching File object by given key exists in the fileRegister
=======
     * Checks if matching File object by given key exists in the fileRegister.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Checks if matching File object by given key exists in the fileRegister
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $key
     *
     * @return bool
     */
    private function isFileInRegister($key)
    {
        return array_key_exists($key, $this->fileRegister);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Clear files register
=======
     * Clear files register.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Clear files register
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function clearFileRegister()
    {
        $this->fileRegister = array();
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Removes File object from register
=======
     * Removes File object from register.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Removes File object from register
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $key
     */
    public function removeFromRegister($key)
    {
        if ($this->isFileInRegister($key)) {
            unset($this->fileRegister[$key]);
        }
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function isDirectory($key)
    {
        return $this->adapter->isDirectory($key);
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======

    /**
     * @param string $key
     *
     * @throws \InvalidArgumentException Given $key should not be empty
     */
    private static function assertValidKey($key)
    {
        if (empty($key)) {
            throw new \InvalidArgumentException('Object path is empty.');
        }
    }
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
}
