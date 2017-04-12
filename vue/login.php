<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 22/03/2017
 * Time: 09:26
 */
?>
<div class="page-wrap" id="login_warp">
    <form class="form" id="login_form" action="//localhost/blog/validation-login/from/<?php echo $redirect_after_login?>" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <div>
                <input type="email" class="form-control" id="email" name="email" placeholder="Entrer votre email">
                <span id="empty_email" style="display:none">Veuillez remplir ce champ</span>
                <span id="email_error_message" style="display:none">Adresse email inconnue</span>
                <input id="fill_up" type="hidden" value="<?php echo $fillUpForNewbie;?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="pswd">Mot de passse</label>
            <div>
                <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Entrer votre mot de passe">
                <span id="pswd_informations" style="display:none">Veuillez remplir ce champ</span>
                <span id="pswd_error_message" style="display:none">Vérifiez votre  mot de passe</span>
                <input id="posted_email" type="hidden" value="<?php echo $email;?>">
                <input id="pswd_error" type="hidden" value="<?php echo $error;?>">
            </div>
        </div>
        <div class="form-group">
            <div>
                <button type="submit" class="btn btn-default" id="apply_login">Connexion</button>
                <a href="//localhost/blog/inscription"  class="btn btn-default" id="show_register">S'inscrire</a>
            </div>
            <div>
                <label><input type="checkbox" name="remain_connect" value="1"> Se souvenir de moi</label>
            </div>
        </div>
    </form>
</div>