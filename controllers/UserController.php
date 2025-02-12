<?php

namespace App\controllers;

use App\core\Application;
use App\models\User;

class UserController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }

    public function User($params)
    {
        return Application::$app->Router->renderView("user", $params);
    }

    public function Delete($data)
    {   
        $this->userModel = $this->userModel->findOneBy("id", $data["user_id"]);
        $this->userModel->Delete();
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function getAll()
    {
        return $this->userModel->getAll();
    }

}
