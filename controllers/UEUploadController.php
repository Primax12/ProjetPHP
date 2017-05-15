<?php
	class UEUploadController{
		public function __construct(){
		}
		public function run(){
			$block=$_POST['block'];
			$path='cpnf/'.basename($FILES['bloc']['tmp_name']);
			$file=$_FILES['bloc']['tmp_name'];
			move_uploaded_file($file,$path);
			$this->importUE($path,$block);
				
			$result = array();
			if (file_exists ($file)){
				$fcontents = file ($file);
				Db::getInsatnce()->deleteUE();
				foreach ($fcontents as $i => $icontent){
					#skip the fisrt line on the csv
					if ($i != 0){
						preg_match('/(.*);(.*);(.*);(.*);(.*);(.*)/',$icontent,$result);
						$code=$result[2];
						$nom=$result[1];
						$ects=$result[5];
						$abv=$result[6];
						$quadri=$result[3];
						Db::getInstance()->insertUE($code,$nom,$ects,$abv,$quadri);
					}
				}
			}
		}
	}
?>
