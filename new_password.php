<?php
session_start();

include('include/display_art_min.php');

if(!empty($_POST)){

    // Vérification que le champ EMAIL existe et n'est pas vide
	if(isset($_POST['email']) AND !empty($_POST['email'])){
        // Vérification que le champ EMAIL soit conforme à la regex
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            // Si le champ n'est pas conforme, on créer une erreur dans l'array $errors
			$errors[] = '<div class="alert alert-danger"><strong>Email non valide</strong></div>';
		}
	} else {
        // Si le champ n'existe pas ou est vide, on créer une erreur dans l'array $errors
		$errors[] = '<div class="alert alert-warning"><strong>Veuillez remplir tous les champs</strong></div>';
	}


    // Vérification que le champ SECRET existe et n'est pas vide
	if(isset($_POST['secret']) AND !empty($_POST['secret']))
    {
        // Vérification que le champ PASSWORD soit conforme à la regex
		if(!preg_match('#^[a-z \-áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{3,30}$#i', $_POST['secret']))
        {
            // Si le champ n'est pas conforme, on créer une erreur dans l'array $errors
			$errors[] = '<div class="alert alert-danger"><strong>Réponse à la question secrète non conforme</strong></div>';
            
		}
	} 
    else 
    {
        // Si le champ n'existe pas ou est vide, on créer une erreur dans l'array $errors
		$errors[] = '<div class="alert alert-warning"><strong>Veuillez inscrire la réponse à la question secrète</strong></div>';
	}




	if(!isset($errors)){

		include ('include/try_catch.php');

		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$email= ($_POST['email']);		//preparation des variables des champs 
		$secret= ($_POST['secret']);

		$response = $bdd->prepare("SELECT * FROM user WHERE email= ?"); // ? = correspond à l'array donc $_POST email
		$response->execute(				//requete préparé qui empeche les injection SQL
			array(
				$email
				)
			);

		$infos = $response->fetch(PDO::FETCH_ASSOC); //sauvegarde des données récupérées
		$response->closeCursor();

		if ($response->rowCount()==1) {

			if ($secret == $infos['secret']) {   //si le secret rentré correspond a celui de la base de donnée sauvegardé dans l'array grace au fetch
			$success = 'Vous pouvez changer votre mot de passe';
            header('Location: new_password2.php');
            $_SESSION['editPassword'] = "editTrue";
            $_SESSION['editEmail'] = $email;
                

		}else{
			$errors[] = 'Réponse à la question secrète invalide';
		}


	}else{
		$errors[] = 'Ce compte n\'existe pas.';
	}


}
}




?>



<!DOCTYPE HTML>
<!--
	Future Imperfect by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
	<title>Je suis une bobo</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/css/main.css" />
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body class="single">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			<h1><a href="index.php">BLOG D'UNE BOBO</a></h1>
			<?php 

			include ('include/menu.php')

			 ?>
			<nav class="main">
				<ul>
					<li class="search">
						<a class="fa-search" href="#search">Rechercher</a>
						<form id="search" method="get" action="#">
							<input type="text" name="query" placeholder="Rechercher" />
						</form>
					</li>
					<li class="menu">
						<a class="fa-bars" href="#menu">Menu</a>
					</li>
				</ul>
			</nav>
		</header>

		<!-- Menu -->
		<section id="menu">

			<!-- Search -->
			<section>
				<form class="search" method="get" action="#">
					<input type="text" name="query" placeholder="Search" />
				</form>
			</section>

			<!-- Links -->
			<section>
				<?php display_articles_min(); ?>
			</section>

			<!-- Actions -->
			<section>
				<ul class="actions vertical">
					<li><a href="connexion.php" class="button big fit">Se connecter</a></li>
				</ul>
			</section>

		</section>

		<!-- Main -->
		<div id="main">

			<form method="POST" action="">
				<h1>Changer le mot de passe</h1>
				<div class="row uniform">

					<div class="6u 12u$(xsmall)">
						<input type="text" name="email" placeholder="Email" />
					</div>
					<div class="6u$ 12u$(xsmall)">
						<input type="text" name="secret" placeholder="Réponse à la question secrète" />
					</div>



					<div class="12u$">
						<ul class="actions">
							<li><input type="submit" value="Réinitialiser" /></li><br>

						</ul>
					</div>
				</div>
			</form>

			<?php

    // Si l'array $errors existe, on extrait toutes les erreurs qu'il contien avec un foreach et on les affiches
			if(isset($errors)){
				foreach($errors as $error){
					echo $error;
				}
			}
    // Si $success existe, on l'affiche
			if(isset($success)){
				echo $success;
			}
			?>

		</div>



	</div>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
	<script src="assets/js/main.js"></script>

</body>
</html>