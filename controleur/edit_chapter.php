<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 20/02/2017
 * Time: 11:07
 */
require(ROOT.'blog/controleur/head.php');

/**------------ variable initialisation ----------**/
$novel_id      = isset($url[4]) ? $url[4] : null;
$chapter_id    = isset($url[6]) ? $url[6] : null;
$chapter_title = isset($_POST['chapter_title']) ? $_POST['chapter_title'] : null;
$chapter_body  = isset($_POST['chapter_body']) ? $_POST['chapter_body'] : null;
$publish_on    = isset($_POST['publish_on']) ? $_POST['publish_on'] : null;
$publish       = isset($_POST['publish']) ? $_POST['publish'] : null;
$preview       = isset($_POST['preview']) ? $_POST['preview'] : null;
/**-------------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();


//create a new tools object
$tools = new tools();

//call sql_date method to convert french date format to the sql one
if(!empty($publish_on))
{
    $sql_date = $tools->dateToSql($publish_on);
    $publish_on =$sql_date;
}

//create a new chapter object
$chapter = new chapter();

//call to setters methods and set the chapter title, body, novel_id and id
$chapter->setChapterTitle($chapter_title);
$chapter->setChapterBody($chapter_body);
$chapter->setChapterPublishOn($publish_on);


//create a new chapterManager object
$edit = new chapterManager();

//call "saveChapter" method which will update or create chapter wether it's new chapter or a modified one
$save = $edit->saveChapter($publish_on, $publish, $chapter,$novel_id,$chapter_id);

/**--prepare all the data needed for redirection => chapter_id, novel_title as we already have access to the novel_id--**/

//1. find the chapter id

//if the chapter is a new one and not an updated one => find its id
if($chapter_id == null)
{
    $find_chapter_id = $edit->getAllChapter($novel_id,$filter="body = '$chapter_body' AND title = '$chapter_title' AND started_on <= NOW() ORDER BY started_on ASC LIMIT 1",$array = false);

    $chapter_id_for_redirect= $find_chapter_id->getChapterId();
}
else
{
    $chapter_id_for_redirect = $chapter_id;
}

//2.find  the novel title the chapter belongs to
$saved_chapter = new chapter();
$saved_chapter->setChapterNovelTitle($novel_id);
$novel_title = $saved_chapter->getChapterNovelTitle();


//3.find if user want to save and preview or save and continue to work
$redirect = $tools->redirectToPreviewOrModify($preview,$chapter_id_for_redirect,$novel_id,$novel_title);

//if user want to preview is work in a front context => redirect to preview
//if user just want to save and continue => redirect to modify_chapter
header($redirect);