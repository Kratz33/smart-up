<?php

namespace app\models;


class Notification extends \Illuminate\Database\Eloquent\Model{
    protected $table = 'notification';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function addNotification($userId, $text, $postId = null) {

        try {
            $this->utilisateur_id = $userId;
            $this->posts_id = $postId;
            $this->lu = 0;
            $this->text = $text;
            $this->save();
        }
        catch (\Exception $e) {
            var_dump($e);
        }

    }

    public static function getNotifs($userId) {

        $notifs['not_read'] = \app\models\Notification::where('utilisateur_id', '=', $userId)->where('lu', '=', 0)->get()->toArray();
        $notifs['all'] = \app\models\Notification::where('utilisateur_id', '=', $userId)->orderBy('date', 'DESC')->get()->toArray();
        return($notifs);

    }

    public function setRead() {

        $this->lu = 1;
        $this->save();

    }
}
