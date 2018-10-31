<?php
/**
 * model/AuthA.inc.php
 * @package MVC_NML_Sample
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once 'authi.php';

abstract class AuthA implements AuthI {
    protected static $sessvar = 'nAuth42'; // if set = logged on
    protected static $logInstance = false;
    protected $userId;
    
    protected function __construct($user) {
        $this->userId = $user;
    }
    
    
    public function getUserId() {
        return $this->userId;
    }
    
    public static function getLoginId() {
        return isset($_SESSION[self::$sessvar]) ? $_SESSION[self::$sessvar] : 'nobody';
    }

    public static function isAuthenticated() {
      return isset($_SESSION[self::$sessvar]) ? true : false;
    }
    
    public static function logout() {
        setcookie(session_name(), '', 0, '/');
        session_unset();
        session_destroy();
        session_write_close();
        unset($_SESSION[self::$sessvar]);
    }

    abstract public static function authenticate($user, $pwd);
    abstract protected static function dbLookUp($user, $pwd);
}
