<?php


namespace app\models;


class SousCategorie extends \Illuminate\Database\Eloquent\Model{

    protected $table = 'sous_categories';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function addSousCategory($labelSousCategory) {
        try {
            $this->label = $labelSousCategory;
            $this->save();
        }
        catch (\Exception $e) {
            var_dump($e);
        }
    }

    public function deleteSousCategory($id) {
        try {
            $category = SousCategorie::where('id', '=', $id);
            $category->delete();
        }
        catch (\Exception $e) {
            var_dump($e);
        }
    }

    public function editSousCategory($id, $newLabel) {
        try {
            $sousCategory = SousCategorie::where('id', '=', $id);
            $sousCategory->label = $newLabel;
            $sousCategory->save();
        }
        catch(\Exception $e) {
            echo $e;
        }
    }

}
?>