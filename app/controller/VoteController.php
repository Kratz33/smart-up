<?php

use app\models\Billet;
use app\models\Categorie;
use app\models\Comment;
use app\models\Utilisateur;

class VoteController extends Controller {

    public function addVote($commentId, $value, $userId){

        $vote = \app\models\Vote::where("valeur", '=', $value)
            ->where("commentaire_id", '=', $commentId)
            ->where("utilisateur_id", '=', $userId)
            ->first();

        if(is_null($vote)) {
            $vote = \app\models\Comment::addVote($value, $userId, $commentId);
        }

    }

}