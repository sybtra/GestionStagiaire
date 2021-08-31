<?php
class Database
{

    static public function creer(string $sqlfile): string
    {
        $sql = file_get_contents($sqlfile);
        Table::$link->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
        Table::$link->exec($sql);
        return $sql;
    }


    static public function genererstagiaire(int $nbstagiaire): int
    {
        $sql = "insert into stagiaire values ";
        $data = [];
        $listpromo = ["Prépa", "Tertiaire", "IFMK"];
        for ($i = 1; $i <= $nbstagiaire; $i++) {
            $sta_nom = "nom$i";
            $sta_prenom = "prenom$i";
            $sta_adresse = "adresse$i";
            $sta_ville = "ville$i";
            $sta_code = $i;
            shuffle($listpromo);
            $sta_promotion = $listpromo[0];
            $data[] = "(null,'$sta_nom','$sta_prenom','$sta_adresse','$sta_ville','$sta_code','$sta_promotion')";
        }

        return Table::$link->exec($sql . implode(",", $data));
    }
}
