<?php

namespace app\http;

use App\models\Role;
use App\models\User;
use Exception;

class Register
{
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private string $passwordConfirmation;
    private string $role;
    private User $userModel;



    public function __construct() {}

    public function __call($name, $args)
    {

        if ($name == 'registerAttributes') {
            if (count($args) == 6) {
                $this->firstname = $args[0];
                $this->lastname = $args[1];
                $this->email = $args[2];
                $this->password = $args[3];
                $this->passwordConfirmation = $args[4];
                $this->role = $args[5];
            }
        }
    }

    public function getFirstname()
    {
        return $this->firstname;
    }
    public function getLastname()
    {
        return $this->lastname;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getPasswordConfirmation()
    {
        return $this->passwordConfirmation;
    }
    public function getRoleName()
    {
        return $this->role;
    }

    public function passwordValidation($password, $passwordConfirmation): bool
    {
        if ($passwordConfirmation === $password) {
            return true;
        } else {
            return false;
        }
    }
    public function register(Register $register)
    {
        if ($this->passwordValidation($register->getPassword(), $register->getPasswordConfirmation())) {
            $role = new Role();
            $role->setRoleName($register->getRoleName());
            $role->findByName($role->getRoleName());
            $user = new User();
            $user->registerAttributes(
                $register->getFirstname(),
                $register->getLastname(),
                $register->getEmail(),
                $register->getPassword(),
                $role
            );
            $user->create();
        }
        else
        {
            return new Exception("password invalide");
        }
    }
}
