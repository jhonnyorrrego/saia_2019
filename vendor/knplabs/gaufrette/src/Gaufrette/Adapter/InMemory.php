<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Gaufrette\Util;

/**
<<<<<<< HEAD
 * In memory adapter
 *
 * Stores some files in memory for test purposes
 *
 * @package Gaufrette
 * @author Antoine Hérault <antoine.herault@gmail.com>
 */
class InMemory implements Adapter
=======
 * In memory adapter.
 *
 * Stores some files in memory for test purposes
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 */
class InMemory implements Adapter,
                          MimeTypeProvider
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
{
    protected $files = array();

    /**
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @param array $files An array of files
     */
    public function __construct(array $files = array())
    {
        $this->setFiles($files);
    }

    /**
<<<<<<< HEAD
     * Defines the files
=======
     * Defines the files.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param array $files An array of files
     */
    public function setFiles(array $files)
    {
        $this->files = array();
        foreach ($files as $key => $file) {
            if (!is_array($file)) {
                $file = array('content' => $file);
            }

            $file = array_merge(array(
<<<<<<< HEAD
                'content'   => null,
                'mtime'     => null,
=======
                'content' => null,
                'mtime' => null,
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            ), $file);

            $this->setFile($key, $file['content'], $file['mtime']);
        }
    }

    /**
<<<<<<< HEAD
     * Defines a file
     *
     * @param string  $key     The key
     * @param string  $content The content
     * @param integer $mtime   The last modified time (automatically set to now if NULL)
=======
     * Defines a file.
     *
     * @param string $key     The key
     * @param string $content The content
     * @param int    $mtime   The last modified time (automatically set to now if NULL)
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function setFile($key, $content = null, $mtime = null)
    {
        if (null === $mtime) {
            $mtime = time();
        }

        $this->files[$key] = array(
<<<<<<< HEAD
            'content'   => (string) $content,
            'mtime'     => (integer) $mtime
=======
            'content' => (string) $content,
            'mtime' => (integer) $mtime,
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        );
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
        return $this->files[$key]['content'];
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
        $content = $this->read($sourceKey);
        $this->delete($sourceKey);

        return (boolean) $this->write($targetKey, $content);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
     */
    public function write($key, $content, array $metadata = null)
    {
        $this->files[$key]['content']  = $content;
        $this->files[$key]['mtime']    = time();
=======
     * {@inheritdoc}
     */
    public function write($key, $content, array $metadata = null)
    {
        $this->files[$key]['content'] = $content;
        $this->files[$key]['mtime'] = time();
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744

        return Util\Size::fromContent($content);
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
        return array_key_exists($key, $this->files);
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
        return array_keys($this->files);
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
        return isset($this->files[$key]['mtime']) ? $this->files[$key]['mtime'] : false;
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
        unset($this->files[$key]);
        clearstatcache();

        return true;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function isDirectory($path)
    {
        return false;
    }
<<<<<<< HEAD
=======

    /**
     * {@inheritdoc}
     */
    public function mimeType($key)
    {
        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);

        return $fileInfo->buffer($this->files[$key]['content']);
    }
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
}
