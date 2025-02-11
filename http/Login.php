<?php


namespace App\http;

use App\config\Database;
use App\models\User;

class Login
{
    public string $email;
    public string $password;


    public function __construct()
    {
        
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

        return $object;
    }

    public function login($email , $password)
    {
        return  $this->getUserByEmailAndPassword($email, $password);
    }
}