<?php

namespace App\controllers;

use App\core\Application;
use App\core\Request;
use App\models\User;

class AuthController 
{
    private User $userModel;
    private Request $Request;

    public function __construct() {
        $this->userModel = new User();
    }

    public function Auth(){
        return Application::$app->Router->renderView("login");
    }

    public function Login(array $data) {
        if(!empty($data)) {
            $user = $this->userModel->authenticate($data["email"], $data["password"]);
        }

        if ($user) {
            $_SESSION['user'] = $user;
            var_dump($_SESSION['user']);
            die;
        } else {
            $_SESSION['message'] = "Login failed";
            header('Location: /login?error=invalid_credentials');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /');
    }
}