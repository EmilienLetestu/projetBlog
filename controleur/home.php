<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 17/02/2017
 * Time: 16:57
 */
require(ROOT.'blog/controleur/header.php');

$chapters = new chapterManager();
$excerpt = new chapter();

$chapter_list = $chapters->getPublishedChapter(1);

$chapter_number =1;

foreach ($chapter_list as $chapter)
{
    $chapter_title      = $chapter->getChapterTitle();
    $chapter_startedOn  = $chapter->getChapterStaredOn();
    $chapter_id         = $chapter->getChapterId();
    $chapter_body       = $chapter->getChapterBody();
    $chapter_body       = $excerpt->getChapterExcerpt($chapter_body);
    $count_comments = new commentsManager();
}



//call to the view
require(ROOT.'blog/vue/home.php');
include_once(ROOT.'blog/vue/footer.php');





