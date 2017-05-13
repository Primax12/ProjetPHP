<?php 
class BlocsController{

	public function __construct() {
	
	}
		
	public function run(){	
		# Si un distrait écrit ?action=login en étant déjà authentifié
		if ($_SESSION['rights']!='blocs') {
			header("Location: index.php?action=login"); # redirection HTTP vers l'action login
			die(); 
		}	
		require_once(CHEMIN_VUES . 'blocs.php');
	}
	
} 
?>
