<?php

namespace Gaufrette\Adapter;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * interface that adds support of native listKeys to adapter
=======
 * interface that adds support of native listKeys to adapter.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * interface that adds support of native listKeys to adapter
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Andrew Tch <andrew.tchircoff@gmail.com>
 */
interface ListKeysAware
{
    /**
     * Lists keys beginning with pattern given
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * (no wildcard / regex matching)
     *
     * @param string $prefix
     * @return array
     */
    public function listKeys($prefix = '');
<<<<<<< HEAD
}
=======
     * (no wildcard / regex matching).
     *
     * @param string $prefix
     *
     * @return array
     */
    public function listKeys($prefix = '');
}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
