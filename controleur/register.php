<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 13/02/2017
 * Time: 10:18
 */
require(ROOT.'blog/controleur/header.php');

/**------------ variable initialisation --------------------**/
$register_error   = isset($_SESSION['register_error']) ? $_SESSION['register_error'] :null;
$email            = isset($_SESSION['email']) ? $_SESSION['email'] :null;
$name             = isset($_SESSION['name']) ? $_SESSION['name'] : null;
$surname          = isset($_SESSION['surname']) ? $_SESSION['surname'] : null;
/**---------------------------------------------------------**/


//call to the view
require(ROOT.'blog/vue/register.php');
include_once(ROOT.'blog/vue/footer.php');