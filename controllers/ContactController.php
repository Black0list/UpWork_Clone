<?php

namespace App\controllers;

use App\core\Application;

class ContactController
{

    public function Contact(){
        return Application::$app->Router->renderView("contact");
    }

    public function Transform(array $data)
    {
        die($data["username"] . "OO" . $data["text"]);
    }

}