<?php

namespace App\controllers;

use App\core\Application;
use App\models\Role;

class RoleController
{

    private Role $roleModel;

    public function __construct()
    {
        $this->roleModel = new Role;
    }

    public function Role($params){
        return Application::$app->Router->renderView("role", $params);
    }

    public function Create($data){
        $this->roleModel->Create();
    }

    public function getAll(){
        return $this->roleModel->getAll();
    }

}