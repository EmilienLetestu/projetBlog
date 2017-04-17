<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 20/02/2017
 * Time: 14:56
 */
require(ROOT.'blog/controleur/header.php');

/**------------ variable initialisation ----------**/
$novel_id      = isset($url[4]) ? $url[4] : null;
$filters       = isset($_POST['filter']) ? $_POST['filter'] : "1=1";
/**----------------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();

//create a new filter object
$chapter_filters = new filter();

//use sent values as set and get a filter
$chapter_filters->setFilter($filters);
$apply_filters = $chapter_filters->getFilter();

//call "filterForChapter"s method will define a filter query for "getAllChapter" method use below
$apply_set_filters = $chapter_filters->applyFilter($apply_filters);

//create a new chapterManager object
$chapters = new chapterManager();

//add an order constraint to query
$order_by = ' ORDER BY publish_on DESC';

//call "getAllChapter" method and return all the chapter from a selected  novel and apply some filters
$chapter_list = $chapters->getAllChapter($novel_id, $apply_set_filters.$order_by);


//use a foreach loop on the array to get and display information on all the chapters
foreach ($chapter_list as $chapter)
{
    $chapter_title      = $chapter->getChapterTitle();
    $chapter_startedOn  = $chapter->getChapterStaredOn();
    $chapter_id         = $chapter->getChapterId();
    $chapter_body       = $chapter->getChapterBody();
    $chapter_state      = $chapter->getChapterState();
    $chapter_lastMod    = $chapter->getChapterLastMod();
    $chapter_publish_on = $chapter->getChapterPublishOn();

}

//create a new tools object -> will be used in view to keep select option selected after submit
$tools = new tools();

$title = new chapter();

$title->setChapterNovelTitle($novel_id);
$novel_title = $title->getChapterNovelTitle();

//call to the view
require(ROOT.'blog/vue/list_chapter.php');

include_once(ROOT.'blog/vue/footer.php');