<?php

namespace Gaufrette;

/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Represents a stream mode
=======
 * Represents a stream mode.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * Represents a stream mode
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
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
<<<<<<< HEAD
     * Constructor
     *
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Constructor
     *
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
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
<<<<<<< HEAD
     * Returns the underlying mode
=======
     * Returns the underlying mode.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Returns the underlying mode
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Indicates whether the mode allows to read
     *
     * @return Boolean
=======
     * Indicates whether the mode allows to read.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Indicates whether the mode allows to read
     *
     * @return Boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
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
<<<<<<< HEAD
     * Indicates whether the mode allows to write
     *
     * @return Boolean
=======
     * Indicates whether the mode allows to write.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Indicates whether the mode allows to write
     *
     * @return Boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
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
<<<<<<< HEAD
     * Indicates whether the mode allows to open an existing file
     *
     * @return Boolean
=======
     * Indicates whether the mode allows to open an existing file.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Indicates whether the mode allows to open an existing file
     *
     * @return Boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function allowsExistingFileOpening()
    {
        return 'x' !== $this->base;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Indicates whether the mode allows to create a new file
     *
     * @return Boolean
=======
     * Indicates whether the mode allows to create a new file.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Indicates whether the mode allows to create a new file
     *
     * @return Boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function allowsNewFileOpening()
    {
        return 'r' !== $this->base;
    }

    /**
     * Indicates whether the mode implies to delete the existing content of the
<<<<<<< HEAD
<<<<<<< HEAD
     * file when it already exists
     *
     * @return Boolean
=======
     * file when it already exists.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * file when it already exists
     *
     * @return Boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function impliesExistingContentDeletion()
    {
        return 'w' === $this->base;
    }

    /**
     * Indicates whether the mode implies positioning the cursor at the
<<<<<<< HEAD
<<<<<<< HEAD
     * beginning of the file
     *
     * @return Boolean
=======
     * beginning of the file.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * beginning of the file
     *
     * @return Boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function impliesPositioningCursorAtTheBeginning()
    {
        return 'a' !== $this->base;
    }

    /**
     * Indicates whether the mode implies positioning the cursor at the end of
<<<<<<< HEAD
<<<<<<< HEAD
     * the file
     *
     * @return Boolean
=======
     * the file.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * the file
     *
     * @return Boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function impliesPositioningCursorAtTheEnd()
    {
        return 'a' === $this->base;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Indicates whether the stream is in binary mode
     *
     * @return Boolean
=======
     * Indicates whether the stream is in binary mode.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Indicates whether the stream is in binary mode
     *
     * @return Boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function isBinary()
    {
        return 'b' === $this->flag;
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * Indicates whether the stream is in text mode
     *
     * @return Boolean
=======
     * Indicates whether the stream is in text mode.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * Indicates whether the stream is in text mode
     *
     * @return Boolean
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function isText()
    {
        return false === $this->isBinary();
    }
}
