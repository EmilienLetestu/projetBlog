<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 20/02/2017
 * Time: 11:01
 */



?>
<div class="container col-sm-12">
    <div id="message">
        <?php echo $message;?>
    </div>

    <div class="col-sm-12">
        <h1>Roman : <?php echo $chapter->getChapterNovelTitle();?></h1>
    </div>

    <form  id="chapter_form" action="//localhost/blog/sauver-nouveau-chapitre/novelId/<?php echo $novel->getNovelId();?>/novelTitle/<?php echo $novel->getNovelTitle();?>" method="post">
        <div class="form-group">
            <div class="col-sm-12 col-lg-10">
                <input type="text" class="form-control" id="chapter_title"  name="chapter_title" placeholder="entrer le titre du chapitre">
                <span id="title_error" style="display: none">Veuillez donner un titre à votre chapitre !</span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12 col-lg-10">
                <span id="body_error" style="display: none">Votre chapitre ne comporte pas de texte !</span>
                <textarea class="form-control" id="chapter_body" rows="50" name="chapter_body"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-8 col-lg-2" id="control">
                <button type="submit" class="btn btn-success" id="save_chapter">Enregistrer</button>
                <label class="checkbox-inline"><input type="checkbox"  name="preview" value="preview">aperçu du chapitre</label>
                <a id="link_admin_home" class="btn btn-primary" href="//localhost/blog/admin" onclick="return confirm('Vous vous apprêtez à quitter le mode édition, toute modification non sauvegardée sera perdue')">Retour à l'administration</a>
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
                    <input id="later_on" name="publish" value="laterOn" type="radio"/>Publication différée
                </label>
            </div>
            <div class="col-sm-4 col-lg-2">
                <input type="text" class="form-control publish_on" id="publish" name="publish_on" placeholder="JJ/MM/AAAA"/>
                <span id="date_error" style="display: none">Veuillez préciser une date de publication</span>
            </div>
        </div>
    </form>
</div>
