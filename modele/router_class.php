<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 15/03/2017
 * Time: 17:43
 */
class router
{

    /**
     * get the requested url and explode it using slashes as a delimiter
     * @return array
     */
    public function getRequest()
    {
        $get_url = $_SERVER['REQUEST_URI'];
        $url = explode('/',$get_url);
        return $url;
    }

    /**
     * parse a given directory and return its content in aan array
     * @param $dir
     * @return array
     */
    public function getRoutes($dir)
    {
        $routes = scandir($dir);
        return $routes;
    }

    /**
     * will look for administrator signature variable
     * will return true if they are found
     * @return bool
     */
    public function isAdmin()
    {
        if(isset($_SESSION['access_level']) && $_SESSION['access_level'] == 1 && isset($_SESSION['token']) && $_SESSION['token'] !== null)
        {
           $admin = true;
        }
        else
        {
            $admin = false;
        }
        return $admin;
    }
    /**
     * use the result of "getRoutes" method as parameter
     * get array index "2" of "getRequest" method and decide which route to load
     * @param $routes
     * @return mixed
    */
    public function loadPage($routes)
    {
        $url = $this->getRequest();

        if($url[2] == "commentaire")
        {
            $page = require(ROOT ."blog/controleur/$routes[4]");
        }
        elseif($url[2] == "chapitre")
        {
            $page = require(ROOT ."blog/controleur/$routes[3]");
        }
        elseif($url[2] == "billet-simple-pour-l-alaska" || $url[2] == "accueil" || empty($url[2]))
        {
            $page = require(ROOT ."blog/controleur/$routes[13]");
        }
        elseif($url[2] == 'admin')
        {
            $page = require(ROOT ."blog/controleur/$routes[2]");
        }
        elseif($url[2] == 'nouveau-chapitre')
        {
            $page = require(ROOT ."blog/controleur/$routes[19]");
        }
        elseif($url[2] == "logout")
        {
            $page = require(ROOT ."blog/controleur/$routes[16]");
        }
        elseif($url[2] == 'liste-chapitres')
        {
            $page = require(ROOT ."blog/controleur/$routes[14]");
        }
        elseif($url[2] == "modifier-chapitre")
        {
            $page = require(ROOT ."blog/controleur/$routes[18]");
        }
        elseif($url[2] == "sauver-modification" || $url[2] == "sauver-nouveau-chapitre")
        {
            $page = require(ROOT ."blog/controleur/$routes[8]");
        }
        elseif($url[2] == "effacer-chapitre")
        {
            $page = require(ROOT ."blog/controleur/$routes[5]");
        }
        elseif($url[2] == "sauver-roman")
        {
            $page =  require(ROOT ."blog/controleur/$routes[10]");
        }
        elseif($url[2] == "effacer-roman")
        {
            $page =  require(ROOT ."blog/controleur/$routes[7]");
        }
        elseif($url[2] == "informations-sur-le-membre")
        {
            $page =  require(ROOT ."blog/controleur/$routes[17]");
        }
        elseif($url[2] == "effacer-commentaire")
        {
            $page =  require(ROOT ."blog/controleur/$routes[6]");
        }
        elseif($url[2] == "modifier-le-statut" || $url[2] == "effacer-le-membre")
        {
            $page =  require(ROOT ."blog/controleur/$routes[9]");
        }
        elseif($url[2] == "noter-commentaire" || $url[2] == "signaler-commentaire")
        {
            $page =  require(ROOT ."blog/controleur/$routes[22]");
        }
        elseif($url[2] == "login")
        {
            $page =  require(ROOT ."blog/controleur/$routes[15]");
        }
        elseif($url[2] == "appercu")
        {
            $page =  require(ROOT ."blog/controleur/$routes[20]");
        }
        elseif($url[2] == "inscription")
        {
            $page =  require(ROOT ."blog/controleur/$routes[21]");
        }
        elseif($url[2] == "validation-login")
        {
            $page =  require(ROOT ."blog/controleur/$routes[23]");
        }
        elseif($url[2] == "validation-inscription")
        {
            $page =  require(ROOT ."blog/controleur/$routes[24]");
        }
        else
        {

            $page = false;
        }
        return $page;
    }

    /**
     * if page doesn't exist user will be redirected to home page
     * @param $page
     * @param $routes
     * @return mixed
     */
    public function error_404($page, $routes)
    {
        if(isset($page) && $page == false)
        {
            $_SESSION['flash'] = "Désolé cette page n'existe pas !";
            $redirect = require(ROOT ."blog/controleur/$routes[13]");
        }
        else
        {
            $redirect = null;

        }
        return $redirect;
    }

    /**
     * will check if user really is admin before granting access to any admin page or features
     * @param $administrator
     * @return mixed|null
     */
    public function protectAdmin($administrator)
    {
       $url = $this->getRequest();
       if($administrator == false)
       {
           if ($url[2] == 'admin' || $url[2] == 'nouveau-chapitre' || $url[2] == 'liste-chapitres' || $url[2] == 'modifier-chapitre' || $url[2] == 'sauver-modification' || $url[2] == 'sauver-nouveau-chapitre' || $url[2] == 'effacer-chapitre' ||
               $url[2] == 'sauver-roman' || $url[2] == 'effacer-roman' || $url[2] == 'informations-sur-le-membre' || $url[2] == 'effacer-commentaire' || $url[2] == 'modifier-le-statut')
           {
               $redirect = header('Location: http://localhost/blog/accueil');
           }
           else
           {
               $redirect = null;
           }

           return $redirect;
       }
    }
}