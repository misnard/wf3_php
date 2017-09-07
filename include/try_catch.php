<?php  

try {
	$bdd= new PDO ('mysql:host=localhost;dbname=tp_php','root','');

}
catch (PDOException $e)
{
	echo 'Echec lors de la connexion : ' . $e->getMessage();
}



?>