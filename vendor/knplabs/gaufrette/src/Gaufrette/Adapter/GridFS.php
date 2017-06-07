<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
<<<<<<< HEAD
use \MongoGridFS as MongoGridFs;
use \MongoDate;

/**
 * Adapter for the GridFS filesystem on MongoDB database
=======
use MongoGridFS as MongoGridFs;
use MongoDate;

/**
 * Adapter for the GridFS filesystem on MongoDB database.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
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
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @param \MongoGridFS $gridFS
     */
    public function __construct(MongoGridFs $gridFS)
    {
        $this->gridFS = $gridFS;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function read($key)
    {
        $file = $this->find($key);

        return ($file) ? $file->getBytes() : false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function write($key, $content)
    {
        if ($this->exists($key)) {
            $this->delete($key);
        }

        $metadata = array_replace_recursive(array('date' => new MongoDate()), $this->getMetadata($key), array('filename' => $key));
<<<<<<< HEAD
        $id   = $this->gridFS->storeBytes($content, $metadata);
=======
        $id = $this->gridFS->storeBytes($content, $metadata);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        $file = $this->gridFS->findOne(array('_id' => $id));

        return $file->getSize();
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
        return false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function rename($sourceKey, $targetKey)
    {
        $bytes = $this->write($targetKey, $this->read($sourceKey));
        $this->delete($sourceKey);

        return (boolean) $bytes;
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
        return (boolean) $this->find($key);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
     */
    public function keys()
    {
        $keys   = array();
=======
     * {@inheritdoc}
     */
    public function keys()
    {
        $keys = array();
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        $cursor = $this->gridFS->find(array(), array('filename'));

        foreach ($cursor as $file) {
            $keys[] = $file->getFilename();
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
    public function mtime($key)
    {
        $file = $this->find($key, array('date'));

        return ($file) ? $file->file['date']->sec : false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function checksum($key)
    {
        $file = $this->find($key, array('md5'));

        return ($file) ? $file->file['md5'] : false;
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
        $file = $this->find($key, array('_id'));

        return $file && $this->gridFS->delete($file->file['_id']);
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
        $this->metadata[$key] = $metadata;
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
        return isset($this->metadata[$key]) ? $this->metadata[$key] : array();
    }

    private function find($key, array $fields = array())
    {
        return $this->gridFS->findOne($key, $fields);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function listKeys($prefix = '')
    {
        $prefix = trim($prefix);

        if ('' == $prefix) {
            return array(
                'dirs' => array(),
<<<<<<< HEAD
                'keys' => $this->keys()
=======
                'keys' => $this->keys(),
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            );
        }

        $result = array(
            'dirs' => array(),
<<<<<<< HEAD
            'keys' => array()
        );

        $gridFiles = $this->gridFS->find(array(
            'filename' => new \MongoRegex(sprintf('/^%s/', $prefix))
=======
            'keys' => array(),
        );

        $gridFiles = $this->gridFS->find(array(
            'filename' => new \MongoRegex(sprintf('/^%s/', $prefix)),
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        ));

        foreach ($gridFiles as $file) {
            $result['keys'][] = $file->getFilename();
        }

        return $result;
    }
}
