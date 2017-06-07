<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Gaufrette\Util;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Apc adapter, a non-persistent adapter for when this sort of thing is appropriate
=======
 * Apc adapter, a non-persistent adapter for when this sort of thing is appropriate.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * Apc adapter, a non-persistent adapter for when this sort of thing is appropriate
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Alexander Deruwe <alexander.deruwe@gmail.com>
 * @author Antoine Hérault <antoine.herault@gmail.com>
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
class Apc implements Adapter
{
    protected $prefix;
    protected $ttl;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Constructor
     *
     * @throws \RuntimeException
     * @param  string            $prefix to avoid conflicts between filesystems
     * @param  int               $ttl    time to live, default is 0
<<<<<<< HEAD
=======
     * @throws \RuntimeException
     *
     * @param string $prefix to avoid conflicts between filesystems
     * @param int    $ttl    time to live, default is 0
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function __construct($prefix, $ttl = 0)
    {
        if (!extension_loaded('apc')) {
            throw new \RuntimeException('Unable to use Gaufrette\Adapter\Apc as the APC extension is not available.');
        }

        $this->prefix = $prefix;
        $this->ttl = $ttl;
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
    public function read($key)
    {
        return apc_fetch($this->computePath($key));
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
    public function write($key, $content, array $metadata = null)
    {
        $result = apc_store($this->computePath($key), $content, $this->ttl);

        if (!$result) {
            return false;
        }

        return Util\Size::fromContent($content);
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
    public function exists($key)
    {
        return apc_exists($this->computePath($key));
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
    public function keys()
    {
        $cachedKeys = $this->getCachedKeysIterator();

        if (null === $cachedKeys) {
            return array();
        }

        $keys = array();
        foreach ($cachedKeys as $key => $value) {
            $pattern = sprintf('/^%s/', preg_quote($this->prefix, '/'));
            $keys[] = preg_replace($pattern, '', $key);
        }
        sort($keys);

        return $keys;
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
    public function mtime($key)
    {
        $cachedKeys = iterator_to_array($this->getCachedKeysIterator($key, APC_ITER_MTIME));

        return $cachedKeys[$this->computePath($key)]['mtime'];
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
    public function delete($key)
    {
        return apc_delete($this->computePath($key));
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
    public function rename($sourceKey, $targetKey)
    {
        // TODO: this probably allows for race conditions...
<<<<<<< HEAD
<<<<<<< HEAD
        $written  = $this->write($targetKey, $this->read($sourceKey));
=======
        $written = $this->write($targetKey, $this->read($sourceKey));
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $written  = $this->write($targetKey, $this->read($sourceKey));
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $deleted = $this->delete($sourceKey);

        return $written && $deleted;
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
    public function isDirectory($key)
    {
        return false;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Computes the path for the given key
     *
     * @param  string $key
=======
     * Computes the path for the given key.
     *
     * @param string $key
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Computes the path for the given key
     *
     * @param  string $key
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @return string
     */
    public function computePath($key)
    {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        return $this->prefix . $key;
    }

    /**
     * @param  string       $key    - by default ''
     * @param  integer      $format - by default APC_ITER_NONE
     * @return \APCIterator
     *
<<<<<<< HEAD
=======
        return $this->prefix.$key;
    }

    /**
     * @param string $key    - by default ''
     * @param int    $format - by default APC_ITER_NONE
     *
     * @return \APCIterator
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    protected function getCachedKeysIterator($key = '', $format = APC_ITER_NONE)
    {
        $pattern = sprintf('/^%s/', preg_quote($this->prefix.$key, '/'));

        return new \APCIterator('user', $pattern, $format);
    }
}
