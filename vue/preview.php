<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 12/04/2017
 * Time: 10:29
 */
?>
<div class="page-wrap">
    <div class="container col-sm-12">
        <h1 class="chapter_title"><?php echo $chapter_title;?></h1>
        <div class="col-sm-12" id ="read_chapter">
            <a id="back_to_edit" class="btn btn-primary" href="//localhost/blog/modifier-chapitre/chapterId/<?php echo $chapter_id;?>/novelId/<?php echo $novel_id;?>/novelTitle/<?php echo $novel_title;?>">Retour</a>
            <?php echo $chapter_body;?>
        </div>
    </div>
</div>