<?php 
session_start();
include('include/display_art.php');
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
<body>

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header">
			<h1><a href="index.php">BLOG D'UN BOBO</a></h1>

			<?php 

			include ('include/menu.php')

			?>
			
			<nav class="main">
				<ul>
					<li class="search">
						<a class="fa-search" href="#search">Search</a>
						<form id="search" method="get" action="#">
							<input type="text" name="query" placeholder="Search" />
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
					<li><a href="connexion.php" class="button big fit">Log In</a></li>
				</ul>
			</section>

		</section>

		<!-- Main -->
		<div id="main">
			<?php
				if(isset($_GET['p']) && !empty($_GET['p'])) {
					$p_max = display_articles($_GET['p']);
				} 
				else {
					$p_max = display_articles("1");
				}
			?>

			<!-- Pagination -->
			<ul class="actions pagination">
			
				<?php 
					if(isset($_GET['p']) && !empty($_GET['p'])) {
						$p_max = display_pagination($p_max, $_GET['p']);
					} 
					else {
						$p_max = display_pagination($p_max, "1");
					} 
				?>
			</ul>

		</div>

		<!-- Sidebar -->
		<section id="sidebar">

			<!-- Intro -->
			<section id="intro">
				<a href="#" class="logo"><img src="images/logo.jpg" alt="" /></a>
				<header>
					<h2>Les bobos de Paris</h2>
					<p>Le blog des bobos de Paris intra-muros</a></p>
				</header>
			</section>

			

			

			<!-- About -->
			<section class="blurb">
				<h2>A prpopos</h2>
				<p>Voila ma vie, mon oeuvre, et bla bla bla bla !!</p>
				
			</section>

			<!-- Footer -->

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