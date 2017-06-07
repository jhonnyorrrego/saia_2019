<?php

namespace Gaufrette\Adapter\OpenStackCloudFiles;

use OpenCloud\OpenStack;

/**
<<<<<<< HEAD
 * ObjectStoreFactory
=======
 * ObjectStoreFactory.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Daniel Richter <nexyz9@gmail.com>
 */
class ObjectStoreFactory implements ObjectStoreFactoryInterface
{
    /**
     * @var OpenStack
     */
    protected $connection;

    /**
     * @var string
     */
    protected $region;

    /**
     * @var string
     */
    protected $urlType;

    /**
     * @var string
     */
    protected $objectStoreType;

    /**
<<<<<<< HEAD
     * Constructor
     *
     * @param OpenStack $connection
     * @param string $region
     * @param string $urlType
     * @param string $objectStoreType
=======
     * @param OpenStack $connection
     * @param string    $region
     * @param string    $urlType
     * @param string    $objectStoreType
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function __construct(OpenStack $connection, $region, $urlType, $objectStoreType = 'cloudFiles')
    {
        $this->connection = $connection;
        $this->region = $region;
        $this->urlType = $urlType;
        $this->objectStoreType = $objectStoreType;
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectStore()
    {
        return $this->connection->objectStoreService($this->objectStoreType, $this->region, $this->urlType);
    }
}
