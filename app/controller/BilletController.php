<?php

use app\models\Billet;
use app\models\Categorie;
use app\models\Comment;
use app\models\Utilisateur;

class BilletController extends Controller {

    public function getBillets($page) {

        AnonymousController::header();

        // take pour prendre 20 élément, skip concerne l'offset
        $billets = Billet::orderBy('date', 'DESC')->take(20)->skip(20 * ($page - 1))->get();

        foreach($billets as $billet) {
            // Récupération de la catégorie en rapport avec le billet
            $category = Categorie::where('id', '=', $billet['id_categorie'])->first();
            // Récuprétion du label de la catégorie
            $categoryLabel = $category->label;
            // Ajout au tableau de billet le label de la catégorie
            $billet['category_label'] = $categoryLabel;
        }

        $categories = Categorie::all();

        // Récupréation du nombre de billets
        $countBillets = count(Billet::all());
        // Division par 20 arrondie à l'unité supérieure pour mettre en place le pager
        $nbPages = ceil($countBillets / 20);


        Controller::$app->render('billet/billets.php', array(
            'billets' => $billets,
            'nbPages' => $nbPages,
            'categories' => $categories
        ));

        AnonymousController::modals();
        AnonymousController::footer();

    }

    public function getBillet($id) {
        AnonymousController::header();
        //$app = new \Slim\Slim();

        // On récupère le billet avec l'id passé en paramètre
        $billet = Billet::whereId($id)->first();
        // On récupère le label de la catégorie lié au billet récupéré
        $category = Categorie::where('id', '=', $billet['id_categorie'])->first();
        $categoryLabel = $category->label;
        // On ajoute dans le tableau du billet le label de la catégorie
        $billet['category_label'] = $categoryLabel;

        // On récupère les commentaires liés au billet
        $comments = $this->getComments($id);

        Controller::$app->render('billet/billet.php', array('billet' => $billet, 'comments' => $comments));

        AnonymousController::modals();
        AnonymousController::footer();
    }

    public function getComments($billet_id) {
        //Récupération des commentaires liés à l'id du billet passé en paramètre
        $comments = Comment::whereIdBillet($billet_id)->get();
        $i = 0;
        foreach ($comments as $comment) {
            // On récupère le pseudo de l'utilisateur pour l'ajouter à chaque commentaire
            $user = Utilisateur::whereId($comment['id_utilisateur'])->first()->toArray();
            $arrayVotes = $comment->getVotes();
            $comment['vote_pos'] = $arrayVotes['vote_pos'];
            $comment['vote_neg'] = $arrayVotes['vote_neg'];

            // On vérifie si l'utilisateur courant a voté ou non pour le commentaire courant
            if ($_SESSION['userId']) {
                $vote = \app\models\Vote::where("commentaire_id", '=', $comment['id'])
                    ->where("utilisateur_id", '=', $_SESSION['userId'])
                    ->first();
                if (!is_null($vote)) {
                    $vote = $vote->toArray();
                    if($vote['valeur'] == 1) {
                        $comment['vote_color'] = "green";
                    }
                    else {
                        $comment['vote_color'] = "red";
                    }
                }
                else {
                    $comment['vote_color'] = "";
                }
            }
        }
        // On renvoie le tableau des commentaires avec l'ajout du pseudo pour chaque commentaire
        return $comments;
    }

    public function addBillet($id) {

        $app        = new \Slim\Slim();
        $billet     = new Billet();
        $title      = $app->request->params('add-billet-title');
        $categoryId = $app->request->params('add-billet-category');
        $message    = $app->request->params('add-billet-message');
        $userId     = $_SESSION['userId'];

        try {
            $billet->titre          = $title;
            $billet->id_categorie   = $categoryId;
            $billet->message        = $message;
            $billet->id_utilisateur = $userId;
            $billet->save();
        }
        catch(Exception $e) {
            echo $e;
        }

        $this->getBillets($id);

    }

    public function addComment($id) {

        $app      = new \Slim\Slim();
        $comment  = new Comment();
        $comment->message           = $app->request->params('comment-text-add');
        $comment->id_utilisateur    = $_SESSION['userId'];
        $comment->id_billet         = $id;
        $comment->save();
        $this->getBillet($id);

    }

}