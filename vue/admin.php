<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 14/02/2017
 * Time: 11:41
 */



?>
<div class="page-wrap">

    <h2 class="table_title">Mes romans</h2>

    <div class="col-sm-12">
        <a id="new_novel" href="#">nouveau roman</a>
    </div>


    <form class="form" id="novel_form" action="//localhost/blog/sauver-roman" method="post">
        <div class="form-group">
                <div class="col-sm-11">
                    <input type="text" class="form-control" id="novel_title"  name="novel_title" placeholder="entrer le titre du roman">
                    <span id="novel_title_error" style="display: none">Veuillez donner un titre à votre chapitre !</span>
                </div>
        </div>
        <div class="form-group">
            <div class=" col-sm-0">
                <button type="submit" class="btn btn-default" id="create_novel">Créer le roman</button>
            </div>
        </div>
    </form>


    <div class="col-sm-12" id="table_novels">
        <section class="table-responsive">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-book"></span></th>
                    <th><span class="glyphicon glyphicon-calendar"></span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span></th>
                    <th><span class="glyphicon glyphicon-list"></span></th>
                    <th><span class="glyphicon glyphicon-trash"></span></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach($novel_list as $novel):?>
                    <td id ="novel_title"><?php echo $novel->getNovelTitle();?></td>
                    <td class="table_center" id ="started_on"><?php echo  $novel->getNovelDate();?></td>
                    <td class="table_center"><a class="btn green_btn" href="nouveau-chapitre/novelId/<?php echo $novel->getNovelId();?>">nouveau chapitre</a></td>
                    <td class="table_center"><a class="btn blue_btn" href="liste-chapitres/novelId/<?php echo $novel->getNovelId();?>">Liste des chapitres</a></td>
                    <td class="table_center"><a class="btn delete" href="effacer-roman/novelId/<?php echo $novel->getNovelId();?>"onclick="return confirm('Attention en supprimant ce roman, vous supprimerez également tous ses chapitres.')">Effacer</a></td>
                </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </section>
    </div>


    <h2 class="table_title" id="members_table_title">Gestion des membres</h2>


        <form class="form" id="filter_member" action="//localhost/blog/admin" method="POST">
            <div class="form-group">
                <div class="col-sm-5">
                    <select class="form-control col-sm-1" id="sel" name ="filter_member">
                        <option value ="1=1"  <?php  $tools->selectedOption("filter_member","1=1");?>> Tous les membres</option>
                        <option value ="banni"<?php  $tools->selectedOption("filter_member","banni");?>>Les membres bannis</option>
                        <option value ="actif"<?php  $tools->selectedOption("filter_member","actif");?>>Les membres actif </option>
                    </select>
                </div>
            </div>
        </form>

    <div class="col-sm-12" id="table_members">
        <section class="table-responsive">
            <table class="table table-hover table-bordered table-striped" id="table">
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-user"></span></th>
                    <th><span class="glyphicon glyphicon-envelope"></span></th>
                    <th><span class="glyphicon glyphicon-calendar"></span></th>
                    <th>Statut</th>
                    <th><span class="glyphicon glyphicon-ban-circle"></span></th>
                    <th><span class="glyphicon glyphicon-info-sign"></th>
                    <th><span class="glyphicon glyphicon-trash"></span></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach($member_list as $member):?>
                    <td id ="member_name"><?php echo $member->getSurname();?>
                        <?php echo $member->getName();?></td>
                    <td id ="member_email"><?php echo $member->getEmail();?></td>
                    <td class="table_center"><?php echo $member->getDate();?></td>
                    <td class="table_center"><?php echo $member->getStatus();?></td>
                    <td class="table_center"><a class="btn green_btn" id="ban_btn" href="//localhost/blog/modifier-le-statut/user/<?php echo $member->getId();?>/status/<?php echo $member->getStatus();?>"><?php echo $ban_button = $tools->textForBanButton($member->getStatus())?></a></td>
                    <td class="table_center"><a class="btn blue_btn" href="informations-sur-le-membre/user/<?php echo $member->getId();?>">Détails</a></td>
                    <td class="table_center"><a class="btn delete" href="effacer-le-membre/user/<?php echo $member->getId();?>"onclick="return confirm('Supprimer ce membre')">Effacer</a></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </section>
    </div>
</div>

