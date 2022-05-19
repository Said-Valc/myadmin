<?php

class LessonsesDB extends ObjectDB{
	
	protected static $table = "lessonses";
	
	public function __construct(){
		parent::__construct(self::$table);
		$this->add('title', 'ValidateID');
		$this->add('lessons_id', 'ValidateID');
		$this->add('title', 'ValidateTitle');
		$this->add('hour');
		$this->add('practice');
		$this->add('text');
		$this->add('regdata');
	}
	
	public static function getLessonses(){
		return ObjectDB::getAll(__CLASS__);
	}
	
	
	
	public static function getLessonsesOnID($lessons_id){
		if(!$lessons_id) return false;
		return objectDB::getAllOnField(self::$table, __CLASS__, 'lessons_id', $lessons_id);
	}
	
	public function postInit(){
		$this->regdataUnix = $this->regdata;
		$this->regdata = date('d.m.Y',$this->regdata);
		$this->practice = ($this->practice) ? 'Да' : 'Нет';
		$this->lessons_idOrig = $this->lessons_id;
		$this->lessons_id = $this->transFormLessID($this->lessons_id)->title;
	}
	
	
	
	private function transFormLessID($id){
		if(!$id) return false;
		foreach( lessonsDB::getLessonsOnID($id) as $item){
			return $item;
		}
	}
	
	public static function getAllOnID($id, $lessons = false){
		if(!$id) return false;
		$data = ObjectDB::getAllOnField(self::$table, __CLASS__, 'id', $id);
		if($lessons){
			//если нам нужен родитель из базы данных
			$arr = lessonsDB::getAllOnID($data[$id]->lessons_idOrig);
			if($arr) $data[$id]->lessons = $arr;
		}
		return $data[$id];
	}
	
	public function updateData($obj){
		if(!$obj->id_1) return false;
		$i = 1;
		$id = "id_$i";
		while($obj->$id){
		if(!$obj->$id) break;
		$id = "id_$i";
		$title = "title_$i";
		$hour = "hour_$i";
		$practice = "practice_$i";
		$text = "text_$i";
		$regdataUnix = "regdataUnix_$i";
		$regdata = "regdata_$i";
		$data[$i][$id] = $obj->$id;
		$data[$i][$title] = $obj->$title;
		$data[$i][$hour] = $obj->$hour;
		$data[$i][$practice] = $obj->$practice;
		$data[$i][$text] = $obj->$text;
		$data[$i][$regdata] = $obj->$regdataUnix;
			$i++;
		}
	
		if(is_array($data)){
			for($i = 1; $i < count($data); $i++){
				
					foreach($data[$i] as $key => $value){
						if(($pos = strpos($key, "_")) !== false){
							$fields = substr($key, 0, $pos);
							$arr[$i][$fields] = $value;
						}
					}
				
			
			}
		}
		
	//	$db->update(self::$table,$arr[1], "id=".$arr[1]['id'], $arr[1] );
		$this->updateLess($arr);
		header("Location: http://myadmin.loc/lessonsesJS-livel-1.html");
		
	}
	
	
	
	public function updateLess($data){
		$db = DataBase::getDBO();

		$res = '';
		foreach($data as $arr){
			$query = "UPDATE ggg_".self::$table." SET";
			foreach($arr as $key => $value){
				if($key != 'id'){
					$res .= "`$key` = '$value',";
				}
				else $where = " WHERE $key = ".$value;
			}
			$query = $query.substr($res, 0, -1).$where;
			$db->mysqli->query($query);
		}
		
	}
	
	
}


?>