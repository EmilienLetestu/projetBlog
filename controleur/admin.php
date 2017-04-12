<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 14/02/2017
 * Time: 13:27
 */
require(ROOT.'blog/controleur/header.php');

/**------------ variable initialisation --------------------**/
$filters   = isset($_POST['filter_member']) ? $_POST['filter_member'] : "1=1";
/**---------------------------------------------------------**/

//Create a new novelManager object
$novels = new novelManager();

//Call to getNovel method
//return an array
$novel_list = $novels->getNovel();

//use a foreach loop on the array to get id, title and date of all novels
foreach($novel_list as $novel)
{
  $id         = $novel->getNovelId();
  $title      = $novel->getNovelTitle();
  $started_on = $novel->getNovelDate();
}

//create a new filter object
$filter = new filter();

//set and get the filter object with posted values as parameter
$filter->setFilter($filters);
$filter_member = $filter->getFilter();

//call to "apply filter" method
$apply_filter_member = $filter->applyFilter($filter_member);


//create a new memberManager object
$members = new memberManager();

//Call to getMember method
$member_list = $members->getMember($apply_filter_member);


//use a foreach loop on the array to get surname, name and email and subscription date for all members
foreach($member_list as $member)
{
  $surname      =  $member->getSurname();
  $name         =  $member->getName();
  $email        =  $member->getEmail();
  $registeredOn =  $member->getDate();
  $status       =  $member->getStatus();
  $tools  = new tools();
  $ban_button   = $tools->textForBanButton($member->getStatus());
}

//call to the view

require(ROOT . 'blog/vue/admin.php');
include_once(ROOT.'blog/vue/footer.php');