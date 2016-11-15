<?php

use app\models\Categorie;
use app\models\Billet;

class SousCategorieController extends Controller {
    public function getSousCategories() {

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

    public function addSousCategory() {

        AnonymousController::header();

        $app = new \Slim\Slim();
        // Si on récupère bien les paramètres envoyés par le post
        if(!is_null($app->request->params())) {
            // Récupération du label de la catégorie
            $labelSousCategory = $app->request->params('label-sous-category');
            if(SousCategorie::whereLabel($labelSousCategory)->get()->toArray() == null) {
                //Création du nouveal objet de catégorie
                $sousCategory = new \app\models\SousCategorie();
                // Appel de la fonction addCategory du model Category
                $sousCategory->addSousCategory($labelSousCategory);
                $message = "Sous Catégorie bien ajoutée.";
            }
            else {
                $message = "Erreur. Sous-Catégorie déjà existante.";
            }
        }

        else {
            $message = "erreur lors de l'envoi du formulaire.";
        }

        Controller::$app->render('categorie/categories.php', array(
                'categories' => SousCategorie::all(),
                'message'    => $message,
            )
        );

        AnonymousController::modals();
        AnonymousController::footer();
    }

    public function deleteSousCategory($id) {

        AnonymousController::header();

        try {
            // Tentative de récupération de la catégorie avec l'id passé en paramètre
            $sousCategory = SousCategorie::where('id', '=', $id);
            $sousCategory->delete();
            $message = "La sous catégorie a bien été supprimée.";
        }
        catch(Exception $e) {
            $message = "Erreur lors de la suppression, la sous catégorie est sûrement liée à des billets existants.";
        }

        Controller::$app->render('categorie/categories.php', array(
            'categories' => SousCategorie::all(),
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
            $cat = SousCategorie::where('id', '=', $id)->first();
            // Récupération à travers le formulaire du nouveau label de la catégorie
            $newLabelSousCategory = $app->request->params('edit-label-sous-category');
            if(SousCategorie::whereLabel($newLabelSousCategory)->get()->toArray() == null) {
                $cat->label = $newLabelSousCategory;
                // Sauvegarde de la catégorie modifiée, puis modification envoyée à la bdd
                $cat->save();
                $message = "Sous catégorie bien modifiée.";
            }
            else {
                $message = "Une sous catégorie existante porte déjà ce label.";
            }
        }
        else {
            $message = "Erreur lors de l'envoi du formulaire";
        }

        Controller::$app->render('categorie/categories.php', array(
                'categories' => SousCategorie::all(),
                'message'   => $message,
            )
        );

        AnonymousController::modals();
        AnonymousController::footer();
    }

    public function getBilletsByCategory($id, $page) {
        // take pour prendre 20 élément, skip concerne l'offset
        $billets        = Billet::where('id_categorie', '=', $id)->orderBy('date', 'DESC')->take(20)->skip(20 * ($page - 1))->get();
        $category       = Categorie::whereId($id)->first();
        $countBillets   = count(Billet::where('id_categorie', '=', $id)->get());
        // Division par 20 arrondie à l'unité supérieure pour mettre en place le pager
        $nbPages        = ceil($countBillets / 20);
        AnonymousController::header();
        Controller::$app->render('billet/billets-by-category.php', array(
            'billets'   => $billets,
            'category'  => $category,
            'nbPages'   => $nbPages,
        ));
        AnonymousController::modals();
        AnonymousController::footer();
    }
}