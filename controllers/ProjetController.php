<?php

namespace App\controllers;

use App\core\Application;
use App\models\Category;
use App\models\Projet;
use App\models\User;

class ProjetController
{
    private Projet $projetModel;
    private User $userModel;
    private Category $categoryModel;

    public function __construct()
    {
        $this->projetModel = new Projet;
        $this->userModel = new User;
        $this->categoryModel = new Category;
    }

    public function Projet($params)
    {
        return Application::$app->Router->renderView("projet", $params);
    }

    public function getAll()
    {
        return $this->projetModel->getAll();
    }

    public function Create($params)
    {
        $this->projetModel->setNom($params['nom']);
        $this->projetModel->setDescription($params['description']);
        $this->categoryModel->setId($params['category']);
        $this->projetModel->setCategory($this->categoryModel);
        $this->projetModel->setStatus("in Progress");
        $this->userModel->setId(0);
        $this->projetModel->setFreelancer($this->userModel);
        $this->userModel->setId($params['client_id']);
        $this->projetModel->setClient($this->userModel);

        $this->projetModel->Create();
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function Delete($params)
    {   
        $this->projetModel = $this->projetModel->findOneBy("id", $params["projet_id"]);
        $this->projetModel->Delete();
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function Apply($params)
    {   
        $this->projetModel->setId($params['projet_id']);
        $this->userModel->setId($params['user_id']);
        $this->projetModel->setFreelancer($this->userModel);
        $this->projetModel->Apply();
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function Show($params)
    {
        $this->projetModel->setId($params['projet_id']);
        $projet = $this->projetModel->findOneBy("id", $this->projetModel->getId());
        return Application::$app->Router->renderView("show", $projet);
    }



}
