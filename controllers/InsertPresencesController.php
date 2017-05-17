<?php 
class InsertPresencesController{

	public function __construct() {
	
	}
		
	public function run(){	
		# Si un distrait écrit ?action=login en étant déjà authentifié
		if (($_SESSION['rights']!='0')&&
			($_SESSION['rights']!='1')&&
			($_SESSION['rights']!='2')&&
			($_SESSION['rights']!='3')&&
			($_SESSION['rights']!='blocs')&&
			($_SESSION['rights']!='admin')) {
			header("Location: index.php?action=login"); # redirection HTTP vers l'action login
			die(); 
		}	
		$students = $_POST['checkboxArray'];
		foreach ($students as $stud) {
			Db::getInstance()->insertPresence($stud,$_POST['ue'],$_POST['sem'],$_POST['num']);
        	}
		header('Location: index.php');
		//require_once(CHEMIN_VUES . 'prof.php');
	}
	
} 
?>
