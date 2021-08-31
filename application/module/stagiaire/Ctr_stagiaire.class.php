<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_stagiaire extends Ctr_controleur
{

	public $classTable = "stagiaire";
	public $table = "stagiaire";
	public $cle = "sta_id";

	public function __construct($action)
	{
		parent::__construct("stagiaire", $action);
		$a = "a_$action";
		$this->$a();
	}

	public function a_contact()
    {
        require $this->gabarit;
    }

	function a_index()
	{
		$u = new Stagiaire();
		$result = $u->findAll();
		require $this->gabarit;
	}
	function a_prepa()
	{
		$u = new Stagiaire();
		$result = Stagiaire::findByPrepa();
		require $this->gabarit;
	}
	function a_tertiaire()
	{
		$u = new Stagiaire();
		$result = Stagiaire::findByTertiaire();
		require $this->gabarit;
	}
	function a_ifmk()
	{
		$u = new Stagiaire();
		$result = Stagiaire::findByIfmk();
		require $this->gabarit;
	}
	//$_GET["id"] : id de l'enregistrement
	function a_edit()
	{
		if (isset($_POST["btSubmit"])) {
			$u = new Stagiaire();
			$u->chargerDepuisTableau($_POST);
			$u->sauver();
			header("location:index.php?m=stagiaire");
		} else {
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$u = new Stagiaire($id);
			extract($u->data);
			$sta_nom = $sta_nom;
			$sta_prenom = $sta_prenom;
			$sta_adresse = $sta_adresse;
			$sta_ville = $sta_ville;
			$sta_code = $sta_code;
			$sta_promotion = $sta_promotion;
			require $this->gabarit;
		}
	}


	//param GET id 
	function a_del()
	{
		if (isset($_GET["id"])) {
			$u = new Stagiaire();
			$u->supprimer($_GET["id"]);
		}
		header("location:index.php?m=stagiaire");
	}
}
