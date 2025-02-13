<?php


namespace App\http;

use App\config\Database;
use App\models\Role;
use App\models\User;

class Login
{
    public string $email;
    public string $password;
    private Role $role;


    public function __construct()
    {
        $this->role = new Role;
    }

    public function __call($name , $args)
    {
        if($name == 'loginAttributes')
        {
            if(count($args) == 2)
            {
                $this->email = $args[0];
                $this->password = $args[1];
            }
        }
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function getUserByEmailAndPassword($email, $password)
    {
        $Db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM utilisateur WHERE email = '{$email}' AND password = '{$password}'";
        $statement = $Db->prepare($query);  
        $statement->execute();
        $object = $statement->fetchObject(User::class);

        $role = $this->role->findOneBy("id", $object->role_id);
        $object->setRole($role);

        return $object;
    }

    public function login($email , $password)
    {
        return  $this->getUserByEmailAndPassword($email, $password);
    }
}