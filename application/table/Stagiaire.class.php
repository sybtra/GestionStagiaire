<?php

/**
Classe créé par le générateur.
 */
class Stagiaire extends Table
{
	public function __construct($id = 0)
	{
		parent::__construct("stagiaire", "sta_id", $id);
	}

	public function findAll()
	{
		$sql = "select * from stagiaire";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}
	static public function findByPrepa()
	{
		$sql = "select * from stagiaire where sta_promotion='Prépa'";
		$statement = self::$link->prepare($sql);
		try {
			$statement->execute();
		} catch (Exception $e) {
			var_dump($e);
		}
		return $statement->fetchAll();
	}
	static public function findByTertiaire()
	{
		$sql = "select * from stagiaire where sta_promotion='Tertiaire'";
		$statement = self::$link->prepare($sql);
		try {
			$statement->execute();
		} catch (Exception $e) {
			var_dump($e);
		}
		return $statement->fetchAll();
	}
	static public function findByIfmk()
	{
		$sql = "select * from stagiaire where sta_promotion='IFMK'";
		$statement = self::$link->prepare($sql);
		try {
			$statement->execute();
		} catch (Exception $e) {
			var_dump($e);
		}
		return $statement->fetchAll();
	}
}
