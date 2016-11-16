<div class="col-xs-6 col-xs-offset-3 mt40">
    <div class="col-xs-12 message t-center">
        <?php if(isset($message)): ?>
            <?php echo $message ?>
        <?php endif; ?>
    </div>
    <table class="categories-table col-xs-12 mt40">
        <tr>
            <th>
                Label des catégories
            </th>
            <th>
                Modifier/Supprimer
            </th>
        </tr>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td>
                    <?php echo $category['label']; ?>
                </td>
                <td>
                    <a class="edit-category-<?php echo $category['id'] ?>"
                       onclick="$('#modal-edit-category-<?php echo $category['id'] ?>').modal()"> Modifier </a>
                    /
                    <a class="delete-category-<?php echo $category['id'] ?>"
                       onclick="$('#modal-delete-category-<?php echo $category['id'] ?>').modal()"> Supprimer </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<div class="col-xs-12">
    <button id="add-category" class="add-category"> Ajouter une catégorie </button>
</div>
