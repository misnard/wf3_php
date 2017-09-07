<?php 


function createFileName($nameLength){		//$name = variable temporaire ou paramètre
	if (!is_int($nameLength) ) {
		trigger_error('entrez un entier', E_USER_ERROR);
	}else{
		$Caracteres = "abcdefghijklmnopqrstuvwxyz0123456789";
		$nombreCaracteres = 35;

		$Hash=NULL;
		for($x=1;$x<=$nameLength;$x++){ 
			$Position = rand(0,$nombreCaracteres); 
			$Hash .= substr($Caracteres,$Position,1); 
		} 
		return $Hash;
	}
}


?>