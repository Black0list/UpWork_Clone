<?php

namespace App\core;

class Response
{
    private int $statusCode;

    public function SetStatusCode($code)
    {
        $this->statusCode = $code;
        http_response_code($code);
    }


}