<?php 
//echo "<pre>";
//print_r($_FILES);
//echo "</pre>";



// Vérification type erreur de fichier


if (!empty($_FILES['monFichier']) && isset($_FILES['monFichier'])) {  // vérification si le fichier est bien envoyé
	
	if ($_FILES['monFichier']['error']==1 || $_FILES['monFichier']['error']==2 ) {
		$error[] ='<div class="alert alert-warning"><strong>Fichier trop volumineux</strong></div>';

	}elseif ($_FILES['monFichier']['error']==3) {
		$error[] ='<div class="alert alert-warning"><strong>Erreur lors du téléchargement</strong></div>';

	}elseif ($_FILES['monFichier']['error']==4) {
		$error[] ='<div class="alert alert-warning"><strong>Veillez selectionner un fichier</strong></div>';

	}elseif ($_FILES['monFichier']['error']==6) {
		$error[] ='<div class="alert alert-warning"><strong>Erreur serveur (6)</strong></div>';

	}elseif ($_FILES['monFichier']['error']==7) {
		$error[] ='<div class="alert alert-warning"><strong>Erreur serveur (7)</strong></div>';

	}elseif ($_FILES['monFichier']['error']==8) {
		$error[] ='<div class="alert alert-warning"><strong>Erreur serveur (8)</strong></div>';

	}elseif ($_FILES['monFichier']['error']!=0){
		$error[] ='<div class="alert alert-warning"><strong>Erreur inconnue</strong></div>'; //condition pour les autres erreurs rares non traités dans ces conditions
	}

	if (!isset($error)) {

		$mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE),$_FILES['monFichier']['tmp_name']);
		if ($mime != 'image/png' && $mime != 'image/jpeg' ) {
			$error[] ='<div class="alert alert-warning"><strong>Mauvais type de fichier envoyé</strong></div>';
		}
		if ($_FILES['monFichier']['size']>512000){
			$error[] ='<div class="alert alert-warning"><strong>Fichier trop volumineux</strong></div>';
		}
		if(!isset($error)) {
			
			//récuperation, déplacement et changement de nom du fichier 
			require('file_name_generator.php');
			

			$newFileName = createFileName(10);

			if ($mime == 'image/jpeg') {
				$newFileMime = '.jpg';
			}elseif ($mime == 'image/png') {
				$newFileMime = '.png';
			}
			$finalFileName = $newFileName.$newFileMime;

			while(file_exists('images/'.$finalFileName)){	//vérification qu'il n'y ai pas deux noms commun de fichier
				$newFileName = createFileName(10);
				$finalFileName = $newFileName.$newFileMime;
			}

			move_uploaded_file($_FILES['monFichier']['tmp_name'],'images/'.$finalFileName);

			$success = '<div class="alert alert-success"><strong>Fichier téléchargé avec succès</strong></div>';










		}
	}
}







?>