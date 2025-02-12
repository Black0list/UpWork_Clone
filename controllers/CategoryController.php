<?php

namespace App\controllers;

use App\core\Application;
use App\models\Category;

class CategoryController
{

    private Category $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category;
    }

    public function Category($params){
        return Application::$app->Router->renderView("category", $params);
    }

    public function Create($data){
        $this->categoryModel->Create();
    }

    public function getAll(){
        return $this->categoryModel->getAll();
    }

}