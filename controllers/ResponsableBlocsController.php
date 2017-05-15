<?php
	class ResponsableBlocsController{
		private $_database;

		public function __construct($database){
			$this->_database = $database;
		}
		
		public function run(){
			
			require_once(VIEW_PATH."teacher.php");
			require_once(VIEW_PATH."ResponsableBlocs.php");
			if (!empty ($_FILES ['upload_file2'])) $this->run_students();
		}
		
		
		private function run_students() {
		if (! empty ( $_FILES ['upload_file2'] )) {
			
			$origin = $_FILES ['upload_file2'] ['tmp_name'];
			$destination = CONF_PATH . basename ( $_FILES ['upload_file2'] ['name'] );
			move_uploaded_file ( $origin, $destination );
			
			$fcontents = file ( $destination ); 
			foreach ( $fcontents as $i => $icontent ) {
				
				if ( $i == 0 ) continue;
				
				preg_match ( '/(.*);(.*);(.*);(.*)/', $icontent, $result ); // bloc,lastname, name, email
				
				Db::get_Instance()->add_student(new students(trim($result[4]),trim($result[2]),trim($result[3]),trim($result[1])));			
				
				}
			}
		}
		
	}
?>