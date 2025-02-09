<?php

namespace App\models;

use App\config\Database;

class User
{
    protected int $id;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected string $password;
    protected Role $role;

    public function __call($name, $arguments)
    {
        if ($name === "Build" && isset($arguments[0]) && is_array($arguments[0])) {
            $allowedAttributes = ['id', 'firstname', 'lastname', 'email', 'password', 'role'];

            foreach ($arguments[0] as $key => $value) {
                if (in_array($key, $allowedAttributes)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function login($email, $password)
    {
        $db = Database::getInstance()->getConnection();
        
    }

    public function getId() { return $this->id; }
    public function getFirstname() { return $this->firstname; }
    public function getLastname() { return $this->lastname; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getRole() { return $this->role; }

    public function setId($id) { $this->id = $id; }
    public function setFirstname($firstname) { $this->firstname = $firstname; }
    public function setLastname($lastname) { $this->lastname = $lastname; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setRole(Role $role) { $this->role = $role; }

    public function __toString()
    {
        return "id : {$this->getId()}, Firstname : {$this->getFirstname()}, Lastname : {$this->getLastname()}, Email : {$this->getEmail()}, Password : {$this->getPassword()}, , Role : {$this->getRole()}";
    }
}
?>
