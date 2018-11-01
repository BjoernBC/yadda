<?php
require_once 'classes/dbp.php';

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