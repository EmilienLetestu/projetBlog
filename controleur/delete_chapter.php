<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 21/02/2017
 * Time: 13:04
 */
include_once(ROOT.'blog/config.php');

/**------------ variable initialisation ----------**/
$chapter_id  = isset($url[4]) ? $url[4] : null;
$novel_id    = isset($url[6]) ? $url[6] : null;
/**-------------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();

//create a new chapterManager object
$chapter = new chapterManager();

//create a new filter object
$filter = new filter();

//set and get requested filter
$filter->setFilter("id = $chapter_id");
$query = $filter->getFilter();

//call to deleteChapter method
$chapter->deleteChapter($query);

//call to th view
header('Location: //localhost/blog/liste-chapitres/novelId/'.$novel_id.'');



