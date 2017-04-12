<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 20/02/2017
 * Time: 14:44
 */

?>
<div class="page-wrap">

    <div class="container col-sm-12">

        <a class="btn btn-primary" id="nav_list_chapter" href="//localhost/blog/admin">Retour à l'adminstration</a>
        <h1 class="table_title">Chapitres du roman :<?php echo $novel_title?></h1>

        <form class="form-horizontal" id="filter" action="//localhost/blog/liste-chapitres/novelId/<?php echo $novel_id;?>" method="POST">
            <div class="form-group">
                <div class="col-sm-5">
                    <select class="form-control col-sm-1" id="sel" name ="filter">
                        <option value ="1=1"<?php $tools->selectedOption("filter","1=1");?>> Tous les chapitres</option>
                        <option value ="publié"<?php $tools->selectedOption("filter","publié");?>>Les chapitres publiés</option>
                        <option value ="en attente de publication"<?php $tools->selectedOption("filter","en attente de publication");?>>Les chapitres en attentes de publication </option>
                        <option value ="en cours de rédaction"<?php $tools->selectedOption("filter","en cours de rédaction");?>>Les chapitres en cours de rédaction</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="row" id="table_chapters">
            <section class="col-lg-12 table-responsive">
                <table class="table table-hover table-bordered table-striped" id="table_chapter">
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-bookmark"></span></th>
                    <th>Statut</th>
                    <th>Commencer le </th>
                    <th>Modifier le</th>
                    <th><span class="glyphicon glyphicon-pencil"></span></th>
                    <th><span class="glyphicon glyphicon-trash"></span></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <?php foreach($chapter_list as $chapter):?>
                    <td id ="chapter_title"><?php echo $chapter->getChapterTitle();?></td>
                    <td id ="chapter_state" id ="chapter_state"><?php echo $chapter->getChapterState();?> <?php echo $chapter->getChapterPublishOn($fr=true);?></td>
                    <td class ="table_center"><?php echo $chapter->getChapterStaredOn();?></td>
                    <td class ="table_center"><?php echo $chapter->getChapterLastMod();?></td>
                    <td class ="table_center"><a class="btn blue_btn" href="//localhost/blog/modifier-chapitre/chapterId/<?php echo $chapter->getChapterId();?>/novelId/<?php echo $novel_id;?>/novelTitle/<?php echo $novel_title;?>">Modifier</a></td>
                    <td class ="table_center"><a class="btn delete" href="//localhost/blog/effacer-chapitre/chapterId/<?php echo $chapter->getChapterId();?>/novelId/<?php echo $novel_id;?>/novelTitle/<?php echo $novel_title;?>"onclick="return confirm('Vous êtes sur le point de supprimer ce chapitre')">Effacer</a></td>
                </tr>
                <?php endforeach;?>
                </tbody>
                </table>
            </section>
        </div>
    </div>
</div>