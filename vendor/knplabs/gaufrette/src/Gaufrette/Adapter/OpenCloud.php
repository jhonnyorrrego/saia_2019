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
<<<<<<< HEAD
 * OpenCloud adapter
 *
 * @package Gaufrette
=======
 * OpenCloud adapter.
 *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * OpenCloud adapter
 *
 * @package Gaufrette
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
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
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Constructor
     *
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @param Service $objectStore
     * @param string  $containerName   The name of the container
     * @param bool    $createContainer Whether to create the container if it does not exist
     */
    public function __construct(Service $objectStore, $containerName, $createContainer = false)
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $this->objectStore     = $objectStore;
        $this->containerName   = $containerName;
=======
        $this->objectStore = $objectStore;
        $this->containerName = $containerName;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $this->objectStore     = $objectStore;
        $this->containerName   = $containerName;
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $this->createContainer = $createContainer;
    }

    /**
<<<<<<< HEAD
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
=======
     * Returns an initialized container
     *
     * @throws \RuntimeException
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
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
    public function read($key)
    {
        if ($object = $this->tryGetObject($key)) {
            return $object->getContent();
        }

        return false;
    }

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
    public function write($key, $content)
    {
        try {
            $object = $this->getContainer()->uploadObject($key, $content);
<<<<<<< HEAD
<<<<<<< HEAD
        }
        catch (CreateUpdateError $updateError) {
=======
        } catch (CreateUpdateError $updateError) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        }
        catch (CreateUpdateError $updateError) {
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            return false;
        }

        return $object->getContentLength();
    }

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
    public function keys()
    {
        $objectList = $this->getContainer()->objectList();
<<<<<<< HEAD
<<<<<<< HEAD
        $keys = array ();
=======
        $keys = array();
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $keys = array ();
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

        while ($object = $objectList->next()) {
            $keys[] = $object->getName();
        }

        sort($keys);

        return $keys;
    }

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
    public function mtime($key)
    {
        if ($object = $this->tryGetObject($key)) {
            return $object->getLastModified();
        }

        return false;
    }

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
    public function delete($key)
    {
        if (!$object = $this->tryGetObject($key)) {
            return false;
        }

        try {
            $object->delete();
<<<<<<< HEAD
<<<<<<< HEAD
        }
        catch (DeleteError $deleteError) {
=======
        } catch (DeleteError $deleteError) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        }
        catch (DeleteError $deleteError) {
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            return false;
        }

        return true;
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
     * @return boolean
=======
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @return boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
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
    public function isDirectory($key)
    {
        return false;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Returns the checksum of the specified key
=======
     * Returns the checksum of the specified key.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Returns the checksum of the specified key
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
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
<<<<<<< HEAD
        }
        catch (ObjectNotFoundException $objFetchError) {
=======
        } catch (ObjectNotFoundException $objFetchError) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        }
        catch (ObjectNotFoundException $objFetchError) {
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            return false;
        }
    }
}
