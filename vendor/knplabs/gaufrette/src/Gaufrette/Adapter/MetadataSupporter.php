<?php

namespace Gaufrette\Adapter;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Interface which add supports for metadata
=======
 * Interface which add supports for metadata.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * Interface which add supports for metadata
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
interface MetadataSupporter
{
    /**
     * @param string $key
     * @param array  $content
     */
    public function setMetadata($key, $content);

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  string $key
=======
     * @param string $key
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * @param  string $key
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @return array
     */
    public function getMetadata($key);
}
