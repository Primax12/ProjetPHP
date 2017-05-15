<?php
	class ResponsableBlocController{
		private $_database;

		public function __construct($database){
			$this->_database = $database;
		}
		public function run(){
			if (!empty ($_POST ['blocSubmit'])){
				$block=$_POST['block'];
				$path='cpnf/'.basename($FILES['bloc']['tmp_name']);
				$file=$_FILES['bloc']['tmp_name'];
				move_uploaded_file($file,$path);
				$this->importUE($path,$block);
			}
		}
		
		
		
		
		function importUE($fil,$block){
			$result = array();
			if (file_exists ($file)){
				$fcontents = file ($file);
				froreach ($fcontents as $i => $icontent){
					#skip the fisrt line on the csv
					if ($i != 0){
						preg_match('/(.*);(.*);(.*);(.*);(.*);(.*)/',$icontent,$result);
						Db::getInstance()->insert_lessons($result[2],$result[1],$result[3],$result[4],$result[5],$result[6],$block);
					}
				}
			}
		}
	}
?>