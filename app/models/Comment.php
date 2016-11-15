<?php
namespace app\models;


class Comment extends \Illuminate\Database\Eloquent\Model{

    protected $table = 'commentaires';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getVotes() {
        $votesNeg = Vote::where("valeur", '=', -1)->Where("commentaire_id", '=', $this->id)->count();
        $votesPos  = Vote::where("valeur", '=', 1)->Where("commentaire_id", '=', $this->id)->count();
        $arrayVotes['vote_pos'] = $votesPos;
        $arrayVotes['vote_neg'] = $votesNeg;
        return($arrayVotes);
    }
}
?>