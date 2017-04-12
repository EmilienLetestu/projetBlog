<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 13/02/2017
 * Time: 15:08
 */
class session extends bddManager
{
    /**
     * change aspect of the connection button if user is connected
     * @return string
     */

    public function sessionButton()
    {

        if(isset($_SESSION['id']) && $_SESSION['id'] !== null && isset($_SESSION['status']) && $_SESSION['status'] =='actif')
        {
            $buttonState = '<li><a href= "//localhost/blog/logout" id="connexion"><span class="glyphicon glyphicon-user"> Déconnexion</span></a></li>';
        }
        else
        {
            $buttonState = '<li><a href= "//localhost/blog/login" class="connexion">Connexion</a></li>';
        }

        return $buttonState;
    }

    /**
     * Parse table and verify if submitted email and password match together
     * will create a cookie if "stay connect" is checked to enable automatic login on user next visit
     * @param $user_email
     * @param $user_pswd
     * @return null|string
     */
    public function startSession($user_email,$user_pswd)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT * FROM members WHERE email = '$user_email' AND pswd = '$user_pswd'");
        $req->execute();
        $result = $req->fetch();

        if($result)
        {
            $_SESSION['id']             = $result['id'];
            $_SESSION['surname']        = $result['surname'];
            $_SESSION['name']           = $result['name'];
            $_SESSION['email']          = $result['email'];
            $_SESSION['status']         = $result['status'];
            $_SESSION['message']        = 0;
            $_SESSION['access_level']   = 0;
            $_SESSION['login_error']    = 0;

            if(isset($_POST['remain_connect']))
            {
                setcookie('user_id',$result['id'], time() + 3600 * 24 * 5,'/','localhost',false,true);
            }

        }
        elseif(!$result)
        {
            $bdd = $this->bdd;
            $req = $bdd->prepare("SELECT * FROM members WHERE email = '$user_email'");
            $req->execute();
            $result = $req->fetch();

            if ($result) {
                $_SESSION['login_error'] = 1;
                $_SESSION['email'] = $result['email'];
                $_SESSION['email'] = $result['email'];
            }
            else
            {
                $_SESSION['login_error'] = 2;
                $_SESSION['email'] = $user_email;
            }
        }
        return $result;
    }


    /**
     * will display a welcome message on login
     * if user is banned => disconnect him
     * @return null|string
     */
    public function sessionMessage()
    {

        if(isset($_SESSION['id']) && $_SESSION['id'] !== null && isset($_SESSION['status']) && $_SESSION['status'] =='actif' && $_SESSION['message'] == 0)
        {

            $message = "<p class='feedback_messsage'>Bonjour ".$_SESSION['name']." content de vous revoir !<span id='close' class='glyphicon glyphicon-remove' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;'></span></p>";

            $_SESSION['message'] = 1;
        }
        elseif(isset($_SESSION['id']) && $_SESSION['id'] !== null && isset($_SESSION['status']) && $_SESSION['status'] =='banni' )
        {

            $message = "<p class='feedback_messsage'>Bonjour ".$_SESSION['name']." vous êtes banni et allez être deconnecté !<span id='close' class='glyphicon glyphicon-remove' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;'></span></p>";
            session_destroy();
        }
        elseif(isset($_SESSION['flash']))
        {
            $message = "<p class='feedback_messsage'>" . $_SESSION['flash'] . "<span id='close' class='glyphicon glyphicon-remove' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;'></span></p>";

            $_SESSION['flash'] = $message;
            unset($_SESSION['flash']);
        }
        else
        {
            $message = null;
        }

        return $message;
    }

    /**
     *  decide where to redirect user after login based on its access level
     * @param $result
     * @param $url_param
     * @param string $admin_email
     * @return string
     */
    public function sessionRedirect($result,$url_param,$admin_email = 'j.forteroche@test.fr')
    {
        $token = new tools();

        if($result && $_SESSION['login_error'] == 0 && $_SESSION['name']  == 'Jean' && $_SESSION['surname'] == 'Forteroche' && $_SESSION['email'] == $admin_email && $url_param !== '0' )
        {
            $token->createAdminToken($num = 16);
            $_SESSION['access_level'] =  1;
            $_SESSION['token'] = $token;
            $header = "//localhost/blog/chapitre/episode-numéro/$url_param";
        }
        elseif($result &&  $_SESSION['login_error'] == 0 && $_SESSION['name']  == 'Jean' && $_SESSION['surname'] == 'Forteroche' && $_SESSION['email'] == $admin_email && $url_param == '0')
        {
            $token->createAdminToken($num = 16);
            $_SESSION['access_level'] =  1;
            $_SESSION['token'] = $token;
            $header = '//localhost/blog/admin';
        }
        elseif ($result && $_SESSION['login_error'] == 0 && $url_param !== '0')
        {
            $header = "//localhost/blog/chapitre/episode-numéro/$url_param";
        }
        elseif($result && $_SESSION['login_error'] == 0 && $url_param == '0')
        {
            $header = '//localhost/blog/acceuil';
        }
        else
        {
            $header = $_SERVER['HTTP_REFERER'];
        }
        return $header;
    }

    /**
     * will redirect all new registered member to login page
     * if registration process fails reload registration page
     * @return string
     */
    public function sessionRedirectAfterRegister()
    {
        if(isset($_SESSION['register_error']) && $_SESSION['register_error'] == 0)
        {
            $header = "//localhost/blog/login";
        }
        else
        {
            $header = "//localhost/blog/inscription";
        }
        return $header;
    }

}