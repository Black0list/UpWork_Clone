<?php

namespace App\models;

use App\config\Database;

class Proposal
{
    protected int $id;
    protected User $freelancer;
    protected Projet $project;
    protected string $quote;
    protected string $status;
    protected User $client;

    public function __call($name, $arguments)
    {
        if ($name === "Build" && isset($arguments[0]) && is_array($arguments[0])) {
            $allowedAttributes = ['id', 'freelancer', 'project', 'quote', 'status', 'client'];

            foreach ($arguments[0] as $key => $value) {
                if (in_array($key, $allowedAttributes)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function getId() { return $this->id; }
    public function getFreelancer() { return $this->freelancer; }
    public function getProject() { return $this->project; }
    public function getQuote() { return $this->quote; }
    public function getStatus() { return $this->status; }
    public function getClient() { return $this->client; }

    public function setId($id) { $this->id = $id; }
    public function setFreelancerId(User $freelancer) { $this->freelancer = $freelancer; }
    public function setProjectId(Projet $project) { $this->project = $project; }
    public function setQuote($quote) { $this->quote = $quote; }
    public function setStatus($status) { $this->status = $status; }
    public function setClientId(User $client) { $this->client = $client; }

    public function __toString()
    {
        return "id : {$this->getId()}, Freelancer ID : {$this->getFreelancer()}, Project ID : {$this->getProject()}, Status : {$this->getStatus()}";
    }
}
?>
