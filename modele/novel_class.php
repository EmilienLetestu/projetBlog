<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 17/02/2017
 * Time: 23:36
 */
class novel
{
    protected $novel_id = null ;
    protected $novel_title;
    protected $added_on;


    /**----------------------setters list-----------------*/

    /**
     * @param $novel_id
     */
    public function setNovelId($novel_id)
    {
        $this->novel_id = $novel_id;
    }

    /**
     * @param $novel_title
     */
    public function setNovelTitle($novel_title)
    {
        if(is_string($novel_title) && !empty($novel_title))
        {
            $this->novel_title = ucfirst($novel_title);
        }
    }

    /**
     * @param $added_on
     */
    public function  setNovelDate($added_on)
    {

        $this->added_on = $added_on;
    }

    /**----------------------getters list------------------*/

    /**
     * @return null
     */
    public function getNovelId()
    {
        return $this->novel_id;
    }

    /**
     * @return mixed
     */
    public function getNovelTitle()
    {
        return $this->novel_title;
    }

    /**
     * @return false|string
     */
    public function getNovelDate()

    {
        $tools = new tools();
        $date=$this->added_on;
        $fr_date = $tools->dateFormat($date,$time=true);
        return $fr_date;
    }
}