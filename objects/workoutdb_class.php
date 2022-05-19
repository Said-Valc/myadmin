<?php

class WorkoutDB extends ObjectDB{
	
	protected static $table = "workout";
	
	public function __construct(){
		parent::__construct(self::$table);
		$this->add('format');
		$this->add('title', 'ValidateTitle');
		$this->add('podhod');
		$this->add('cols');
		$this->add('comment');
		$this->add('regdata');
	}
	
	public function getAllOnID(){
		$data = ObjectDB::getAll(__CLASS__);
		if(is_array($data)) return $data;
	}
	
	public function postInit(){
		$this->regdata = date('Y.m.d H:i:s', $this->regdata);
	}
	
	public function addWorkout($data){
		if(!is_array($data)) return false;
		$db = DataBase::getDBO();
		if(!empty($data['form2'])){
			foreach($data as $key => $value){
				if($key == 'addWorkout') continue;
				if($key == 'form2') continue;
				if(($pos = strpos($key, '_')) === false){
					$arr[$key] = $value;
				}elseif(($pos2 = strpos($key, "_")) !== false){
					$key = substr($key, 0, -strlen(substr($key, $pos2)));
					$arr2[$key] = $value;
				}
				$arr['regdata'] = time();
				$arr2['regdata'] = time();
			}
				$array = array($arr, $arr2);
				foreach($array as $arr){
					$result = $db->insert(self::$table, $arr);
				}
				if($result) header('Location: /workout.html');
		}else{
			foreach($data as $key => $value){
				if($key == 'addWorkout') continue;
				if($key == 'form2') continue;
				if(($pos = strpos($key, '_')) !== false) continue;
				$array[$key]  = $value;
			}
			$array['regdata'] = time();
			if($db->insert(self::$table, $array)) header('Location: /workout.html');
		}
	}
	
	
	
	
	
}


?>