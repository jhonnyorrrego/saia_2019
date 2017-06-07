<?php

namespace Gaufrette\Exception;

use Gaufrette\Exception;

/**
<<<<<<< HEAD
 * Exception to be thrown when a file was not found
=======
 * Exception to be thrown when a file was not found.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 */
class FileNotFound extends \RuntimeException implements Exception
{
    private $key;

    public function __construct($key, $code = 0, \Exception $previous = null)
    {
        $this->key = $key;

        parent::__construct(
            sprintf('The file "%s" was not found.', $key),
            $code,
            $previous
        );
    }

    public function getKey()
    {
        return $this->key;
    }
}
