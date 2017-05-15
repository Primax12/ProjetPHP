<?php
class StudentUploadController{
	private $_database;

	public function __construct(){
	}

	public function run(){
		if($_SESSION['rights']!='blocs'){
			header('Location: index.php');
			die();
		}
		if (! empty ( $_FILES ['student'] )) {

			$origin = $_FILES ['student'] ['tmp_name'];
			$destination = 'uploads/'.basename ( $_FILES ['student'] ['name'] );
			move_uploaded_file ( $origin, $destination );
			$fcontents = file ( $destination ); 
			Db::getInstance()->deleteStudents();
			foreach ( $fcontents as $i => $icontent ) {

				if ( $i == 0 ) continue;

				preg_match ( '/(.*);(.*);(.*);(.*)/', $icontent, $result ); // bloc,lastname, name, email
				$adr_mail=trim($result[4]);
				$name=trim($result[2].' '.$result[3]);
				$bloc=trim($result[1][-1]);
				Db::getInstance()->addStudent($adr_mail,$name,$bloc);			

			}
			header('Location: index.php');
		}
	}

}
?>
