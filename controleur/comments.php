<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 23/02/2017
 * Time: 10:08
 */
include_once(ROOT.'blog/config.php');

/**------------ variable initialisation ----------**/
$comment        = isset($_POST['cmt_body']) ? $_POST['cmt_body'] : null;
$member_id      = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$chapter_id     = isset($url[4]) ? $url[4] : null;
$parent_id      = isset($_POST['parent_id']) ? $_POST['parent_id'] : null;
/**-------------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();

//create a new comments object
$cmt = new comments();

//set it with  appropriates variables
$cmt->setCmtBody($comment);
$cmt->setMembersId($member_id);
$cmt->setChaptersId($chapter_id);


//create a new commentManager object
$comment_manager = new commentsManager();
//call to save comment method and store comment into db
$parent_parent_id=$comment_manager->getCommentParent($parent_id);
var_dump($parent_parent_id);
$save_comment = $comment_manager->saveComment($cmt,$parent_id,$parent_parent_id);




//redirect after data treatment
header('Location: ' . $_SERVER['HTTP_REFERER']);



