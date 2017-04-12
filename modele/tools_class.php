<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 25/02/2017
 * Time: 15:22
 */
class tools
{
    /**
     * change date format from sql format to the french one
     * can also set the way time should be display if "$time" parameter is set to "true"
     * @param $sqlDateTime
     * @param bool $time
     * @return false|string
     */
    public function dateFormat($sqlDateTime, $time=false)
    {
        if($time != false)
        {
            $dateTime = strtotime($sqlDateTime);
            $fr_dateTime = date("d/m/y H:i:s", $dateTime);

            return $fr_dateTime;
        }
        else
        {
            $dateTime =strtotime($sqlDateTime);
            $fr_dateTime = date("d/m/Y", $dateTime);

            return $fr_dateTime;
        }
    }

    /**
     * display some element only if user is logged in
     * @return null|string
     */
    public function registerOnly()
    {
        if(!isset($_SESSION['id']) || $_SESSION['id'] == null)
        {
            $display = 'style="display:none;';
        }
        else
        {
            $display = null;
        }

        return $display;
    }

    /**
     * change the comment button text relying on comments presence or not
     * @param $chapter_comments
     * @return string
     */
    public function textForShowCmtButton($chapter_comments)
    {
        if($chapter_comments == null)
        {
            $text = 'Etre le premier à réagir';
        }
        else
        {
            $text = 'Envoyer le commentaire';
        }

        return $text;
    }

    /**
     * change the text of the admin banish button relying on member status
     * @param $status
     * @return string
     */
    public function textForBanButton($status)
    {
        if($status == "actif")
        {
            $text = "Bannir";

        }
        elseif($status == "banni")
        {
            $text = "Activer";

        }
        return $text;
    }

    /**
     * will display a connection button on the todp of the comments section if  user is not logged
     * @return null|string
     */
    public function unknownUserButton($chapter_id)
    {
        if(!isset($_SESSION['id']) || $_SESSION['id'] == null)
        {
            $btn= "<a class='connexion' id='cmt' href='//localhost/blog/login/from/$chapter_id'>Se connecter et commenter</a>";
        }
        else
        {
            $btn = null;
        }

        return $btn;
    }

    /**
     * turn date from french format to the sql one
     * @param $date
     * @return string
     */
    public function dateToSql($date)
    {
        $dbDate = explode('/',$date);
        $date_conversion = $dbDate[2].'/'.$dbDate[1].'/'.$dbDate[0];

        return $date_conversion;
    }

    /**
     * will display some extra button on front area  if admin is logged in
     * @return string
     */
    public function displayForAdminOnly()
    {
        if(isset($_SESSION['access_level']) && $_SESSION['access_level'] == 1)
        {
            $style = 'null';
        }

        else
        {
            $style = "style ='display : none'";
        }

        return $style;
    }

    /**
     * @return string
     */
    public function displayErrorOnLoginForm()
    {
        if(isset($_SESSION['pswd_error']) && $_SESSION['pswd_error'] == 1)
        {
            $style = "null'";
        }
        else
        {
            $style = "style ='display : none'";
        }
        return $style;
    }

    /**
     * will log user in if "user_id" cookie is detected
     */
    public function remainConnect()
    {
        if(isset($_COOKIE['user_id']) && !isset($_SESSION['id']))
        {
            $user_id = $_COOKIE['user_id'];
            $user = new memberManager();
            $member = $user->getMemberById($user_id);

            $_SESSION['id']             = $member->getId();
            $_SESSION['surname']        = $member->getSurname();
            $_SESSION['name']           = $member->getName();
            $_SESSION['email']          = $member->getEmail();
            $_SESSION['status']         = $member->getStatus();
            $_SESSION['message']        = 0;

            if($_SESSION['name']  == 'Jean' && $_SESSION['surname'] == 'Forteroche')
            {
                $_SESSION['access_level'] = 1;
                $token = $this->createAdminToken($num = 16);
                $_SESSION['token'] = $token;
            }
            else
            {
                $_SESSION['access_level'] = 0;
            }
        }
    }

    /**
     * will choose which url to bind with links
     * @param $id
     * @param $title
     * @return string
     */
    public function createLink($id,$title)
    {
        if($title !== "A suivre..." && $title !== "Accueil")
        {
            $link = "href=//localhost/blog/chapitre/episode-numéro/$id";
        }
        else
        {
           $link = "href=//localhost/blog/accueil";
        }

        return $link;
    }

    /**
     * will choose which icon to display on links
     * @param $title
     * @return string
     */
    public function linkIcon($title)
    {
        if($title !== "A suivre..." &&  $title !== "Accueil")
        {
            $icon = '<i class="fa fa-book"></i>';
        }
        else
        {
            $icon = null;
        }
        return $icon;
    }

    /**
     * send recaptcha to google server and check result
     * @param $code
     * @param null $ip
     * @return bool
     */
    function isRecaptchaValid($code, $ip = null)
    {
        if (empty($code))
        {
            return false;
        }
        $params = [
            'secret' => '6LczJhoUAAAAAP7JIEzIdmQotijfg46pxhjTZob-',
            'response' => $code
        ];
        if ($ip) {
            $params['remoteip'] = $ip;
        }
        $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
        if (function_exists('curl_version')) {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
        }
        else
        {

            $response = file_get_contents($url);
        }

        if (empty($response) || is_null($response))
        {
            return false;
        }

        $json = json_decode($response);
        return $json->success;
    }

    /**
     * @param $select_name
     * @param $value
     */
    public function selectedOption($select_name,$value)
    {
        if(isset($_POST[$select_name]) && $_POST[$select_name] == $value) echo 'selected="selected"';
    }

    /**
     * @param $depth
     * @return string
     */
    public function answerMarginClass($depth)
    {
        if($depth == 1)
        {
            $class = "comments-1";
        }
        elseif($depth == 2)
        {
            $class = "comments-2";
        }
        elseif($depth == 3)
        {
            $class = "comments-3";
        }
        else
        {
            $class = "comments-1";
        }

        return $class;
    }

    /**
     * will hide thumb/flag buttons if the comment was moderated
     * @param $cmt_status
     * @return null|string
     */
    public function displayVoteButton($cmt_status)
    {
        if($cmt_status !== "show")
        {
            $style = "style ='display : none'";
        }
        else
        {
            $style = null;
        }
        return $style;
    }

    /**
     * will hide reply button if the comment was moderated or reach the depth limit
     * @param $cmt_status
     * @param $class
     * @return null|string
     */
    public function displayReplyButton($cmt_status, $class)
    {
        if($cmt_status !== "show" || $class == "comments-3")
        {
            $style = "style ='display : none'";
        }
        else
        {
            $style = null;
        }
        return $style;
    }

    /**
     * will display a moderation button on each comment only for the administrator
     * @return null|string
     */
    public function displayDeleteCommentBtn()
    {
        if(isset($_SESSION['access_level']) && $_SESSION['access_level'] == 1)
        {
            $display = null;
        }
        else
        {
            $display = 'style="display:none;"';
        }
        return $display;
    }

    /**
     * will change moderation button text based on comment status
     * @param $cmt_status
     * @return string
     */
    public function textForDeleteCommentBtn($cmt_status)
    {
        if($cmt_status == "show")
        {
            $text = "Modérer";
        }
        else
        {
            $text ="Afficher";
        }
        return $text;
    }

    /**
     * will be used to fill an hidden input with newly registered member
     * a js script will then look for this value
     * @return null
     */
    public function fillUpEmailInputForNewbie()
    {
        if(isset( $_SESSION['newbie_email']) && $_SESSION['newbie_email'] !== null)
        {
            $fillUpInput = $_SESSION['newbie_email'];
        }
        else
        {
            $fillUpInput = null;
        }
        return $fillUpInput;
    }

    /**
     * will create an anchor
     * @param $cmt_id
     * @return null|string
     */
    public function setAnchor($cmt_id)
    {
        if(!isset($_SESSION['flash']))
        {
            $anchor = "#comments-$cmt_id";
        }
        else
        {
            $anchor = null;
        }
        return $anchor;
    }

    /**
     * will create a token on loggin
     * the method will only be casted on administrator connection
     * @param int $num
     * @return string
     */
     public function createAdminToken($num = 16)
    {
        $token = bin2hex(openssl_random_pseudo_bytes($num));

        return $token;
    }

    public function redirectToPreviewOrModify($preview, $chapter_id, $novel_id, $novel_title)
    {
        if($preview == null)
        {
            $header = 'Location: http://localhost/blog/modifier-chapitre/chapterId/'.$chapter_id.'/novelId/'.$novel_id.'/novelTitle/'.$novel_title.'';
        }
        else
        {
            $header = 'Location: http://localhost/blog/appercu/chapterId/'.$chapter_id.'/novelId/'.$novel_id.'/novelTitle/'.$novel_title.'';
        }

        return $header;
    }

}