<?php
class Ctr__default extends Ctr_controleur
{

    public function __construct($action)
    {
        parent::__construct("_default", $action);
        $a = "a_$action";
        $this->$a();
    }

    public function a_index()
    {
        if (isset($_SESSION["id"])) {
            try {
                $u = new Stagiaire();
                require $this->gabarit;
            } catch (Exception $e) {
                $_GET["erreur"] = $e;
                new Ctr_erreur("catch");
            }
        } else {
            header("location:" . hlien("stagiaire", "edit"));
        }
    }
}
