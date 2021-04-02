<?php

class YoutubeHelperParamException extends Exception
{
    public function __construct($paramName, $code = 0, $previous = null)
    {
        $message = "Parâmentro '$paramName' inexistente ou inválido";
        parent::__construct($message, $code, $previous);
    }
}