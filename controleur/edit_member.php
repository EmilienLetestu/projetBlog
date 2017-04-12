<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 27/02/2017
 * Time: 09:56
 */

include_once(ROOT.'blog/config.php');

/**------------ variable initialisation ----------**/
$user_id = isset($url[4]) ? $url[4] : null;
$status  = isset($url[6]) ? $url[6] : null;
/**-----------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();


//create a new memberManager object
$edit = new memberManager();

//call "editMember" to apply requested action
$edit->editMember($user_id, $status);

//redirect to admin view
header('Location: ' . $_SERVER['HTTP_REFERER']);