<?php

namespace Gaufrette\Adapter;

use Gaufrette\File;
use Gaufrette\Adapter;
use Gaufrette\Adapter\InMemory as InMemoryAdapter;

/**
<<<<<<< HEAD
 * Cache adapter
 *
 * @package Gaufrette
=======
 * Cache adapter.
 *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 * @author  Antoine Hérault <antoine.herault@gmail.com>
 */
class Cache implements Adapter,
                       MetadataSupporter
{
    /**
     * @var Adapter
     */
    protected $source;

    /**
     * @var Adapter
     */
    protected $cache;

    /**
<<<<<<< HEAD
     * @var integer
=======
     * @var int
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    protected $ttl;

    /**
     * @var Adapter
     */
    protected $serializeCache;

    /**
<<<<<<< HEAD
     * Constructor
     *
     * @param Adapter $source         The source adapter that must be cached
     * @param Adapter $cache          The adapter used to cache the source
     * @param integer $ttl            Time to live of a cached file
=======
     * @param Adapter $source         The source adapter that must be cached
     * @param Adapter $cache          The adapter used to cache the source
     * @param int     $ttl            Time to live of a cached file
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @param Adapter $serializeCache The adapter used to cache serializations
     */
    public function __construct(Adapter $source, Adapter $cache, $ttl = 0, Adapter $serializeCache = null)
    {
        $this->source = $source;
        $this->cache = $cache;
        $this->ttl = $ttl;

        if (!$serializeCache) {
            $serializeCache = new InMemoryAdapter();
        }
        $this->serializeCache = $serializeCache;
    }

    /**
<<<<<<< HEAD
     * Returns the time to live of the cache
     *
     * @return integer $ttl
=======
     * Returns the time to live of the cache.
     *
     * @return int $ttl
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
<<<<<<< HEAD
     * Defines the time to live of the cache
     *
     * @param integer $ttl
=======
     * Defines the time to live of the cache.
     *
     * @param int $ttl
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    }

    /**
<<<<<<< HEAD
     * {@InheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function read($key)
    {
        if ($this->needsReload($key)) {
            $contents = $this->source->read($key);
            $this->cache->write($key, $contents);
        } else {
            $contents = $this->cache->read($key);
        }

        return $contents;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function rename($key, $new)
    {
        return $this->source->rename($key, $new) && $this->cache->rename($key, $new);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function write($key, $content, array $metadata = null)
    {
        $bytesSource = $this->source->write($key, $content);

        if (false === $bytesSource) {
            return false;
        }

        $bytesCache = $this->cache->write($key, $content);

        if ($bytesSource !== $bytesCache) {
            return false;
        }

        return $bytesSource;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function exists($key)
    {
        if ($this->needsReload($key)) {
            return $this->source->exists($key);
        }
<<<<<<< HEAD
=======

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        return $this->cache->exists($key);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function mtime($key)
    {
        return $this->source->mtime($key);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function keys()
    {
        $cacheFile = 'keys.cache';
        if ($this->needsRebuild($cacheFile)) {
            $keys = $this->source->keys();
            sort($keys);
            $this->serializeCache->write($cacheFile, serialize($keys));
        } else {
            $keys = unserialize($this->serializeCache->read($cacheFile));
        }

        return $keys;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function delete($key)
    {
        return $this->source->delete($key) && $this->cache->delete($key);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function isDirectory($key)
    {
        return $this->source->isDirectory($key);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function setMetadata($key, $metadata)
    {
        if ($this->source instanceof MetadataSupporter) {
            $this->source->setMetadata($key, $metadata);
        }

        if ($this->cache instanceof MetadataSupporter) {
            $this->cache->setMetadata($key, $metadata);
        }
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function getMetadata($key)
    {
        if ($this->source instanceof MetadataSupporter) {
            return $this->source->getMetadata($key);
        }

        return false;
    }

    /**
<<<<<<< HEAD
     * Indicates whether the cache for the specified key needs to be reloaded
=======
     * Indicates whether the cache for the specified key needs to be reloaded.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $key
     */
    public function needsReload($key)
    {
        $needsReload = true;

        if ($this->cache->exists($key)) {
            try {
                $dateCache = $this->cache->mtime($key);
                $needsReload = false;

                if (time() - $this->ttl >= $dateCache) {
                    $dateSource = $this->source->mtime($key);
                    $needsReload = $dateCache < $dateSource;
                }
<<<<<<< HEAD
            } catch (\RuntimeException $e) { }
=======
            } catch (\RuntimeException $e) {
            }
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        }

        return $needsReload;
    }

    /**
<<<<<<< HEAD
     * Indicates whether the serialized cache file needs to be rebuild
=======
     * Indicates whether the serialized cache file needs to be rebuild.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $cacheFile
     */
    public function needsRebuild($cacheFile)
    {
        $needsRebuild = true;

        if ($this->serializeCache->exists($cacheFile)) {
            try {
                $needsRebuild = time() - $this->ttl >= $this->serializeCache->mtime($cacheFile);
<<<<<<< HEAD
            } catch (\RuntimeException $e) { }
=======
            } catch (\RuntimeException $e) {
            }
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        }

        return $needsRebuild;
    }
}
