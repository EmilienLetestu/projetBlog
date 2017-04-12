<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 23/02/2017
 * Time: 09:30
 */
class comments
{
    public    $id = null;
    public    $parent_id = null;
    protected $cmt_body;
    protected $cmt_date;
    public    $flag;
    protected $thumb_up;
    protected $thumb_down;
    protected $cmt_status;
    protected $members_id;
    protected $chapters_id;
    public    $depth;
    public    $ancestor = null;


    /**----------------------setters list-----------------*/

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }


    /**
     * @param mixed $cmt_body
     */
    public function setCmtBody($cmt_body)
    {
        if(is_string($cmt_body) && !empty($cmt_body))
        {
            $this->cmt_body = strip_tags($cmt_body);
        }
    }

    /**
     * @param mixed $cmt_date
     */
    public function setCmtDate($cmt_date)
    {
        $this->cmt_date = $cmt_date;
    }

    /**
     * @param $flag
     */
    public function setFlag($flag)
    {
        $this->flag =$flag;
    }

    /**
     * @param mixed $thumb_up
     */
    public function setThumbUp($thumb_up)
    {
        $this->thumb_up = $thumb_up;
    }

    /**
     * @param mixed $thumb_down
     */
    public function setThumbDown($thumb_down)
    {
        $this->thumb_down = $thumb_down;
    }

    /**
     * @param $cmt_status
     */

    public function setCmtStatus($cmt_status)
    {
        $this->cmt_status = $cmt_status;
    }

    /**
     * @param mixed $members_id
     */
    public function setMembersId($members_id)
    {
        $this->members_id = $members_id;
    }

    /**
     * @param mixed $chapters_id
     */
    public function setChaptersId($chapters_id)
    {
        $this->chapters_id = $chapters_id;
    }


    /**
     * @param mixed $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    /**
     * @param null $ancestor
     */
    public function setAncestor($ancestor)
    {
        $this->ancestor = $ancestor;
    }


    /**----------------------getters list-----------------*/

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @return mixed
     */
    public function getCmtBody()
    {
        return $this->cmt_body;
    }

    /**
     * will return comment date on french date format
     * @return mixed
     */
    public function getCmtDate()
    {
        $tools = new tools();
        $date = $this->cmt_date;
        $fr_date = $tools->dateFormat($date, $time = false);
        return $fr_date;
    }

    /**
     * @return mixed
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * @return mixed
     */
    public function getThumbUp()
    {
        return $this->thumb_up;
    }

    /**
     * @return mixed
     */
    public function getThumbDown()
    {
        return $this->thumb_down;
    }

    /**
     * @return mixed
     */

    public function getCmtStatus()
    {
        return $this->cmt_status;
    }

    /**
     * @return mixed
     */
    public function getMembersId()
    {
        return $this->members_id;
    }

    /**
     * @return mixed
     */
    public function getChaptersId()
    {
        return $this->chapters_id;
    }

    /**
     * @return mixed
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @return null
     */
    public function getAncestor()
    {
        return $this->ancestor;
    }
}