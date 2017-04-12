<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 12/04/2017
 * Time: 11:39
 */
require(ROOT.'blog/controleur/header.php');
/**------------ variable initialisation ----------**/
$chapter_id  = isset($url[4]) ? $url[4] : null;
$novel_id    = isset($url[6]) ? $url[6] : null;
$novel_title = isset($url[8]) ? $url[8] : null;
/**--------------------------------------------------**/
//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();

//create a new chapterManager object
$preview_chapter = new chapterManager();


//Call to getChapterById method to select the requested chapter
$wip_chapter = $preview_chapter->getChapterById($chapter_id);

//Display chapter's title and body
$chapter_title = $wip_chapter->getChapterTitle();
$chapter_body  = $wip_chapter->getChapterBody();
$novel_id      = $wip_chapter->getChapterNovelId();


require(ROOT.'blog/vue/preview.php');
include_once(ROOT.'blog/vue/footer.php');