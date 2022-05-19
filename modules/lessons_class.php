<?php

class Lessons extends Module {

	public function __construct() {
		parent::__construct();
		$this->add("data");
		$this->add("hour");
	}
	
	public function getTmplFile() {
		return module::$content."lessons_table";
	}
	
}

?>