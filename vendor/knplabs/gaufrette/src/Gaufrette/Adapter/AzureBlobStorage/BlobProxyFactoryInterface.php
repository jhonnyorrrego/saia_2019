<?php

namespace Gaufrette\Adapter\AzureBlobStorage;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Interface to define Blob proxy factories
=======
 * Interface to define Blob proxy factories.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * Interface to define Blob proxy factories
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Luciano Mammino <lmammino@oryzone.com>
 */
interface BlobProxyFactoryInterface
{
    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Creates a new instance of the Blob proxy
     *
     * @return \WindowsAzure\Blob\Internal\IBlob
=======
     * Creates a new instance of the Blob proxy.
     *
     * @return \MicrosoftAzure\Storage\Blob\Internal\IBlob
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Creates a new instance of the Blob proxy
     *
     * @return \WindowsAzure\Blob\Internal\IBlob
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function create();
}
