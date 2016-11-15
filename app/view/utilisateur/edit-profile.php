<div class="col-xs-12 t-center">
    <h3> Modifier mon profil : </h3>
    <div class="col-xs-10 col-xs-offset-1">
        <?php if(isset($message)): ?>
            <div class="col-xs-12 t-red t-center">
                <?php echo $message ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo $app->urlFor('edit_profile') ?>">
            <div class="col-xs-12 mt20">
                <label for="edit-profile-lastname">Nom :</label></br>
                <input type="text" id="edit-profile-lastname" name="edit-profile-lastname"
                    value="<?php echo $user['nom'] ?>"/>
            </div>
            <div class="col-xs-12 mt20">
                <label for="edit-profile-firstname">Prénom :</label></br>
                <input type="text" id="edit-profile-firstname" name="edit-profile-firstname"
                       value="<?php echo $user['prenom'] ?>"/>
            </div>
            <div class="col-xs-12 mt20">
                <label for="edit-profile-mail">Email :</label></br>
                <input type="text" id="edit-profile-mail" name="edit-profile-mail"
                       value="<?php echo $user['mail'] ?>"/>
            </div>
            <div class="col-xs-12 mt20">
                <label for="edit-profile-password">Mot de passe :</label></br>
                <input type="password" id="edit-profile-password" name="edit-profile-password"
                       value="<?php echo $user['mdp'] ?>"/>
            </div>
            <div class="col-xs-12 mt20">
                <input type="submit" id="submit-edit-profile" class="submit-edit-profile" value="Modifier"/>
            </div>
        </form>
    </div>
</div>