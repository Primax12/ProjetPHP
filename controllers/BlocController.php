<?php 
class BlocController{

	public function __construct() {
	
	}
		
	public function run(){	
		# Si un distrait écrit ?action=login en étant déjà authentifié
		if (($_SESSION['rights']!='3')&&($_SESSION['rights']!='2')&&($_SESSION['rights']!='1')) {
			header("Location: index.php?action=login"); # redirection HTTP vers l'action login
			die(); 
		}	
		require_once(CHEMIN_VUES . 'bloc.php');
	}
	
} 
?>
