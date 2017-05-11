<?php
	# Activer le mécanisme des sessions
	session_start();
	
	# Prise du temps actuel au début du script
	$time_start = microtime(true);


	# Variables globales du site
	define('CHEMIN_VUES','views/');
	if(!isset($_SESSION['rights'])){
		$_SESSION['rights']=NULL;
	}
	#define('EMAIL','jeanluc.collinet@ipl.be');
	#if (empty($_SESSION['authentifie'])){
	#	$actionloginadmin='login';
	#	$libelleloginadmin='Login';
	#} else {
	#	$actionloginadmin='admin';
	#	$libelleloginadmin='Zone Admin';
	#}
	
	# Require des classes automatisé
	function chargerClasse($classe) {
		require 'models/' . $classe . '.class.php';
	}
	spl_autoload_register('chargerClasse'); 

	# Ecrire ici le header de toutes pages HTML
	require_once(CHEMIN_VUES . 'header.php');
	require_once(CHEMIN_VUES . 'sidemenu.php');

	# Tester si une variable GET 'action' est précisée dans l'URL index.php?action=...
	$action = (isset($_GET['action'])) ? htmlentities($_GET['action']) : 'default';
	
	switch($action) {
		case 'admin':
			require_once('controllers/AdminController.php');	
			$controller = new AdminController();
			break;
		case 'logout':
			require_once('controllers/LogoutController.php');
			$controller = new LogoutController();
			break;
		case 'agenda':
			require_once('controllers/AgendaUploadController.php');
			$controller = new AgendaUploadController();
			break;
		case 'student':
			require_once('controllers/StudentController.php');
			$controller = new StudentController();
			break;
		default: # Par défaut, le contrôleur de l'accueil est sélectionné
			require_once('controllers/LoginController.php');	
			$controller = new LoginController();
			break;
	}
	$controller->run();
	require_once(CHEMIN_VUES . 'footer.php');
?>
