<?php

namespace App\models;

use App\config\Database;

class Projet
{
    private int $id;
    private string $nom;
    private string $description;
    private String $created_at;
    private Categorie $categorie;
    private string $status;
    private User $freelancer;
    private User $client;
    private array $terms = [];


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
    public function getCategorie() { return $this->categorie; }
    public function getStatus() { return $this->status; }
    public function getFreelancer() { return $this->freelancer; }
    public function getClient() { return $this->client; }
    public function getTerms() { return $this->terms; }

    public function setId($id) { $this->id = $id; }
    public function setNom($nom) { $this->nom = $nom; }
    public function setDescription($description) { $this->description = $description; }
    public function setDate($created_at) { $this->created_at = $created_at; }
    public function setCategorie( Categorie $categorie) { $this->categorie = $categorie; }
    public function setStatus($status) { $this->status = $status; }
    public function setFreelancer(User $freelancer) { $this->freelancer = $freelancer; }
    public function setClient(User $client) { $this->client = $client; }
    public function setTerms(array $terms) { $this->client = $terms; }

    public function __toString()
    {
        return "id : {$this->getId()}, Name : {$this->getNom()}, Description : {$this->getDescription()}, Duration : {$this->getDate()}, Status : {$this->getStatus()}, " . "Terms :" . implode(',', $this->getTerms());
    }
}
?>
