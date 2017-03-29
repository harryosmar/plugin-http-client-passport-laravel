<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/29/17
 * Time: 11:23 PM
 */

namespace PluginHttpClientPassportLaravel\Exception;

class InvalidTokenException extends \Exception
{
    public function __construct($message, $code, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return $this->message;
    }
}
