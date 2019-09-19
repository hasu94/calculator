<?php
namespace Hasu94\Calculator\Exception;

class DivisionByZeroException extends \RuntimeException
{

    public function __construct($code = null, $previous = null)
    {
        parent::__construct('Division by zero', $code, $previous);
    }
}