<?php

namespace App\models;

use App\config\Database;
use PDO;

class Role
{
    protected int $id = 0;
    protected string $role_name = '';
    protected string $description = '';

    public function __call($name, $arguments)
    {
        if ($name === "Build" && isset($arguments[0]) && is_array($arguments[0])) {
            $allowedAttributes = ['id', 'role_name', 'description'];

            foreach ($arguments[0] as $key => $value) {
                if (in_array($key, $allowedAttributes)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function getId() { return $this->id; }
    public function getRoleName() { return $this->role_name; }
    public function getDescription() { return $this->description; }

    public function setId($id) { $this->id = $id; }
    public function setRoleName($role_name) { $this->role_name = $role_name; }
    public function setDescription($description) { $this->description = $description; }


    public function findOneBy($field, $value){
        $Db = Database::getInstance()->getConnection();
        $query = "SELECT " . implode(", ", $this->getAttributes()) . " FROM {$this->TableName()} WHERE {$field} = '{$value}' LIMIT 1";
        $statement = $Db->prepare($query); 
        $statement->execute();
        $result = $statement->fetchObject($this->getClass());
        return $result;
    }
    public function create()
    {
        $Db = Database::getInstance()->getConnection();
        $query = "INSERT INTO role (role_name , description) VALUES ('" . $this->getRoleName() ." ',' ".$this->getDescription()."';)";
        $stmt = $Db->prepare($query); 
        $stmt->execute();
        $this->setId($Db->lastInsertId());
    }
    public function update()
    {
        $Db = Database::getInstance()->getConnection();
        $query = "UPDATE TABLE role SET role_name = '".$this->getRoleName() . "' , SET description = '".$this->getDescription()."' WHERE id = ".$this->getId().";";
        $stmt = $Db->prepare($query); 
        $stmt->execute();
    }
    public function delete()
    {
        $Db = Database::getInstance()->getConnection();
        $query = "DELETE FROM role WHERE id = " .$this->getId().";";
        $stmt = $Db->prepare($query); 
        $stmt->execute();
    }
    public function findAll()
    {
        $Db = Database::getInstance()->getConnection();
        $query = "SELECT id , role_name , description FROM role;";
        $stmt = $Db->prepare($query); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Role::class);
    }


    public function getAttributes(): array{
        return ["id", "role_name", "description"];
    }

    public function getClass(){
        return Role::class;
    }

    public function TableName(): String{
        return "role";
    }

    public function __toString()
    {
        return "id : {$this->getId()}, Role Name : {$this->getRoleName()}, Description : {$this->getDescription()}";
    }
}





