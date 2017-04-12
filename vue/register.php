<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 22/03/2017
 * Time: 10:23
 */
?>
<div class="page-wrap">
    <div class="container col-sm-12" id="register_warp">
        <form class="form" id="register_form" action="//localhost/blog/validation-inscription" method="post">
            <div class="form-group">
                <label class="control-label col-sm-10" for="surname">Nom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Entrez votre nom">
                    <span id="empty_surname" style="display: none">Ce champ doit être rempli</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-10" for="name">Prenom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Entrer votre prenom">
                    <span id="empty_name" style="display: none">Ce champ doit être rempli</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-10" for="email">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrer votre email">
                    <span id="empty_register_email" style="display: none">Ce champ doit être rempli</span>
                    <span id="email_exist" style="display: none">Cette adresse email est déjà utilisé</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-10" for="pswd">Mot de passse</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Entrer votre mot de passe">
                    <span id="weak_pswd" style="display: none">Votre mot de passe doit comporter un minimum de 4 caractères</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-10" for="pswd">Confirmer le mot de passe</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="confirm_pswd" name="confirm_pswd" placeholder="Entrer votre mot de passe">
                    <span id="pswd_matches" style="display: none">Les mots de passe ne correspondent pas ou le champ est vide</span>
                </div>
            </div>
            <div class="g-recaptcha" id="recaptcha" data-sitekey="6LczJhoUAAAAAJjl9NLyScyLau0nKFA7Tl-CSm6S"></div>
                <br/>
                <div class="form-group">
                    <button type="submit" class="btn btn-default" id="apply_register">Créer mon compte</button>
                    <input type="hidden" id="register_error" value="<?php echo $register_error;?>">
                    <input id="posted_register_surname" type="hidden" value="<?php echo $surname;?>">
                    <input id="posted_register_name" type="hidden" value="<?php echo $name;?>">
                    <input id="posted_register_email" type="hidden" value="<?php echo $email;?>">
                </div>
            </div>
        </form>
    </div>
</div>