<?php

class PagesDB extends ObjectDB{
	
	protected static $table = "pages";
	
	public function __construct(){
		parent::__construct(self::$table);
		$this->add('id', 'ValidateID');
		$this->add('id_book', 'ValidateID');
		$this->add('page', 'ValidateTitle');
		$this->add('title', 'ValidateTitle');
		$this->add('description', 'ValidateTitle');
		$this->add('text', 'ValidateText');
		$this->add('comment', 'ValidateTitle');
		$this->add('regdate');
	}
	
	
	
	public function insertPage($data){
		$db = DataBase::getDBO();
		$array = array();
		foreach($data as $key => $value){
			if($key == 'click') continue;
			$array[$key] = $value;
		}
		$fields = '';
		$values = '';
		$sql = "INSERT INTO `ggg_pages` ";
		if(!is_array($array)) return false;
		foreach($array as $key => $value){
			$fields .= "`$key`,";
			$values .= "'$value',";
		}
		$fields = substr($fields, 0, -1);
		$values = substr($values, 0, -1);
		$sql .= "(".$fields.")VALUES(".$values.")";
		$db->mysqli->query($sql);
		
	}
	
	public function updatePage($data, $id){
		$db = DataBase::getDBO();
		$array = array();
		foreach($data as $key => $value){
			if($key == 'click') continue;
			$array[$key] = $value;
		}
		
		$sql = "UPDATE `ggg_pages` SET  ";
		if(!is_array($array)) return false;
		$fields = '';
		foreach($array as $key => $value){
			$fields .= "`$key` = '$value',";
		}
		$fields = substr($fields, 0, -1);
		$fields .= "WHERE `id` = $id";
		$sql .= $fields;
		$db->mysqli->query($sql);
		
	}
	
	public function getPageOnID($id){
		if(!$id) return false;
		return ObjectDB::getAllOnField(self::$table, __CLASS__, 'id', $id)[$id];
	}
	
	public function getAllPages(){
			return ObjectDB::getAll(__CLASS__);
	}
	
}


?>