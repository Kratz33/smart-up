<?php


namespace app\models;


class Vote extends \Illuminate\Database\Eloquent\Model{

    protected $table = 'vote';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function addVote($valueArray) {
        try {
            $this->value   = $valueArray['value'];
            $this->utilisateurId      = $valueArray['userId'];
            $this->commentaireId   = $valueArray['commentId'];
            $this->save();
        }
        catch (\Exception $e) {
            var_dump($e);
        }
    }

    public function deleteVote($valueArray) {

    }

    public function editVote($valueArray) {

    }
}
?>