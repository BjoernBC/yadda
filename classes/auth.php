<?php
require_once rootPath . 'classes/authi.php';

abstract class Auth implements AuthI{
    protected static $sessvar;
    protected static $logInstance = false;
    protected $userId;
    
    protected function __construct($user){
        $this->userId = $user;
    }
    
    
    public function getUserId(){
        return $this->userId;
    }
    
    public static function getLoginId(){
        return isset($_SESSION[self::$sessvar]) ? $_SESSION[self::$sessvar] : 'nobody';
    }

    public static function isAuthenticated(){
      return isset($_SESSION[self::$sessvar]) ? true : false;
    }
    
    public static function logout(){
        setcookie(session_name(), '', 0, '/');
        session_unset();
        session_destroy();
        session_write_close();
        unset($_SESSION[self::$sessvar]);
    }

    abstract public static function authenticate($user, $pwd);
    abstract protected static function dbLookUp($user, $pwd);
}
