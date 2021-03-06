<div class="col-xs-9">
    <div>
        <h3><?php echo $category['label'] ?></h3>
    </div>
    <div class="entete col-xs-12">
        <p class="billet-votes-count">
            Nombre Votes
        </p>
        <p class="billet-commentaires-count">
            Nombre Commentaires
        </p>
    </div>
    <?php foreach ($billets as $billet): ?>
        <ul class="billets-ul col-xs-9">
            <a href="<?php echo $app->urlFor('billet', array('id' => $billet['id'], 'page' => 1)) ?>">
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
<div class="fixed-action-btn">
    <a href="<?php echo $app->urlFor('add_billet_get') ?>" class="btn-floating btn-large bg-blue">
        <i class="material-icons">add</i>
    </a>
</div>
