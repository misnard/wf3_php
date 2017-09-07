<?php 

session_start();

include('include/display_art_min.php');




// if (empty($e)) {
// 	$dbh=$db=prepare("SELECT * FROM users WHERE email=:email");
// 	$dbh->bindParam(":email", $_POST['email']);
// 	$dbh->execute();
// 	if ($data=$dbh->fetch()) {
// 		if ($data==) {
// 			# code...
// 		}
// 	}

// }


if(isset($_POST['singlebutton'])){

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


    // Vérification que le champ PASSWORD existe et n'est pas vide
	if(isset($_POST['password']) AND !empty($_POST['password'])){
        // Vérification que le champ PASSWORD soit conforme à la regex
		if(!preg_match('#^[a-z \-áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{3,30}$#i', $_POST['password'])){
            // Si le champ n'est pas conforme, on créer une erreur dans l'array $errors
			$errors[] = '<div class="alert alert-danger"><strong>Mote de passe invalide</strong></div>';
			
		}
	} else {
        // Si le champ n'existe pas ou est vide, on créer une erreur dans l'array $errors
		$errors[] = '<div class="alert alert-warning"><strong>Veuillez inscrire le mot de passe</strong></div>';
	}




	if(!isset($errors)){

		include ('include/try_catch.php');

		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);





		$email= ($_POST['email']);		//preparation des variables des champs 
		$password= ($_POST['password']);


		$response = $bdd->prepare("SELECT * FROM user WHERE email= ?"); // ? = correspond à l'array donc $_POST email
		$response->execute(				//requete préparé qui empeche les injection SQL
			array(
				$email
				)
			);

		$infos = $response->fetch(PDO::FETCH_ASSOC); //sauvegarde des données récupérées
		$response->closeCursor();

		if ($response->rowCount()==1) {

			if (password_verify($password, $infos['password'] )) {   //si le password rentré correspond a celui de la base sauvegardé dans l'array grace au fetch
			$success = '<div class="alert alert-success"><strong>Vous êtes connecté ! <br><br> <a href="index.php">Retour à la page d\'accueil</a></strong></div>';
			//Création de la session
			$_SESSION['account'] = array(
				'user' => $infos['uname'],
				
				'email' => $infos['email'],
				'admin' => $infos['admin']
				);

			




		}else{
			$errors[] = '<div class="alert alert-warning"><strong>Mot de passe invalide</strong></div><br>Vous pouvez réinitialiser votre mot de passe en <a href="new_password.php">cliquant ici</a>';
		}


	}else{
		$errors[] = '<div class="alert alert-warning"><strong>Ce compte n\'existe pas</strong></div>';
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
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
					
					<li class="menu">
						<a class="fa-bars" href="#menu">Menu</a>
					</li>
				</ul>
			</nav>
		</header>

		<!-- Menu -->
		<section id="menu">

			

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

			<form method="post" action="connexion.php">
				<h1>Connexion</h1>
				<div class="row uniform">

					<div class="6u 12u$(xsmall)">
						<input type="text" name="email" id="inputEmail" value="" placeholder="Email" />
					</div>
					<div class="6u$ 12u$(xsmall)">
						<input type="password" name="password" id="inputPassword" value="" placeholder="Mot de passe" />
					</div>



					<div class="12u$">
						<ul class="actions">
							<li><input type="submit" name="singlebutton" id="singlebutton" value="Se connecter" /></li><br>

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
				echo 'Bienvenue '. htmlspecialchars($_SESSION['account']['user']).'!';
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