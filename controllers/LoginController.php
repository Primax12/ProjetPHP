<?php 
class LoginController{
	
	public function __construct() {

	}
			
	public function run(){
		if(!empty($_SESSION['rights'])){
			switch($_SESSION['rights']){
				case 'admin':
					header("Location: index.php?action=admin");
					die();
					break;
				case 'student':
					header("Location: index.php?action=student");
					die();
					break;
				case 'O':
				case '1':
					$_SESSION['bloc']='1';
					header("Location: index.php?action=prof");
					die();
					break;
				case '2':
					$_SESSION['bloc']='2';
					header("Location: index.php?action=prof");
					die();
					break;
				case '3':
					$_SESSION['bloc']='3';
					header("Location: index.php?action=prof");
					die();
					break;
				case 'blocs':
					header("Location: index.php?action=prof");
					die();
					break;
			}
		}
		if(!empty($_POST)){
			$_SESSION['login']=$_POST['login'];
			if($_POST['login']=='admin'){
				$_SESSION['rights']='admin';
				header('Location: index.php');
				die();
			}else{
				$_SESSION['rights']=Db::getInstance()->getRights(htmlspecialchars($_POST['login']));
				header("Location: index.php");
				die();
			}
		}
		# Un contrôleur se termine en écrivant une vue
		require_once(CHEMIN_VUES . 'login.php');
	}
	
}
?>
