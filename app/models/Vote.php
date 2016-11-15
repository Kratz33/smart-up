<?php


namespace app\models;


class Vote extends \Illuminate\Database\Eloquent\Model{

    protected $table = 'vote';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function deleteVote($valueArray) {

    }

    public function editVote($valueArray) {

    }
}
?>