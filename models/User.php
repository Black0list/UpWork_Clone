<?php

namespace App\models;

use App\config\Database;

class User extends GenericModel{
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private string $Cpassword;
    private Role $role;

    public function __call($name, $arguments)
    {
        if ($name === "Build" && isset($arguments[0]) && is_array($arguments[0])) {
            $allowedAttributes = ['id', 'firstname', 'lastname', 'email', 'password', 'password', 'role'];

            foreach ($arguments[0] as $key => $value) {
                if (in_array($key, $allowedAttributes)) {
                    $this->{$key} = $value;
                }
            }
        }
        if ($name === "registerAttribues")
        {
            if (count($arguments) == 5 ) {
                $this->firstname = $arguments[0];
                $this->lastname = $arguments[1];
                $this->email = $arguments[2];
                $this->password = $arguments[3];
                $this->role = $arguments[4];
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
    public function getCPassword() { return $this->Cpassword; }
    public function getRole() { return $this->role; }
    public function getRole_name() { return $this->role->getRoleName(); }
    
    

    public function setId($id) { $this->id = $id; }
    public function setFirstname($firstname) { $this->firstname = $firstname; }
    public function setLastname($lastname) { $this->lastname = $lastname; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setRole(Role $role) { $this->role = $role; }


    public function getAttributes(): array{
        return ["firstname", "lastname", "email", "password", "role_id"];
    }

    public function getClass(){
        return User::class;
    }

    public function TableName(): String{
        return "Utilisateur";
    }

    public function __toString()
    {
        return "id : {$this->getId()}, Firstname : {$this->getFirstname()}, Lastname : {$this->getLastname()}, Email : {$this->getEmail()}, Password : {$this->getPassword()}, , Role : {$this->getRole()}";
    }
}
?>
