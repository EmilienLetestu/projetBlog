<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 25/02/2017
 * Time: 16:40
 */
include_once(ROOT.'blog/config.php');


/**------------ variable initialisation ----------**/
$chapter_id  = isset($url[4]) ? $url[4] : null;
$user_id     = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$cmt_id      = isset($url[8]) ? $url[8] : null;
$score       = isset($url[10]) ? $url[10] : null;
$action      = isset($url[12]) ? $url[12] : null;
/**-------------------------------------------------**/

//create a new router object
$router = new router();
//explode url and search for parameters
$url=$router->getRequest();


//create a new review object
$review = new review();

//use sent data as setters for review object
$review->setReviewVote($action);
$review->setReviewCommentsId($cmt_id);
$review->setReviewMembersId($_SESSION['id']);

//use getters method to define review comment and reviewer
$comment_id = $review->getReviewCommentsId();
$member = $review->getReviewMembersId();

//create a new filter object
$filter_member = new filter();

//define the filter to  use it below
$filter_member->setFilter('members_id ='.$member);
$filter_member_id = $filter_member->getFilter();


//create a new review manager object
$reviewManager = new reviewManager();

//check if the user hasn't review comment yet
$check_vote = $reviewManager->oneVoteOnly($comment_id,$filter_member_id);

//store the new review into review table
$createReview  = $reviewManager->createReview($action,$review,$check_vote);

//create a new commentManager object
$update = new commentsManager();
//call to "updateCommentReview" method to increment thumbs or flag by 1 if user hasn't review comment yet, then store the updated  score into comment table
$update_comment = $update->updateCommentReview($cmt_id,$score,$action,$check_vote);

//create a new tool manager
$tools = new tools();
//will create an anchor to reload page on a similar position if the vote is valid
$anchor = $tools->setAnchor($cmt_id);
//redirect after data treatment
header("Location://localhost/blog/chapitre/episode-numero/$chapter_id$anchor");



