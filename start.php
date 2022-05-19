<?php
	mb_internal_encoding("UTF-8");
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	set_include_path(get_include_path().PATH_SEPARATOR."core".PATH_SEPARATOR."lib".PATH_SEPARATOR."objects".PATH_SEPARATOR."validator".PATH_SEPARATOR."controllers".PATH_SEPARATOR."modules");
	spl_autoload_extensions("_class.php");
	spl_autoload_register();
	
	define("MAINMENU", 1);
	define("TOPMENU", 2);
	define("KB_B", 1024);
	define("PAY_COURSE", 1);
	define("FREE_COURSE", 2);
	define("ONLINE_COURSE", 3);
	
	function arrScripts(){
		$scripts= file_get_contents('testscript.txt');
		$arr = explode("<", $scripts);
			foreach($arr as $v){
			if(($pos = strpos($v, '"')) !==false){
				if(($pos2 = strpos($v, ">")) !== false){
					$data[] = substr($v, $pos+1, -2);
				}
			}
			
		}
		return $data;
	
	}
	
	AbstractObjectDB::setDB(DataBase::getDBO());
	
?>