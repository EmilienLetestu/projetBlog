<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 13/02/2017
 * Time: 10:22
 */
require(ROOT.'blog/controleur/header.php');
/**------------ variable initialisation --------------------**/
$error                = isset($_SESSION['login_error']) ? $_SESSION['login_error'] :null;
$email                = isset($_SESSION['email']) ? $_SESSION['email'] :null;
$redirect_after_login = isset($url[4]) ? $url[4] : 0;
$newbie_email         = isset($_SESSION['newbie_email']) ? $_SESSION['newbie_email'] :null;
/**---------------------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();

//create a new tools object
$tools = new tools();
//use to fill an hidden input
$fillUpForNewbie = $tools->fillUpEmailInputForNewbie();

require(ROOT.'blog/vue/login.php');
include_once(ROOT.'blog/vue/footer.php');