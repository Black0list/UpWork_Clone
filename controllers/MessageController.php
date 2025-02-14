<?php

namespace App\controllers;

use App\core\Application;
use App\models\Message;
use App\models\User;

class MessageController
{
    private Message $messageModel;
    private User $userModel;


    public function __construct()
    {
        $this->messageModel = new Message();
        $this->userModel = new User();
    }

    public function message($params)
    {
        return Application::$app->Router->renderView("projet", $params);
    }

    public function getAll()
    {
        var_dump($data['client_id']);
        die;
        return $this->messageModel->getAll($params['data'] , $_SESSION['user']  );
    }

    



}