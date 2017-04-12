<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 09/02/2017
 * Time: 15:28
 */
class Member
{
    protected $id = null;
    protected $surname;
    protected $name;
    protected $email;
    protected $password;
    protected $createdOn;
    protected $status;
    protected $countBan = null;

    /*---------------------------------------------------------------------- setters list--------------------------------------------------------------------------*/

    /**
     * @param null $id
     */

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param $surname
     */
    public function setSurname($surname)
    {

        if(is_string($surname) && ctype_alpha($surname) && !empty($surname))
        {
            $this->surname = strip_tags(ucfirst($surname));
        }
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        if(is_string($name) && ctype_alpha($name) && !empty($name))
        {
            $this->name = strip_tags(ucfirst($name));
        }
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if(!filter_var($email, FILTER_SANITIZE_EMAIL) === false && !empty($email))
        {
            $this->email = $email;
        }
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $check_strength = strlen($password);

        if($check_strength >= 4)
        {
            $hash = sha1($password);
            $this->password = $hash;
        }

    }

    /**
     * @param mixed $createdOn
     */
    public function setDate($createdOn)
    {

        $this->createdOn = $createdOn;
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param $countBan
     */
    public  function setCountBan($countBan)
    {
        $this->countBan = $countBan;
    }


    /*---------------------------------------------------------------------- getters list--------------------------------------------------------------------------*/

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

   /**
    * @return mixed
    */
    public function getSurname()
    {
       return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * will return subscription date on french format
     * @return mixed
     */
    public function getDate()
    {
        $tools = new tools;
        $date = $this->createdOn;
        $fr_date = $tools->dateFormat($date, $time=false);

        return $fr_date;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return null
     */
    public function getCountBan()
    {
        return $this->countBan;
    }

}