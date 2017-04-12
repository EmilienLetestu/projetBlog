<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 26/02/2017
 * Time: 23:35
 */

?>
<div class="page-wrap">
    <div class="col-sm-12" id ="members_summary">

        <a class="btn btn-primary" id="nav_member_informations" href="//localhost/blog/admin">Retour à l'adminstration</a>

        <h1><?php echo $member_name;?> <?php echo $member_surname;?></h1>
        <p>Inscrit depuis le : <?php echo $member_date;?></p>
        <p>Banni : <?php echo $member_countBan;?> fois</p>
        <p>Statut actuel : <?php echo  $member_status;?></p>
        <a class="btn green_btn" id="ban" href="//localhost/blog/modifier-le-statut/user/<?php echo $member_id;?>/status/<?php echo $member_status;?>"><?php echo $ban_button ;?></a>
    </div>

    <div class="col-sm-12" id="members_details">
        <section class="table-responsive">
            <table id="ng-table" class="table table-hover table-bordered table-striped">
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-bookmark"></th>
                    <th><span class="glyphicon glyphicon-comment"></span></th>
                    <th><span class="glyphicon glyphicon-calendar"></span></th>
                    <th><span class="glyphicon glyphicon-thumbs-up"></span></th>
                    <th><span class="glyphicon glyphicon-thumbs-down"></span></th>
                    <th><span class="glyphicon glyphicon-flag"></span></th>
                    <th><span class="glyphicon glyphicon-trash"></span></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <?php foreach($member_comments as $comment):?>
                    <td class ="table_center"><?php echo $chapter_title?></td>
                    <td id ="members_comment"><?php echo $comment->getCmtBody();?></td>
                    <td class ="table_center"><?php echo $comment->getCmtDate();?></td>
                    <td class ="table_center"><?php echo $comment->getThumbUp();?></td>
                    <td class ="table_center"><?php echo $comment->getThumbDown();?></td>
                    <td class ="table_center"><?php echo $comment->getFlag();?></td>
                    <td class ="table_center"><a <?php echo $displayButton = $button_text->displayDeleteCommentBtn($comment->getCmtStatus());?>class="delete" href="//localhost/blog/effacer-commentaire/cmt/<?php echo $comment->getId();?>/statut/<?php echo $comment->getCmtStatus()?>"><?php echo $button_text->textForDeleteCommentBtn($comment->getCmtStatus())?></a></td>
                </tr>
                <?php endforeach;?>
                </tbody>
             </table>
        </section>
    </div>
</div>