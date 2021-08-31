<?php
/**
* classe mère pour gérer les tables de la BDD
* propose les requetes génériques du CRUD
*/
class Table {
	//connexion PDO à la BDD
	public static $link;	
	//nom de la table
	public $table;	
	//Nom du champ clé primaire
	public $cle;   	
	//tableau associatif (field=>value) représentant un enregistrement
	public $data; 	
	
	/**
	 * Constructeur
	 *
	 * @param string $table        	
	 * @param string $cle        	
	 * @param string $id : si >0 charge un enregistrement depuis la BDD        	
	 */
	public function __construct($table, $cle,$id=0) {
		$this->table = $table;
		$this->cle = $cle;
		$this->data = array ();
		if ($id==0)
			//initialise data[] avec le nom des champs comme clé et des valeurs vide
			$this->init();
		else
			//charge un enregistrement de la base
			$this->charger($id);
	}
	
	/**
	* charge une connexion à la BDD
	*/
	static function setLink($link) {
		self::$link=$link;
	}
	
	/**
	 * Retourne tous les enregistrements de la table
	 * 
	 * @return array
	 */
	function findAll() {
		$sql="select * from $this->table";
		$result=self::$link->query($sql);
		return $result->fetchAll();			
	}
	
	/**
	 * Charge un enregistrement depuis la base de données
	 *
	 * @param integer $id        	
	 */
	function charger($id) {
		$sql="select * from $this->table where $this->cle=:id";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id",$id,PDO::PARAM_INT);
		try {
			$statement->execute();
		} finally {}
		$this->data=$statement->fetch();
	}
	
	/**
	* initialise data[] avec le nom des champs comme clés et des valeurs vide
	*/
	function init() {
		$champs=$this->getChamps($this->table);
		foreach($champs as $valeur) {
			$this->data[$valeur]="";
		}		
		$this->data[$this->cle]=0;
	}
	
	/**
	 * Charge un enregistrement depuis un tableau
	 *
	 * @param array $tab
	 */
	function chargerDepuisTableau(array $tab) {
		foreach($this->getChamps() as $valeur) {
			$this->data[$valeur]=$tab[$valeur];
		}		
	}
	
	/**
	 * retourne un tableau contenant le nom des champs de la table
	 *
	 * @return array
	 */
	function getChamps() {
		$sql="show columns from $this->table";
		$result= self::$link->query($sql);	
		foreach ($result as $row) {
			$champs[]=$row["Field"];
		}
		return $champs;
	}
	
	/**
	 * retourne la chaine SQL (préparé pour PDO) de mise a jour d'un enregistrement de $table
	 *
	 * @return string
	 */
	function updateSql() {
		foreach($this->getChamps() as $nom) {
			if ($nom!=$this->cle)
				$tab[]=$nom . "=:" . $nom;
		}

		$sql="update $this->table set " . implode(",",$tab) . " where $this->cle=:" . $this->cle;
		return $sql;
	}

	/**
	 * retourne la chaine SQL (préparé pour PDO) d'insertion d'un enregistrement dans $table :nomchamp
	 *
	 * @return string
	 */
	function insertSql() {
		foreach($this->getChamps() as $nom) {
			if ($nom!=$this->cle)
				$tab[]=":" . $nom;
		}

		$sql="insert into $this->table values (null," . implode(",",$tab) . ")";
		return $sql;
	}
	
	
	/**
	 * Enregistre en base de données l'enregistrement $this->data
	 * si id > 0 update SINON insert
	 */
	function sauver() {
		if ($this->data[$this->cle]>0) {
			$sql=$this->updateSql();
		} else {
			$sql=$this->insertSql();
		}

		$statement = self::$link->prepare($sql);
		foreach($this->data as $cle => $valeur) {
			if ($this->cle!=$cle or $this->data[$this->cle]>0)
				$statement->bindValue(":" . $cle,$valeur);
		}

		try {
			$statement->execute();
		} finally {}
		/*
		catch(Exception $e) {
			var_dump($e);
		}
		*/
		
		//si création d'un enregsitrement : récupère l'id 
		if ($this->data[$this->cle]==0)
			$this->data[$this->cle]=self::$link->lastInsertId(); 
	}
	
	/**
	 * execute la suppression d'un enregsitrement
	 * @param integer $id : id de l'enregistrement
	 */
	function supprimer($id) {
		$sql="delete from $this->table where $this->cle=:id";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id",$id,PDO::PARAM_INT);
		try {
			$statement->execute();
		} finally {}
	}
	
	/**
	 * fonction générique pour générer les balises OPTION d'un SELECT
	 *
	 * @param string $sql requete sql
	 * @param string $pk nom du champ cle primaire
	 * @param string $label nom du champ à afficher dans la balise OPTION
	 * @param integer $id valeur à préselectionner
	 */
	static public function HTMLselect($sql,$pk,$label,$id) {
		$resultat = self::$link->query($sql);
		$s="";
		foreach($resultat as $tab) {
			if ($tab[$pk]==$id)
				$sel= " selected ";
			else 
				$sel="";
			
			$s=$s . "<option $sel value='$tab[$pk]'>$tab[$label]</option>";		
		}
		return $s;
	}
}
?>