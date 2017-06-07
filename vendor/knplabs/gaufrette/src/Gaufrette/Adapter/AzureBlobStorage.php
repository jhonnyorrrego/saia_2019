<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Gaufrette\Util;
use Gaufrette\Adapter\AzureBlobStorage\BlobProxyFactoryInterface;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

use WindowsAzure\Blob\Models\CreateBlobOptions;
use WindowsAzure\Blob\Models\CreateContainerOptions;
use WindowsAzure\Blob\Models\DeleteContainerOptions;
use WindowsAzure\Blob\Models\ListBlobsOptions;
use WindowsAzure\Common\ServiceException;

/**
 * Microsoft Azure Blob Storage adapter
<<<<<<< HEAD
=======
use MicrosoftAzure\Storage\Blob\Models\CreateBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\DeleteContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Common\ServiceException;

/**
 * Microsoft Azure Blob Storage adapter.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Luciano Mammino <lmammino@oryzone.com>
 * @author Paweł Czyżewski <pawel.czyzewski@enginewerk.com>
 */
class AzureBlobStorage implements Adapter,
                                  MetadataSupporter
{
    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Error constants
=======
     * Error constants.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Error constants
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    const ERROR_CONTAINER_ALREADY_EXISTS = 'ContainerAlreadyExists';
    const ERROR_CONTAINER_NOT_FOUND = 'ContainerNotFound';

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * @var AzureBlobStorage\BlobProxyFactoryInterface $blobProxyFactory
=======
     * @var AzureBlobStorage\BlobProxyFactoryInterface
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @var AzureBlobStorage\BlobProxyFactoryInterface $blobProxyFactory
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    protected $blobProxyFactory;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * @var string $containerName
=======
     * @var string
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @var string $containerName
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    protected $containerName;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * @var bool $detectContentType
=======
     * @var bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @var bool $detectContentType
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    protected $detectContentType;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * @var \WindowsAzure\Blob\Internal\IBlob $blobProxy
=======
     * @var \MicrosoftAzure\Storage\Blob\Internal\IBlob
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @var \WindowsAzure\Blob\Internal\IBlob $blobProxy
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    protected $blobProxy;

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
     * @param AzureBlobStorage\BlobProxyFactoryInterface $blobProxyFactory
     * @param string                                     $containerName
     * @param bool                                       $create
     * @param bool                                       $detectContentType
     */
    public function __construct(BlobProxyFactoryInterface $blobProxyFactory, $containerName, $create = false, $detectContentType = true)
    {
        $this->blobProxyFactory = $blobProxyFactory;
        $this->containerName = $containerName;
        $this->detectContentType = $detectContentType;
        if ($create) {
            $this->createContainer($containerName);
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Creates a new container
     *
     * @param  string                                           $containerName
     * @param  \WindowsAzure\Blob\Models\CreateContainerOptions $options
     * @throws \RuntimeException                                if cannot create the container
<<<<<<< HEAD
=======
     * Creates a new container.
     *
     * @param string                                                     $containerName
     * @param \MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions $options
     *
     * @throws \RuntimeException if cannot create the container
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function createContainer($containerName, CreateContainerOptions $options = null)
    {
        $this->init();

        try {
            $this->blobProxy->createContainer($containerName, $options);
        } catch (ServiceException $e) {
            $errorCode = $this->getErrorCodeFromServiceException($e);

            if ($errorCode != self::ERROR_CONTAINER_ALREADY_EXISTS) {
                throw new \RuntimeException(sprintf(
                    'Failed to create the configured container "%s": %s (%s).',
                    $containerName,
                    $e->getErrorText(),
                    $errorCode
                ));
            }
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Deletes a container
     *
     * @param  string                 $containerName
     * @param  DeleteContainerOptions $options
     * @throws \RuntimeException      if cannot delete the container
<<<<<<< HEAD
=======
     * Deletes a container.
     *
     * @param string                 $containerName
     * @param DeleteContainerOptions $options
     *
     * @throws \RuntimeException if cannot delete the container
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function deleteContainer($containerName, DeleteContainerOptions $options = null)
    {
        $this->init();

        try {
            $this->blobProxy->deleteContainer($containerName, $options);
        } catch (ServiceException $e) {
            $errorCode = $this->getErrorCodeFromServiceException($e);

            if ($errorCode != self::ERROR_CONTAINER_NOT_FOUND) {
                throw new \RuntimeException(sprintf(
                    'Failed to delete the configured container "%s": %s (%s).',
                    $containerName,
                    $e->getErrorText(),
                    $errorCode
                ), $e->getCode());
            }
        }
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
        $this->init();

        try {
            $blob = $this->blobProxy->getBlob($this->containerName, $key);

            return stream_get_contents($blob->getContentStream());
        } catch (ServiceException $e) {
            $this->failIfContainerNotFound($e, sprintf('read key "%s"', $key));

            return false;
        }
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
        $this->init();

        try {
            $options = new CreateBlobOptions();

            if ($this->detectContentType) {
<<<<<<< HEAD
<<<<<<< HEAD
                $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
                $contentType = $fileInfo->buffer($content);
                $options->setContentType($contentType);
=======
                $contentType = $this->guessContentType($content);

                $options->setBlobContentType($contentType);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
                $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
                $contentType = $fileInfo->buffer($content);
                $options->setContentType($contentType);
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            }

            $this->blobProxy->createBlockBlob($this->containerName, $key, $content, $options);

<<<<<<< HEAD
<<<<<<< HEAD
=======
            if (is_resource($content)) {
                return Util\Size::fromResource($content);
            }

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            return Util\Size::fromContent($content);
        } catch (ServiceException $e) {
            $this->failIfContainerNotFound($e, sprintf('write content for key "%s"', $key));

            return false;
        }
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
        $this->init();

        $listBlobsOptions = new ListBlobsOptions();
        $listBlobsOptions->setPrefix($key);

        try {
            $blobsList = $this->blobProxy->listBlobs($this->containerName, $listBlobsOptions);

            foreach ($blobsList->getBlobs() as $blob) {
                if ($key === $blob->getName()) {
                    return true;
                }
            }
        } catch (ServiceException $e) {
            $this->failIfContainerNotFound($e, 'check if key exists');
            $errorCode = $this->getErrorCodeFromServiceException($e);

            throw new \RuntimeException(sprintf(
                'Failed to check if key "%s" exists in container "%s": %s (%s).',
                $key,
                $this->containerName,
                $e->getErrorText(),
                $errorCode
            ), $e->getCode());
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
    public function keys()
    {
        $this->init();

        try {
            $blobList = $this->blobProxy->listBlobs($this->containerName);

            return array_map(
<<<<<<< HEAD
<<<<<<< HEAD
                function($blob) {
=======
                function ($blob) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
                function($blob) {
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
                    return $blob->getName();
                },
                $blobList->getBlobs()
            );
        } catch (ServiceException $e) {
            $this->failIfContainerNotFound($e, 'retrieve keys');
            $errorCode = $this->getErrorCodeFromServiceException($e);

            throw new \RuntimeException(sprintf(
                'Failed to list keys for the container "%s": %s (%s).',
                $this->containerName,
                $e->getErrorText(),
                $errorCode
            ), $e->getCode());
        }
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
        $this->init();

        try {
            $properties = $this->blobProxy->getBlobProperties($this->containerName, $key);

            return $properties->getProperties()->getLastModified()->getTimestamp();
        } catch (ServiceException $e) {
            $this->failIfContainerNotFound($e, sprintf('read mtime for key "%s"', $key));

            return false;
        }
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
        $this->init();

        try {
            $this->blobProxy->deleteBlob($this->containerName, $key);

            return true;
        } catch (ServiceException $e) {
            $this->failIfContainerNotFound($e, sprintf('delete key "%s"', $key));

            return false;
        }
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
        $this->init();

        try {
            $this->blobProxy->copyBlob($this->containerName, $targetKey, $this->containerName, $sourceKey);
            $this->blobProxy->deleteBlob($this->containerName, $sourceKey);

            return true;
        } catch (ServiceException $e) {
            $this->failIfContainerNotFound($e, sprintf('rename key "%s"', $sourceKey));

            return false;
        }
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
        // Windows Azure Blob Storage does not support directories
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
    public function setMetadata($key, $content)
    {
        $this->init();

        try {
            $this->blobProxy->setBlobMetadata($this->containerName, $key, $content);
        } catch (ServiceException $e) {
            $errorCode = $this->getErrorCodeFromServiceException($e);

            throw new \RuntimeException(sprintf(
                'Failed to set metadata for blob "%s" in container "%s": %s (%s).',
                $key,
                $this->containerName,
                $e->getErrorText(),
                $errorCode
            ), $e->getCode());
        }
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
    public function getMetadata($key)
    {
        $this->init();

        try {
            $properties = $this->blobProxy->getBlobProperties($this->containerName, $key);

            return $properties->getMetadata();
        } catch (ServiceException $e) {
            $errorCode = $this->getErrorCodeFromServiceException($e);

            throw new \RuntimeException(sprintf(
                'Failed to get metadata for blob "%s" in container "%s": %s (%s).',
                $key,
                $this->containerName,
                $e->getErrorText(),
                $errorCode
            ), $e->getCode());
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Lazy initialization, automatically called when some method is called after construction
=======
     * Lazy initialization, automatically called when some method is called after construction.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Lazy initialization, automatically called when some method is called after construction
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    protected function init()
    {
        if ($this->blobProxy == null) {
            $this->blobProxy = $this->blobProxyFactory->create();
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Throws a runtime exception if a give ServiceException derived from a "container not found" error
     *
     * @param  ServiceException  $exception
     * @param  string            $action
<<<<<<< HEAD
=======
     * Throws a runtime exception if a give ServiceException derived from a "container not found" error.
     *
     * @param ServiceException $exception
     * @param string           $action
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @throws \RuntimeException
     */
    protected function failIfContainerNotFound(ServiceException $exception, $action)
    {
        $errorCode = $this->getErrorCodeFromServiceException($exception);

        if ($errorCode == self::ERROR_CONTAINER_NOT_FOUND) {
            throw new \RuntimeException(sprintf(
                'Failed to %s: container "%s" not found.',
                $action,
                $this->containerName
            ), $exception->getCode());
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Extracts the error code from a service exception
     *
     * @param  ServiceException $exception
=======
     * Extracts the error code from a service exception.
     *
     * @param ServiceException $exception
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Extracts the error code from a service exception
     *
     * @param  ServiceException $exception
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @return string
     */
    protected function getErrorCodeFromServiceException(ServiceException $exception)
    {
        $xml = @simplexml_load_string($exception->getErrorReason());

        if ($xml && isset($xml->Code)) {
            return (string) $xml->Code;
        }

        return $exception->getErrorReason();
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======

    /**
     * @param string $content
     *
     * @return string
     */
    private function guessContentType($content)
    {
        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);

        if (is_resource($content)) {
            return $fileInfo->file(stream_get_meta_data($content)['uri']);
        }

        return $fileInfo->buffer($content);
    }
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
}
