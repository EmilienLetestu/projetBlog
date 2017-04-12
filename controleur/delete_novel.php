<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 23/02/2017
 * Time: 23:27
 */
include_once(ROOT.'blog/config.php');

/**------------ variable initialisation ----------**/
$novel_id  = isset($url[4]) ? $url[4] : null;
/**-------------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();

//create a new filter object
$filter = new filter();

//call setter and getter methods of filter to get the novel to delete below
$filter->setFilter("novels_id = $novel_id");
$query =$filter->getFilter();

//create a new novelManager object
$novel = new novelManager();

//call to deleteNovel method
$novel->deleteNovel($novel_id);


//call to th view
header('Location:'.$_SERVER["HTTP_REFERER"]);