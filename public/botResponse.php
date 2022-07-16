<?php
require __DIR__ . '/../vendor/autoload.php';
use app\models\User;
use app\core\Application;

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [

    "dns" => $_ENV["DB_DNS"],
    "dbc" => $_ENV["DB_CREATE"],
    "user" => $_ENV["DB_USER"],
    "password" => $_ENV["DB_PASSWORD"]

];
$fields = $_POST["fields"];
$result = $_POST["result"];
$session_var = $_POST["session_var"];

$app = new Application($config);
$app->user = User::getUserBySession($session_var);
//var_dump($_POST);
$response = [];
$response['msg'] = 1;
$response['fieldExist'] = false;

if($result == 0)
{
    $response['fieldO'] = \app\core\Game::findCombination($fields);
    $fields[$response['fieldO']] = '0';
    $response['fieldExist'] = true;
    $response['botWin'] = \app\core\Game::checkBotWin($fields);
    if($response['botWin']){
        $response['msg'] = "Game over!";
        $response['game'] = 1;
        $app->user->decreaseLvl();
    }
    else{
        $response['msg'] = "Your turn!";
        $response['game'] = 0;
    }
}
if($result ==  1){
    $response['msg'] = "O no,u bit me";
    $response['game'] = 1;
    $app->user->increaseLvl();
}
if($result == 2) {
    $response['msg'] = "Draw!";
    $response['game'] = 1;
}
//


echo json_encode($response);
//var_dump($fields);
$mass = $_POST['fields'];
$response['success1'] = $app->user->getLvl();


