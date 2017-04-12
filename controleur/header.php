<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 17/02/2017
 * Time: 17:00
 */
require(ROOT.'blog/controleur/head.php');

/**------------ variable initialisation ----------**/
 $pswd_error     = isset($_SESSION['pswd_error'])  ? $_SESSION['pswd_error'] : null;
 $register_error = isset($_SESSION['register_error']) ? $_SESSION['register_error'] :null;
/**----------------------------------------------------**/

//create a new session object
$state = new session();

//if user is logged in : login button turns into a logout one
$buttonState = $state->sessionButton();

//display users a feedback message
$message = $state->sessionMessage();

$tools = new tools();

//wil display some admin buttons on frond-end view if administrator is logged
$for_admin_only = $tools->displayForAdminOnly();
//call to the view
require(ROOT.'blog/vue/header.php');