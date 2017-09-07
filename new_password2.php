<?php
session_start();

include('include/display_art_min.php');

if(!empty($_POST))
{ // Vérifie que les champs rentrés sont identiques
    if($_POST['newPassword'] == $_POST['newPasswordConfirm']) 
    {

        if($_SESSION['editPassword'] == "editTrue" && !empty($_SESSION['editEmail']))
        {
            include ('include/try_catch.php');

            $newPassword = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);

            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $dbh=$bdd->prepare('UPDATE user SET password=:password WHERE email=:email');

            $dbh->bindParam(':password', $newPassword, PDO::PARAM_STR);

            $dbh->bindParam(':email', $_SESSION['editEmail']);

            $dbh->execute();
            
            $success = 'Votre mot de passe a été modifié<br><a href="index.php">Cliquez ici pour revenir à l\'accueil</a>';

        }
        else
        {
            header('Location: new_password.php');
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
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
						<input type="text" name="newPassword" placeholder="Nouveau mot de passe" />
					</div>
					<div class="6u$ 12u$(xsmall)">
						<input type="text" name="newPasswordConfirm" placeholder="Confirmer le nouveau mot de passe" />
					</div>



					<div class="12u$">
						<ul class="actions">
							<li><input type="submit" value="Valider le nouveau mot de passe" /></li><br>

						</ul>
					</div>
				</div>
			</form>

			<?php
    // Si $success existe, on l'affiche
			if(isset($success))
            {
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