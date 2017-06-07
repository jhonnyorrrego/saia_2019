<?php

namespace Gaufrette\Adapter;

/**
<<<<<<< HEAD
 * interface that adds support of native listKeys to adapter
=======
 * interface that adds support of native listKeys to adapter.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Andrew Tch <andrew.tchircoff@gmail.com>
 */
interface ListKeysAware
{
    /**
     * Lists keys beginning with pattern given
<<<<<<< HEAD
     * (no wildcard / regex matching)
     *
     * @param string $prefix
     * @return array
     */
    public function listKeys($prefix = '');
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
