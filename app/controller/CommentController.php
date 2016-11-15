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

    public function vote($commentId, $value, $userId) {
        try {
            // Si le vote pour ce commentaire a déjà été effectué, qu'il soit positif ou négatif
            $vote = \app\models\Vote::where("commentaire_id", '=', $commentId)
                ->where("utilisateur_id", '=', $userId)
                ->first();
            if(is_null($vote)) {
                $this->createVote($value, $userId, $commentId);
            }
            else {
                $vote = \app\models\Vote::where("valeur", '=', $value)
                    ->where("commentaire_id", '=', $commentId)
                    ->where("utilisateur_id", '=', $userId)
                    ->first();
                // si le vote est l'inverse de celui déjà présent, on créé le nouveau et supprime l'ancien
                if (is_null($vote)) {
                    $valueToDestroy = -1 * $value;
                    $voteToDelete = \app\models\Vote::where("valeur", '=', $valueToDestroy)
                        ->where("commentaire_id", '=', $commentId)
                        ->where("utilisateur_id", '=', $userId)
                        ->first();
                    $voteToDelete->delete();
                    $this->createVote($value, $userId, $commentId);
                }
                //sinon on détruit simplement le vote
                else {
                    $vote->delete();
                }
            }
        }
        catch (\Exception $e) {
            var_dump($e);
        }
    }

    public function createVote($value, $userId, $commentId) {

        $vote = new app\models\Vote();
        $vote->setAttribute('valeur', $value);
        $vote->setAttribute('utilisateur_id', $userId);
        $vote->setAttribute('commentaire_id', $commentId);
        $vote->save();

    }

}