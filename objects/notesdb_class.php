<?php

class NotesDB extends ObjectDB{
	
	protected static $table = "notes";
	
	public function __construct(){
		parent::__construct(self::$table);
		$this->add('title', 'ValidateID');
		$this->add('title', 'ValidateTitle');
		$this->add('description', 'ValidateTitle');
		$this->add('text');
		$this->add('regdata');
	}
	
	
	
}


?>