<?php

abstract class Controller extends AbstractController{
	
	protected $title;
	protected $meta_desc;
	protected $meta_key;
	protected $mail = null;
	protected $url_active;
	protected $section_id = 0;
	
	public function __construct() {
		parent::__construct(new View(Config::DIR_TMPL), false);
		//$this->mail = new Mail();
		//$this->url_active = URL::deleteGET(URL::current(), "page");
	}
	
	public function getHeader() {
		$header = new Header();
		$header->title = $this->title;
		$header->meta("Content-Type", "text/html; charset=utf-8", true);
		$header->meta("description", $this->meta_desc, false);
		$header->meta("keywords", $this->meta_key, false);
		$header->meta("viewport", "width=device-width", false);
		$header->favicon = "images/favicon.ico";
		$header->css = array('../vendors/bootstrap/dist/css/bootstrap.min.css','
		../vendors/font-awesome/css/font-awesome.min.css',
		'../vendors/nprogress/nprogress.css',
		'../vendors/iCheck/skins/flat/green.css',
		'../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
		'../vendors/jqvmap/dist/jqvmap.min.css','../vendors/bootstrap-daterangepicker/daterangepicker.css',
		'../build/css/custom.min.css',
		'../vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css',
		"../vendors/ion.rangeSlider/css/ion.rangeSlider.css",
		"../vendors/cropper/dist/cropper.min.css",
		"../vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css",
		"../vendors/normalize-css/normalize.css",
		"../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css"
		);		
		$header->js =  arrScripts();
		return $header;
	}
	
	
	protected function render($str){
		$params['header'] = $this->getHeader();
		$params['center'] = $str;
		$params['tmpl'] = module::$content;
		$params['leftmenu'] = $this->getLeft();
		$this->view->render(Config::LAYOUT, $params);
	}
	
	
	protected function getLeft(){
		$items = MenuDB::getMainMenu();
		$mainmenu = new MainMenu();
		$mainmenu->uri = $this->url_active;
		$mainmenu->items = $items;
		return $mainmenu;
	}
	
	
	protected function accessDenied(){
		
	}
	public function action404(){
		
	}
	
}
