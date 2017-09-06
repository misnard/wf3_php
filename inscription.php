<?php
if(!empty($_POST))
{
	require('isRecaptchaValid.php');

	if(isset($_POST['content']) AND !empty($_POST['content']))
	{
			//ici code habituel de verif du contenu
	}
	else
	{
		$errors[] = 'Remplissez le champ content';
	}

	if(!isRecaptchaValid($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']))
	{
		$errors[] = 'Captcha Invalide!';
	}

	if(!isset($errors))
	{
		$success = 'ok';
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
        <script src="https://www.google.com/recaptcha/api.js"></script>
	</head>
	<body class="single">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="#">BLOG D'UNE BOBO</a></h1>
						<nav class="links">
							<ul>
								<li><a href="connexion.php">Connexion</a></li>
								<li><a href="inscription.php">Inscription</a></li>
								<li><a href="#">Profil</a></li>
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

                <form method="post" action="#">
                                        <div class="row uniform">
                                            <div class="6u">                                               <input type="email" name="email" placeholder="Email" />
                                            </div>
                                            <div class="6u">
                                               <input type="email" name="confirm-email" placeholder="Confirmation d'email" />
                                            </div>
                                            <div class="6u">
                                               <input type="text" name="pseudo" placeholder="Pseudo" />
                                            </div>                                
                                               <div class="6u">
                                                <input type="password" name="password" placeholder="Mot de passe" />
                                            </div>    
                                            
                                            <!-- Captcha -->
                                            <div class="6u">
                                                <div class="g-recaptcha" data-sitekey="6Lc9SS4UAAAAAFUTghLqVMQluTzujXUlUP821k2g"></div>

                                            </div>
                                
                                                <ul class="actions">
                                                    <li><input type="submit" value="S'inscrire" /></li>
                                                    <li><input type="reset" value="Reset" /></li>
                                                </ul>
                                            </div>
                                    </form>
<?php
if(isset($errors))
{
	foreach($errors as $error)
	{
		echo $error;
	}
}
        
if(isset($success))
{
	echo $success;
}
?>

				<!-- Footer -->
					<section id="footer">
						<ul class="icons">
							<li><a href="#" class="fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="fa-rss"><span class="label">RSS</span></a></li>
							<li><a href="#" class="fa-envelope"><span class="label">Email</span></a></li>
						</ul>
                        <p class="copyright">&copy; Blog d'une bobo <?php echo date('Y'); ?></p>
					</section>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>