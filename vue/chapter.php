<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 20/02/2017
 * Time: 19:28
 */
?>


<div class="page-wrap">
    <div class="container col-sm-12">

        <h1 class="chapter_title"><?php echo $chapter_title;?></h1>

        <div class="col-sm-12" id ="read_chapter">
            <?php echo $chapter_body;?>
        </div>

        <div class="col-sm-12">
            <a class ="col-sm-offset-5 blue_btn" id="modify_chapter_front" <?php echo $for_admin_only ?> href="//localhost/blog/modifier-chapitre/chapterId/<?php echo $chapter_id;?>/novelId/<?php echo $novel_id;?>/novelTitle/<?php echo $novel_title;?>">Modifier</a>
        </div>

        <nav class="col-sm-12">
            <ul class="pager" id= "link_next">
                <li><a class ="previous pull-left"<?php echo $link_previous ;?>>&larr; <?php echo $previous_icon?> <?php echo $previous_title?></a></li>
                <li><a class ="next pull-right"<?php echo $link_next ;?>><?php echo$next_title?> <?php echo $next_icon?> &rarr;</a></li>
            </ul>
        </nav>

        <div class="col-sm-offset-5" id ="connexion_for_cmt">
            <?php echo $register_btn;?>
        </div>

        <div id = "edit_comment" <?php echo $check_user;?>>
            <form class="col-sm-12"  id="cmt_form" action="//localhost/blog/commentaire/chapterId/<?php echo $chapter_id;?>/user/<?php echo $_SESSION['id'] ;?>" method="post">
                <div class="form-group">
                    <label class="control-label" for="Commentaire">Commenter</label>
                    <div class="col-sm-12">
                        <span id="empty_cmt" style="display: none">Votre commentaire est vide!</span>
                        <textarea class="form-control" id="cmt_body" rows="12" name="cmt_body"></textarea>
                    </div>
                </div>
                <div class="form-group col-sm-12" id="submit_div">
                    <div>
                        <input type="hidden" id="parent_id" name="parent_id" value="0">
                        <input type="hidden" id="scroll_position" name="scroll_position" value=" ">
                        <button type="submit" class="btn btn-success" id="submit_cmt"><?php echo $button_text?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="col-sm-12" id="chapter_comments">
        <?php foreach ($chapter_comments as $comment):?>
            <?php if($comment->getParentId() == 0):?>
                <hr class ="level_marker">
                <div class=<?php echo $class = $tools->answerMarginClass($comment->getDepth());?> id="comments-<?php echo $comment->getId();?>">
                    <br>
                    <h5 class="comments_date"><?php echo $comment->getCmtDate();?></h5>
                    <?php $author_details = $author->getMemberById($comment->getMembersId());?>
                    <h5><?php echo $author_name=$author_details->getName();?> <?php echo $author_surname=$author_details->getSurname();?></h5>
                    <p><?php echo  $comment->getCmtBody();?></p>
                    <div id ="cmt_buttons">
                        <a class="thumb" <?php echo $style = $tools->displayVoteButton($comment->getCmtStatus())?> href="//localhost/blog/noter-commentaire/chapterId/<?php echo $chapter_id;?>/user/<?php echo $comment->getMembersId();?>/cmtId/<?php echo $comment->getId();?>/score/<?php echo $comment->getThumbUp();?>/action/thumb_up"><span class="glyphicon glyphicon-thumbs-up"> <?php echo $comment->getThumbUp();?></span></a>
                        <a class="thumb" <?php echo $style = $tools->displayVoteButton($comment->getCmtStatus())?> href="//localhost/blog/noter-commentaire/chapterId/<?php echo $chapter_id;?>/user/<?php echo $comment->getMembersId();?>/cmtId/<?php echo $comment->getId();?>/score/<?php echo $comment->getThumbDown();?>/action/thumb_down"><span class="glyphicon glyphicon-thumbs-down"> <?php echo $comment->getThumbDown();?></span></a>
                        <a class="flag"  <?php echo $style = $tools->displayVoteButton($comment->getCmtStatus())?> href="//localhost/blog/signaler-commentaire/chapterId/<?php echo $chapter_id;?>/user/<?php echo $comment->getMembersId();?>/cmtId/<?php echo $comment->getId();?>/score/<?php echo $comment->getFlag();?>/action/flag"><span class="glyphicon glyphicon-flag"> <?php echo $comment->getFlag();?></span></a>
                        <a class="send_answer" id ="<?php echo $cmt = $comment->getId();?>" <?php echo $style = $tools->displayReplyButton($comment->getCmtStatus(),$class)?> href="#"><i class="fa fa-reply"></i></a>
                        <a class="delete"  <?php echo $for_admin_only ?> <?php echo $tools->displayDeleteCommentBtn($comment->getCmtStatus());?>href="//localhost/blog/effacer-commentaire/cmt/<?php echo $comment->getId();?>/statut/<?php echo $comment->getCmtStatus()?>"><?php echo $tools->textForDeleteCommentBtn($comment->getCmtStatus())?></a>
                    </div>
                 </div>
            <?php endif;?>

            <?php foreach ($chapter_comments as $descendants):?>
                <?php if($descendants->getParentId() !== 0 && $descendants->getAncestor() == $comment->getId()):?>
                    <div class=<?php echo $class = $tools->answerMarginClass($descendants->getDepth());?> id="comments-<?php echo $descendants->getId();?>">
                        <br>
                        <h5 class="comments_date"><?php echo $descendants->getCmtDate();?></h5>
                        <?php $author_details = $author->getMemberById($descendants->getMembersId());?>
                        <h5><?php echo $author_name=$author_details->getName();?> <?php echo $author_surname=$author_details->getSurname();?></h5>
                        <p><?php echo  $descendants->getCmtBody();?></p>
                        <div id ="cmt_buttons">
                            <a class="thumb" <?php echo $style = $tools->displayVoteButton($descendants->getCmtStatus())?> href="//localhost/blog/noter-commentaire/chapterId/<?php echo $chapter_id;?>/user/<?php echo $descendants->getMembersId();?>/cmtId/<?php echo $descendants->getId();?>/score/<?php echo $descendants->getThumbUp();?>/action/thumb_up"><span class="glyphicon glyphicon-thumbs-up"> <?php echo $descendants->getThumbUp();?></span></a>
                            <a class="thumb" <?php echo $style = $tools->displayVoteButton($descendants->getCmtStatus())?> href="//localhost/blog/noter-commentaire/chapterId/<?php echo $chapter_id;?>/user/<?php echo $descendants->getMembersId();?>/cmtId/<?php echo $descendants->getId();?>/score/<?php echo $descendants->getThumbDown();?>/action/thumb_down"><span class="glyphicon glyphicon-thumbs-down"> <?php echo $descendants->getThumbDown();?></span></a>
                            <a class="flag"  <?php echo $style = $tools->displayVoteButton($descendants->getCmtStatus())?> href="//localhost/blog/signaler-commentaire/chapterId/<?php echo $chapter_id;?>/user/<?php echo $descendants->getMembersId();?>/cmtId/<?php echo $descendants->getId();?>/score/<?php echo $descendants->getFlag();?>/action/flag"><span class="glyphicon glyphicon-flag"> <?php echo $descendants->getFlag();?></span></a>
                            <a class="send_answer" id ="<?php echo $cmt = $descendants->getId();?>" <?php echo $style = $tools->displayReplyButton($descendants->getCmtStatus(),$class)?> href="#"><i class="fa fa-reply"></i></a>
                            <a class="delete" <?php echo $tools->displayDeleteCommentBtn($descendants->getCmtStatus());?>href="//localhost/blog/effacer-commentaire/cmt/<?php echo $descendants->getId();?>/statut/<?php echo $descendants->getCmtStatus()?>"><?php echo $tools->textForDeleteCommentBtn($descendants->getCmtStatus())?></a>
                        </div>
                    </div>
                <?php endif;?>
            <?php endforeach?>
        <?php endforeach;?>
    </div>
</div>