<?php

class MyBooks extends Module {

	public function __construct() {
		parent::__construct();
		$this->add("books");
		$this->add("pages");
	}
	
	public function getTmplFile() {
		return module::$content."mybooks";
	}
	
}

?>