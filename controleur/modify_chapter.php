<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 20/02/2017
 * Time: 18:48
 */
require(ROOT.'blog/controleur/head.php');


/**------------ variable initialisation ----------**/
$chapter_id  = isset($url[4]) ? $url[4] : null;
$novel_id    = isset($url[6]) ? $url[6] : null;
$novel_title = isset($url[8]) ? $url[8] : null;
/**--------------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();

//create a new session object
$session = new session();
//wil display flash message on save
$message = $session->sessionMessage();

//create a new novel object
$novel = new novel();
//set it with appropriates variables
$novel->setNovelTitle($novel_title);
$novel->setNovelId($novel_id);

//get the novel id => will be use as url parameter in the view
$novel_id_for_href = $novel->getNovelId();
//get the novel title => will be use in the view
$display_novel_title = $novel->getNovelTitle();

//create a new chapterManager object
$update_chapter = new chapterManager();


//call to getChapterById method and select the requested chapter
$chapter = $update_chapter->getChapterById($chapter_id);

//get all the data to display
$chapter_title = $chapter->getChapterTitle();
$chapter_startedOn = $chapter->getChapterStaredOn();
$chapter_id = $chapter->getChapterId();
$chapter_body = $chapter->getChapterBody();
$chapter_novelId = $chapter->getChapterNovelId();



//call to the view
require(ROOT.'blog/vue/modify_chapter.php');

