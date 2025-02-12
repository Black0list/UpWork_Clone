<?php

namespace App\controllers;

use App\core\Application;
use App\models\Projet;

class ProjetController
{
    private Projet $projetModel;

    public function __construct()
    {
        $this->projetModel = new Projet;
    }

    public function Projet($params)
    {
        return Application::$app->Router->renderView("projet", $params);
    }

    public function getAll()
    {
        return $this->projetModel->getAll();
    }

    // public function Delete($data)
    // {   
    //     $this->userModel = $this->userModel->findOneBy("id", $data["user_id"]);
    //     $this->userModel->Delete();
    //     header("Location: ".$_SERVER['HTTP_REFERER']);
    // }

}
