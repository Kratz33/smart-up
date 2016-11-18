<?php

use app\models\Billet;
use app\models\Categorie;

class AnonymousController extends Controller {

    public static function header() {
		$app = Controller::$app;
		if(isset($_SESSION['userId'])) {
			$notifs = \app\models\Notification::getNotifs($_SESSION['userId']);
			$_SESSION['notifs'] = $notifs;
		}
		$app->render('front/header.php',compact('app'));
    }

    public static function footer() {
		Controller::$app->render('front/footer.php');
    }

	public static function modals() {
		$categories = \app\models\Categorie::orderBy('label', 'ASC')->get()->toArray();
		Controller::$app->render('front/modals.php', array('categories' => $categories));
	}

    public static function index(){

		$app = new \Slim\Slim();

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
		if(!isset($_SESSION['message'])){
			$_SESSION['message'] = '';
		}
		AnonymousController::header();
		Controller::$app->render('front/homepage.php', array(
			'billets'			  => $billets,
			'billetsByCategory'   => $billetsByCategory,
			'categoriesWithBillets' => $categoriesWithBillets
		));
		AnonymousController::modals();
		AnonymousController::footer();
    }

    public function yopla(){
		$this->header();
		Controller::$app->render('arf.php');
		$this->modals();
		$this->footer();
    }

    public function affiche_item($id){
		$this->header();
		Controller::$app->render('aff_item.php', compact('id'));
		$this->modals();
		$this->footer();
    }

    public function insert_info(){
		$app = Controller::$app;
		$nom = $app->request->post('nom');
		$app->flash('info', "J'ai ajouté le nom « $nom »");
		$app->redirectTo('root');
    }

    public static function leftbarre($categories){
    	Controller::$app->render('front/leftbarre.php', array('categories' => $categories));
    }
}

?>
