<?php

class LessonsDB extends ObjectDB{
	
	protected static $table = "lessons";
	
	public function __construct(){
		parent::__construct(self::$table);
		$this->add('title', 'ValidateTitle');
		$this->add('link');
		$this->add('hours');
		$this->add('img');
		$this->add('regdata');
	}
	
	public static function getLessons($lang = false){
		if($lang)
			return ObjectDB::getAllOnField(self::$table, __CLASS__, 'lang', $lang);
		else
			return ObjectDB::getAll(__CLASS__);
	}
	
	public static function getHoursInLessonsAndLessonsses(){
		if(!$lessonsData = self::getLessons()) return false;
		foreach($lessonsData as $obj){
			$lessonsesData = LessonsesDB::getLessonsesOnID($obj->id);
			if(!$lessonsesData) $result[$obj->id] = 0.5;
			$hour[$obj->id] = $obj->hours;
				foreach($lessonsesData as $obj2){
					$hours[$obj->id][] = $obj2->hour;
				}
		}
		foreach($hours as $id => $items){
			
			foreach($items as $key => $item){
				//if($key == 'hours') continue;
				if(($pos = strpos($item, ':')) !== false){
					$data = explode(":", $item);
						foreach($data as $k => $v){
							if($k == 0) $array['hour'][] = $v;
							if($k == 1) $array['min'][] = $v;
							if($k == 2) $array['sec'][] = $v;
						}
				}
			}
			foreach($array as $k => $v){
				if($k == 'hour') $arr[] = 3600 * array_sum($v);
				if($k == 'min') $arr[] = 60 * array_sum($v);
				if($k == 'sec') $arr[] = array_sum($v);
			}
			$res[$id] = ceil(round(array_sum($arr) / 3600, 2));
			foreach(explode(':', $hour[$id]) as $v){
				if($k ==0) $h[] = 3600 * $v;
				if($k ==1) $h[] = 60 * $v;
			}
			$res_hour[$id] = ceil(round(array_sum($h) / 3600, 2)) - 1;

			//осталось вычисть процент
			$result[$id] = $res[$id] / $res_hour[$id] * 100;
		}
		return $result;

	}
	
	public static function insertLesson(){
		if($_POST['addIdea']){
			foreach($_POST as $key => $value){
				if($key == 'addIdea') continue;
				if($key == 'regdata') $data[$key] = time();
				$data[$key] = strip_tags($value);
			}
			if($_FILES['img']['name']){
				$uploadfile = 'images/'.basename($_FILES['img']['name']);
				$data['img'] = basename($_FILES['img']['name']);
				move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile);
			}
			$db = DataBase::getDBO();
			if($db->insert(self::$table, $data)) return true;
			return false;
			
		}
	}
	
	public static function getAllOnID($id){
		if(!$id) return false;
		$data = ObjectDB::getAllOnField(self::$table, __CLASS__, 'id', $id);
		return $data[$id];
	}
	
	public static function getLessonsOnID($id){
		if(!$id) return false;
		return ObjectDB::getAllOnField(self::$table, __CLASS__, 'id', $id);
	}
	
	
	
	
}


?>