<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 11/03/2017
 * Time: 16:51
 */
class reviewManager extends bddManager
{
    /**
     * will allow a user to perform a vote (thumbs / flag) on a comment only if he hasn't already done it
     * will also check if the user is not banned
     * @param $action
     * @param $review
     * @param $check_vote
     */
    public function createReview($action,$review,$check_vote)
    {
        if (isset($action) && isset($_SESSION['status']) && $_SESSION['status'] == 'actif' && $check_vote == 0)
        {
            $bdd = $this->bdd;
            $req = $bdd->prepare("INSERT INTO review (vote, members_id, comments_id) VALUES (:vote, :members_id, :comments_id)");
            $req->execute(array('vote'          => $review->getReviewVote(),
                                'members_id'    => $review->getReviewMembersId(),
                                'comments_id'   => $review->getReviewCommentsId()
            ));

        }
        elseif(isset($action) && $action !== null && $_SESSION['status'] == 'actif' && $check_vote !== 0)
        {
            $_SESSION['flash'] = 'Vous avez déjà exprimé votre opinion sur ce commentaitre.';
        }
        else
        {
            $_SESSION['flash'] = 'Vous devez vous idendifier pour voter.';
        }
    }

    /**
     * @param $comment_id
     * @param $query
     * @return string
     */
    public function oneVoteOnly($comment_id, $query)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("SELECT count(*) FROM review WHERE comments_id = $comment_id AND $query");
        $req->execute();
        $result = $req->fetchColumn();

        return $result;
    }


}

