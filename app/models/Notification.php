<?php

namespace app\models;


class Notification extends \Illuminate\Database\Eloquent\Model{
    protected $table = 'notification';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
