<?php
use app\models\Comment;
use app\models\Billet;

class CommentController extends Controller {

    public function addComment($id) {

        $app = new \Slim\Slim();
        $userId = $_SESSION['userId'];
        $comment = new Comment();
        $message = $app->request->params('comment-text-add');
        //$comment->addComment($message, $billetId, $userId);

        AnonymousController::header();

        $comments = $this->getComments($id);
        $billet = Billet::whereId($id)->first();

        Controller::$app->render('billet.php', array('billet' => $billet, 'comments' => $comments));

        AnonymousController::modals();
        AnonymousController::footer();
    }

}