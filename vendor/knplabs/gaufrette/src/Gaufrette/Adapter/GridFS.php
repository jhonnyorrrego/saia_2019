<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
use \MongoGridFS as MongoGridFs;
use \MongoDate;

/**
 * Adapter for the GridFS filesystem on MongoDB database
<<<<<<< HEAD
=======
use MongoGridFS as MongoGridFs;
use MongoDate;

/**
 * Adapter for the GridFS filesystem on MongoDB database.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * @author Tomi Saarinen <tomi.saarinen@rohea.com>
 * @author Antoine Hérault <antoine.herault@gmail.com>
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
class GridFS implements Adapter,
                        ChecksumCalculator,
                        MetadataSupporter,
                        ListKeysAware
{
    private $metadata = array();
    protected $gridFS = null;

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Constructor
     *
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * @param \MongoGridFS $gridFS
     */
    public function __construct(MongoGridFs $gridFS)
    {
        $this->gridFS = $gridFS;
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
        $file = $this->find($key);

        return ($file) ? $file->getBytes() : false;
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
    public function write($key, $content)
    {
        if ($this->exists($key)) {
            $this->delete($key);
        }

        $metadata = array_replace_recursive(array('date' => new MongoDate()), $this->getMetadata($key), array('filename' => $key));
<<<<<<< HEAD
<<<<<<< HEAD
        $id   = $this->gridFS->storeBytes($content, $metadata);
=======
        $id = $this->gridFS->storeBytes($content, $metadata);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
        $id   = $this->gridFS->storeBytes($content, $metadata);
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $file = $this->gridFS->findOne(array('_id' => $id));

        return $file->getSize();
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
        $bytes = $this->write($targetKey, $this->read($sourceKey));
        $this->delete($sourceKey);

        return (boolean) $bytes;
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
        return (boolean) $this->find($key);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * {@inheritDoc}
     */
    public function keys()
    {
        $keys   = array();
<<<<<<< HEAD
=======
     * {@inheritdoc}
     */
    public function keys()
    {
        $keys = array();
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        $cursor = $this->gridFS->find(array(), array('filename'));

        foreach ($cursor as $file) {
            $keys[] = $file->getFilename();
        }

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
        $file = $this->find($key, array('date'));

        return ($file) ? $file->file['date']->sec : false;
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
    public function checksum($key)
    {
        $file = $this->find($key, array('md5'));

        return ($file) ? $file->file['md5'] : false;
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
        $file = $this->find($key, array('_id'));

        return $file && $this->gridFS->delete($file->file['_id']);
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
    public function setMetadata($key, $metadata)
    {
        $this->metadata[$key] = $metadata;
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
    public function getMetadata($key)
    {
        return isset($this->metadata[$key]) ? $this->metadata[$key] : array();
    }

    private function find($key, array $fields = array())
    {
        return $this->gridFS->findOne($key, $fields);
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
    public function listKeys($prefix = '')
    {
        $prefix = trim($prefix);

        if ('' == $prefix) {
            return array(
                'dirs' => array(),
<<<<<<< HEAD
<<<<<<< HEAD
                'keys' => $this->keys()
=======
                'keys' => $this->keys(),
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
                'keys' => $this->keys()
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            );
        }

        $result = array(
            'dirs' => array(),
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            'keys' => array()
        );

        $gridFiles = $this->gridFS->find(array(
            'filename' => new \MongoRegex(sprintf('/^%s/', $prefix))
<<<<<<< HEAD
=======
            'keys' => array(),
        );

        $gridFiles = $this->gridFS->find(array(
            'filename' => new \MongoRegex(sprintf('/^%s/', $prefix)),
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        ));

        foreach ($gridFiles as $file) {
            $result['keys'][] = $file->getFilename();
        }

        return $result;
    }
}
