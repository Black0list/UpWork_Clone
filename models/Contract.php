<?php

namespace App\models;

use App\config\Database;

class Contract
{
    protected int $id;
    protected User $client;
    protected User $freelancer;
    protected Projet $project;
    protected Terms $terms;
    protected string $status;

    public function __call($name, $arguments)
    {
        if ($name === "Build" && isset($arguments[0]) && is_array($arguments[0])) {
            $allowedAttributes = ['id', 'client', 'freelancer', 'project', 'terms', 'status'];

            foreach ($arguments[0] as $key => $value) {
                if (in_array($key, $allowedAttributes)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function getId() { return $this->id; }
    public function getClient() { return $this->client; }
    public function getFreelancer() { return $this->freelancer; }
    public function getProject() { return $this->project; }
    public function getTerms() { return $this->terms; }
    public function getStatus() { return $this->status; }

    public function setId($id) { $this->id = $id; }
    public function setClient(User $client) { $this->client = $client; }
    public function setFreelancer(User $freelancer) { $this->freelancer = $freelancer; }
    public function setProject(Projet $project) { $this->project = $project; }
    public function setTerms(Terms $terms) { $this->terms = $terms; }
    public function setStatus($status) { $this->status = $status; }

    public function __toString()
    {
        return "id : {$this->getId()}, Client ID : {$this->getClient()}, Freelancer ID : {$this->getFreelancer()}, Project ID : {$this->getProject()}, Status : {$this->getStatus()}";
    }
}
?>
