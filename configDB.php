<?php
require __DIR__ . '/vendor/autoload.php';
use app\core\Db;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [

            "dns" => $_ENV["DB_DNS"],
            "dbc" => $_ENV["DB_CREATE"],
            "user" => $_ENV["DB_USER"],
            "password" => $_ENV["DB_PASSWORD"]

];


$db = new Db($config);
$db->Start($config);


