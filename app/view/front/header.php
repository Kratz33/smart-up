<!DOCTYPE html>
<html lang="fr">
    <head >
		<title>Smart Up</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="scale=1.0" />

		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="/smart-up/css/bootstrap/bootstrap.min.css" media="screen" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="/smart-up/css/font-awesome.min.css" media="screen" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="/smart-up/css/materialize.css" media="screen" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="/smart-up/css/style.css" media="screen" type="text/css" rel="stylesheet"/>

		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="/smart-up/js/materialize.js"></script>
		<script src="/smart-up/js/bootstrap/bootstrap.min.js"></script>
		<script src="/smart-up/js/blogslim.js"></script>
		<script src="/smart-up/js/init.js"></script>
		

	</head>
    <body class="container">
		<div class="header">
			<section>
				<nav class="light-blue lighten-1" role="navigation">
					<div class="nav-wrapper container">
                        <a href="<?php echo $app->urlFor('root');?>"><i class="fa fa-home fa-3x"></i></a>
                        <span class="title">SMART UP</span>
                        <?php if(!isset($_SESSION["userPseudo"])): ?>
                            <ul class="right hide-on-med-and-down">
                                <li><a class="header-inscription" id="header-inscription"><i class="fa fa-user-plus fa-2x"></i>S'inscrire</a></li>
                                <li><a class="header-connexion" id="header-connexion"><i class="fa fa-user fa-2x"></i>Se connecter</a></li>
                            </ul>
                        <?php else: ?>
                            <ul class="right hide-on-med-and-down">
                                <li class="header-logged-in">Bienvenue <?php echo $_SESSION["userPrenom"]; ?></li>
                                <li><a href="<?php echo $app->urlFor('logout');?>" class="header-logout" id="header-logout"><i class="fa fa-power-off fa-2x"></i></a></li>
                            </ul>
                            <?php if(isset($_SESSION["userProfile"])): ?>
                                <ul class="right hide-on-med-and-down">
                                    <li><a class="header-get-billets" href="<?php echo $app->urlFor('categories') ?>"><i class="fa fa-file-text-o fa-2x"></i></a></li>
                                    <li><a class="header-profile-manage" href="<?php echo $app->urlFor('profile') ?>"><i class="fa fa-user-circle-o fa-2x"></i></a></li>
                                </ul>
                            <?php endif; ?>
                        <?php endif; ?>
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

			if (window.location.pathname == '/smart-up/') {
				$('body').css({
                    'background-image': 'url(/img/bg.jpg) no-repeat',
                    'background-color': 'none'
                });
			} else {
                $('body').css({
                    'background-image': 'none',
                    'background-color': '#eee'
                });
            }


		</script>

