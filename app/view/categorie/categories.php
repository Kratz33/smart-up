<?php foreach ($categoriesWithBillets as $category): ?>
    <div class="row">
        <div class="col s6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title"><?php echo $category['label']; ?></span>
              <p><?php echo $category['billets_count'] ?> billets</p>
            </div>
            <div class="card-action">
              <a href="<?php echo $app->urlFor('billets_by_category', array('id' => $category['id'], 'page' => 1)) ?>">Voir</a>
            </div>
          </div>
        </div>
    </div>
<?php endforeach; ?>
