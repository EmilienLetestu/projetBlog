<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 22/03/2017
 * Time: 10:03
 */
include_once(ROOT.'blog/config.php');


/**------------ variable initialisation ----------**/
$email                = isset($_POST['email']) ? $_POST['email'] : null;
$pswd                 = isset($_POST['pswd'])  ? $_POST['pswd'] : null;
$redirect_after_login = isset($url[4]) ? $url[4] : null;
/**----------------------------------------------------**/
//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();

//create a new member object
$login_info = new Member();
//create a new session object
$verify_info = new session();

//use sent data from login form as setters
$login_info->setEmail($email);
$login_info->setPassword($pswd);

//use these data as getters
$userEmail =  $login_info->getEmail();
$userPswd  =  $login_info->getPassword();

//check if submitted email and password match
$verify_user = $verify_info->startSession($userEmail, $userPswd);

//create a new tools object
$tools = new tools();


$login_error = $tools->displayErrorOnLoginForm();

//redirect user to homepage or administrator to admin
$redirect = $verify_info->sessionRedirect($verify_user,$redirect_after_login);


//redirect after data treatment
header("Location: $redirect");

