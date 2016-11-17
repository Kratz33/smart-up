<?php


namespace app\models;


class Utilisateur extends \Illuminate\Database\Eloquent\Model{

    protected $table = 'utilisateurs';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function addUser($valueArray) {
        try {
            $this->pseudo   = $valueArray['pseudo'];
            $this->nom      = $valueArray['lastname'];
            $this->prenom   = $valueArray['firstname'];
            $this->mail     = $valueArray['email'];
            $this->mdp      = $valueArray['password'];
			$this->premium  = $valueArray['premium'];
            $this->type_id  = $valueArray['type_id'];
			//$this->label      = $valueArray['type'];
            //$this->profil = $valueArray['profile'];
            $this->save();
        }
        catch (\Exception $e) {
            var_dump($e);
        }
    }

    public function editProfile($params) {
        try {
            $this->nom          = $params['edit-profile-lastname'];
            $this->prenom       = $params['edit-profile-firstname'];
            $this->mail         = $params['edit-profile-mail'];
            $this->mdp          = $params['edit-profile-password'];
            $this->description  = $params['edit-profile-description'];
            $this->save();
            return "Modification bien effectuée !";
        }
        catch(\Exception $e) {
            var_dump($e);
            return "Modification échouée, veuillez recommencer ou contacter le webmaster !";
        }
    }
}
?>