<?php

namespace Gaufrette\Adapter\AzureBlobStorage;

<<<<<<< HEAD
use WindowsAzure\Common\ServicesBuilder;

/**
 * Basic implementation for a Blob proxy factory
=======
use MicrosoftAzure\Storage\Common\ServicesBuilder;

/**
 * Basic implementation for a Blob proxy factory.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Luciano Mammino <lmammino@oryzone.com>
 */
class BlobProxyFactory implements BlobProxyFactoryInterface
{
    /**
<<<<<<< HEAD
     * @var string $connectionString
=======
     * @var string
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    protected $connectionString;

    /**
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @param string $connectionString
     */
    public function __construct($connectionString)
    {
        $this->connectionString = $connectionString;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function create()
    {
        return ServicesBuilder::getInstance()->createBlobService($this->connectionString);
    }
}
