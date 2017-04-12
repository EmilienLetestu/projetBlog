<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 05/02/2017
 * Time: 16:29
 */
if(!isset($_SESSION))
{
    session_start();
}
ini_set('display_errors','on');
error_reporting(E_ALL);

$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
$root = $_SERVER['DOCUMENT_ROOT'].'/';
define("ROOT",$root);
define("HOST",$host);



function loadClass($class)
{
    include("modele/".$class."_class.php");
}

spl_autoload_register("loadclass");
