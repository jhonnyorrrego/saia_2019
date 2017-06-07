<?php

namespace Gaufrette\Adapter\OpenStackCloudFiles;

use OpenCloud\ObjectStore\Service;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * ObjectStoreFactoryInterface
=======
 * ObjectStoreFactoryInterface.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * ObjectStoreFactoryInterface
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Daniel Richter <nexyz9@gmail.com>
 */
interface ObjectStoreFactoryInterface
{
    /**
     * @return Service
     */
    public function getObjectStore();
}
