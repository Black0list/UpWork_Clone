<?php

namespace App\core;

class Request
{

    public function getPath()
    {
        $path = $_SERVER['PATH_INFO'] ?? '/';

        return $path;
    }

    public function getMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? false;
        return $method;
    }

    public function getData()
    {
        $data = [];
        foreach ($_REQUEST as $key => $value) {
            $data[$key] = $value;
        }

        return $data;
    }
}