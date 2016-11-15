<?php


namespace app\models;


class Categorie extends \Illuminate\Database\Eloquent\Model{

    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function addCategory($labelCategory) {
        try {
            $this->label = $labelCategory;
            $this->save();
        }
        catch (\Exception $e) {
            var_dump($e);
        }
    }

    public function deleteCategory($id) {
        try {
            $category = Categorie::where('id', '=', $id);
            $category->delete();
        }
        catch (\Exception $e) {
            var_dump($e);
        }
    }

    public function editCategory($id, $newLabel) {
        try {
            $category = Categorie::where('id', '=', $id);
            $category->label = $newLabel;
            $category->save();
        }
        catch(\Exception $e) {
            echo $e;
        }
    }

}
?>