<?php include('include/do_connexion.php');




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

    // Vérification que le champ FRUIT existe et n'est pas vide
	if(isset($_POST['email']) AND !empty($_POST['email'])){
        // Vérification que le champ FRUIT soit conforme à la regex
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            // Si le champ n'est pas conforme, on créer une erreur dans l'array $errors
			$errors[] = '<div class="alert alert-danger"><strong>Email non valide</strong></div>';
		}
	} else {
        // Si le champ n'existe pas ou est vide, on créer une erreur dans l'array $errors
		$errors[] = '<div class="alert alert-warning"><strong>Veuillez remplir tous les champs</strong></div>';
	}


    // Vérification que le champ COULEUR existe et n'est pas vide
	if(isset($_POST['password']) AND !empty($_POST['password'])){
        // Vérification que le champ COULEUR soit conforme à la regex
		if(!preg_match('#^[a-z \-áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{3,30}$#i', $_POST['password'])){
            // Si le champ n'est pas conforme, on créer une erreur dans l'array $errors
			$errors[] = '<div class="alert alert-danger"><strong>Mot de passe invalide</strong></div>';
		}
	} else {
        // Si le champ n'existe pas ou est vide, on créer une erreur dans l'array $errors
		$errors[] = '<div class="alert alert-warning"><strong>Veuillez inscrire le mot de passe</strong></div>';
	}




if(!isset($errors)){

	try {
		$bdd= new PDO ('mysql:host=localhost;dbname=tp_php','root','');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
		echo 'Echec lors de la connexion : ' . $e->getMessage();
	}

	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);





		$email= htmlspecialchars($_POST['email']);		//preparation des variables des champs 
		$password= htmlspecialchars($_POST['password']);


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
			$success = '<div class="alert alert-success"><strong>Vous êtes connecté !</strong></div>';

		}else{
			$errors[] = '<div class="alert alert-warning"><strong>Mot de passe invalide</strong></div>';
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
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body class="single">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			<h1><a href="index.php">BLOG D'UNE BOBO</a></h1>
			<nav class="links">
				<ul>
					<li><a href="connexion.php">Connexion</a></li>
					<li><a href="inscription.php">Inscription</a></li>
					<li><a href="profil.php">Profil</a></li>
					<li><a href="#">Administration</a></li>
					<li><a href="#">Déconnexion</a></li>
				</ul>
			</nav>
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
				<ul class="links">
					<li>
						<a href="#">
							<h3>Lorem ipsum</h3>
							<p>Feugiat tempus veroeros dolor</p>
						</a>
					</li>
					<li>
						<a href="#">
							<h3>Dolor sit amet</h3>
							<p>Sed vitae justo condimentum</p>
						</a>
					</li>
					<li>
						<a href="#">
							<h3>Feugiat veroeros</h3>
							<p>Phasellus sed ultricies mi congue</p>
						</a>
					</li>
					<li>
						<a href="#">
							<h3>Etiam sed consequat</h3>
							<p>Porta lectus amet ultricies</p>
						</a>
					</li>
				</ul>
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