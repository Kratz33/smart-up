<div class="col-xs-12 t-center">
    <div class="col-xs-10 col-xs-offset-1">
        <?php if(isset($message)): ?>
            <div class="col-xs-12 t-red t-center">
                <?php echo $message ?>
            </div>
        <?php endif; ?>
        <div class="col-xs-12 mt20">
            <label for="profile-lastname">Nom :</label>
            <div id="profile-lastname"><?php echo $user['nom'] ?></div>
        </div>
        <div class="col-xs-12 mt20">
            <label for="profile-firstname">Prénom :</label>
            <div id="profile-firstname"><?php echo $user['prenom'] ?></div>
        </div>
        <div class="col-xs-12 mt20">
            <label for="profile-mail">Email :</label>
            <div id="profile-mail"><?php echo $user['mail'] ?></div>
        </div>
        <div class="col-xs-12 mt20">
            <label for="profile-description">Description :</label>
            <div id="profile-description"><?php echo $user['description'] ?></div>
        </div>
        <div class="col-xs-12 mt20">
            <label for="profile-profil">Vous êtes un </label>
            <?php
                if ($user['profil'] == 1) {
                    echo "futur entrepreneur";
                } else {
                    echo "professionnel";
                }
            ?>
        </div>
        <div class="col-xs-12 mt20">
            <label for="profile-premium">Vous avez un compte </label>
            <?php
                if ($user['premium'] == 0) {
                    echo "gratuit";
                } else {
                    echo "premium";
                }
            ?>
        </div>
        <div class="col-xs-12 mt20">
            <a class="edit-profil" href="<?php echo $app->urlFor('edit_profile') ?>">Éditer</a>
        </div>
        <div class="col-xs-12 mt20">
            <?php   if(!is_null($posts)){
                        if($user['type_id'] == 1){
                            echo "<h3>Vos questions</h3>";
                        }
                        else{
                            echo "<h3>Vos commentaires</h3>";
                        }
                        
                        foreach($posts as $post){
                            echo "<ul class='billets-ul'>";
                            echo "<a href='".$app->urlFor('billet', array('id'=>$post["id"]))."'>"
                                    .'<li class="utilisateur-photo">'
                                        .'<i class="medium material-icons">perm_identity</i>'
                                    .' </li>'
                                    .'<li class="billet-titre">'
                                        .$post['titre']             
                                    .'</li>'
                                    .'<li class="billet-votes-count">'
                                        .'1'               
                                    .'</li>'
                                    .'<li class="billet-commentaires-count">'
                                        .'1'                
                                    .'</li>'
                                .'</a>';
                            echo "</ul>";
                        }
                        
                    }
            ?>
        </div>
    </div>
</div>
