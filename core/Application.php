<?php

namespace app\core;

use app\models\User;

class Application
{
    public static Application $app;
    public User $user;
    public Db $db;
    public function __construct(array $config)
    {
        self::$app = $this;
        $this->db = new Db($config);

    }
    public function start(){


    }

}