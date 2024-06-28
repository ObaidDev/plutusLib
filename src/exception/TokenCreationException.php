<?php


namespace Fdvice\exception;

final class TokenCreationException extends \Exception
{
    public function __construct($message = "Data not found", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
