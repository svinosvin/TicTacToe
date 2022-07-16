<?php
require __DIR__ . '/../vendor/autoload.php';
use app\core\Application;
use app\models\User;

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [

    "dns" => $_ENV["DB_DNS"],
    "dbc" => $_ENV["DB_CREATE"],
    "user" => $_ENV["DB_USER"],
    "password" => $_ENV["DB_PASSWORD"]

];
$app = new Application($config);
$app->user = new User();


session_start();


if( !isset($_SESSION['session_variable'])){
    $_SESSION['session_variable'] = time();
    $app->user->setSessionVar($_SESSION['session_variable']);
    User::insertUser(Application::$app->user);
    $app->user->setSessionVar($_SESSION['session_variable']);
}
$session_variable = $_SESSION['session_variable'];
$app->user = User::getUserBySession($session_variable);
$_SESSION['lvl'] = $app->user->getLvl();

include 'game.php';

//include __DIR__ . '/../views/botResponse.php'

