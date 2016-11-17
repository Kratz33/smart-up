<?php

use app\models\Utilisateur;
use app\models\Billet;
use app\models\Categorie;

class UserController extends Controller
{
    public function inscription()
    {
        AnonymousController::header();

        $app = new \Slim\Slim();
        if(!is_null($app->request->params())) {

            $valueArray = array(
                'pseudo'    => $app->request->params('inscription-pseudo'),
                'lastname'  => $app->request->params('inscription-lastname'),
                'firstname' => $app->request->params('inscription-firstname'),
                'email'     => $app->request->params('inscription-mail'),
                'password'  => md5($app->request->params('inscription-password')),
				'type'   => $app->request->params('inscription-type'),
				'premium'      => $app->request->params('inscription-premium'),
				
            );

            $user = new \app\models\Utilisateur();
            $user->addUser($valueArray);
        }
        else {
            echo "non non non";
        }
        Controller::$app->render('utilisateur/inscription.php');

        AnonymousController::modals();
        AnonymousController::footer();
    }

    public function connexion()
    {

        $app = new \Slim\Slim();

        // Récupération de l'utilisateur en fonction du pseudo et du mot de passe renseignées
        $user = Utilisateur::wherePseudo($app->request->params('connexion-pseudo'))
            ->whereMdp(md5($app->request->params('connexion-password')))
            ->first();
        // Si la base de données match avec le pseudo et le mot de passe et qu'il n'est pas radié
        if(isset($user)) {
            // On créé un cookie Slim pour y inclure le profil, le pseudo et l'id (utilisés un peu partout)
            $app->add(new \Slim\Middleware\SessionCookie());
            $_SESSION["userProfile"] = $user['profil'];
            $_SESSION["userPseudo"] = $user['pseudo'];
            $_SESSION['userId'] = $user['id'];
            $_SESSION['userPremium'] = $user['premium'];
            $_SESSION['userType'] = $user['type_id'];

            $message = "Bienvenue, vous êtes connecté sous le pseudo " . $user['pseudo'];
        }
        else{
            $message = "Le pseudo et/ou le mot de passe n'est/ne sont pas bon(s), merci de retenter de vous connecter";
        }

       for ($i = 0; $i < 20; $i++) {
            if(isset($billets[$i])) {
                $category = Categorie::where('id', '=', $billets[$i]['id_categorie'])->first();
                $categoryLabel = $category->label;
                $billets[$i]['category_label'] = $categoryLabel;
            }
       }

        $categories = Categorie::all();
        // $billetsByCategory pour Google Charts
        $billetsByCategory = array();
        // $categoriesWithBillets pour charger le tableau dans la homepage des billets par catégorie
        $categoriesWithBillets = array();
        foreach($categories as $category) {

            $billetsCount = count(Billet::where('id_categorie', '=', $category['id'])->get());
            $billetsByCategory[] = array($category['label'], $billetsCount);

            $categoriesWithBillets[$i]['id']            = $category['id'];
            $categoriesWithBillets[$i]['label']         = $category['label'];
            $categoriesWithBillets[$i]['billets_count'] = $billetsCount;


            $i++;
        }

        AnonymousController::header();

        Controller::$app->render('categorie/categories.php', array('categoriesWithBillets' => $categoriesWithBillets));

        AnonymousController::modals();
        AnonymousController::footer();
    }

    public function logout(){

        // On met à null les variables de sessions
        $_SESSION["userPseudo"]     = null;
        $_SESSION["userProfile"]    = null;
        $_SESSION["userId"]         = null;
        $_SESSION['userPremium']    = null;
        $_SESSION['userType']       = null;

        $app = new \Slim\Slim();
        $app->deleteCookie('user');


        // take pour prendre 20 élément, skip concerne l'offset
        $billets = Billet::orderBy('date', 'DESC')->take(20)->skip(0)->get();

        for ($i = 0; $i < 20; $i++) {
            if(isset($billets[$i])) {
                $category = Categorie::where('id', '=', $billets[$i]['id_categorie'])->first();
                $categoryLabel = $category->label;
                $billets[$i]['category_label'] = $categoryLabel;
            }
        }

        $categories = Categorie::all();
        // $billetsByCategory pour Google Charts
        $billetsByCategory = array();
        // $categoriesWithBillets pour charger le tableau dans la homepage des billets par catégorie
        $categoriesWithBillets = array();
        foreach($categories as $category) {

            $billetsCount = count(Billet::where('id_categorie', '=', $category['id'])->get());
            $billetsByCategory[] = array($category['label'], $billetsCount);

            $categoriesWithBillets[$i]['id'] 			= $category['id'];
            $categoriesWithBillets[$i]['label'] 		= $category['label'];
            $categoriesWithBillets[$i]['billets_count'] = $billetsCount;


            $i++;
        }

        AnonymousController::header();
        Controller::$app->render('front/homepage.php', array('billets' => $billets, 'categoriesWithBillets' => $categoriesWithBillets));
        AnonymousController::modals();
        AnonymousController::footer();

    }

    public function getProfile() {

        // On charge les données de l'utilisateur courant
        $user = Utilisateur::wherePseudo($_SESSION["userPseudo"])->get()->toArray();

        AnonymousController::header();
        Controller::$app->render('utilisateur/profil.php', array('user' => $user[0]));
        AnonymousController::modals();
        AnonymousController::footer();
    }

    public function editProfile() {

        // On charge les données de l'utilisateur courant en mode édition
        $user = Utilisateur::wherePseudo($_SESSION["userPseudo"])->get()->toArray();

        AnonymousController::header();
        Controller::$app->render('utilisateur/edit-profile.php', array('user' => $user[0]));
        AnonymousController::modals();
        AnonymousController::footer();

    }

    public function saveProfile() {

        $app = new \Slim\Slim();
        // On charge les données de l'utilisateur courant
        $user = Utilisateur::wherePseudo($_SESSION['userPseudo'])->first();

        // On appelle la fonction editProfile du model Utilisateur pour modifier les données de cet utilisateur, cette fonction
        // retourne un message de confirmation ou d'erreur
        $message = $user->editProfile($app->request->params());

        AnonymousController::header();
        Controller::$app->render('utilisateur/profil.php', array('user' => $user, 'message' => $message));
        AnonymousController::modals();
        AnonymousController::footer();
    }

    public function getUsers() {

        // Charge la liste de tous les utilisateurs qui ont le statut membre
        $users = Utilisateur::whereProfil("membre")->get();

        AnonymousController::header();
        Controller::$app->render('utilisateur/users.php', array('users' => $users));
        AnonymousController::modals();
        AnonymousController::footer();

    }

    public function editUsers() {

        $app = new \Slim\Slim();

        // Charge la liste de tous les utilisateurs qui ont le statut membre
        $users = Utilisateur::whereProfil("membre")->get();

        foreach($users as $user) {
            $postValue      = $app->request->post('user-premium-' . $user['id']);
            $user->premium    = $postValue;
            $user->save();
        }

        AnonymousController::header();
        Controller::$app->render('utilisateur/users.php', array('users' => $users));
        AnonymousController::modals();
        AnonymousController::footer();

    }
}