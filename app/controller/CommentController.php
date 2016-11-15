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

    public function addVote($value, $userId, $commentId) {
        try {
            $vote = \app\models\Vote::where("valeur", '=', $value)
                ->where("commentaire_id", '=', $commentId)
                ->where("utilisateur_id", '=', $userId)
                ->first();

            if(is_null($vote)) {
                $vote = new app\models\Vote();
                $vote->setAttribute('valeur', $value);
                $vote->setAttribute('utilisateur_id', $userId);
                $vote->setAttribute('commentaire_id', $commentId);
                $vote->save();
            }
        }
        catch (\Exception $e) {
            var_dump($e);
        }
    }

}