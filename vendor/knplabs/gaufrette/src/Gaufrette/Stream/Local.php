<?php

namespace Gaufrette\Stream;

use Gaufrette\Stream;
use Gaufrette\StreamMode;

/**
<<<<<<< HEAD
 * Local stream
=======
 * Local stream.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 */
class Local implements Stream
{
    private $path;
    private $mode;
    private $fileHandle;

    /**
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
     */
    public function open(StreamMode $mode)
    {
        $baseDirPath = dirname($this->path);
=======
     * {@inheritdoc}
     */
    public function open(StreamMode $mode)
    {
        $baseDirPath = \Gaufrette\Util\Path::dirname($this->path);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        if ($mode->allowsWrite() && !is_dir($baseDirPath)) {
            @mkdir($baseDirPath, 0755, true);
        }
        try {
            $fileHandle = @fopen($this->path, $mode->getMode());
        } catch (\Exception $e) {
            $fileHandle = false;
        }

        if (false === $fileHandle) {
            throw new \RuntimeException(sprintf('File "%s" cannot be opened', $this->path));
        }

        $this->mode = $mode;
        $this->fileHandle = $fileHandle;

        return true;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
     */
    public function read($count)
    {
        if (! $this->fileHandle) {
=======
     * {@inheritdoc}
     */
    public function read($count)
    {
        if (!$this->fileHandle) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            return false;
        }

        if (false === $this->mode->allowsRead()) {
            throw new \LogicException('The stream does not allow read.');
        }

        return fread($this->fileHandle, $count);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
     */
    public function write($data)
    {
        if (! $this->fileHandle) {
=======
     * {@inheritdoc}
     */
    public function write($data)
    {
        if (!$this->fileHandle) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            return false;
        }

        if (false === $this->mode->allowsWrite()) {
            throw new \LogicException('The stream does not allow write.');
        }

        return fwrite($this->fileHandle, $data);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
     */
    public function close()
    {
        if (! $this->fileHandle) {
=======
     * {@inheritdoc}
     */
    public function close()
    {
        if (!$this->fileHandle) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            return false;
        }

        $closed = fclose($this->fileHandle);

        if ($closed) {
            $this->mode = null;
            $this->fileHandle = null;
        }

        return $closed;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function flush()
    {
        if ($this->fileHandle) {
            return fflush($this->fileHandle);
        }

        return false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        if ($this->fileHandle) {
            return 0 === fseek($this->fileHandle, $offset, $whence);
        }

        return false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function tell()
    {
        if ($this->fileHandle) {
            return ftell($this->fileHandle);
        }

        return false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function eof()
    {
        if ($this->fileHandle) {
            return feof($this->fileHandle);
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
    public function stat()
    {
        if ($this->fileHandle) {
            return fstat($this->fileHandle);
        } elseif (!is_resource($this->fileHandle) && is_dir($this->path)) {
            return stat($this->path);
        }

        return false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function cast($castAs)
    {
        if ($this->fileHandle) {
            return $this->fileHandle;
        }

        return false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function unlink()
    {
        if ($this->mode && $this->mode->impliesExistingContentDeletion()) {
            return @unlink($this->path);
        }

        return false;
    }
}
