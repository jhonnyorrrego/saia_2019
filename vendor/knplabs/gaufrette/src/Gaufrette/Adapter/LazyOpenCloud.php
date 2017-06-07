<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter\OpenStackCloudFiles\ObjectStoreFactoryInterface;

/**
<<<<<<< HEAD
 * LazyOpenCloud
=======
 * LazyOpenCloud.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author  Daniel Richter <nexyz9@gmail.com>
 */
class LazyOpenCloud extends OpenCloud
{
    /**
     * @var ObjectStoreFactoryInterface
     */
    protected $objectStoreFactory;

    /**
     * @param ObjectStoreFactoryInterface $objectStoreFactory
<<<<<<< HEAD
     * @param string $containerName
     * @param bool $createContainer
=======
     * @param string                      $containerName
     * @param bool                        $createContainer
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function __construct(ObjectStoreFactoryInterface $objectStoreFactory, $containerName, $createContainer = false)
    {
        $this->objectStoreFactory = $objectStoreFactory;
        $this->containerName = $containerName;
        $this->createContainer = $createContainer;
    }

    /**
<<<<<<< HEAD
     * Override parent to lazy-load object store
=======
     * Override parent to lazy-load object store.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * {@inheritdoc}
     */
    protected function getContainer()
    {
        if (!$this->objectStore) {
            $this->objectStore = $this->objectStoreFactory->getObjectStore();
        }

        return parent::getContainer();
    }
}
