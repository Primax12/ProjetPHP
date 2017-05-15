<?php
class UEUploadController{
	public function __construct(){
	}
	public function run(){
		if(!empty($_FILES['ue'])){
			$origin=$_FILES['ue']['tmp_name'];
			$destination = 'uploads/'.basename($_FILES['ue']['name']);
			move_uploaded_file($origin,$destination);
			$fcontents = file($destination);
		}
		/*
		   $block=$_POST['ddbloc'];
		   $path='cpnf/'.basename($FILES['bloc']['tmp_name']);
		   $file=$_FILES['bloc']['tmp_name'];
		   move_uploaded_file($file,$path);
		//$this->importUE($path,$block);
		 */	
		//$fcontents = file ($file);
		Db::getInstance()->deleteUE();
		foreach ($fcontents as $i => $icontent){
			#skip the fisrt line on the csv
			if ($i != 0){
				preg_match('/(.*);(.*);(.*);(.*);(.*);(.*)/',$icontent,$result);
				var_dump($result);
				$mne=$result[2];
				$nom=$result[1];
				$ects=$result[5];
				$abv=$result[6];
				$quadri=$result[3];
				Db::getInstance()->insertUE($mne,$nom,$ects,$abv,$quadri[-1]);
				header("Location: index.php");
			}
		}
	}
}
?>
