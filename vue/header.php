<?php
/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 14/02/2017
 * Time: 11:43
 */


?>

<nav class="navbar navbar-toggleable-md navbar-fixed-top">
    <div class="container-fluid"
        <div class="navbar-header">
            <button type = "button" class = "navbar-toggle" data-toggle = "collapse" data-target = "#responsive_nav"><i class="fa fa-bars"></i></button>
            <ul class="nav navbar-nav navbar-left">
                <li><a class="navbar-brand" href="//localhost/blog/accueil"><span class="glyphicon glyphicon-home"></span>  Billet simple pour l'alaska</a></li>
            </ul>
            <div class = "collapse navbar-collapse" id = "responsive_nav">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="//localhost/blog/admin" id="admin_link"<?php echo $for_admin_only;?>><i class="fa fa-unlock"></i> Administration du site</a></li>
                    <?php echo $buttonState;?>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div id="message">
    <?php echo $message;?>
</div>



