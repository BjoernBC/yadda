<?php
/**
 * model/ModelA.inc.php
 * @package MVC_NML_Sample
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once '../dbh.php';
require_once 'modelif.php';
require_once 'model.php';
require_once '../authentication.php';

abstract class Model implements ModelIf {
    /*
     *
     */
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