<?php
interface AuthI {
    public static function authenticate($user, $pwd);
    public static function isAuthenticated();
    public static function logout();
}