<?php 

session_start();

include('include/display_art_min.php');

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
		<div id="main">

			<!-- Information de compte -->
			<article class="post">
				<header>
					<div class="title">
						<h2> <?php echo htmlspecialchars($_SESSION['account']['user']) ?></h2>
						<h1>Votre Profil</h1>
					</div>
				</header>
				
				<p>Information de votre compte</p>
				<ul>
					<li>Pseudo : <?php echo htmlspecialchars($_SESSION['account']['user']) ?></li>
					<li>Email : <?php echo htmlspecialchars($_SESSION['account']['email']) ?></li>
				</ul>

				<?php 
				if ($_SESSION['account']['admin'] == 'oui') {
					echo "Vous êtes administrateur";
				} else {
					echo "Vous n'êtes pas administrateur";
				}
				?>

			</article>

		</div>

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