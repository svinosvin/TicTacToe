<?php

namespace app\core;
use PDO;

class Db
{

    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dbc = $config["dbc"];
        $dns = $config["dns"];
        $user = $config["user"];
        $password = $config["password"];
        //creating db if not exist
        $this->pdo = new \PDO($dbc, $user, $password);
        if(!$this->dbExist())
            $this->Start($config);
        else{
            //creating db if not exist
            $this->pdo = new \PDO($dns, $user, $password);
        }

    }

    public function Start(array $config)
    {
        $dbc = $config["dbc"];
        $dns = $config["dns"];
        $user = $config["user"];
        $password = $config["password"];
        //creating db if not exist
        $this->pdo = new \PDO($dbc, $user, $password);
        //creating db if not exist
        $this->createDb();
        $this->pdo = new \PDO($dns, $user, $password);
        //creating table if not exist
        $this->createTable();


    }


    private function createDb(){
        $SQL = 'CREATE DATABASE IF NOT EXISTS tictactoe_test_db';
        $this->pdo->exec($SQL);


//Execute a "SHOW DATABASES" SQL query.


    }

    private function dbExist() : bool{
        $stmt = $this->pdo->query('SHOW DATABASES');
        $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach($databases as $database){
            if($database == "tictactoe_test_db")
                return true;
        }
        return false;
    }

    private function  createTable(){

        $SQL = 'CREATE TABLE if not exists users(
        id INT AUTO_INCREMENT PRIMARY KEY,
        session_var VARCHAR(255) not null,
        lvl TINYINT DEFAULT 1,
        played_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB';
        $this->pdo->exec($SQL);

    }


    private function setPdo($path, $user, $password)
    {
        $this->pdo = new \PDO($path, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    protected function log($message)
    {
        echo '['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL;

    }

}