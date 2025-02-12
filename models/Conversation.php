<?php

use App\models\Projet;
use App\models\User;

class Conversation
{
    private int $id;
    private User $user1;
    private User $user2;
    private Projet $projet;


    public function __construct() {}
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setUser1($user1)
    {
        $this->user1 = $user1;
    }
    public function setUser2($user2)
    {
        $this->user2 = $user2;
    }
    public function setProjet($projet)
    {
        $this->projet = $projet;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getUser1()
    {
        return $this->user1;
    }
    public function getRser2()
    {
        return $this->user2;
    }
    public function getProjet()
    {
        return $this->projet;
    }

}
