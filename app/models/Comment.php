<?php
namespace app\models;


class Comment extends \Illuminate\Database\Eloquent\Model{

    protected $table = 'commentaires';
    protected $primaryKey = 'id';
    public $timestamps = false;

    
}
?>