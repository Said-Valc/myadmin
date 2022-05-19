<?php

class BookDB extends ObjectDB{
	
	protected static $table = "book";
	
	public function __construct(){
		parent::__construct(self::$table);
		$this->add('id', 'ValidateID');
		$this->add('title', 'ValidateTitle');
		$this->add('description', 'ValidateTitle');
		$this->add('regdate');
	}
	
	
	
	public function insertBook($data){
		$db = DataBase::getDBO();
		foreach($data as $key => $value){
			$array[$key] = $value;
		}
		$fields = '';
		$values = '';
		$sql = "INSERT INTO `ggg_book` ";
		foreach($array as $key => $value){
			if($key == 'clickBook') continue;
			$fields .= "`$key`,";
			$values .= "'$value',";
		}
		$fields = substr($fields, 0, -1);
		$values = substr($values, 0, -1);
		$sql .= "(".$fields.")VALUES(".$values.")";
		$db->mysqli->query($sql);
		
	}
	
	public function getAllBook(){
			return ObjectDB::getAll(__CLASS__);
	}
	
}


?>