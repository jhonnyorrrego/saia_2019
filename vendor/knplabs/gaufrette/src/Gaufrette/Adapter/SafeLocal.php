<?php

namespace Gaufrette\Adapter;

/**
 * Safe local adapter that encodes key to avoid the use of the directories
<<<<<<< HEAD
 * structure
 *
 * @package Gaufrette
=======
 * structure.
 *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 * @author  Antoine Hérault <antoine.herault@gmail.com>
 */
class SafeLocal extends Local
{
    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function computeKey($path)
    {
        return base64_decode(parent::computeKey($path));
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    protected function computePath($key)
    {
        return parent::computePath(base64_encode($key));
    }
}
