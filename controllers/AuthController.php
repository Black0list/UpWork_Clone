<?php

namespace App\controllers;

use App\core\Application;
use App\core\Request;
use App\models\Role;
use App\models\User;

class AuthController 
{
    private User $userModel;
    private Request $Request;
    private Role $roleModel;

    public function __construct() {
        $this->userModel = new User();
        $this->roleModel = new Role();
    }

    public function Auth(){
        return Application::$app->Router->renderView("login");
    }

    public function Login(array $data) {
        if(!empty($data)) {
            $user = $this->userModel->login($data["email"], $data["password"]);
        }

        if ($user) {
            $_SESSION['user'] = $user;
        } else {
            $_SESSION['message'] = "Login failed";
            header('Location: /login?error=invalid_credentials');
        }
    }

    public function register(array $data) {

        $roleObj = $this->roleModel->findOneBy("role_name", $data["role"]);
        $data["role"] = $roleObj;
        $this->userModel->Build($data);

        $user = $this->userModel->Create();
        $_SESSION['user'] = $user;
    }
    public function logout() {
        session_destroy();
        header('Location: /');
    }
}