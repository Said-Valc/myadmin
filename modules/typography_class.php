<?php

class Typography extends Module {

	public function __construct() {
		parent::__construct();
		$this->add("data");
	}
	
	public function getTmplFile() {
		return module::$content."typography";
	}
	
}

?>