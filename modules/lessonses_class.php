<?php

class Lessonses extends Module {

	public function __construct() {
		parent::__construct();
		$this->add("data");
	}
	
	public function getTmplFile() {
		return module::$content."lessonses_table";
	}
	
}

?>