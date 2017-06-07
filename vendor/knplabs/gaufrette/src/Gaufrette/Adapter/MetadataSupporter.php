<?php

namespace Gaufrette\Adapter;

/**
<<<<<<< HEAD
 * Interface which add supports for metadata
=======
 * Interface which add supports for metadata.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
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
     * @param  string $key
=======
     * @param string $key
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @return array
     */
    public function getMetadata($key);
}
