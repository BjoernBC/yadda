<?php
/**
 * model/DbH.inc.php
 * @package MVC_NML_Sample
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once 'dbp.php';

class DbH extends DbP {
    private static $instance = FALSE;
    private static $dbh;

    private function __construct() {
        try {
            self::$dbh = new PDO(DbP::DSN, DbP::DBUSER, DbP::USERPWD);
            self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            printf("<p>Connect failed for following reason: <br/>%s</p>\n",
              $e->getMessage());
        }
    }

    public static function getDbH() {
        if (! self::$instance) {
            self::$instance = new DbH();
        }
        return self::$dbh;
    }
}