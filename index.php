<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 15/03/2017
 * Time: 16:44
 */
require ('config.php');

//create a new tools object
$detect_cookies = new tools();
//look for  some connexion cookies
$detect_cookies->remainConnect();

//create a new router object
$router = new router();

//will look for admin signatures variables
$administrator = $router->isAdmin();

//call method getRoutes and scan controller directory
$routes = $router->getRoutes('controleur');

//will check if user really is admin before granted access to any admin page or features
$restricted_access = $router->protectAdmin($administrator);

//call method loadPage with variable routes parameter
//will decide based on url which file to load into controller
$find_route = $router->loadPage($routes);

//if the page doesn't exist user will be redirected to home and a flash message will pop
$no_such_page = $router->error_404($find_route,$routes);


