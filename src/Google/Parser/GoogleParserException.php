<?php
/**
 * Created by PhpStorm.
 * User: nekrasov
 * Date: 05.12.15
 * Time: 2:46
 */

namespace Google\Parser;


class GoogleParserException extends \Exception
{
    public function __construct($message, $code = null, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}