<div class="col-xs-12 t-center">
    <div class="col-xs-10 col-xs-offset-1 modif-profil container-interne">
        <h4 class="col-xs-12 mt20">Modifier mon profil</h4>
        <?php if(isset($message)): ?>
            <div class="col-xs-12 t-red t-center">
                <?php echo $message ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo $app->urlFor('save_profile') ?>">
            <div class="col-xs-6 mt20">
                <label for="edit-profile-lastname">Nom :</label>
                <input type="text" id="edit-profile-lastname" name="edit-profile-lastname"
                    value="<?php echo $user['nom'] ?>"/>
            </div>
            <div class="col-xs-6 mt20">
                <label for="edit-profile-firstname">Prénom :</label>
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
                <label for="edit-profile-description">Description :</label></br>
                <textarea id="edit-profile-description" name="edit-profile-description"
                        cols="40" rows="20"><?php echo $user['description'] ?></textarea>
            </div>
            <div class="col-xs-12 mt20">
                <label for="edit-profile-profil">Vous êtes un </label>
                <?php
                    if ($user['profil'] == 1) {
                        echo "futur entrepreneur";
                    } else {
                        echo "professionnel";
                    }
                ?>
            </div>
            <div class="col-xs-12 mt20">
                <label for="edit-profile-premium">Vous avez un compte </label>
                <?php
                    if ($user['premium'] == 0) {
                        echo "gratuit";
                    } else {
                        echo "premium";
                    }
                ?>
            </div>
            <div class="col-xs-12 mt20">
                <input type="submit" id="submit-edit-profile" class="submit-edit-profile" value="Modifier"/>
            </div>
        </form>
    </div>
</div>