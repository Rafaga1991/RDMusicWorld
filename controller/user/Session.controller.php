<?php

session_start();

class Session{
    public static function Auth(){
        return isset($_SESSION['LOGIN'])?$_SESSION['LOGIN']:false;
    }

    public static function Admin(){
        return isset($_SESSION['privileges'])?$_SESSION['privileges']:false;
    }

    public static function getUsername(){
        return isset($_SESSION['username'])?$_SESSION['username']:null;
    }
    
    public static function getUserID(){
        return isset($_SESSION['idUser'])?$_SESSION['idUser']:0;
    }

    public static function logout(){
        unset($_SESSION);
        session_destroy();
    }
}