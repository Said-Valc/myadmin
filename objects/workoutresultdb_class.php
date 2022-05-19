<?php

class WorkoutresultDB extends ObjectDB{
	
	protected static $table = "workoutresult";
	
	public function __construct(){
		parent::__construct(self::$table);
		$this->add('title');
		$this->add('turnik', 'ValidateTitle');
		$this->add('brucya');
		$this->add('otjimani');
		$this->add('prisedani');
		$this->add('press');
		$this->add('regdata');
	}
	
	public function getTable(){
		$data = ObjectDB::getAll(__CLASS__);
		return $data[1];
	}
	
	
	public function updateTable($data){
		if(!is_array($data)) return false;
		foreach($data as $obj){
			if($obj->format == 1){
				$arr['turnik'] = ($obj->podhod * $obj->cols);
			}elseif($obj->format == 2){
				$arr['brucya'] = ($obj->podhod * $obj->cols);
			}elseif($obj->format == 3){
				$arr['otjimani'] = ($obj->podhod * $obj->cols);
			}elseif($obj->format == 4){
				$arr['prisedani'] = ($obj->podhod * $obj->cols);
			}elseif($obj->press == 5){
				$arr['press'] = ($obj->podhod * $obj->cols);
			}else return false;
			$db = DataBase::getDBO();
			$res = $db->update2(self::$table, $arr);
			
		}
	}
	
	
	
	
	
	
	
}


?>