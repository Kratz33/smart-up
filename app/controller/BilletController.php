<?php

use app\models\Billet;
use app\models\Categorie;
use app\models\Comment;
use app\models\Utilisateur;

class BilletController extends Controller {

    public function getBillets($page) {

        AnonymousController::header();

        // take pour prendre 20 élément, skip concerne l'offset
        $billets = Billet::orderBy('date', 'DESC')->take(8)->skip(8 * ($page - 1))->get();

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
        $nbPages = ceil($countBillets / 8);


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
            if (isset($_SESSION['userId'])) {
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

    public function addBillet() {
        
        AnonymousController::header();
        $app        = new \Slim\Slim();
        
        //Si c'est du post, on enregistre le post
        if($app->request->isPost()){
            $billet     = new Billet();
            $title      = $app->request->params('title');
            $categoryId = $app->request->params('category');
            $message    = $app->request->params('description');
            $userId     = $_SESSION['userId'];

            try {
                $billet->titre          = $title;
                $billet->id_categorie   = $categoryId;
                $billet->message        = $message;
                $billet->id_utilisateur = $userId;
                
                $billet->save();
                
                //Création des notifications
                //Récupérer les pro intéréssé a la catégories
                $util_categ = \app\models\UtilCateg::where("categorie_id", "=", $categoryId)->get()->toArray();
                $ids = $this->sortIdUtilCateg($util_categ);
                //$professionnels = Utilisateur::where("type_id", "=", 2)->whereIn("id", $ids)->get()->toArray();
                foreach($ids as $id){
                    $notification = new \app\models\Notification();
                    $notification->addNotification($id, "test");
                }                
            }
            catch(Exception $e) {
                echo $e;
            }
        }
        
        $categories = Categorie::all();
        
        Controller::$app->render('billet/add_billet.php', array('categories'=>$categories));

        AnonymousController::modals();
        AnonymousController::footer();
        
        
    }

    public function addComment($id) {

        try {
            $app = new \Slim\Slim();
            $comment = new Comment();
            $comment->message = $app->request->params('comment-text-add');
            $comment->id_utilisateur = $_SESSION['userId'];
            $comment->id_billet = $id;
            $comment->save();
            $this->getBillet($id);

            $userId = $_SESSION['userId'];
            $userPseudo = $_SESSION['userPseudo'];
            //Création de la notification pour le créateur du post

            $notification = new \app\models\Notification();
            $notification->addNotification($userId, "Votre post a reçu une réponse de la part de" . $userPseudo, $id);
        }
        catch (Exception $e) {
            var_dump($e);
        }

    }
    
    private function sortIdUtilCateg($util_categ){
        $ids = array();
        foreach ($util_categ as $el){
            array_push($ids, $el['utilisateur_id']);
        }
        return $ids;
    }

}