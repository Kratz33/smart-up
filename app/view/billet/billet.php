<div class="col-xs-9 mt40">
    <div class="col-xs-10 col-xs-offset-1 container-interne">
        <h3 id="billet-title">
            <?php echo $billet['titre'] ?>
        </h3>
        <p id="billet-message">
            <?php echo $billet['message'] ?>
        </p>
        <div class="billet-footer">
            <p id="billet-date">
                le <?php echo $billet['date'] ?>
            </p>
            /
            <p id="billet-category">
                <?php echo $billet['category_label'] ?>
            </p>
        </div>
    </div>

    <?php if((isset($_SESSION['userPremium']) && $_SESSION['userPremium']==1) || (isset($_SESSION['userType']) && $_SESSION['userType']==2)): ?>
        <div class="col-xs-10 col-xs-offset-1">
            <ul class="collection col-s-12">
                 <?php foreach($comments as $comment): ?>
                    <li id="comment-<?php echo $comment['id'] ?>" class="collection-item col-s-12">
                        <div class="commentaire-utilisateur col-s-3">
                            <i class="medium material-icons">perm_identity</i>
                            <span class="utilisateur-pseudo"><?php echo $comment['userPseudo'] ?> <br>
                            note <sapn class="utilisateur-note"><?php echo $comment['userNote'] ?></span></span>
                        </div>
                        <div class="commentaire-message col-s-6">
                            <p><?php echo $comment['message'] ?></p>
                        </div>
                        <div class="commentaire-vote col-s-3">
                            <?php $array = array(
                                'comment_id' => $comment['id'],
                                'value'      => 1,
                                'user_id'    => $_SESSION['userId'],
                            );
                            ?>
                            <a id="vote-pos" onclick='vote(<?php echo(json_encode($array)); ?>);' >
                                <span class="
                                    <?php if($comment['vote_color'] == 'green'){ echo 't-green'; } ?>">
                                    <i class="material-icons">thumb_up</i>
                                    <span id="result-pos">
                                        <?php echo $comment['vote_pos'] ?>
                                    </span>
                                </span>
                            </a>
                            <?php $array = array(
                                'comment_id' => $comment['id'],
                                'value'      => -1,
                                'user_id'    => $_SESSION['userId'],
                                );
                            ?>
                            <a id="vote-neg" onclick='vote(<?php echo(json_encode($array)); ?>);'>
                                <span class="
                                    <?php if($comment['vote_color'] == 'red'){ echo 't-red'; } ?>">
                                        <i class="material-icons">thumb_down</i>
                                        <span id="result-neg">
                                            <?php echo $comment['vote_neg'] ?>
                                        </span>
                                </span>
                            </a>
                        </div>
                        <p class="billet-date col-s-12">
                            le <?php echo $comment['date'] ?>
                        </p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="pager col-xs-10">
            Page :
            <?php for($i=1; $i <= $nbPages; $i++): ?>
                <a href="<?php echo $app->urlFor('billet', array('id' => $billet['id'], 'page' => $i)); ?>" class=""> <?php echo $i ?> </a>
            <?php endfor; ?>
        </div>
        <?php if((isset($_SESSION['userType']) &&  $_SESSION['userType'] == 2) || $_SESSION['userId'] == $billet['utilisateur_id']): ?>
            <div class="col-xs-10 col-xs-offset-1">
                <form method="post" action="<?php echo $app->urlFor('add_comment', array('id' => $billet['id'])) ?>">
                    <div class="input-field col-xs-12">
                        <textarea id="comment-text-add" class="materialize-textarea" name="comment-text-add" required></textarea>
                        <label for="comment-text-add">Ajouter un commentaire</label>
                    </div>
                    <button class="btn waves-effect waves-light col-xs-12" type="submit" name="action">Commenter
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<script type="text/javascript">
    function vote(sendData) {
        $url = "/smart-up/vote/" + sendData['comment_id'] + "/" + sendData['value'] + "/" + sendData['user_id'];

        $.ajax({
            url: $url,
            type: "POST",
            data: sendData,
            success: function() {
                console.log("success !");
                if(sendData['value'] == -1
                    && !$("#comment-" + sendData['comment_id'] + " a#vote-neg span").hasClass("t-red")) {
                    $("#comment-" + sendData['comment_id'] + " a#vote-neg span").addClass("t-red");
                    $("#comment-" + sendData['comment_id'] + " span#result-neg").html(
                        parseInt($("#comment-" + sendData['comment_id'] + " span#result-neg").html())+1
                    );
                    if($("#comment-" + sendData['comment_id'] + " a#vote-pos span").hasClass("t-green")) {
                        $("#comment-" + sendData['comment_id'] + " span#result-pos").html(
                            parseInt($("#comment-" + sendData['comment_id'] + " span#result-pos").html())-1
                        );
                        $("#comment-" + sendData['comment_id'] + " a#vote-pos span").removeClass("t-green");
                    }
                }
                else if(sendData['value'] == -1
                    && $("#comment-" + sendData['comment_id'] + " a#vote-neg span").hasClass("t-red")) {
                    $("#comment-" + sendData['comment_id'] + " span#result-neg").html(
                        parseInt($("#comment-" + sendData['comment_id'] + " span#result-neg").html())-1
                    );
                    $("#comment-" + sendData['comment_id'] + " a#vote-neg span").removeClass("t-red");
                }
                else if(sendData['value'] == 1
                    && !$("#comment-" + sendData['comment_id'] + " a#vote-pos span").hasClass("t-green")) {
                    $("#comment-" + sendData['comment_id'] + " a#vote-pos span").addClass("t-green");
                    $("#comment-" + sendData['comment_id'] + " span#result-pos").html(
                        parseInt($("#comment-" + sendData['comment_id'] + " span#result-pos").html())+1
                    );
                    if($("#comment-" + sendData['comment_id'] + " a#vote-neg span").hasClass("t-red")) {
                        $("#comment-" + sendData['comment_id'] + " span#result-neg").html(
                            parseInt($("#comment-" + sendData['comment_id'] + " span#result-neg").html())-1
                        );
                        $("#comment-" + sendData['comment_id'] + " a#vote-neg span").removeClass("t-red");
                    }
                }
                else if(sendData['value'] == 1
                    && $("#comment-" + sendData['comment_id'] + " a#vote-pos span").hasClass("t-green")){
                    $("#comment-" + sendData['comment_id'] + " span#result-pos").html(
                        parseInt($("#comment-" + sendData['comment_id'] + " span#result-pos").html())-1
                    );
                    $("#comment-" + sendData['comment_id'] + " a#vote-pos span").removeClass("t-green");
                }
                return false;
            },
            error : function(xhr,status,error){
                alert("Erreur, veuillez contacter l'administrateur du site");
            },
        });
    }
</script>