<?php

namespace App\models;

use App\config\Database;

class Role
{
    protected int $id;
    protected string $role_name;
    protected string $description;

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

    public function __toString()
    {
        return "id : {$this->getId()}, Role Name : {$this->getRoleName()}, Description : {$this->getDescription()}";
    }
}

