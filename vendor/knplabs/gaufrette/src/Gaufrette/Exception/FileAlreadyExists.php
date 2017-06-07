<?php

namespace Gaufrette\Exception;

use Gaufrette\Exception;

/**
<<<<<<< HEAD
 * Exception to be thrown when a file already exists
=======
 * Exception to be thrown when a file already exists.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class FileAlreadyExists extends \RuntimeException implements Exception
{
    private $key;

    public function __construct($key, $code = 0, \Exception $previous = null)
    {
        $this->key = $key;

        parent::__construct(
            sprintf('The file %s already exists and can not be overwritten.', $key),
            $code,
            $previous
        );
    }

    public function getKey()
    {
        return $this->key;
    }
}
