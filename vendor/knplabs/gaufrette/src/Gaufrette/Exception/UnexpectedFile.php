<?php

namespace Gaufrette\Exception;

use Gaufrette\Exception;

/**
<<<<<<< HEAD
 * Exception to be thrown when an unexpected file exists
=======
 * Exception to be thrown when an unexpected file exists.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author  Antoine Hérault <antoine.herault@gmail.com>
 */
class UnexpectedFile extends \RuntimeException implements Exception
{
    private $key;

    public function __construct($key, $code = 0, \Exception $previous = null)
    {
        $this->key = $key;

        parent::__construct(
            sprintf('The file "%s" was not supposed to exist.', $key),
            $code,
            $previous
        );
    }

    public function getKey()
    {
        return $this->key;
    }
}
