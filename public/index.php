<?php

use App\core\Application;
use App\models\User;

require_once dirname(__DIR__, 1)."\\vendor\\autoload.php";

session_start();

$app = new Application(dirname(__DIR__, 1));

$user = new User;

$app->run();



