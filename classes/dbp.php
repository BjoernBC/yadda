<?php
/**
 * model/AuthA.inc.php
 * @package MVC_NML_Sample
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
abstract class DbP {
    const DBHOST = 'localhost';
    const DBUSER = 'root';
    const USERPWD = '';
    const DB = 'newworld';
    const DSN = "mysql:host=".self::DBHOST.";dbname=".self::DB;
}