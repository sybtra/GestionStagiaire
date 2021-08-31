<?php
//class mère des controleurs secondaires
class Ctr_controleur {
	protected $module;
    protected $action;
    protected $gabarit;
    protected $vue;
	
	public function __construct($module, $action, $gabarit="gabarit.php") {
        $this->module = $module;
        $this->action = $action;
        $this->gabarit ="../application/gabarit/$gabarit";
        $this->vue = "../application/module/{$module}/vue_{$module}_{$action}.php";
    }
}