
<nav class="links">
	<ul>
		<li><a href="connexion.php">
			<?php 
			if (!isset($_SESSION['account'])) {
				echo "Connexion";
			} 
			?>
		</a></li>
		<li><a href="inscription.php">
			
		<?php 
			if (!isset($_SESSION['account'])) {
				echo "Inscription";
			} 
			?>
		</a></li>
		<li><a href="profil.php">
			<?php 
			if (isset($_SESSION['account'])) {
				echo "Profil";
			} 
			?>
			
		</a></li>

		<li><a href="administration.php">
			<?php 
			if ($_SESSION['account']['admin'] == '1') {
				echo "Administration";
			} 
			?>
			
		</a></li>
		<li><a href="include/session_end.php">
			<?php 
			if (isset($_SESSION['account'])) {
				echo "Deconnexion";
			} 
			?>
		</a></li>
		<li></li>
	</ul>
</nav>