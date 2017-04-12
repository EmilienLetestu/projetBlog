<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 13/02/2017
 * Time: 17:27
 */
include_once(ROOT.'blog/config.php');

session_start();
$_SESSION = array();
session_destroy();
if(isset($_COOKIE['user_id']))
{
    setcookie('user_id','',-3600,'/','localhost',false,true);
}
header('Location:accueil');

