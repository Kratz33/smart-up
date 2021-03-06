<div class="col-xs-10 col-xs-offset-1 mt40 container-interne add-billet">
    <div class="col-xs-10 col-xs-offset-1">
        <h3>Poser votre question</h3>
    </div>

    <div class="col-xs-10 col-xs-offset-1">
        <form class="form-horizontal" method="post" action="<?php echo $app->urlFor('add_billet_get');?>">
            <div class="form-group">
                <label for="category" class="col-sm-1 control-label">Catégorie</label>
                <div class="input-field col-sm-8">
                    <select name="category" class="form-control" required>
                        <option value="">SELECTIONNER</option>
                        <?php 
                            foreach ($categories as $category){
                                echo "<option value=".$category['id'].">".$category['label']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field col-sm-9">
                  <input name="title" id="title"  type="text" class="validate" required>
                  <label for="title">Titre</label>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field col-sm-9">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="description"  name="description" class="materialize-textarea" required></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="fixed-action-btn">
                <button type="submit" id="submit-edit-profile" class="submit-edit-profile btn-floating btn-large bg-blue">
                    <i class="material-icons">send</i>
                </button>
            </div>
        </form>
    </div>
</div>