<?php

namespace Gaufrette\Adapter\AzureBlobStorage;

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
use WindowsAzure\Common\ServicesBuilder;

/**
 * Basic implementation for a Blob proxy factory
<<<<<<< HEAD
=======
use MicrosoftAzure\Storage\Common\ServicesBuilder;

/**
 * Basic implementation for a Blob proxy factory.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Luciano Mammino <lmammino@oryzone.com>
 */
class BlobProxyFactory implements BlobProxyFactoryInterface
{
    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * @var string $connectionString
=======
     * @var string
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @var string $connectionString
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    protected $connectionString;

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
     * @param string $connectionString
     */
    public function __construct($connectionString)
    {
        $this->connectionString = $connectionString;
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
    public function create()
    {
        return ServicesBuilder::getInstance()->createBlobService($this->connectionString);
    }
}
