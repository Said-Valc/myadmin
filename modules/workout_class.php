<?php

class Workout extends Module {

	public function __construct() {
		parent::__construct();
		$this->add("data");
		$this->add("dataWR");
	}
	
	public function getTmplFile() {
		return module::$content."workout";
	}
	
}

?>