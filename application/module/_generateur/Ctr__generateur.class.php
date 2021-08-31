<?php

class Ctr__generateur extends Ctr_controleur{
	//Les champs des tables doivent etre préfixés par les 3 premiers caracteres du nom de la table !!
    public static $lprefixe = DB_PREFIXE_LENGTH;

    public function __construct($action) {
		parent::__construct("_generateur",$action);
        $a = "a_$action";
		$this->$a();
    }

	function a_index() {
        echo "Accés au générateur... en attente";
    }
	
    function a_magicAllTables() {
        echo "<h1><a href='index.php'>Voir le site</a></h1>";
        $sql = "show tables";
        $result = Table::$link->query($sql,PDO::FETCH_BOTH);
        
        foreach ( $result as $row)
            $this->magicOneTable($row[0]);

        $this->creerMenu();
    }

    //génération pour une table, eventuellement passée en parametre
    function a_magicOneTable($table = "") {
        $table = $table == "" ? $_GET["table"] : $table;
        echo " -- Génération pour la table $table <br>";
        $this->creerClassTable($table);
        $this->creerClassControleur($table);
        $this->creerVueIndex($table);
        $this->creerVueEdit($table);

    }

    private function creerClassTable($nomTable) {
        $nomClasse = ucfirst($nomTable);
        $nomCle = substr($nomTable, 0, self::$lprefixe) . "_id";
        $chaine = file_get_contents("../application/module/_generateur/template/Xxx.class.txt");
        $chaine = str_replace("[nomClasse]", $nomClasse, $chaine);
        $chaine = str_replace("[nomTable]", $nomTable, $chaine);
        $chaine = str_replace("[nomCle]", $nomCle, $chaine);
        file_put_contents("../application/table/$nomClasse.class.php", $chaine);
    }

    private function creerClassControleur($nomTable) {
    	$nomClasse = ucfirst($nomTable);
    	$nomCle = substr($nomTable, 0, self::$lprefixe) . "_id";
        $chaine = file_get_contents("../application/module/_generateur/template/Ctr_xxx.class.txt");
        $chaine = str_replace("[nomTable]", $nomTable, $chaine);
        $chaine = str_replace("[nomClasse]", $nomClasse, $chaine);
        $chaine = str_replace("[nomCle]", $nomCle, $chaine);
        @mkdir("../application/module/$nomTable");
        file_put_contents("../application/module/$nomTable/Ctr_$nomTable.class.php", $chaine);
    }

    private function creerVueIndex($nomTable) {
        $chaine = file_get_contents("../application/module/_generateur/template/xxx_index_vue.txt");
        $chaine = str_replace("[nomTable]", $nomTable, $chaine);
        $nomCle = substr($nomTable, 0, self::$lprefixe)  . "_id";
        $chaine = str_replace("[nomCle]", $nomCle, $chaine);
        $thnc=$this->thListeChamp($this->getChamps($nomTable));
        $chaine = str_replace("[thListeChamps]", $thnc, $chaine);
        $tdlv=$this->tdListeValeur($this->getChamps($nomTable));
        $chaine = str_replace("[tdListeValeur]", $tdlv, $chaine);
        file_put_contents("../application/module/" . $nomTable . "/vue_" . $nomTable . "_index.php", $chaine);
    }

    private function creerVueEdit($nomTable) {
		$nomCle = substr($nomTable, 0, self::$lprefixe)  . "_id";
        $chaine = file_get_contents("../application/module/_generateur/template/xxx_edit_vue.txt");
        $chaine = str_replace("[listeChamps]", $this->genererFormulaire($nomTable), $chaine);
        $chaine = str_replace("[nomTable]", $nomTable, $chaine);
		$chaine = str_replace("[nomCle]", $nomCle, $chaine);
        file_put_contents("../application/module/" . $nomTable . "/vue_" . $nomTable . "_edit.php", $chaine);
    }

    private function creerMenu() {
        $chaine = file_get_contents("../application/module/_generateur/template/inc_menu.php");
        $sql = "show tables";
        $result = Table::$link->query($sql,PDO::FETCH_BOTH);
        $menu = "";
        foreach ( $result as $row) {
            $s='<?=hlien("' . $row[0] . '","index")?>';
            $menu = $menu . "<li><a class='nav-link' href='$s'>" . ucfirst($row[0]) . "</a></li>\n";
        }
        $chaine = str_replace("[menu]", $menu, $chaine);
        file_put_contents("../application/gabarit/inc_menu.php", $chaine);
    }

    private function genererFormulaire($nomTable) {
        $chaine = "";
        $nomCle = substr($nomTable, 0, self::$lprefixe) . "_id";
        $result = Table::$link->query("SHOW COLUMNS FROM $nomTable",PDO::FETCH_BOTH);
        foreach ( $result as $row) {
            /*
            echo "<pre>";
            print_r($row);
            echo "</pre>";
            */
            $nom = $row[0];
            if ($nomCle != $nom) {
                $libelle = ucfirst(substr($nom, self::$lprefixe + 1));
                $phpVar = "<?=mhe(\$" . $nom . ")?>";
                $chaine .= "
                        <div class='form-group'>
                            <label for='$nom'>$libelle</label>
                            <input id='$nom' name='$nom' type='text' size='50' value='$phpVar'  class='form-control' />
                        </div>";
            }
        }
        return $chaine;
    }
	
	private function getChamps($table) {
		$sql="show columns from $table";
		$result= Table::$link->query($sql);	
		foreach ($result as $row) {
			$champs[]=$row["Field"];
		}
		return $champs;
	}

    function thListeChamp($ar) {
        $s = "";
        foreach ($ar as $valeur)
            $s.="\n\t\t\t<th>" . ucfirst(substr($valeur,self::$lprefixe + 1)) . "</th>";
        return $s;
    }

    function tdListeValeur($ar) {
        $s = "";
        foreach ($ar as $valeur)
            $s.="\n\t\t\t<td><?=mhe(\$row['" . $valeur . "'])?></td>";
        return $s;
    }

}

?>