<!DOCTYPE html>
<html lang="fr">
    <head >
		<title>Smart Up</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="scale=1.0" />

		<link rel="stylesheet" href="/smart-up/css/bootstrap/bootstrap.min.css" media="screen" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/smart-up/css/style.css" media="screen" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="/smart-up/css/materialize.css" media="screen" type="text/css" rel="stylesheet"/>

		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="/smart-up/js/materialize.js"></script>
		<script src="/smart-up/js/bootstrap/bootstrap.min.js"></script>
		<script src="/smart-up/js/blogslim.js"></script>
		<script src="/smart-up/js/init.js"></script>
		

	</head>
    <body class="container">
		<div class="header col-xs-12">
			<section>
				<nav class="light-blue lighten-1" role="navigation">
					<div class="nav-wrapper container">
                        <a href="<?php echo $app->urlFor('root');?>"><i class="fa fa-home fa-3x"></i></a>
                        <?php if(!isset($_SESSION["userPseudo"])): ?>
                            <ul class="right hide-on-med-and-down">
                                <li><a class="header-inscription" id="header-inscription"><i class="fa fa-user-plus fa-2x"></i>S'inscrire</a></li>
                                <li><a class="header-connexion" id="header-connexion"><i class="fa fa-user fa-2x"></i>Se connecter</a></li>
                            </ul>
                        <?php else: ?>
                            <?php if(isset($_SESSION["userProfile"]) && $_SESSION["userProfile"] == "admin"): ?>
                                <ul class="right hide-on-med-and-down">
                                    <li><a class="header-categories-manage" href="<?php echo $app->urlFor('categories'); ?>">Gérer les catégories</a></li>
                                    <li><a class="header-users-manage" href="<?php echo $app->urlFor('users'); ?>">Gérer les utilisateurs</a></li>
                                </ul>
                            <?php else: ?>
                                <ul class="right hide-on-med-and-down">
                                    <li><a class="header-get-billets" href="<?php echo $app->urlFor('billets', array('id' => 1)) ?>"><i class="fa fa-power-off fa-2x"></i></a></li>
                                    <li><a class="header-profile-manage" href="<?php echo $app->urlFor('profile') ?>">Gérer mon profil</a></li>
                                </ul>
                            <?php endif ?>
                            <ul class="right hide-on-med-and-down">
                                <li><a class="header-logged-in"><?php echo $_SESSION["userPseudo"]; ?></a></li>
                                <li><a href="<?php echo $app->urlFor('logout');?>" class="header-logout" id="header-logout"><i class="fa fa-power-off fa-2x"></i>Se déconnecter</a></li>
                            </ul>
                        <?php endif ?>
					</div>
				</nav>
			</section>
		</div>
		<script type="text/javascript">

			var liste = [
				"Draggable",
				"Droppable",
				"Resizable",
				"Selectable",
				"Sortable"
			];

			$("#autocomplete").autocomplete({
				source: liste,
				minLength: 2,
				select: function(event, ui) {
					window.location = (ui.value);
					$('#autocomplete > ul > li').val(ui.label);
					return false;
				}
			});


		</script>

