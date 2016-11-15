<?php

use app\models\Billet;
use app\models\Categorie;
use app\models\Comment;
use app\models\Utilisateur;

class VoteController extends Controller {

    public function addVote(){

        $app = new \Slim\Slim();
        $commentId = $app->request->params('comment_id');
        $value     = $app->request->params('value');
        $userId    = $app->request->params('user_id');
        echo $commentId . "</br>" . $value . "</br>" . $userId;
        $vote = \app\models\Vote::where("valeur", '=', $value)
            ->where("commentaire_id", '=', $commentId)
            ->where("utilisateur_id", '=', $userId)
            ->first();
        var_dump($vote);

    }

}