<div class="col-xs-12 t-center">
    <div class="col-xs-12 t-center mt20">
        <?php echo $message; ?>
    </div>
    <div class="col-xs-12 t-center mt40">
        <a href="<?php echo $app->urlFor('root');?>" class="btn-classic">Retourner à l'accueil</a>
    </div>
    <?php if(!isset($_SESSION["userPseudo"])): ?>
        <div class="col-xs-12 t-center mt40">
            <a class="btn-classic btn-connexion">Se connecter</a>
        </div>
    <?php endif ?>
</div>
