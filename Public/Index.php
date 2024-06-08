<?php
    ini_set("error_reporting",E_ALL);
    ini_set("display_errors",1);
    ini_set("display_startup_errors",1);
    require_once("../vendor/autoload.php");
    
    if(!isset($_SESSION))
    {
        session_start();
        /*$_SESSION['msgerro'] = array();
        $_SESSION['msgsuccess'] = array();
        $_SESSION['usuario'] = array();*/
    }

    $route = new \App\Routes;

