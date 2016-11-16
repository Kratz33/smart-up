<div class="col-xs-12 mt40">
    <div class="col-xs-10 col-xs-offset-1">
        <label for="billet-title">Titre :</label>
        <p id="billet-title">
            <?php echo $billet['titre'] ?>
        </p>
        <label for="billet-message">Message :</label>
        <p id="billet-message">
            <?php echo $billet['message'] ?>
        </p>
        <label for="billet-date">Date de parution :</label>
        <p id="billet-date">
            <?php echo $billet['date'] ?>
        </p>
        <label for="billet-category">Catégorie liée :</label>
        <p id="billet-category">
            <?php echo $billet['category_label'] ?>
        </p>
    </div>

    <?php if((isset($_SESSION['userPremium']) && $_SESSION['userPremium']==1) || (isset($_SESSION['userType']) && $_SESSION['userType']==2)): ?>
        <div class="col-xs-8 col-xs-offset-2 comments mt20">
            <?php foreach($comments as $comment): ?>
                <label>Commentaire posté par <?php echo $comment['userPseudo'] ?>, <le></le> <?php echo $comment['date'] ?></label></br>
                <p>
                    <?php echo $comment['message'] ?>
                </p>
                <p id="vote">
                    <?php $array = array(
                        'comment_id' => $comment['id'],
                        'value'      => 1,
                        'user_id'    => $_SESSION['userId'],
                    );
                    ?>
                    <a onclick='vote(<?php echo(json_encode($array)); ?>);'>
                        <span class="
                            <?php if($comment['vote_color'] == 'green'){ echo 't-green'; } ?>">
                            <i class="fa fa-plus fa-2x"></i> <?php echo $comment['vote_pos'] ?>
                        </span>
                    </a>
                    <?php $array = array(
                        'comment_id' => $comment['id'],
                        'value'      => -1,
                        'user_id'    => $_SESSION['userId'],
                        );
                    ?>
                    <a onclick='vote(<?php echo(json_encode($array)); ?>);'>
                        <span class="
                            <?php if($comment['vote_color'] == 'red'){ echo 't-red'; } ?>">
                            <i class="fa fa-minus fa-2x"></i> <?php echo $comment['vote_neg'] ?>
                        </span>
                    </a>
                </p>
            <?php endforeach; ?>
        </div>
        <?php if(isset($_SESSION['userType']) &&  $_SESSION['userType'] == 2): ?>
            <div class="col-xs-12 t-center">
                <h3>Ajouter un commentaire</h3>
                <form method="post" action="<?php echo $app->urlFor('add_comment', array('id' => $billet['id'])) ?>">
                    <div class="col-xs-12 t-center">
                        <label for="comment-text-add">Text du commentaire :</label></br>
                        <textarea id="comment-text-add" name="comment-text-add" required="required" placeholder="Message du commentaire"></textarea>
                    </div>
                    <div class="col-xs-12 t-center">
                        <input type="submit" value="poster mon commentaire"/>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<script type="text/javascript">
    function vote(sendData) {
        $url = "/smart-up/vote/" + sendData['comment_id'] + "/" + sendData['value'] + "/" + sendData['user_id'];

        console.log($url);
        $.ajax({
            url: $url,
            type: "GET",
            contentType: false,
            processData: false,
            dataType: "json",
            data: sendData,
            success: function() {
                console.log("success !")
            },
            error: function() {
                console.log("Error, please contact the website admin who'll never answer");
            }
        });
    }
</script>