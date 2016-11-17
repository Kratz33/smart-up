<?php

use app\models\Categorie;
use app\models\Billet;
use app\models\Comment;
use app\models\Vote;

class CategorieController extends Controller {
    public function getCategories() {

        if(!isset($_SESSION['userProfile']) || $_SESSION['userProfile'] != "admin") {
            AnonymousController::index();
        }
        else {
            AnonymousController::header();

            // Si l'utilisateur connecté est admin, on lui retourne la page des catégories
            if (isset($_SESSION['userProfile']) && $_SESSION['userProfile'] == "admin") {
                Controller::$app->render('categorie/categories.php', array('categories' => Categorie::all()));
            } // Sinon on le renvoie sur la homepage
            else {
                Controller::$app->render('front/homepage.php');
            }


            AnonymousController::modals();
            AnonymousController::footer();
        }
    }
    
    public function addCategory() {

        AnonymousController::header();

        $app = new \Slim\Slim();
        // Si on récupère bien les paramètres envoyés par le post
        if(!is_null($app->request->params())) {
            // Récupération du label de la catégorie
            $labelCategory = $app->request->params('label-category');
            if(Categorie::whereLabel($labelCategory)->get()->toArray() == null) {
                //Création du nouveal objet de catégorie
                $category = new \app\models\Categorie();
                // Appel de la fonction addCategory du model Category
                $category->addCategory($labelCategory);
                $message = "Catégorie bien ajoutée.";
            }
            else {
                $message = "Erreur. Catégorie déjà existante.";
            }
        }

        else {
            $message = "erreur lors de l'envoi du formulaire.";
        }

        Controller::$app->render('categorie/categories.php', array(
            'categories' => Categorie::all(),
            'message'    => $message,
            )
        );

        AnonymousController::modals();
        AnonymousController::footer();
    }

    public function deleteCategory($id) {

        AnonymousController::header();

        try {
            // Tentative de récupération de la catégorie avec l'id passé en paramètre
            $category = Categorie::where('id', '=', $id);
            $category->delete();
            $message = "La catégorie a bien été supprimée.";
        }
        catch(Exception $e) {
            $message = "Erreur lors de la suppression, la catégorie est sûrement liée à des billets existants.";
        }

        Controller::$app->render('categorie/categories.php', array(
            'categories' => Categorie::all(),
            'message'    => $message
        ));

        AnonymousController::modals();
        AnonymousController::footer();
    }

    public function editCategory($id) {

        AnonymousController::header();

        $app = new \Slim\Slim();

        // S'il y a récupération des paramètres envoyés par le formulaire
        if(!is_null($app->request->params())) {

            // récupération de la catégorie via le paremètre $id
            $cat = Categorie::where('id', '=', $id)->first();
            // Récupération à travers le formulaire du nouveau label de la catégorie
            $newLabelCategory = $app->request->params('edit-label-category');
            if(Categorie::whereLabel($newLabelCategory)->get()->toArray() == null) {
                $cat->label = $newLabelCategory;
                // Sauvegarde de la catégorie modifiée, puis modification envoyée à la bdd
                $cat->save();
                $message = "Catégorie bien modifiée.";
            }
            else {
                $message = "Une catégorie existante porte déjà ce label.";
            }
        }
        else {
            $message = "Erreur lors de l'envoi du formulaire";
        }

        Controller::$app->render('categorie/categories.php', array(
            'categories' => Categorie::all(),
             'message'   => $message,
            )
        );

        AnonymousController::modals();
        AnonymousController::footer();
    }

    public function getBilletsByCategory($id, $page) {
        // take pour prendre 20 élément, skip concerne l'offset
        $billets        = Billet::where('id_categorie', '=', $id)->orderBy('date', 'DESC')->take(8)->skip(8 * ($page - 1))->get();
        $countBillets   = count(Billet::where('id_categorie', '=', $id)->get());
        $nbPages        = ceil($countBillets / 8);

        // Ul Billets
        $billetsWithCommentVote = array();
        $i = 0;
        foreach($billets as $billet) {
            $billetsWithCommentVote[$i]['id'] = $billet['id'];
            $billetsWithCommentVote[$i]['titre'] = $billet['titre'];
            $billetsWithCommentVote[$i]['votes_count'] = 0;
            $billetsWithCommentVote[$i]['commentaires_count'] = 0;

            $comments = Comment::whereIdBillet($billet['id'])->get();
            foreach($comments as $comment) {
                $billetsWithCommentVote[$i]['votes_count'] += count(Vote::where('commentaire_id', '=', $comment['id'])->get());
                $billetsWithCommentVote[$i]['commentaires_count'] += 1;
            }
            $i++;           
        }

        // Table Categories
        $categories = Categorie::all();
        $categoriesWithBillets = array();
        $i = 0;
        foreach($categories as $category) {

            $billetsCount = count(Billet::where('id_categorie', '=', $category['id'])->get());

            $categoriesWithBillets[$i]['id']            = $category['id'];
            $categoriesWithBillets[$i]['label']         = $category['label'];
            $categoriesWithBillets[$i]['billets_count'] = $billetsCount;

            $i++;
        }
        
        $category       = Categorie::whereId($id)->first();

        AnonymousController::header();
        Controller::$app->render('billet/billets-by-category.php', array(
            'billets'   => $billetsWithCommentVote,
            'category'  => $category,
            'categories'=> $categoriesWithBillets,
            'nbPages'   => $nbPages,
        ));
        AnonymousController::modals();
        AnonymousController::footer();
    }
}