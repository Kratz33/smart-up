<!DOCTYPE html>
<html lang="fr">
    <head >
		<title>Smart Up</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="scale=1.0" />

		<link rel="stylesheet" href="/smart-up/css/bootstrap/bootstrap.min.css" media="screen" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/smart-up/css/style.css" media="screen" type="text/css" rel="stylesheet"/>

		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="/smart-up/js/bootstrap/bootstrap.min.js"></script>
		<script src="/smart-up/js/blogslim.js"></script>

	</head>
    <body class="container">
		<div class="header col-xs-12">
			<section>
				<div class="col-xs-2">
					<a href="<?php echo $app->urlFor('root');?>"><i class="fa fa-home fa-3x"></i></a>
				</div>
				<div class="ui-widget col-xs-4">
					<div id="div-autocomplete">
						<label for="autocomplete">Rechercher :</label>
						<input id="autocomplete">
						<ul></ul>
					</div>
				</div>
				<?php if(!isset($_SESSION["userPseudo"])): ?>
					<div class="col-xs-4">
						<div class="col-xs-6">
							<a class="header-inscription" id="header-inscription">
								<div class="t-center header-inscription">
									<i class="fa fa-user-plus fa-2x"></i>
								</div>
								<div class="t-center header-inscription">
									S'inscrire
								</div>
							</a>
						</div>
						<div class="col-xs-6">
							<a class="header-connexion">
								<div class="t-center">
									<i class="fa fa-user fa-2x"></i>
								</div>
								<div class="t-center">
									Se connecter
								</div>
							</a>
						</div>
					</div>
				<?php else: ?>
					<div class="col-xs-6">
                        <?php if(isset($_SESSION["userProfile"]) && $_SESSION["userProfile"] == "admin"): ?>
                            <?php $classBootStrap = "col-xs-3"; ?>
                            <div class="<?php echo $classBootStrap ?>">
                                <a class="header-categories-manage" href="<?php echo $app->urlFor('categories'); ?>">
                                    <div class="t-center">
                                        Gérer les catégories
                                    </div>
                                </a>
                            </div>
							<div class="<?php echo $classBootStrap ?>">
								<a class="header-users-manage" href="<?php echo $app->urlFor('users'); ?>">
									<div class="t-center">
										Gérer les utilisateurs
									</div>
								</a>
							</div>
                        <?php else: ?>
                            <?php $classBootStrap = "col-xs-3"; ?>
							<div class="<?php echo $classBootStrap ?>">
								<a class="header-get-billets" href="<?php echo $app->urlFor('billets', array('id' => 1)) ?>">
									<div class="t-center">
										Voir les billets
									</div>
								</a>
							</div>
							<div class="<?php echo $classBootStrap ?>">
								<a class="header-profile-manage" href="<?php echo $app->urlFor('profile') ?>">
									<div class="t-center">
										Gérer mon profil
									</div>
								</a>
							</div>
                        <?php endif ?>
						<div class="<?php echo $classBootStrap ?>">
							<a class="header-logged-in">
								<div class="t-center">
									Vous êtes connecté(e) sous <?php echo $_SESSION["userPseudo"]; ?>
								</div>
							</a>
						</div>
						<div class="<?php echo $classBootStrap ?>">
							<a href="<?php echo $app->urlFor('logout');?>" class="header-logout" id="header-logout">
								<div class="t-center header-inscription">
									<i class="fa fa-power-off fa-2x"></i>
								</div>
								<div class="t-center header-inscription">
									Se déconnecter
								</div>
							</a>
						</div>
					</div>
				<?php endif ?>
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

