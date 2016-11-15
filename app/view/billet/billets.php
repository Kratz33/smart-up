<div class="col-xs-6 col-xs-offset-3 mt40 t-center">
    <h3> Liste des billets</h3>
    <table class="categories-table col-xs-12">
        <tr>
            <th>
                Titre
            </th>
            <th>
                Date
            </th>
            <th>
                Catégorie
            </th>
            <th>
                Début du message
            </th>
            <th>
                Action
            </th>
        </tr>
        <?php foreach ($billets as $billet): ?>
            <tr>
                <td>
                    <?php echo $billet['titre'] ?>
                </td>
                <td>
                    <?php echo $billet['date'] ?>
                </td>
                <td>
                    <?php echo $billet['category_label'] ?>
                </td>
                <td>
                    <?php // Prendre les 30 premiers caractères ?>
                    <?php echo substr($billet['message'], 0, 29) ?>
                </td>
                <td>
                    <a href="<?php echo $app->urlFor('billet', array('id' => $billet['id'])) ?>">
                        Voir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<div class="pager col-xs-12">
    Page : 
    <?php for($i=1; $i <= $nbPages; $i++): ?>
        <a href="<?php echo $app->urlFor('billets', array('page' => $i)); ?>" class=""> <?php echo $i ?> </a>
    <?php endfor; ?>
</div>
<div class="col-xs-12">
    <button id="add-billet" class="add-billet"> Ajouter un billet</button>
</div>
