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
				return 's';
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
		$this->_db->prepare($query)->execute();
	}
	*/
}
