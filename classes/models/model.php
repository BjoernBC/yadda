<?php
require_once rootPath . 'classes/dbh.php';
require_once rootPath . 'classes/models/modelif.php';
//require_once 'model.php';
require_once rootPath . 'classes/authentication.php';

abstract class Model implements ModelIf {
    
    private static $dbh;
    private static $cookieQ = true;

    public function __construct() {
        $this->areCookiesEnabled();
    }
    
    public static function connect() {
        if (! self::$dbh) {
            self::$dbh = DbH::getDbH();
        }
        return self::$dbh;
    }

    public static function areCookiesEnabled() {
        if (self::$cookieQ) {
            return true;
        } else {
            try {
                setcookie('foo', 'bar', time() + 3600);
                self::$cookieQ = true;

            } catch (Exception $ex) {
                self::$cookieQ = false;
            } finally {
                return self::$cookieQ;                
            }
        }
    }

    abstract public function create();
    abstract public function update();
    abstract public function delete();
}