<?php

namespace App\models;

use App\config\Database;
use PDO;

class Projet
{
    private int $id;
    private string $nom;
    private string $description;
    private String $created_at;
    private Category $category;
    private string $status;
    private User $freelancer;
    private User $client;
    private array $terms = [];

    public function __construct()
    {
        $this->category = new Category;
        $this->freelancer = new User;
        $this->client = new User;
    }


    public function __call($name, $arguments)
    {
        if ($name === "Build" && isset($arguments[0]) && is_array($arguments[0])) {
            $allowedAttributes = ['id', 'nom', 'description', 'created_at', 'categorie', 'status', 'freelancer', 'client', 'terms'];

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
    public function getDate() { return $this->created_at; }
    public function getCategory() { return $this->category; }
    public function getStatus() { return $this->status; }
    public function getFreelancer() { return $this->freelancer; }
    public function getClient() { return $this->client; }
    public function getTerms() { return $this->terms; }

    public function setId($id) { $this->id = $id; }
    public function setNom($nom) { $this->nom = $nom; }
    public function setDescription($description) { $this->description = $description; }
    public function setDate($created_at) { $this->created_at = $created_at; }
    public function setCategory( Category $category) { $this->category = $category; }
    public function setStatus($status) { $this->status = $status; }
    public function setFreelancer(User $freelancer) { $this->freelancer = $freelancer; }
    public function setClient(User $client) { $this->client = $client; }
    public function setTerms(array $terms) { $this->client = $terms; }


    public function Create()
    {
        $Db = Database::getInstance()->getConnection();
        $query = "INSERT INTO Projet (nom, description, category_id, status, freelancer_id, client_id) VALUES('{$this->getNom()}', '{$this->getDescription()}', '{$this->getCategory()->getId()}', '{$this->getStatus()}', '{$this->getFreelancer()->getId()}', '{$this->getClient()->getId()}')";
        $statement = $Db->prepare($query); 
        $statement->execute();
    }


    public function getAll(){
        $Db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM projet";
        $statement = $Db->prepare($query); 
        $statement->execute();
        $objects = $statement->fetchAll(PDO::FETCH_CLASS, Projet::class);


        foreach ($objects as $object) {
            $category = $this->category->findOneBy("id", $object->category_id);
            $freelancer = $this->freelancer->findOneBy("id", $object->freelancer_id);
            $client = $this->client->findOneBy("id", $object->client_id);
            $object->setCategory($category);
            $object->setFreelancer($freelancer);
            $object->setClient($client);
        }

        return $objects;
    }

    public function findOneBy($field, $value){
        $Db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM projet WHERE {$field} = '{$value}' LIMIT 1";
        $statement = $Db->prepare($query); 
        $statement->execute();
        $object = $statement->fetchObject(Projet::class);

        return $object;
    }

    public function Delete()
    {
        $Db = Database::getInstance()->getConnection();
        $query = "DELETE FROM projet WHERE id = {$this->getId()}";
        $statement = $Db->prepare($query);  
        $statement->execute();
    }

    public function __toString()
    {
        return "id : {$this->getId()}, Name : {$this->getNom()}, Description : {$this->getDescription()}, Duration : {$this->getDate()}, Status : {$this->getStatus()}, " . "Terms :" . implode(',', $this->getTerms());
    }
}
?>
