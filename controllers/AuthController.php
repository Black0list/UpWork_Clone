<?php

namespace App\controllers;

use App\core\Application;
use App\core\Request;
use App\http\Login;
use App\http\Register;
use App\models\Role;
use App\models\User;

class AuthController
{
    private Login $login;
    private Request $Request;
    private Role $roleModel;
    private Register $register;

    public function __construct()
    {
        $this->login = new Login();
        $this->roleModel = new Role();
        $this->register = new Register;
    }

    public function Auth()
    {
        return Application::$app->Router->renderView("login");
    }

    public function Login(array $data)
    {
        $user = '';
        if (!empty($data)) {
            $user = $this->login->login($data["email"], $data["password"]);
        }

        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: /home');

        } else {
            $_SESSION['message'] = "Login failed";
            header('Location: /login?error=invalid_credentials');
        }
    }

    public function register(array $data)
    {
        $data = array_values($data);
        
        $reg = $this->register->registerAttributes($data);

        $this->register->register($reg);

        header('Location: /login');

    }
    public function logout()
    {
        session_destroy();
        header('Location: /');
    }
}
