<?php
class Db
{
	private static $instance = null;
	private $_db;
	private $target_dir="uploads/";
	private function __construct()
	{
		try {
			$this->_db = new PDO('mysql:host=localhost;dbname=ProjetPHP;charset=utf8', 'root', '');
			$this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
		} 
		catch (PDOException $e) {
			die('Erreur de connexion à la base de données : '.$e->getMessage());
		}
	}

	# Pattern Singleton
	public static function getInstance(){
		if (is_null(self::$instance)) {
			self::$instance = new Db();
		}
		return self::$instance;
	}
	
	public function getRights($login=''){
		$query = "SELECT * FROM professeurs WHERE adr_mail LIKE '".$login."'";
		$result = $this->_db->query($query); 
		if ($result->rowcount()==0) {
			$query = "SELECT * FROM etudiants WHERE adr_mail LIKE '".$login."'";
			$result = $this->_db->query($query);
			if ($result->rowcount()!=0) {
				return 'student';
			}
		} else {
			# Parcourir les résultats dans $result 
			# avec un foreach ou un while…
			$result=$result->fetch();
			return $result->rights;
		}
	}
	
	public function deleteAgenda(){
		$query='DELETE FROM semaines';
		$this->_db->prepare($query)->execute();
	}
	public function insertAgenda($date, $i){
		$query="INSERT INTO semaines (lundi, num) VALUES ('".$date."',".$i.")";
		$this->_db->prepare($query)->execute();
	}

	public function deleteProfs(){
		$query='DELETE FROM professeurs';
		$this->_db->prepare($query)->execute();
	}
	public function insertProf($adr_mail, $name, $rights){
		$query="INSERT INTO professeurs (adr_mail, nom, rights) VALUES ('".$adr_mail."','".$name."','".$rights."')";
		$this->_db->prepare($query)->execute();
	}
	public function deleteStudents(){
		$query='DELETE FROM etudiants';
		$this->_db->prepare($query)->execute();
	}
	public function addStudent($adr_mail, $name, $bloc){
		$query="INSERT INTO etudiants (adr_mail, nom, num_bloc) SELECT \"".$adr_mail."\",\"".$name."\", num FROM blocs WHERE num = \"".$bloc."\"";
		echo($query.';<br>');
		$this->_db->prepare($query)->execute();
	}
	public function deleteUE(){
		$query='DELETE FROM ues_aas';
		$this->_db->prepare($query)->execute();
	}
	public function insertUE($code, $nom, $ects, $abv, $quadri){
		$query="INSERT INTO ues_aas (code, nom, ects, abv, quadri, bloc) VALUES(\"".$code."\",\"".$nom."\",\"".$ects."\",\"".$abv."\",\"".$quadri."\",\"".$_SESSION['bloc']."\")";
		$this->_db->prepare($query)->execute();
	}

	public function getUEs(){
		
		$query = "SELECT code FROM ues_aas WHERE bloc LIKE ".$_SESSION['bloc'];
		$result = $this->_db->query($query);
		//$result=$this->_db->prepare($query)->execute();
		//$result = $this->_db->query($query);
		$toReturn=array();
		if($result->rowcount()!=0){
			while($row=$result->fetch()){
				$toReturn[]=$row->code;
			}
		}
		return $toReturn;
	}	
	public function getSems(){
		$query = "SELECT num FROM semaines";
		$result = $this->_db->query($query);
		//$result=$this->_db->prepare($query)->execute();
		//$result = $this->_db->query($query);
		$toReturn=array();
		if($result->rowcount()!=0){
			while($row=$result->fetch()){
				$toReturn[]=$row->num;
			}
		}
		return $toReturn;
	}	
	public function getSeries(){
		$query = "SELECT num, bloc FROM series";
		$result = $this->_db->query($query);
		//$result=$this->_db->prepare($query)->execute();
		//$result = $this->_db->query($query);
		$toReturn=array();
		if($result->rowcount()!=0){
			while($row=$result->fetch()){
				$toReturn[]=$row->bloc.'-'.$row->num;
			}
		}
		return $toReturn;
	}	

	public function getStudentFromSerie($bloc, $serie){
		$query = "SELECT nom FROM etudiants WHERE num_bloc=".$bloc." AND num_serie=".$serie.";";
		$result = $this->_db->query($query);
		$toReturn=array();
		if($result->rowcount()!=0){
			while($row=$result->fetch()){
				$toReturn[]=$row->nom;
			}
		}
		return $toReturn;

	}
	
	public function insertPresence($nom, $code, $sem, $num){
		$query = "INSERT INTO presences(etudiant,aa,semaine,num) SELECT etudiants.adr_mail, ues_aas.code, semaines.num, ".$num." FROM etudiants, ues_aas, semaines WHERE etudiants.nom LIKE '".$nom."' AND ues_aas.code LIKE '".$code."' AND semaines.num=".$sem; 
		//$query="INSERT INTO presences (etudiant, aa, semaine, num) VALUES(\"".$code."\",\"".$nom."\",\"".$ects."\",\"".$abv."\",\"".$quadri."\",\"".$_SESSION['bloc']."\")";
		$this->_db->prepare($query)->execute();
	}
	public function getPresences($code, $sem, $num, $serie){
		$query = "SELECT etudiants.nom FROM etudiants, presences WHERE etudiants.adr_mail=presences.etudiant AND etudiants.num_serie=".$serie." AND presences.aa LIKE '".$code."' AND presences.semaine=".$sem." AND presences.num=".$num; 
		//$query="INSERT INTO presences (etudiant, aa, semaine, num) VALUES(\"".$code."\",\"".$nom."\",\"".$ects."\",\"".$abv."\",\"".$quadri."\",\"".$_SESSION['bloc']."\")";
		$result = $this->_db->query($query);
		$toReturn=array();
		if($result->rowcount()!=0){
			while($row=$result->fetch()){
				$toReturn[]=$row->nom;
			}
		}
		return $toReturn;
	}

	/*
	# Fonction qui exécute un SELECT dans la table des livres 
	# et qui renvoie un tableau d'objet(s) de la classe Livre
	public function select_livres($keyword='') {
		# Définition du query
		if ($keyword != '') {
			# Remplacer une single quote ' par une single quote échappée \'
			# pour que la requête SQL fonctionne avec une single quote dans le $keyword
			$keyword = str_replace("'", "\'", $keyword);
			$query = "SELECT * FROM livres WHERE titre LIKE '%" . $keyword . "%' COLLATE utf8_bin ORDER BY no DESC";
		} else {
			$query = 'SELECT * FROM livres ORDER BY no DESC';
		}

		# Exécution du query
		$result = $this->_db->query($query); 

		# Parcours de l'ensemble des résultats et construction d'un tableau d'objet(s) de la classe Livre
		$tableau = array();
		if ($result->rowcount()!=0) {
			while ($row = $result->fetch()) {		
				$tableau[] = new Livre($row->no,$row->titre,$row->auteur);
			}
		}	
		# pour debug : affichage ici possible de l'array à l'aide de var_dump($tableau);
		# var_dump($tableau);
		return $tableau;
	}	

	public function insert_livre($titre,$auteur) {
		# Solution d'INSERT avec quote
		$query = 'INSERT INTO livres (titre, auteur) 
		values ('. $this->_db->quote($titre) . ',' . $this->_db->quote($auteur) . ')';
		$this->_db->prepare($query)->execute();
		# ou Solution d'INSERT avec bindValue
		#$query = 'INSERT INTO livres (titre, auteur) 
		#values (:titre,:auteur)';
		#$qp = $this->_db->prepare($query);
		#$qp->bindValue(':titre',$titre);
		#$qp->bindValue(':auteur',$auteur);
		#$qp->execute();
	}

	public function delete_livre($no) {
		$query = 'DELETE FROM livres WHERE no='. $no .' LIMIT 1';
			}
	*/
}
