<?php

namespace Gaufrette\Adapter;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Interface which add checksum calculation support to adapter
=======
 * Interface which add checksum calculation support to adapter.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * Interface which add checksum calculation support to adapter
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
interface ChecksumCalculator
{
    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Returns the checksum of the specified key
=======
     * Returns the checksum of the specified key.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Returns the checksum of the specified key
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @param string $key
     *
     * @return string
     */
    public function checksum($key);
}
