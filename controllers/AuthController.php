<?php

namespace App\controllers;

use App\core\Application;
use App\core\Request;
use app\http\Register;
use App\models\Role;
use App\models\User;

class AuthController
{
    private User $userModel;
    private Request $Request;
    private Role $roleModel;
    private Register $register;

    public function __construct()
    {
        $this->userModel = new User();
        $this->roleModel = new Role();
        $this->register = new Register();
    }

    public function Auth()
    {
        return Application::$app->Router->renderView("login");
    }

    public function Login(array $data)
    {
        if (!empty($data)) {
            $user = $this->userModel->login($data["email"], $data["password"]);
        }

        if ($user) {
            $_SESSION['user'] = $user;
        } else {
            $_SESSION['message'] = "Login failed";
            header('Location: /login?error=invalid_credentials');
        }
    }

    public function register(array $data)
    {
        $data = array_values($data);
        
        $reg = $this->register->registerAttributes($data);
        
        
        $user = $this->register->register($reg);
        var_dump($user);
        die;


        $_SESSION['user'] = $user;
    }
    public function logout()
    {
        session_destroy();
        header('Location: /');
    }
}
