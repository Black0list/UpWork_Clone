<?php

namespace App\models;

use App\config\Database;

class User
{
    protected int $id;
    protected String $name;
    protected String $email;
    protected String $password;

    public function __call($name, $arguments) {
        if ($name === "Build" && isset($arguments[0]) && is_array($arguments[0])) {
            $allowedAttributes = ['id', 'name', 'email', 'password'];
    
            foreach ($arguments[0] as $key => $value) {
                if (in_array($key, $allowedAttributes)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function authenticate($email, $password)
    {
//        phpinfo();
        $db = Database::getInstance()->getConnection();
        var_dump($db);
        die;
    }


    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }


    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }

    public function __toString()
    {
        return "id : {$this->getId()}, nom : {$this->getName()}, Email : {$this->getEmail()}, Password : {$this->getPassword()}";
    }
}