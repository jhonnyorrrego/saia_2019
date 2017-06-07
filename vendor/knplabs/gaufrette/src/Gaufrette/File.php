<?php

namespace Gaufrette;

use Gaufrette\Adapter\MetadataSupporter;
use Gaufrette\Exception\FileNotFound;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Points to a file in a filesystem
=======
 * Points to a file in a filesystem.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * Points to a file in a filesystem
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 */
class File
{
    protected $key;
    protected $filesystem;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Content variable is lazy. It will not be read from filesystem until it's requested first time
=======
     * Content variable is lazy. It will not be read from filesystem until it's requested first time.
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Content variable is lazy. It will not be read from filesystem until it's requested first time
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @var mixed content
     */
    protected $content = null;

    /**
     * @var array metadata in associative array. Only for adapters that support metadata
     */
    protected $metadata = null;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Human readable filename (usually the end of the key)
=======
     * Human readable filename (usually the end of the key).
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Human readable filename (usually the end of the key)
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @var string name
     */
    protected $name = null;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * File size in bytes
=======
     * File size in bytes.
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * File size in bytes
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @var int size
     */
    protected $size = 0;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * File date modified
=======
     * File date modified.
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * File date modified
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @var int mtime
     */
    protected $mtime = null;

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
     * @param string     $key
     * @param Filesystem $filesystem
     */
    public function __construct($key, Filesystem $filesystem)
    {
        $this->key = $key;
        $this->name = $key;
        $this->filesystem = $filesystem;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Returns the key
=======
     * Returns the key.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Returns the key
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Returns the content
     *
     * @throws FileNotFound
     *
     * @param  array  $metadata optional metadata which should be send when read
<<<<<<< HEAD
=======
     * Returns the content.
     *
     * @throws FileNotFound
     *
     * @param array $metadata optional metadata which should be set when read
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @return string
     */
    public function getContent($metadata = array())
    {
        if (isset($this->content)) {
            return $this->content;
        }
        $this->setMetadata($metadata);

        return $this->content = $this->filesystem->read($this->key);
    }

    /**
     * @return string name of the file
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int size of the file
     */
    public function getSize()
    {
        if ($this->size) {
            return $this->size;
        }

        try {
            return $this->size = $this->filesystem->size($this->getKey());
        } catch (FileNotFound $exception) {
        }

        return 0;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Returns the file modified time
     *
     * @return int
     */    
<<<<<<< HEAD
=======
     * Returns the file modified time.
     *
     * @return int
     */
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
    public function getMtime()
    {
        return $this->mtime = $this->filesystem->mtime($this->key);
    }

    /**
     * @param int $size size of the file
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Sets the content
=======
     * Sets the content.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Sets the content
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $content
     * @param array  $metadata optional metadata which should be send when write
     *
<<<<<<< HEAD
<<<<<<< HEAD
     * @return integer The number of bytes that were written into the file, or
     *                 FALSE on failure
=======
     * @return int The number of bytes that were written into the file, or
     *             FALSE on failure
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @return integer The number of bytes that were written into the file, or
     *                 FALSE on failure
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function setContent($content, $metadata = array())
    {
        $this->content = $content;
        $this->setMetadata($metadata);

        return $this->size = $this->filesystem->write($this->key, $this->content, true);
    }

    /**
     * @param string $name name of the file
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Indicates whether the file exists in the filesystem
     *
     * @return boolean
=======
     * Indicates whether the file exists in the filesystem.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Indicates whether the file exists in the filesystem
     *
     * @return boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function exists()
    {
        return $this->filesystem->has($this->key);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Deletes the file from the filesystem
     *
     * @throws FileNotFound
     * @throws \RuntimeException                when cannot delete file
     * @param  array                            $metadata optional metadata which should be send when write
     * @return boolean                          TRUE on success
<<<<<<< HEAD
=======
     * Deletes the file from the filesystem.
     *
     * @throws FileNotFound
     * @throws \RuntimeException when cannot delete file
     *
     * @param array $metadata optional metadata which should be send when write
     *
     * @return bool TRUE on success
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function delete($metadata = array())
    {
        $this->setMetadata($metadata);

        return $this->filesystem->delete($this->key);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Creates a new file stream instance of the file
=======
     * Creates a new file stream instance of the file.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Creates a new file stream instance of the file
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @return Stream
     */
    public function createStream()
    {
        return $this->filesystem->createStream($this->key);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Sets the metadata array to be stored in adapters that can support it
     *
     * @param  array   $metadata
     * @return boolean
<<<<<<< HEAD
=======
     * Sets the metadata array to be stored in adapters that can support it.
     *
     * @param array $metadata
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    protected function setMetadata(array $metadata)
    {
        if ($metadata && $this->supportsMetadata()) {
            $this->filesystem->getAdapter()->setMetadata($this->key, $metadata);

            return true;
        }

        return false;
    }

    /**
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
    private function supportsMetadata()
    {
        return $this->filesystem->getAdapter() instanceof MetadataSupporter;
    }
}
