<div class="col-xs-12 t-center mt40">
    <h2>Poser votre question</h2>
</div>

<div class="col-xs-12 mt40">
    <form class="form-horizontal" method="post" action="<?php echo $app->urlFor('add_billet_get');?>">
        <div class="form-group">
            <label for="category" class="col-sm-2 control-label">Catégorie</label>
            <div class="col-sm-10">
                <select name="category" class="form-control">
                    <option>SELECTIONNER</option>
                    <?php 
                        foreach ($categories as $category){
                            echo "<option value=".$category['id'].">".$category['label']."</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Titre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="title" id="title" placeholder="Titre">
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" id="description"  name="description" placeholder="Mettez ici votre question"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Enregistrer</button>
            </div>
        </div>
    </form>
</div>