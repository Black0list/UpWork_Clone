<?php
namespace App\public;


use App\models\Role;

$role = new Role();
$role->setRoleName('freeee');
$role->setDescription('test');
$role->create();