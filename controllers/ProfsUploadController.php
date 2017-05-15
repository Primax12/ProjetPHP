
<?php
class ProfsUploadController{
	public function __construct(){
	
	}
	
	public function run(){
		if($_SESSION['rights']!='admin'){
			header('Location: index.php');
			die();
		}
		
		$target_dir = "uploads/";
		$target_file = "uploads/profs.csv";
		$uploadOk = 1;
		
		// Check file size
		if ($_FILES["profs"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		if(pathinfo($_FILES["profs"]["name"])["extension"]!="csv"){
			echo "Wrong ext.";
			$uploadOk=0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES['profs']['tmp_name'], $target_file)) {
				#echo "The file ". basename( $_FILES["agenda"]["name"]). " has been uploaded.";
				Db::getInstance()->deleteProfs();
				$handle = fopen($target_file, "r");
				$row=fgetcsv($handle,0,';');
				$i=0;
				while($row!=false){
					error_log($i);
					if($i==0){
						$row=fgetcsv($handle,0,';');
						$i++;
						continue;
					}
					$i++;
					$adr_mail=$row[0];
					$name=$row[1].' '.$row[2];
					switch($row[3]){
						case 'true':
							$rights='admin';
							break;
						case 'blocs':
							$rights='blocs';
							break;
						case 'bloc1':
							$rights='1';
							break;
						case 'bloc2':
							$rights='2';
							break;
						case 'bloc3':
							$rights='3';
							break;
						default:
							$rights='0';
							break;
					}
					Db::getInstance()->insertProf($adr_mail,$name,$rights);
					$row=fgetcsv($handle,0,';');
				}
				fclose($handle);
			}
		}
		require_once(CHEMIN_VUES.'admin.php');
	}
}
?>

