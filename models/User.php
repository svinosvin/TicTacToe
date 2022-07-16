<?php

namespace app\models;

use app\core\Application;
use app\core\Db;
use PDO;
class User
{
    private $id;
    private $session_var;
    private $lvl;
    public static User $currentUser;
    public function __construct( )
    {

    }

    public static function insertUser(User $user){
        $myDb = Application::$app->db;
        $session_var = $user->getSessionVar();
        $SQL = "INSERT INTO `users` (`session_var`) VALUES ('$session_var');";
        $pdo = $myDb->pdo;
        $pdo->exec($SQL);
    }

    public static function updateUser(User $user){
        $myDb = Application::$app->db;
        $session_var = $user->getSessionVar();
        $lvl = $user->getLvl();
        $SQL = "UPDATE `users` SET session_var='$session_var', lvl = $lvl WHERE `users`.session_var='$session_var';";
        $pdo = $myDb->pdo;
        $pdo->exec($SQL);

    }

    public static function getUserBySession($session_var) : User {
        $myDb = Application::$app->db;
        $pdo = $myDb->pdo;
        $statement = $pdo->query('SELECT * FROM users');

        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            if($session_var==$row['session_var']){
                $id = $row['id'];
                $lvl = $row['lvl'];
                $user = new User();
                $user->setSessionVar($session_var);
                $user->setId($id);
                $user->setLvl($lvl);
                return $user;
            }
        }
        return new User();
    }



    private function checkLvl(int $lvl) : bool{
        if($lvl>0 && $lvl<6){
            return true;
        }
        else{
            return false;
        }
    }
    public function increaseLvl(){
        $newLvl = $this->lvl;
        $newLvl++;
        if($this->checkLvl($newLvl))
            $this->setLvl($newLvl);
    }

    public function decreaseLvl(){
        $newLvl = $this->lvl;
        $newLvl--;
        if($this->checkLvl($newLvl))
            $this->setLvl($newLvl);
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSessionVar()
    {
        return $this->session_var;
    }

    /**
     * @param mixed $session_var
     */
    public function setSessionVar($session_var): void
    {
        $this->session_var = $session_var;
    }

    /**
     * @return mixed
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * @param mixed $lvl
     */
    public function setLvl($lvl): void
    {
        if($this->checkLvl($lvl)){
            $this->lvl = $lvl;
            self::updateUser($this);
        }
    }









}