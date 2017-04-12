<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 20/02/2017
 * Time: 19:28
 */
require(ROOT.'blog/controleur/header.php');

/**------------ variable initialisation ----------**/
$chapter_id      = isset($url[4]) ? $url[4] : null;
$next_id         = isset($next_id) ? $next_id : null;
$next_title      = isset($next_title) ? $next_title : null;
$previous_id     = isset($previous_id) ? $previous_id : null;
$previous_title  = isset($previous_title) ? $previous_title : null;
/**-------------------------------------------------**/
//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();

//create a new chapterManager object
$read_chapter = new chapterManager();


//Call to getChapterById method to select the requested chapter
$current_chapter = $read_chapter->getChapterById($chapter_id);

//Display chapter's title and body
$chapter_title = $current_chapter->getChapterTitle();
$chapter_body  = $current_chapter->getChapterBody();
$novel_id      = $current_chapter->getChapterNovelId();


//create a new chapter object
$chapter = new chapter();

//set an get the novel title => will be needed further on for the modify chapter link
$chapter->setChapterNovelTitle($novel_id);
$novel_title = $chapter->getChapterNovelTitle();

//Call to getChapterById method to create a link to the next chapter
$next_chapter = $read_chapter->getNextChapter($chapter_id);
foreach($next_chapter as $next)
{
    $next_title  = $next->getChapterTitle();
    $next_id     = $next->getChapterId();
}

//if there's no another chapter
if(!$next_title)
{
    $next_title = "A suivre...";
}

//create a new tools object
$tools = new tools();
//call to createLink method to generate the appropriate navigation link
$link_next = $tools->createLink($next_id,$next_title,$class="next");

$next_icon = $tools->linkIcon($next_title);

//Call to getChapterById method to create a link to the previous chapter
$previous_chapter = $read_chapter->getPreviousChapter($chapter_id);

foreach($previous_chapter as $previous)
{
    $previous_title  = $previous->getChapterTitle();
    $previous_id     = $previous->getChapterId();
}

//if there's no previous chapter
if(!$previous_title)
{
   $previous_title = "Accueil";
}

//call to createLink method to generate the appropriate navigation link
$link_previous = $tools->createLink($previous_id,$previous_title,$class="previous");

//call to createLink method to generate the appropriate icon
$previous_icon = $tools->linkIcon($previous_title);

//create a new commentsManger object1
$comments = new commentsManager();


//will return all comments and if a comment was moderate text will be change for "commentaire supprimé"
$chapter_comments = $comments->getCommentsByChapterId($chapter_id);

//
$btn = new tools();
$author = new memberManager();


//create a new tools object
$write_comment = new tools();

$button_text = $write_comment->textForShowCmtButton($chapter_comments);

//will display a button to unknown user
$register_btn = $write_comment->unknownUserButton($chapter_id);

//will hide text area if user is not logged
$check_user = $write_comment->registerOnly();

//wil display some admin buttons on frond-end view if administrator is logged
$for_admin_only = $write_comment->displayForAdminOnly();

//call to the view

require (ROOT.'blog/vue/chapter.php');
include_once(ROOT.'blog/vue/footer.php');

