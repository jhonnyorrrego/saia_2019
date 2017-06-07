<?php

namespace Gaufrette\Adapter;

/**
 * Safe local adapter that encodes key to avoid the use of the directories
<<<<<<< HEAD
<<<<<<< HEAD
 * structure
 *
 * @package Gaufrette
=======
 * structure.
 *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * structure
 *
 * @package Gaufrette
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 * @author  Antoine Hérault <antoine.herault@gmail.com>
 */
class SafeLocal extends Local
{
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
    public function computeKey($path)
    {
        return base64_decode(parent::computeKey($path));
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
    protected function computePath($key)
    {
        return parent::computePath(base64_encode($key));
    }
}
