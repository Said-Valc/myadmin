<?php

class IdeaDB extends ObjectDB{
	
	protected static $table = "idea";
	public static $settings = '';
	public function __construct(){
		parent::__construct(self::$table);
		$this->add('id');
		$this->add('title', 'ValidateTitle');
		$this->add('description');
		$this->add('text');
		$this->add('regdata');
	}
	
	public static function getIdea(){
		return array_reverse(ObjectDB::getAll(__CLASS__));
	}
	
	public static function redactIdea($obj){
		$id = $obj->redact;
		if(!$id) return false;
		self::$settings = 'redact';
		$obj = ObjectDB::getAllOnField(self::$table, __CLASS__, 'id', $id);
		return $obj;
	}
	
	public static function redactSuccess($request){
		$arr = ['title' => $request->title, 'description' => $request->description, 'text' => $request->text];
		$db = DataBase::getDBO();
		if($db->update2(self::$table, $arr, 'id = '.$request->id)) header("Location: /idea.html");
	}
	
	public static function deleteIdea($request){
		$id = $request->deleteIdea;
		if($id < 1) return false;
		$db = DataBase::getDBO();
		if($db->delete(self::$table, "id = ?", array($id))) header("Location: /idea.html");
		return false;
	}
	
	public static function addIdea($request){
		$arr = ['title' => $request->title, 'description' => $request->description, 'text' => $request->text];
		$db = DataBase::getDBO();
		if($db->insert(self::$table, $arr)) header('Location: /idea.html');
		return false;
	}
	
	protected function postInit(){
		if(!empty(ideaDB::$settings)) $this->settings = ideaDB::$settings;
		return true;
	}

	
	
	
	
}

