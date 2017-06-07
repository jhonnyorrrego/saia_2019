<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Guzzle\Http\Exception\BadResponseException;
use OpenCloud\Common\Exceptions\DeleteError;
use OpenCloud\ObjectStore\Resource\Container;
use OpenCloud\ObjectStore\Service;
use OpenCloud\Common\Exceptions\CreateUpdateError;
use OpenCloud\ObjectStore\Exception\ObjectNotFoundException;

/**
<<<<<<< HEAD
 * OpenCloud adapter
 *
 * @package Gaufrette
=======
 * OpenCloud adapter.
 *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 * @author  James Watson <james@sitepulse.org>
 * @author  Daniel Richter <nexyz9@gmail.com>
 */
class OpenCloud implements Adapter,
                           ChecksumCalculator
{
    /**
     * @var Service
     */
    protected $objectStore;

    /**
     * @var string
     */
    protected $containerName;

    /**
     * @var bool
     */
    protected $createContainer;

    /**
     * @var Container
     */
    protected $container;

    /**
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @param Service $objectStore
     * @param string  $containerName   The name of the container
     * @param bool    $createContainer Whether to create the container if it does not exist
     */
    public function __construct(Service $objectStore, $containerName, $createContainer = false)
    {
<<<<<<< HEAD
        $this->objectStore     = $objectStore;
        $this->containerName   = $containerName;
=======
        $this->objectStore = $objectStore;
        $this->containerName = $containerName;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        $this->createContainer = $createContainer;
    }

    /**
<<<<<<< HEAD
     * Returns an initialized container
     *
     * @throws \RuntimeException
=======
     * Returns an initialized container.
     *
     * @throws \RuntimeException
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @return Container
     */
    protected function getContainer()
    {
        if ($this->container) {
            return $this->container;
        }

        try {
            return $this->container = $this->objectStore->getContainer($this->containerName);
        } catch (BadResponseException $e) { //OpenCloud lib does not wrap this exception
            if (!$this->createContainer) {
                throw new \RuntimeException(sprintf('Container "%s" does not exist.', $this->containerName));
            }
        }

        if (!$container = $this->objectStore->createContainer($this->containerName)) {
            throw new \RuntimeException(sprintf('Container "%s" could not be created.', $this->containerName));
        }

        return $this->container = $container;
    }

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
    public function read($key)
    {
        if ($object = $this->tryGetObject($key)) {
            return $object->getContent();
        }

        return false;
    }

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
    public function write($key, $content)
    {
        try {
            $object = $this->getContainer()->uploadObject($key, $content);
<<<<<<< HEAD
        }
        catch (CreateUpdateError $updateError) {
=======
        } catch (CreateUpdateError $updateError) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            return false;
        }

        return $object->getContentLength();
    }

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
    public function exists($key)
    {
        try {
            $exists = $this->getContainer()->getPartialObject($key) !== false;
        } catch (BadResponseException $objFetchError) {
            return false;
        }

        return $exists;
    }

    /**
<<<<<<< HEAD
     * Returns an array of all keys (files and directories)
=======
     * Returns an array of all keys (files and directories).
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @return array
     */
    public function keys()
    {
        $objectList = $this->getContainer()->objectList();
<<<<<<< HEAD
        $keys = array ();
=======
        $keys = array();
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744

        while ($object = $objectList->next()) {
            $keys[] = $object->getName();
        }

        sort($keys);

        return $keys;
    }

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
    public function mtime($key)
    {
        if ($object = $this->tryGetObject($key)) {
            return $object->getLastModified();
        }

        return false;
    }

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
    public function delete($key)
    {
        if (!$object = $this->tryGetObject($key)) {
            return false;
        }

        try {
            $object->delete();
<<<<<<< HEAD
        }
        catch (DeleteError $deleteError) {
=======
        } catch (DeleteError $deleteError) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            return false;
        }

        return true;
    }

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
    public function rename($sourceKey, $targetKey)
    {
        if (false !== $this->write($targetKey, $this->read($sourceKey))) {
            $this->delete($sourceKey);

            return true;
        }

        return false;
    }

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
    public function isDirectory($key)
    {
        return false;
    }

    /**
<<<<<<< HEAD
     * Returns the checksum of the specified key
=======
     * Returns the checksum of the specified key.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $key
     *
     * @return string
     */
    public function checksum($key)
    {
        if ($object = $this->tryGetObject($key)) {
            return $object->getETag();
        }

        return false;
    }

    /**
     * @param string $key
     *
     * @return \OpenCloud\ObjectStore\Resource\DataObject|false
     */
    protected function tryGetObject($key)
    {
        try {
            return $this->getContainer()->getObject($key);
<<<<<<< HEAD
        }
        catch (ObjectNotFoundException $objFetchError) {
=======
        } catch (ObjectNotFoundException $objFetchError) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            return false;
        }
    }
}
