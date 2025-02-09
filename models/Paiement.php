<?php

namespace App\models;

use App\config\Database;

class Paiement
{
    protected int $id;
    protected string $method;
    protected string $date;
    protected User $user;

    public function __call($name, $arguments)
    {
        if ($name === "Build" && isset($arguments[0]) && is_array($arguments[0])) {
            $allowedAttributes = ['id', 'method', 'date', 'user'];

            foreach ($arguments[0] as $key => $value) {
                if (in_array($key, $allowedAttributes)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function getId() { return $this->id; }
    public function getMethod() { return $this->method; }
    public function getDate() { return $this->date; }
    public function getUser() { return $this->user; }

    public function setId($id) { $this->id = $id; }
    public function setMethod($method) { $this->method = $method; }
    public function setDate($date) { $this->date = $date; }
    public function setUser(User $user) { $this->user = $user; }

    public function __toString()
    {
        return "id : {$this->getId()}, Method : {$this->getMethod()}, Date : {$this->getDate()}, User : {$this->getUser()}";
    }
}
?>
