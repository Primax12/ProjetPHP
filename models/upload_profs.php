
<?php
$target_dir = "uploads/";
$target_file = "uploads/profs.csv";
$uploadOk = 1;

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if(pathinfo($_FILES["fileToUpload"]["name"])["extension"]!="csv"){
	echo "Wrong ext.";
	$uploadOk=0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ProjetPHP";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		echo "Echec conn DB";
	} 
	
	$conn->query("DELETE FROM professeurs"); 
		
	$handle = fopen($target_file, "r");
	for ($i = 0; $row = fgetcsv($handle,0,";" ); ++$i) {
		if($i==0)continue;
		$sql = "INSERT INTO professeurs (adr_mail, nom, rights) VALUES ('".$row[0]."','".$row[1]." ".$row[2]."','".$row[3][0]."')";
		#echo $sql."<br>";
		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully<br>";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();
	fclose($handle);
	
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



?>

