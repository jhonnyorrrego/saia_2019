<?php

namespace Gaufrette;

/**
<<<<<<< HEAD
 * Stream wrapper class for the Gaufrette filesystems
=======
 * Stream wrapper class for the Gaufrette filesystems.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
class StreamWrapper
{
    private static $filesystemMap;

    private $stream;

    /**
<<<<<<< HEAD
     * Defines the filesystem map
=======
     * Defines the filesystem map.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param FilesystemMap $map
     */
    public static function setFilesystemMap(FilesystemMap $map)
    {
        static::$filesystemMap = $map;
    }

    /**
<<<<<<< HEAD
     * Returns the filesystem map
=======
     * Returns the filesystem map.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @return FilesystemMap $map
     */
    public static function getFilesystemMap()
    {
        if (null === static::$filesystemMap) {
            static::$filesystemMap = static::createFilesystemMap();
        }

        return static::$filesystemMap;
    }

    /**
<<<<<<< HEAD
     * Registers the stream wrapper to handle the specified scheme
=======
     * Registers the stream wrapper to handle the specified scheme.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $scheme Default is gaufrette
     */
    public static function register($scheme = 'gaufrette')
    {
        static::streamWrapperUnregister($scheme);

<<<<<<< HEAD
        if (! static::streamWrapperRegister($scheme, __CLASS__)) {
=======
        if (!static::streamWrapperRegister($scheme, __CLASS__)) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            throw new \RuntimeException(sprintf(
                'Could not register stream wrapper class %s for scheme %s.',
                __CLASS__,
                $scheme
            ));
        }
    }

    /**
     * @return FilesystemMap
     */
    protected static function createFilesystemMap()
    {
        return new FilesystemMap();
    }

    /**
     * @param string $scheme - protocol scheme
     */
    protected static function streamWrapperUnregister($scheme)
    {
        if (in_array($scheme, stream_get_wrappers())) {
            return stream_wrapper_unregister($scheme);
        }
    }

    /**
     * @param string $scheme    - protocol scheme
     * @param string $className
     *
     * @return bool
     */
    protected static function streamWrapperRegister($scheme, $className)
    {
        return stream_wrapper_register($scheme, $className);
    }

    public function stream_open($path, $mode)
    {
        $this->stream = $this->createStream($path);

        return $this->stream->open($this->createStreamMode($mode));
    }

    /**
<<<<<<< HEAD
     * @param  int   $bytes
=======
     * @param int $bytes
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @return mixed
     */
    public function stream_read($bytes)
    {
        if ($this->stream) {
            return $this->stream->read($bytes);
        }

        return false;
    }

    /**
<<<<<<< HEAD
     * @param  string $data
=======
     * @param string $data
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @return int
     */
    public function stream_write($data)
    {
        if ($this->stream) {
            return $this->stream->write($data);
        }

        return 0;
    }

    public function stream_close()
    {
        if ($this->stream) {
            $this->stream->close();
        }
    }

    /**
<<<<<<< HEAD
     * @return boolean
=======
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function stream_flush()
    {
        if ($this->stream) {
            return $this->stream->flush();
        }

        return false;
    }

    /**
<<<<<<< HEAD
     * @param  int     $offset
     * @param  int     $whence - one of values [SEEK_SET, SEEK_CUR, SEEK_END]
     * @return boolean
=======
     * @param int $offset
     * @param int $whence - one of values [SEEK_SET, SEEK_CUR, SEEK_END]
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function stream_seek($offset, $whence = SEEK_SET)
    {
        if ($this->stream) {
            return $this->stream->seek($offset, $whence);
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function stream_tell()
    {
        if ($this->stream) {
            return $this->stream->tell();
        }

        return false;
    }

    /**
<<<<<<< HEAD
     * @return boolean
=======
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function stream_eof()
    {
        if ($this->stream) {
            return $this->stream->eof();
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function stream_stat()
    {
        if ($this->stream) {
            return $this->stream->stat();
        }

        return false;
    }

    /**
<<<<<<< HEAD
     * @param  string $path
     * @param  int    $flags
     * @return mixed
=======
     * @param string $path
     * @param int    $flags
     *
     * @return mixed
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @todo handle $flags parameter
     */
    public function url_stat($path, $flags)
    {
        $stream = $this->createStream($path);

        try {
            $stream->open($this->createStreamMode('r+'));
        } catch (\RuntimeException $e) {
        }

        return $stream->stat();
    }

    /**
<<<<<<< HEAD
     * @param  string $path
=======
     * @param string $path
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @return mixed
     */
    public function unlink($path)
    {
        $stream = $this->createStream($path);

        try {
            $stream->open($this->createStreamMode('w+'));
        } catch (\RuntimeException $e) {
            return false;
        }

        return $stream->unlink();
    }

    /**
     * @return mixed
     */
    public function stream_cast($castAs)
    {
        if ($this->stream) {
            return $this->stream->cast($castAs);
        }

        return false;
    }

    protected function createStream($path)
    {
        $parts = array_merge(
            array(
<<<<<<< HEAD
                'scheme'    => null,
                'host'      => null,
                'path'      => null,
                'query'     => null,
                'fragment'  => null,
=======
                'scheme' => null,
                'host' => null,
                'path' => null,
                'query' => null,
                'fragment' => null,
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            ),
            parse_url($path) ?: array()
        );

        $domain = $parts['host'];
<<<<<<< HEAD
        $key    = substr($parts['path'], 1);

        if (null !== $parts['query']) {
            $key.= '?' . $parts['query'];
        }

        if (null !== $parts['fragment']) {
            $key.= '#' . $parts['fragment'];
=======
        $key = substr($parts['path'], 1);

        if (null !== $parts['query']) {
            $key .= '?'.$parts['query'];
        }

        if (null !== $parts['fragment']) {
            $key .= '#'.$parts['fragment'];
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        }

        if (empty($domain) || empty($key)) {
            throw new \InvalidArgumentException(sprintf(
                'The specified path (%s) is invalid.',
                $path
            ));
        }

        return static::getFilesystemMap()->get($domain)->createStream($key);
    }

    protected function createStreamMode($mode)
    {
        return new StreamMode($mode);
    }
}
