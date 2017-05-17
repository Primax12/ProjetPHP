<?php 
class ProfController{

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
		if(isset($_POST['setPresences'])){
			$serie=$_POST['serie'][-1];
			$bloc=$_POST['serie'][0];
			$students=Db::getInstance()->getStudentFromSerie($bloc, $serie);
		}
		if(isset($_POST['getPresences'])){
			$serie=$_POST['serie'][-1];
			$ue=$_POST['ue'];
			$sem=$_POST['sem'];
			$num=$_POST['num'];
			$students=Db::getInstance()->getPresences($ue, $sem, $num, $serie);
			var_dump($students);
		}
		# Ecrire ici la vue
		$ues=Db::getInstance()->getUEs();
		$sems=Db::getInstance()->getSems();
		$series=Db::getInstance()->getSeries();
		require_once(CHEMIN_VUES . 'prof.php');
	}
	
} 
?>
