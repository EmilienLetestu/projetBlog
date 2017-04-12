<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 27/02/2017
 * Time: 11:21
 */
require(ROOT.'blog/controleur/header.php');

/**------------ variable initialisation ----------**/
$id = isset($url[4]) ? $url[4] : null;
/**-------------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();



//create a new memberManager object
$member = new memberManager();

//call "getMemberById" method and select requested member
$member_details = $member->getMemberById($id);

//Get details on selected member
$member_id = $member_details->getId();
$member_name = $member_details->getName();
$member_surname = $member_details->getSurname();
$member_status = $member_details->getStatus();
$member_date = $member_details->getDate();
$member_countBan = $member_details->getCountBan();

//create a new tools object
$button_text  = new tools();
//call "textForBanButton" method to dynamically change ban button text
$ban_button   = $button_text->textForBanButton($member_status);

//create a new commentsManager object
$informations = new commentsManager();

$query = "members_id = $id";

//call "commentReviewByMember" method and select all comments written by the requested member
$member_comments = $informations->getCommentsBy($query);


//select all the information on the member comments we want to display
foreach ($member_comments as $comment)
{
    $comment->getCmtBody();
    $comment->getCmtDate();
    $comment->getThumbUp();
    $comment->getThumbDown();
    $comment->getFlag();
    $displayButton = $button_text->displayDeleteCommentBtn($comment->getCmtStatus());
    $chapter = new chapterManager();
    $chapters = $chapter->getChapterById($comment->getChaptersId());
    $chapter_title = $chapters->getChapterTitle();
}

//call to the view
require_once (ROOT.'blog/vue/menber_informations.php');
include_once(ROOT.'blog/vue/footer.php');