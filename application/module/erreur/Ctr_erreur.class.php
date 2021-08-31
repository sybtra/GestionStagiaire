<?php
class Ctr_erreur extends Ctr_controleur
{

    public function __construct($action)
    {
        parent::__construct("erreur", $action);
        $a = "a_$action";
        $this->$a();
    }

    public function a_catch()
    {
        require $this->gabarit;
    }

}
