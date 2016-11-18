<div class="col-xs-12 t-center">

    <div class="homepage">
        <div class="text">
            Ayez les bons réflexes pour bien démarrer votre entreprise.
        </div>
    </div>
    
</div>
<?php echo "HELLO"; echo $_SESSION['message']; if($_SESSION['message'] == 'Pseudo et/ou Mot de passe incorrect'): ?>
    <script type="text/javascript">
        Materialize.toast('Pseudo et/ou Mot de passe incorrect', 4000);
    </script>
<?php else: ?>
    <?php  if($_SESSION['message'] == 'Inscription réussi, vous pouvez vous connecter !'): ?>
        <script type="text/javascript">
            Materialize.toast('Inscription réussi, vous pouvez vous connecter !', 4000);
        </script>
    <?php endif; ?>
<?php endif; $_SESSION['message'] = '';?>
