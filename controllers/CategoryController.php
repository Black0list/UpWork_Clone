<?php

namespace App\controllers;

use App\core\Application;
use App\models\Categorie;

class CategoryController
{

    private Categorie $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Categorie;
    }

    public function Category(){
        return Application::$app->Router->renderView("category");
    }

    public function Create($data){
        $this->categoryModel->Create();
    }

    public function getAll(){
        return $this->categoryModel->getAll();
    }

}