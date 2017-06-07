<?php

namespace Gaufrette;

/**
<<<<<<< HEAD
 * Interface for the file streams
=======
 * Interface for the file streams.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 */
interface Stream
{
    /**
<<<<<<< HEAD
     * Opens the stream in the specified mode
     *
     * @param StreamMode $mode
     *
     * @return Boolean TRUE on success or FALSE on failure
=======
     * Opens the stream in the specified mode.
     *
     * @param StreamMode $mode
     *
     * @return bool TRUE on success or FALSE on failure
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function open(StreamMode $mode);

    /**
<<<<<<< HEAD
     * Reads the specified number of bytes from the current position
=======
     * Reads the specified number of bytes from the current position.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * If the current position is the end-of-file, you must return an empty
     * string.
     *
<<<<<<< HEAD
     * @param integer $count The number of bytes
=======
     * @param int $count The number of bytes
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @return string
     */
    public function read($count);

    /**
<<<<<<< HEAD
     * Writes the specified data
=======
     * Writes the specified data.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * Don't forget to update the current position of the stream by number of
     * bytes that were successfully written.
     *
     * @param string $data
     *
<<<<<<< HEAD
     * @return integer The number of bytes that were successfully written
=======
     * @return int The number of bytes that were successfully written
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function write($data);

    /**
<<<<<<< HEAD
     * Closes the stream
     *
     * It must free all the resources. If there is any data to flush, you
     * should do so
     *
     * @return void
=======
     * Closes the stream.
     *
     * It must free all the resources. If there is any data to flush, you
     * should do so
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function close();

    /**
<<<<<<< HEAD
     * Flushes the output
=======
     * Flushes the output.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * If you have cached data that is not yet stored into the underlying
     * storage, you should do so now
     *
<<<<<<< HEAD
     * @return Boolean TRUE on success or FALSE on failure
=======
     * @return bool TRUE on success or FALSE on failure
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function flush();

    /**
<<<<<<< HEAD
     * Seeks to the specified offset
     *
     * @param integer $offset
     * @param integer $whence
     *
     * @return Boolean
=======
     * Seeks to the specified offset.
     *
     * @param int $offset
     * @param int $whence
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function seek($offset, $whence = SEEK_SET);

    /**
<<<<<<< HEAD
     * Returns the current position
     *
     * @return integer
=======
     * Returns the current position.
     *
     * @return int
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function tell();

    /**
<<<<<<< HEAD
     * Indicates whether the current position is the end-of-file
     *
     * @return Boolean
=======
     * Indicates whether the current position is the end-of-file.
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function eof();

    /**
<<<<<<< HEAD
     * Gathers statistics of the stream
=======
     * Gathers statistics of the stream.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @return array
     */
    public function stat();

    /**
<<<<<<< HEAD
     * Retrieve the underlying resource
     *
     * @param  integer $castAs
     * @return mixed   using resource or false
=======
     * Retrieve the underlying resource.
     *
     * @param int $castAs
     *
     * @return mixed using resource or false
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function cast($castAs);

    /**
<<<<<<< HEAD
     * Delete a file
     *
     * @return Boolean TRUE on success FALSE otherwise
=======
     * Delete a file.
     *
     * @return bool TRUE on success FALSE otherwise
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function unlink();
}
