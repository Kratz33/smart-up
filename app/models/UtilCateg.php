<?php

namespace app\models;


class UtilCateg extends \Illuminate\Database\Eloquent\Model{
    protected $table = 'util_categ';
    protected $primaryKey = array('utilisateur_id', "categorie_id");
    public $timestamps = false;
}
