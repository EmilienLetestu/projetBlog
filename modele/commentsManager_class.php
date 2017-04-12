<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 23/02/2017
 * Time: 09:47
 */



class commentsManager extends bddManager

{

    /**
     * will choose between "answerComment" and "createComment" method relying on parent_id value
     * @param $cmt
     * @param $parent_id
     */
    public function saveComment($cmt,$parent_id,$parent_parent_id)
    {
        if($parent_id != 0 )
        {
            $this->answerComment($cmt,$parent_id,$parent_parent_id);
        }
        else
        {
            $this->createComment($cmt);
        }
    }

    /**
     * store a comment without any parent into db
     * set some default keys values to "0"
     * set comment status to "show"
     * @param $cmt
     */
    private function createComment($cmt)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("INSERT INTO comments(parent_id, depth, cmt_body, cmt_date, flag, thumb_up, thumb_down, cmt_status,members_id, chapters_id) VALUES (:parent_id,:depth,:cmt_body,NOW(),:flag,:thumb_up,:thumb_down,:cmt_status,:members_id,:chapters_id)");

        $req->execute(array('cmt_body'      => $cmt->getCmtBody(),
                            'parent_id'     =>  0,
                            'depth'         =>  1,
                            'flag'          =>  0,
                            'thumb_up'      =>  0,
                            'thumb_down'    =>  0,
                            'cmt_status'    =>  "show",
                            'members_id'    => $cmt->getMembersId(),
                            'chapters_id'   => $cmt->getChaptersId()
        ));
        $_SESSION['flash'] = "Merci pour votre commentaire ".$_SESSION['surname'];
    }


    /**
     * store a child comment into db
     * set parent_id key value with comments parent
     * set some default keys values to "0"
     * set comment status to "show"
     * @param $cmt
     * @param $parent_id
     */
    public function answerComment($cmt,$parent_id,$parent_parent_id)
    {
        $bdd = $this->bdd;
        $req = $bdd->prepare("INSERT INTO comments(parent_id,ancestor_id,depth, cmt_body, cmt_date, flag, thumb_up, thumb_down, cmt_status, members_id, chapters_id) VALUES (:parent_id,:ancestor_id,:depth,:cmt_body,NOW(),:flag,:thumb_up,:thumb_down,:cmt_status ,:members_id,:chapters_id)");

        if($parent_parent_id != 0)
        {

            $req->execute(array('cmt_body' => $cmt->getCmtBody(),
                'parent_id'     => $parent_id,
                'ancestor_id'   => $parent_parent_id,
                'depth'         => 3,
                'flag'          => 0,
                'thumb_up'      => 0,
                'thumb_down'    => 0,
                'cmt_status'    => "show",
                'members_id'    => $cmt->getMembersId(),
                'chapters_id'   => $cmt->getChaptersId()
            ));

        }
        else
        {
            $req->execute(array('cmt_body' => $cmt->getCmtBody(),
                'parent_id'     => $parent_id,
                'ancestor_id'   => $parent_id,
                'depth'         => 2,
                'flag'          => 0,
                'thumb_up'      => 0,
                'thumb_down'    => 0,
                'cmt_status'    => "show",
                'members_id'    => $cmt->getMembersId(),
                'chapters_id'   => $cmt->getChaptersId()
            ));
        }
        $_SESSION['flash'] = "Merci pour votre commentaire " .$_SESSION['name'];
    }




    /**
     * will update thumb_up/down, flag of a given comment based on user action
     * will also change the status of a comment  based on its flag score
     * @param $id
     * @param $score
     * @param $action
     * @param $check_vote
     */
    public function updateCommentReview($id,$score,$action,$check_vote)
    {
            if (isset($action)  && $action === 'thumb_up' && isset($_SESSION['status']) && $_SESSION['status'] =='actif' && $check_vote == 0)
            {
                $bdd = $this->bdd;
                $req = $bdd->prepare("UPDATE comments SET thumb_up = :thumb_up WHERE id = $id");

                $req->execute(array('thumb_up' => $score + 1));
            }
            elseif (isset($action) && $action === 'thumb_down'&& isset($_SESSION['status']) && $_SESSION['status'] =='actif' && $check_vote == 0)
            {
                $bdd = $this->bdd;
                $req = $bdd->prepare("UPDATE comments SET thumb_down = :thumb_down WHERE id = $id");

                $req->execute(array('thumb_down' => $score + 1));
            }
            elseif (isset($action) && $action === 'flag'&& isset($_SESSION['status']) && $_SESSION['status'] =='actif' && $check_vote == 0)
            {
                $bdd = $this->bdd;
                $req = $bdd->prepare("UPDATE comments SET flag = :flag, cmt_status = :cmt_status WHERE id = $id");

                if ($score <= 6 )
                {
                    $req->execute(array('flag'       => $score + 1,
                                        'cmt_status' => 'show'
                    ));
                }
                elseif($score > 7)
                {
                    $req->execute(array('flag'       => $score + 1,
                                        'cmt_status' => 'moderate'
                    ));
                }
            }
    }

    /**
     * @param $query
     * @return comments
     */
    public function getCommentsBy($query)
    {
        $bdd = $this->bdd;
        $req =$bdd->prepare("SELECT * FROM comments WHERE $query");
        $req->execute();

        $comments = array();
        while($row = $req->fetch(PDO::FETCH_ASSOC))
        {
            $myComments = new comments();
            $myComments->setId($row['id']);
            $myComments->setParentId($row['parent_id']);
            $myComments->setCmtBody($row['cmt_body']);
            $myComments->setCmtDate($row['cmt_date']);
            $myComments->setFlag($row['flag']);
            $myComments->setThumbUp($row['thumb_up']);
            $myComments->setThumbDown($row['thumb_down']);
            $myComments->setCmtStatus($row['cmt_status']);
            $myComments->setMembersId($row['members_id']);
            $myComments->setChaptersId($row['chapters_id']);
            $myComments->setDepth($row['depth']);
            $myComments->setAncestor($row['ancestor_id']);

            if($myComments->getCmtStatus() !== 'show')
            {
                $myComments->setCmtBody("Commentaire supprimé");
            }

            $comments[] = $myComments;
        }
        return $comments;
    }

    /**
     * get all the comments of a given chapter and order them by depth level and from newer to older
     * @param $chapter_id
     * @return array
     */
    public function getCommentsByChapterId($chapter_id)
    {
        $bdd = $this->bdd;
        $req =$bdd->prepare("SELECT * FROM comments WHERE chapters_id = $chapter_id ORDER BY comments.depth, cmt_date DESC");
        $req->execute();


        $comments = array();
        while($row = $req->fetch(PDO::FETCH_ASSOC))
        {
            $myComments = new comments();
            $myComments->setId($row['id']);
            $myComments->setParentId($row['parent_id']);
            $myComments->setCmtBody($row['cmt_body']);
            $myComments->setCmtDate($row['cmt_date']);
            $myComments->setFlag($row['flag']);
            $myComments->setThumbUp($row['thumb_up']);
            $myComments->setThumbDown($row['thumb_down']);
            $myComments->setCmtStatus($row['cmt_status']);
            $myComments->setMembersId($row['members_id']);
            $myComments->setChaptersId($row['chapters_id']);
            $myComments->setDepth($row['depth']);
            $myComments->setAncestor($row['ancestor_id']);

            if($myComments->getCmtStatus() !== 'show')
            {
                $myComments->setCmtBody("Commentaire supprimé");
            }

            $comments[] = $myComments;

        }
        return $comments;
    }

    /**
     * will allow to retrieve the parent_id of any comment with children
     * @param $parent_id
     * @return array
     */
    public function getCommentParent($parent_id)
    {
        $bdd = $this->bdd;
        $req =$bdd->prepare("SELECT * FROM comments WHERE id = $parent_id");
        $req->execute();

        while($row = $req->fetch(PDO::FETCH_ASSOC))
        {
            $myComments = new comments();
            $myComments->setParentId($row['parent_id']);
            $parent_parent_id = $myComments->getParentId();
        }
        return $parent_parent_id;
    }

    /**
     * will allow admin to bypass automatic moderation rules
     * @param $id
     * @param $cmt_status
     */
    public function manualModerate($id,$cmt_status)
    {
            $bdd = $this->bdd;
            $req = $bdd->prepare("UPDATE comments SET flag = :flag, cmt_status = :cmt_status  WHERE id = $id");

            if($cmt_status == "show")
            {
                $req->execute(array('cmt_status' => 'moderated-by-admin',
                                     'flag'      =>  8
                ));
                $_SESSION['flash'] = "Commentaire modéré";
            }
            else
            {
                $req->execute(array('cmt_status' => 'show',
                                    'flag'       =>  0
                ));
                $_SESSION['flash'] = "Modération du commentaire annulé";
            }
    }

    /**
     * @param $chapter_id
     * @return bool
     */

    public function totalCommentsByChapter($chapter_id)
    {
        $bdd = $this->bdd;
        $req =$bdd->prepare("SELECT * FROM comments WHERE chapters_id = $chapter_id");
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }


}