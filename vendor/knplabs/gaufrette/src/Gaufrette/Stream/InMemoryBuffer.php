<?php

namespace Gaufrette\Stream;

use Gaufrette\Stream;
use Gaufrette\Filesystem;
use Gaufrette\StreamMode;
use Gaufrette\Util;

class InMemoryBuffer implements Stream
{
    private $filesystem;
    private $key;
    private $mode;
    private $content;
    private $numBytes;
    private $position;
    private $synchronized;

    /**
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @param Filesystem $filesystem The filesystem managing the file to stream
     * @param string     $key        The file key
     */
    public function __construct(Filesystem $filesystem, $key)
    {
        $this->filesystem = $filesystem;
<<<<<<< HEAD
        $this->key     = $key;
    }

    /**
     * {@inheritDoc}
=======
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function open(StreamMode $mode)
    {
        $this->mode = $mode;

        $exists = $this->filesystem->has($this->key);

        if (($exists && !$mode->allowsExistingFileOpening())
            || (!$exists && !$mode->allowsNewFileOpening())) {
            return false;
        }

        if ($mode->impliesExistingContentDeletion()) {
            $this->content = $this->writeContent('');
        } elseif (!$exists && $mode->allowsNewFileOpening()) {
            $this->content = $this->writeContent('');
        } else {
            $this->content = $this->filesystem->read($this->key);
        }

        $this->numBytes = Util\Size::fromContent($this->content);
        $this->position = $mode->impliesPositioningCursorAtTheEnd() ? $this->numBytes : 0;

        $this->synchronized = true;

        return true;
    }

    public function read($count)
    {
        if (false === $this->mode->allowsRead()) {
            throw new \LogicException('The stream does not allow read.');
        }

        $chunk = substr($this->content, $this->position, $count);
<<<<<<< HEAD
        $this->position+= Util\Size::fromContent($chunk);
=======
        $this->position += Util\Size::fromContent($chunk);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744

        return $chunk;
    }

    public function write($data)
    {
        if (false === $this->mode->allowsWrite()) {
            throw new \LogicException('The stream does not allow write.');
        }

        $numWrittenBytes = Util\Size::fromContent($data);

<<<<<<< HEAD
        $newPosition     = $this->position + $numWrittenBytes;
        $newNumBytes     = $newPosition > $this->numBytes ? $newPosition : $this->numBytes;
=======
        $newPosition = $this->position + $numWrittenBytes;
        $newNumBytes = $newPosition > $this->numBytes ? $newPosition : $this->numBytes;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744

        if ($this->eof()) {
            $this->numBytes += $numWrittenBytes;
            if ($this->hasNewContentAtFurtherPosition()) {
<<<<<<< HEAD
                $data = str_pad($data, $this->position + strlen($data), " ", STR_PAD_LEFT);
=======
                $data = str_pad($data, $this->position + strlen($data), ' ', STR_PAD_LEFT);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            }
            $this->content .= $data;
        } else {
            $before = substr($this->content, 0, $this->position);
<<<<<<< HEAD
            $after  = $newNumBytes > $newPosition ? substr($this->content, $newPosition) : '';
            $this->content  = $before . $data . $after;
        }

        $this->position     = $newPosition;
        $this->numBytes     = $newNumBytes;
=======
            $after = $newNumBytes > $newPosition ? substr($this->content, $newPosition) : '';
            $this->content = $before.$data.$after;
        }

        $this->position = $newPosition;
        $this->numBytes = $newNumBytes;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        $this->synchronized = false;

        return $numWrittenBytes;
    }

    public function close()
    {
<<<<<<< HEAD
        if (! $this->synchronized) {
=======
        if (!$this->synchronized) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            $this->flush();
        }
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        switch ($whence) {
            case SEEK_SET:
                $this->position = $offset;
                break;
            case SEEK_CUR:
                $this->position += $offset;
                break;
            case SEEK_END:
                $this->position = $this->numBytes + $offset;
                break;
            default:
                return false;
        }

        return true;
    }

    public function tell()
    {
        return $this->position;
    }

    public function flush()
    {
        if ($this->synchronized) {
            return true;
        }

        try {
            $this->writeContent($this->content);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function eof()
    {
        return $this->position >= $this->numBytes;
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
        if ($this->filesystem->has($this->key)) {
            $isDirectory = $this->filesystem->isDirectory($this->key);
<<<<<<< HEAD
            $time        = $this->filesystem->mtime($this->key);

            $stats = array(
                'dev'   => 1,
                'ino'   => 0,
                'mode'  => $isDirectory ? 16893 : 33204,
                'nlink' => 1,
                'uid'   => 0,
                'gid'   => 0,
                'rdev'  => 0,
                'size'  => $isDirectory ? 0 : Util\Size::fromContent($this->content),
=======
            $time = $this->filesystem->mtime($this->key);

            $stats = array(
                'dev' => 1,
                'ino' => 0,
                'mode' => $isDirectory ? 16893 : 33204,
                'nlink' => 1,
                'uid' => 0,
                'gid' => 0,
                'rdev' => 0,
                'size' => $isDirectory ? 0 : Util\Size::fromContent($this->content),
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
                'atime' => $time,
                'mtime' => $time,
                'ctime' => $time,
                'blksize' => -1,
<<<<<<< HEAD
                'blocks'  => -1,
=======
                'blocks' => -1,
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            );

            return array_merge(array_values($stats), $stats);
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
    public function cast($castAst)
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
    public function unlink()
    {
        if ($this->mode && $this->mode->impliesExistingContentDeletion()) {
            return $this->filesystem->delete($this->key);
        }

        return false;
    }

    /**
<<<<<<< HEAD
     * @return Boolean
=======
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    protected function hasNewContentAtFurtherPosition()
    {
        return $this->position > 0 && !$this->content;
    }

    /**
<<<<<<< HEAD
     * @param string $content Empty string by default
     * @param bool $overwrite Overwrite by default
=======
     * @param string $content   Empty string by default
     * @param bool   $overwrite Overwrite by default
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @return string
     */
    protected function writeContent($content = '', $overwrite = true)
    {
        $this->filesystem->write($this->key, $content, $overwrite);

        return $content;
    }
}
