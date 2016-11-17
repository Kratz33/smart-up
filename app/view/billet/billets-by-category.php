<div class="categories-div col-xs-3">
    <table class="categories-table">
        <tbody>
             <?php foreach ($categories as $categNav): ?>
                <tr>
                    <td>
                        <a href="<?php echo $app->urlFor('billets_by_category', array('id' => $categNav['id'], 'page' => 1)) ?>"><?php echo $categNav['label']; ?> (<?php echo $categNav['billets_count']; ?>)</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-xs-9 mt40 t-center">
    <div>
        <h3><?php echo $category['label'] ?></h3>
        <a href="/smart-up/billet/add" class="waves-effect waves-light btn-large"><i class="material-icons right">add</i>Ajouter un billet</a>
    </div>
    <div class="entete">
        <p class="billet-votes-count">
            Nombre Votes
        </p>
        <p class="billet-commentaires-count">
            Nombre Commentaires
        </p>
    </div>
    <?php foreach ($billets as $billet): ?>
        <ul class="billets-ul">
            <a href="<?php echo $app->urlFor('billet', array('id' => $billet['id'])) ?>">
                <li class="utilisateur-photo">
                    <i class="medium material-icons">perm_identity</i>
                </li>
                <li class="billet-titre">
                    <?php echo $billet['titre'] ?>
                </li>
                <li class="billet-votes-count">
                    <?php echo $billet['votes_count'] ?>
                </li>
                <li class="billet-commentaires-count">
                    <?php echo $billet['commentaires_count'] ?>
                </li>
            </a>
        </ul>
    <?php endforeach; ?>
</div>
<div class="pager col-xs-9">
    Page :
    <?php for($i=1; $i <= $nbPages; $i++): ?>
        <a href="<?php echo $app->urlFor('billets_by_category', array('id' => $category['id'], 'page' => $i)); ?>" class=""> <?php echo $i ?> </a>
    <?php endfor; ?>
</div>
