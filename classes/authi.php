<?php
/**
 * model/AuthI.inc.php
 * @package MVC_NML_Sample
 * @author nml
 * @copyright (c) 2017, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
interface AuthI {
    public static function authenticate($user, $pwd);
    public static function isAuthenticated();
    public static function logout();
}