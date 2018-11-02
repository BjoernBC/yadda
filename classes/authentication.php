<?php
require_once rootPath . 'classes/auth.php';

class Authentication extends Auth {
    protected function __construct($user, $pwd){
        parent::__construct($user);
        try{
            self::dbLookUp($user, $pwd);                        // invoke auth
            $_SESSION[self::$sessvar] = $this->getUserId();     // succes
        }
        catch (Exception $e){
            self::$logInstance = FALSE;
            unset($_SESSION[self::$sessvar]);                   //miserys
        }      
    }
    public static function authenticate($user, $pwd) {
        echo self::$logInstance;
        if (!self::$logInstance){
            self::$logInstance = new Authentication($user, $pwd);
        }
        return self::$logInstance;
    }
    protected static function dbLookUp($user, $pwdtry) {
        // Using prepared statement to prevent SQL injection
        $sql = "select id, email, password 
                from users
                where email = :email
                and status = true;";
        $dbh = Model::connect();
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':email', $user);
            $q->execute();
            $row = $q->fetch();
            if (!($row['email'] === $user
                    && password_verify($pwdtry, $row['password']))) { 
                 throw new Exception("Not authenticated", 42);   //misery
            }
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
}