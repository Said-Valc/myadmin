<?php

abstract class Module extends AbstractModule{
	
	public static $content;
	public function __construct(){
		self::$content = URL::getURL();
		parent::__construct(new View(Config::DIR_TMPL));
	}
}

?>