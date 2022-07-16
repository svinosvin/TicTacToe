<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        <?php include_once "style.css"?>
    </style>
</head>
<body>

<div class="container">
    <div>
        <p>Для разблокировки поля нажмите Начать Игру</p>
        <h2 id="hidden"><?php echo \app\core\Application::$app->user->getSessionVar()?></h2>
        <h1> Ваш уровень равен: <?php echo \app\core\Application::$app->user->getLvl()?></h1>
        <table>
            <tr>
                <td><button class="btn btn-game"></button></td>
                <td><button class="btn btn-game"></button></td>
                <td><button class="btn btn-game"></button></td>
            </tr>
            <tr>
                <td><button class="btn btn-game"></button></td>
                <td><button class="btn btn-game"></button></td>
                <td><button class="btn btn-game"></button></td>
            </tr>
            <tr>
                <td><button class="btn btn-game"></button></td>
                <td><button class="btn btn-game"></button></td>
                <td><button class="btn btn-game"></button></td>
            </tr>
        </table>
        <div class="container">
            <div class="div">
                <button class="btn-start">Начать игру</button>
                <button class="btn-stop">Сбросить</button>
            </div>
        </div>
    </div>
  </div>

<script>
    <?php include_once "script.js"?>
</script>
</body>
</html>
<?php
