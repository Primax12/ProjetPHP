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
			}
		}
		
		if(empty($_POST)){
			
		}elseif($_POST['login']=='admin'){
			$_SESSION['rights']='admin';
			header('Location: index.php');
			die();
		}else{
			$_SESSION['rights']=Db::getInstance()->getRights(htmlspecialchars($_POST['login']));
			switch($_SESSION['rights']){
				case 't':
					$_SESSION['rights']='admin';
					$_SESSION['login']=$_POST['login'];
					header("Location: index.php");
					die();
					break;
				case 's':
					$_SESSION['rights']='student';
					$_SESSION['login']=$_POST['login'];
					header("Location: index.php");
					die();
					break;
				default:
					$_SESSION['rights']='';
					$_SESSION['login']=$_POST['login'];
					break;
			}
		}
		# Un contrôleur se termine en écrivant une vue
		require_once(CHEMIN_VUES . 'login.php');
	}
	
}
?>
