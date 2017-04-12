<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 11/03/2017
 * Time: 16:44
 */
class review
{
    protected $review_id = null;
    protected $review_flag;
    protected $review_vote;
    protected $review_members_id;
    protected $review_comments_id;


    /**----------------------setters list-----------------*/

    /**
     * @param null $review_id
     */
    public function setReviewId($review_id)
    {
        $this->review_id = $review_id;
    }

    /**
     * @param mixed $review_vote
     */
    public function setReviewVote($review_vote)
    {
        $this->review_vote = $review_vote;
    }

    /**
     * @param mixed $review_members_id
     */
    public function setReviewMembersId($review_members_id)
    {
        $this->review_members_id = $review_members_id;
    }

    /**
     * @param mixed $review_comments_id
     */
    public function setReviewCommentsId($review_comments_id)
    {
        $this->review_comments_id = $review_comments_id;
    }

    /**----------------------getters list-----------------*/

    /**
     * @return null
     */
    public function getReviewId()
    {
        return $this->review_id;
    }

    /**
     * @return int
     */
    public function getReviewFlag()
    {
        return $this->review_flag;
    }

    /**
     * @return mixed
     */
    public function getReviewVote()
    {
        return $this->review_vote;
    }

    /**
     * @return mixed
     */
    public function getReviewCommentsId()
    {
        return $this->review_comments_id;
    }

    /**
     * @return mixed
     */
    public function getReviewMembersId()
    {
        return $this->review_members_id;
    }
}