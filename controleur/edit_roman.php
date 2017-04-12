<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 18/02/2017
 * Time: 15:34
 */
require(ROOT.'blog/controleur/head.php');


/**------------ variable initialisation ----------**/
$novel_title = isset($_POST['novel_title']) ? $_POST['novel_title'] : null;
/**-------------------------------------------------**/

//create a new novel object
$novel = new novel();

//assign submitted data to the novel object
$novel->setNovelTitle($novel_title);
$title = $novel->getNovelTitle();

//create a new novelManager object
$save_novel = new novelManager();


//check if the title isn't already taken by a previous novel
$bdd_novel = $save_novel->verifyTitle($title);

//if the chosen title is available store the new novel into database
$save_novel->createNovel($bdd_novel, $novel);

//call to the view
header('Location:'.$_SERVER["HTTP_REFERER"]);

