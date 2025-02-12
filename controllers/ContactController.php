<?php

namespace App\controllers;

use App\core\Application;

class ContactController
{

    public function Contact($params){
        return Application::$app->Router->renderView("contact", $params);
    }

    public function Transform(array $data)
    {
        die($data["username"] . "OO" . $data["text"]);
    }

}