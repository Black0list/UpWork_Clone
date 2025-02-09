<?php

namespace App\controllers;

use App\core\Application;

class HomeController
{
    public function Home()
    {
        return Application::$app->Router->renderView("home");
    }

    public function Home2(){
        echo "Hadoui";
    }

}