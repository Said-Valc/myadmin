<?php

class UrokPodrobneeDB extends ObjectDB{
	
	protected static $table = "urokPodrobnee";
	
	public function __construct(){
		parent::__construct(self::$table);
		$this->add('id');
		$this->add('lessonses_id');
		$this->add('title', 'ValidateTitle');
		$this->add('target_1');
		$this->add('target_2');
		$this->add('target_3');
		$this->add('target_4');
		$this->add('target_5');
		$this->add('target_6');
		$this->add('res_1');
		$this->add('res_2');
		$this->add('res_3');
		$this->add('res_4');
		$this->add('res_5');
		$this->add('res_6');
		$this->add('mission');
		$this->add('regdata');
	}
	
	public function getAllOnID($id){
		if(!$id) return false;
		if(($pos = strpos($id, Config::SEF_SUFFIX)) !== false){
			$id = substr($id, 0, -strlen(Config::SEF_SUFFIX));
		}else $id = (int) $id;
		if($id < 1) return false;
		$data = ObjectDB::getAllOnField(self::$table, __CLASS__, 'id', $id);
		if($data) {
			$data[$id]->lessonses = lessonsesDB::getAllOnID($data[$id]->lessonses_id, true);
		}
		if($data)
			foreach($data as $obj) return $obj;
		
		
	}
	

	
	
	
	
}


?>