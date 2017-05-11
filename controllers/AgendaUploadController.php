
<?php
class AgendaUploadController{
	public function __construct(){
	
	}
	
	public function run(){
		if($_SESSION['rights']!='admin'){
			header('Location: index.php');
			die();
		}
		
		$target_dir = "uploads/";
		$target_file = "uploads/agenda.csv";
		$uploadOk = 1;
		
		// Check file size
		if ($_FILES["agenda"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		if(pathinfo($_FILES["agenda"]["name"])["extension"]!="properties"){
			echo "Wrong ext.";
			$uploadOk=0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES['agenda']['tmp_name'], $target_file)) {
				#echo "The file ". basename( $_FILES["agenda"]["name"]). " has been uploaded.";
				Db::getInstance()->deleteAgenda();
				$handle = fopen($target_file, "r");
				$i=1;
				while (($line = fgets($handle)) !== false) {
					$date = explode("=", $line)[1];
					$date = str_replace('/', '-', $date);
					$date=date('Y-m-d',strtotime($date));
					Db::getInstance()->insertAgenda($date,$i);
					$i++;
				}
			}
		}
		require_once(CHEMIN_VUES.'admin.php');
	}
}
?>

