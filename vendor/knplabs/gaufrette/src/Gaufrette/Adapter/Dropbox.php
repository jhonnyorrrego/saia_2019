<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Gaufrette\Util;
use Gaufrette\Exception;
<<<<<<< HEAD
use \Dropbox_API as DropboxApi;
use \Dropbox_Exception_NotFound as DropboxNotFoundException;

/**
 * Dropbox adapter
=======
use Dropbox_API as DropboxApi;
use Dropbox_Exception_NotFound as DropboxNotFoundException;

/**
 * Dropbox adapter.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Markus Bachmann <markus.bachmann@bachi.biz>
 * @author Antoine Hérault <antoine.herault@gmail.com>
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
class Dropbox implements Adapter
{
    protected $client;

    /**
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @param \Dropbox_API $client The Dropbox API client
     */
    public function __construct(DropboxApi $client)
    {
        $this->client = $client;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @throws \Dropbox_Exception_Forbidden
     * @throws \Dropbox_Exception_OverQuota
     * @throws \OAuthException
     */
    public function read($key)
    {
        try {
            return $this->client->getFile($key);
        } catch (DropboxNotFoundException $e) {
            return false;
        }
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
        try {
            $metadata = $this->getDropboxMetadata($key);
        } catch (Exception\FileNotFound $e) {
            return false;
        }

        return (boolean) isset($metadata['is_dir']) ? $metadata['is_dir'] : false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @throws \Dropbox_Exception
     */
    public function write($key, $content)
    {
        $resource = tmpfile();
        fwrite($resource, $content);
        fseek($resource, 0);

        try {
            $this->client->putFile($key, $resource);
        } catch (\Exception $e) {
            fclose($resource);

            throw $e;
        }

        fclose($resource);

        return Util\Size::fromContent($content);
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
        try {
            $this->client->delete($key);
        } catch (DropboxNotFoundException $e) {
            return false;
        }

        return true;
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
        try {
            $this->client->move($sourceKey, $targetKey);
        } catch (DropboxNotFoundException $e) {
            return false;
        }

        return true;
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
        try {
            $metadata = $this->getDropboxMetadata($key);
        } catch (Exception\FileNotFound $e) {
            return false;
        }

        return strtotime($metadata['modified']);
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
        $metadata = $this->client->getMetaData('/', true);
<<<<<<< HEAD
        if (! isset($metadata['contents'])) {
=======
        if (!isset($metadata['contents'])) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            return array();
        }

        $keys = array();
        foreach ($metadata['contents'] as $value) {
            $file = ltrim($value['path'], '/');
            $keys[] = $file;
<<<<<<< HEAD
            if ('.' !== dirname($file)) {
                $keys[] = dirname($file);
=======
            if ('.' !== $dirname = \Gaufrette\Util\Path::dirname($file)) {
                $keys[] = $dirname;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            }
        }
        sort($keys);

        return $keys;
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
        try {
            $this->getDropboxMetadata($key);

            return true;
        } catch (Exception\FileNotFound $e) {
            return false;
        }
    }

    private function getDropboxMetadata($key)
    {
        try {
            $metadata = $this->client->getMetaData($key, false);
        } catch (DropboxNotFoundException $e) {
            throw new Exception\FileNotFound($key, 0, $e);
        }

        // TODO find a way to exclude deleted files
        if (isset($metadata['is_deleted']) && $metadata['is_deleted']) {
            throw new Exception\FileNotFound($key);
        }

        return $metadata;
    }
}
