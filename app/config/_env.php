<?php

define('BASE_PATH', realpath(__DIR__ . '/../../'));

require_once BASE_PATH . '/vendor/autoload.php';

$dotEnv = Dotenv\Dotenv::create(BASE_PATH);

$dotEnv->load();
