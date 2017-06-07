<?php

namespace Gaufrette;

/**
<<<<<<< HEAD
 * Represents a stream mode
=======
 * Represents a stream mode.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 */
class StreamMode
{
    private $mode;
    private $base;
    private $plus;
    private $flag;

    /**
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @param string $mode A stream mode as for the use of fopen()
     */
    public function __construct($mode)
    {
        $this->mode = $mode;

        $mode = substr($mode, 0, 3);
        $rest = substr($mode, 1);

        $this->base = substr($mode, 0, 1);
        $this->plus = false !== strpos($rest, '+');
        $this->flag = trim($rest, '+');
    }

    /**
<<<<<<< HEAD
     * Returns the underlying mode
=======
     * Returns the underlying mode.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
<<<<<<< HEAD
     * Indicates whether the mode allows to read
     *
     * @return Boolean
=======
     * Indicates whether the mode allows to read.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function allowsRead()
    {
        if ($this->plus) {
            return true;
        }

        return 'r' === $this->base;
    }

    /**
<<<<<<< HEAD
     * Indicates whether the mode allows to write
     *
     * @return Boolean
=======
     * Indicates whether the mode allows to write.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function allowsWrite()
    {
        if ($this->plus) {
            return true;
        }

        return 'r' !== $this->base;
    }

    /**
<<<<<<< HEAD
     * Indicates whether the mode allows to open an existing file
     *
     * @return Boolean
=======
     * Indicates whether the mode allows to open an existing file.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function allowsExistingFileOpening()
    {
        return 'x' !== $this->base;
    }

    /**
<<<<<<< HEAD
     * Indicates whether the mode allows to create a new file
     *
     * @return Boolean
=======
     * Indicates whether the mode allows to create a new file.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function allowsNewFileOpening()
    {
        return 'r' !== $this->base;
    }

    /**
     * Indicates whether the mode implies to delete the existing content of the
<<<<<<< HEAD
     * file when it already exists
     *
     * @return Boolean
=======
     * file when it already exists.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function impliesExistingContentDeletion()
    {
        return 'w' === $this->base;
    }

    /**
     * Indicates whether the mode implies positioning the cursor at the
<<<<<<< HEAD
     * beginning of the file
     *
     * @return Boolean
=======
     * beginning of the file.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function impliesPositioningCursorAtTheBeginning()
    {
        return 'a' !== $this->base;
    }

    /**
     * Indicates whether the mode implies positioning the cursor at the end of
<<<<<<< HEAD
     * the file
     *
     * @return Boolean
=======
     * the file.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function impliesPositioningCursorAtTheEnd()
    {
        return 'a' === $this->base;
    }

    /**
<<<<<<< HEAD
     * Indicates whether the stream is in binary mode
     *
     * @return Boolean
=======
     * Indicates whether the stream is in binary mode.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function isBinary()
    {
        return 'b' === $this->flag;
    }

    /**
<<<<<<< HEAD
     * Indicates whether the stream is in text mode
     *
     * @return Boolean
=======
     * Indicates whether the stream is in text mode.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function isText()
    {
        return false === $this->isBinary();
    }
}
