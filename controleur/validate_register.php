<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 22/03/2017
 * Time: 10:55
 */
include_once(ROOT.'blog/config.php');
require(ROOT.'blog/controleur/head.php');


/**------------ variable initialisation ----------**/
$comment = isset($_POST['id']) ? $_POST['id'] : null;
$name = isset($_POST['name']) ? $_POST['name'] : null;
$surname = isset($_POST['surname']) ? $_POST['surname'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$pswd = isset($_POST['pswd']) ? $_POST['pswd'] : null;
/**-----------------------------------------------**/

//create a new member object
$member = new Member();
//create a new memberManager object
$manager = new memberManager();


//use sent data from register form as setters
if((isset($_POST['id']))) $member->setId($_POST['id']);
$member->setName($name);
$member->setSurname($surname);
$member->setEmail($email);
$member->setPassword($pswd);


//get user submitted email and parse table to check if it was already used
$email = $member->getEmail();
$bdd_email = $manager->registeredEmail($email);
$check_pswd = $member->getPassword();

//insert a new member inside db table
$create = $manager->save($member,$bdd_email,$check_pswd);

//create new session object
$session = new session();
//will decide whether to create redirection url to login or register page
$redirect = $session->sessionRedirectAfterRegister();

//redirect after data treatment
header('Location:'.$redirect);