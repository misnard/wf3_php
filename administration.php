<?php 

session_start();

include('include/display_art_min.php');

include ('include/try_catch.php');

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (isset($_GET['id']) && !empty($_GET['id'])) 
{
	if (filter_var($_GET['id'],FILTER_VALIDATE_INT)) {	
		$supprimer = $bdd->prepare("DELETE FROM articles WHERE id=?");
		$supprimer->execute(array(
			filter_var($_GET['id'],FILTER_VALIDATE_INT )));
		$supprimer->closeCursor(); 
		$alertDanger ='<div class="alert alert-success"><strong>L\'article a bien été supprimé</strong></div>';
		header('administration.php');
	}
}


$response = $bdd->query('SELECT * FROM articles ORDER BY id');

$articles = $response->fetchAll(PDO::FETCH_ASSOC);

//AJOUT d'ARTICLES

include('include/upload_file.php');

if(!empty($_POST)) // Si les données du formulaire ne sont pas vides
{
	if(isset($_POST['title']) AND !empty($_POST['title'])){
        // Vérification que le champ TITRE soit conforme à la regex
		if(!preg_match('#^[a-z \'\-áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ0-9]{5,30}$#i', $_POST['title'])){
            // Si le champ n'est pas conforme, on créer une erreur dans l'array $errors
			$errors[] = '<div class="alert alert-danger"><strong>Titre de l\'artice non valide</strong></div>';
		}
	} else {
        // Si le champ n'existe pas ou est vide, on créer une erreur dans l'array $errors
		$errors[] = '<div class="alert alert-warning"><strong>Veuillez renseigner le titre de l\'article</strong></div>';
	}

	if(isset($_POST['content']) AND !empty($_POST['content'])){
        // Vérification que le champ TITRE soit conforme à la regex
		if(!preg_match('#^[\sa-zA-Z0-9ÀÂÇÈÉÊËÎÔÙÛàâçèéêëîôöùû\.\(\)\[\]\"\'\-,;:\/!\?]{5,30}$#i', $_POST['content'])){
            // Si le champ n'est pas conforme, on créer une erreur dans l'array $errors
			$errors[] = '<div class="alert alert-danger"><strong>Contenu non valide</strong></div>';
		}
	} else {
        // Si le champ n'existe pas ou est vide, on créer une erreur dans l'array $errors
		$errors[] = '<div class="alert alert-warning"><strong>Veuillez renseigner le contenu de l\'article</strong></div>';
	}

	if(isset($_POST['author']) AND !empty($_POST['author'])){
        // Vérification que le champ TITRE soit conforme à la regex
		if(!preg_match('#^[a-z \'\-áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ0-9]{3,30}$#i', $_POST['author'])){
            // Si le champ n'est pas conforme, on créer une erreur dans l'array $errors
			$errors[] = '<div class="alert alert-danger"><strong>Nom d\'autheur non valide </strong></div>';
		}
	} else {
        // Si le champ n'existe pas ou est vide, on créer une erreur dans l'array $errors
		$errors[] = '<div class="alert alert-warning"><strong>Veuillez renseigner le nom de l\'autheur</strong></div>';
	}





	if((isset($_POST['title']) && !empty($_POST['title'])) && ($_POST['content'] && !empty($_POST['content'])) && ($_POST['author'] && !empty($_POST['author'])) && (isset($_POST['monFichier']) && !empty($_POST['monFichier'])))
	{

        if(!isset($errors)) // Connexion à la base de donnée avec un prepare et sécurisation des données contre les failles XSS
        {


        	include ('include/try_catch.php');

        	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	$response = $bdd->prepare("INSERT INTO articles(title, content, posted, author, picture) VALUES(?,?,?,?,?)");
        	$response->execute(array(
        		$_POST['title'],
        		$_POST['content'],
				date("d-m-Y"),
        		$_POST['author'],
        		$_POST['monFichier'],

        		));

        	$success[] = 'Votre article a bien été ajouté.';
        }
        else
        {
        	$errors[] = 'Il y a eu un problème durant l\'envoi de l\'article.';
        }
        
    }
    else
    {
    	$errors[] = "Merci de remplir tous les champs.";
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
					<li><a href="#" class="button big fit">Se connecter</a></li>
				</ul>
			</section>

		</section>

		<!-- Main -->
		<section>

			<?php 
			if (isset($alertSuccess)) {
				echo $alertSuccess;
			}


			?>

			<h2>Liste des articles</h2>
			<table class="table">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Contenu</th>
						<th>Date de création</th>
						<th>Image à la une</th>
						<th>Autheur</th>
					</tr>
				</thead>

				<?php 

				foreach( $articles as $data )
				{
					?>
					<tbody>
						<tr>
							<th><?php echo htmlspecialchars($data['title']);?></th>
							<th><?php echo htmlspecialchars($data['content']);?></th>
							<th><?php echo htmlspecialchars($data['posted']);?></th>
							<th><?php echo htmlspecialchars($data['picture']);?></th>
							<th><?php echo htmlspecialchars($data['author']);?></th>
							<th><a href="administration.php?id=<?php echo htmlspecialchars($data['id']);?>" onclick="return" class="btn btn-danger">SUPPRIMER</a></th>
						</tr>

						<?php 
					}
					$response->closeCursor();
					?>
				</tbody>
			</table>

			<h2>Ajout d'un article</h2>

			<?php 
			if (isset($success)) {
				foreach ($success as $success) {
					echo $success;
				}
			}

			if (isset($errors)) {
				foreach ($errors as $errors) {
					echo $errors;
				}
			}

			?>
			<form method="post" action="administration.php">
				<div class="row uniform">
					<div class="6u">
						<input type="text" name="title" placeholder="Titre" />
					</div>
					<div class="6u">
						<input type="text" name="content" placeholder="Contenu" />

					</div>

					<div class="6u">
						<input type="text" name="author" placeholder="Autheur" />
					</div>    
					<!-- File Button --> 
					<div class="form-group">
						<label class="col-md-4 control-label" for="filebutton" ></label>
						<div class="col-md-4">
							<input id="filebutton" name="monFichier" class="input-file" type="file">
						</div>
					</div>
					

					<ul class="actions">
						<li><input type="submit" value="Envoyer" /></li>
						<li><input type="reset" value="Reset" /></li>
					</ul>
				</div>
			</form>
		</section>

		


		<!-- Footer -->


	</div>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
	<script src="assets/js/main.js"></script>

</body>
</html>