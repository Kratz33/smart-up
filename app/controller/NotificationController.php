<?php

use app\models\Billet;
use app\models\Categorie;
use app\models\Comment;
use app\models\Utilisateur;

class NotificationController extends Controller {

    public function readNotification($notificationId, $postId){

        $notif = app\models\Notification::where('id', '=', $notificationId)->first()->setRead();
        Controller::$app->redirectTo('billet', array('id' => $postId));

    }

}