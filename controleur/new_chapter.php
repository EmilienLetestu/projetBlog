<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 03/03/2017
 * Time: 12:14
 */

require(ROOT.'blog/controleur/head.php');


/**------------ variable initialisation ----------**/
$novel_id = isset($url[4]) ? $url[4] : null;
/**-------------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();

//create a new session object to handle flash feedback message to user
$session = new session();
$message = $session->sessionMessage();


//create a new novel object
$novel = new novel();

//call to setter and getter method and get the novel id
$novel->setNovelId($novel_id);
$novel_id = $novel->getNovelId();

$chapter = new chapter();
$chapter ->setChapterNovelTitle($novel_id);



//call to the view
require_once(ROOT.'blog/vue/new_chapter.php');