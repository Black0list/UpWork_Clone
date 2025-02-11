<?php

namespace App\models;

use App\config\Database;
use PDO;

class Categorie
{
    protected int $id;
    protected string $nom;
    protected string $description;

    public function __call($name, $arguments)
    {
        if ($name === "Build" && isset($arguments[0]) && is_array($arguments[0])) {
            $allowedAttributes = ['id', 'nom', 'description'];

            foreach ($arguments[0] as $key => $value) {
                if (in_array($key, $allowedAttributes)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getDescription() { return $this->description; }

    public function setId($id) { $this->id = $id; }
    public function setNom($nom) { $this->nom = $nom; }
    public function setDescription($description) { $this->description = $description; }

    public function findOneBy($field, $value){
        $Db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM categorie WHERE {$field} = '{$value}' LIMIT 1";
        $statement = $Db->prepare($query); 
        $statement->execute();
        $result = $statement->fetchObject(Categorie::class);

        return $result;
    }


    public function getAll(){
        $Db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM categorie";
        $statement = $Db->prepare($query); 
        $statement->execute();
        $objects = $statement->fetchAll(PDO::FETCH_CLASS, Categorie::class);

        return $objects;
    }

    public function __toString()
    {
        return "id : {$this->getId()}, Name : {$this->getNom()}, Description : {$this->getDescription()}";
    }
}
?>
