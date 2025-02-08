<?php

use App\controllers\AuthController;
use App\controllers\ContactController;

return [
    "GET" => [
        "/" => "home",
        "/login" => "login",
        "/contact" => "contact"
    ],
    "POST" => [
        "/login" => [AuthController::class, "login"],
        "/transform" => [ContactController::class, "transform"]
    ]
];
