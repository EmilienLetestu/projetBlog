<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 08/03/2017
 * Time: 14:57
 */
include_once(ROOT.'blog/config.php');

/**------------ variable initialisation ----------**/
$cmt_id     = isset($url[4]) ? $url[4] : null;
$cmt_status = isset($url[6]) ? $url[6] : null;
/**-------------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();

//create a new commentManager object
$id = new commentsManager();

//call to "manualModerate" method to let admin moderate a comment even if it is still bellow the auto moderate value
$moderate_comment = $id->manualModerate($cmt_id,$cmt_status);

//redirect after data treatment
header('Location: ' . $_SERVER['HTTP_REFERER']);