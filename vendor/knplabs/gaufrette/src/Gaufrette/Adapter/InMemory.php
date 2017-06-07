<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Gaufrette\Util;

/**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 * In memory adapter
 *
 * Stores some files in memory for test purposes
 *
 * @package Gaufrette
 * @author Antoine Hérault <antoine.herault@gmail.com>
 */
class InMemory implements Adapter
<<<<<<< HEAD
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
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
{
    protected $files = array();

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
     * @param array $files An array of files
     */
    public function __construct(array $files = array())
    {
        $this->setFiles($files);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Defines the files
=======
     * Defines the files.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Defines the files
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
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
<<<<<<< HEAD
                'content'   => null,
                'mtime'     => null,
=======
                'content' => null,
                'mtime' => null,
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
                'content'   => null,
                'mtime'     => null,
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
            ), $file);

            $this->setFile($key, $file['content'], $file['mtime']);
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * Defines a file
     *
     * @param string  $key     The key
     * @param string  $content The content
     * @param integer $mtime   The last modified time (automatically set to now if NULL)
<<<<<<< HEAD
=======
     * Defines a file.
     *
     * @param string $key     The key
     * @param string $content The content
     * @param int    $mtime   The last modified time (automatically set to now if NULL)
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function setFile($key, $content = null, $mtime = null)
    {
        if (null === $mtime) {
            $mtime = time();
        }

        $this->files[$key] = array(
<<<<<<< HEAD
<<<<<<< HEAD
            'content'   => (string) $content,
            'mtime'     => (integer) $mtime
=======
            'content' => (string) $content,
            'mtime' => (integer) $mtime,
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
            'content'   => (string) $content,
            'mtime'     => (integer) $mtime
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
        );
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
        return $this->files[$key]['content'];
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
        $content = $this->read($sourceKey);
        $this->delete($sourceKey);

        return (boolean) $this->write($targetKey, $content);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     * {@inheritDoc}
     */
    public function write($key, $content, array $metadata = null)
    {
        $this->files[$key]['content']  = $content;
        $this->files[$key]['mtime']    = time();
<<<<<<< HEAD
=======
     * {@inheritdoc}
     */
    public function write($key, $content, array $metadata = null)
    {
        $this->files[$key]['content'] = $content;
        $this->files[$key]['mtime'] = time();
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

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
        return array_key_exists($key, $this->files);
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
        return array_keys($this->files);
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
        return isset($this->files[$key]['mtime']) ? $this->files[$key]['mtime'] : false;
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
        unset($this->files[$key]);
        clearstatcache();

        return true;
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
    public function isDirectory($path)
    {
        return false;
    }
<<<<<<< HEAD
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
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
}
