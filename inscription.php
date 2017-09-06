<?php
if(!empty($_POST)) // Si les données du formulaire ne sont pas vides
{
	require('isRecaptchaValid.php');

	if( // Si les champs ont été envoyés par le client et qu'ils ne sont pas vide
    isset($_POST['email']) && !empty($_POST['email']) 
    && $_POST['uname'] && !empty($_POST['uname']) 
    && $_POST['password'] && !empty($_POST['password'])
    && $_POST['password-confirm'] && !empty($_POST['password-confirm']))
	{
        // Si le captcha est invalide afficher un message d'erreur en dessous du formulaire
        if(!isRecaptchaValid($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']))
        {
            $errors[] = 'Captcha Invalide!';
        }
        
        if($_POST['password'] != $_POST['password-confirm'])
        {
            $errors[] = 'Les mot de passe ne correspondent pas.';
        }
        if(!isset($errors)) // Connexion à la base de donnée avec un prepare et sécurisation des données contre les failles XSS
        {
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=tp_php;charset=utf8','root','');
            } 
            catch(Exception $e)
            {
                die('Erreur: ' . $e->getMessage());
            }
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $response = $bdd->prepare("INSERT INTO user(uname, email, password, admin) VALUES(?,?,?,?)");
                $response->execute(array(
                    $_POST['uname'],
                    $_POST['email'],
                    password_hash($_POST['password'], PASSWORD_BCRYPT),
                    $admin = 0
                ));
            
            $success[] = 'Merci de vous êtes inscrit.';
        }
        else
        {
	       $errors[] = 'Il y a eu un problème durant l\'envoi du formulaire.';
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
        <script src="https://www.google.com/recaptcha/api.js"></script>
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

								

								<li><a href="administration.php">Administration</a></li>
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
                                               <input type="text" name="uname" placeholder="Pseudo" />

                                            </div>
                                            <div class="6u">
                                                <input type="password" name="password" placeholder="Mot de passe" />
                                            </div>                                
                                               <div class="6u">
                                                <input type="password" name="password-confirm" placeholder="Confirmation du mot de passe" />
                                            </div>    
                                            
                                            <!-- Captcha -->
                                            <div class="6u">
                                               <label for "g-recaptcha">Merci de remplir le captcha</label>
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
		echo '<p style=color:red;>'.$error.'</p><br>';
	}
}
        
if(isset($success))
{
    foreach($success as $ok)
	echo '<p style=color:green;>'.$ok.'</p><br>';
}
?>

				

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>