<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 20/02/2017
 * Time: 18:46
 */


?>
<div class="container col-sm-12">

    <div id="message_modify">
        <?php echo $message;?>
    </div>

    <div class="col-sm-12" id="modify_chapter">
        <h1>Roman : <?php echo $display_novel_title;?></h1>
    </div>

    <form id="modify_chapterForm" action="//localhost/blog/sauver-modification/novelId/<?php echo $novel_id_for_href;?>/chapterId/<?php echo $chapter_id;?>" method="post">
        <div class="form-group">
            <span id="title_error" style="display: none">Veuillez donner un titre à votre chapitre !</span>
            <div class="col-sm-12 col-lg-10">
                <input type="text" class="form-control" id="chapter_title"  name="chapter_title" value ="<?php echo $chapter_title;?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12 col-lg-10">
                <span id="body_error" style="display: none">Votre chapitre ne comporte pas de texte !</span>
                <textarea class="tiny form-control" id="chapter_modify" rows="50" name="chapter_body"><?php echo $chapter_body;?> </textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-8 col-lg-2" id="updateButtonsBar">
                <button type="submit" class="btn btn-success" id="update_chapter">Enregistrer le chapitre</button>
                <label class="checkbox-inline"><input type="checkbox"  name="preview" value="preview">aperçu du chapitre</label>
                <a id="delete-chapter" class="btn btn-danger" href="//localhost/blog/effacer-chapitre/chapterId/<?php echo $chapter_id;?>/novelId/<?php echo $novel_id_for_href;?>/novelTitle/<?php echo $display_novel_title;?>"onclick="return confirm('Vous êtes sur le point de supprimer ce chapitre')">Effacer</a>
                <a id="link_to_chapter_list" class="btn btn-primary" href="//localhost/blog/liste-chapitres/novelId/<?php echo $novel_id_for_href;?>">Retour à la liste</a>
             </div>
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-lg-2">
                <label class="radio-inline">
                    <input name="publish" value="now"  type="radio"/>Publier maintenant
                </label>
            </div>
            <div class="col-sm-4 col-lg-2">
                <label class="radio-inline">
                    <input name="publish" value="laterOn" type="radio"/>Publication différée
                </label>
            </div>
            <div class="col-sm-4 col-lg-2">
                <input type="text" class="form-control publish_on" id="publish"  name="publish_on" placeholder="JJ/MM/AAAA"/>
                <span id="date_error" style="display: none">Veuillez préciser une date de publication</span>
            </div>
        </div>
    </form>
</div>
