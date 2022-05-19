<?php

abstract class Config {

	const SITENAME = "http://myadmin.loc/";
	const SECRET = "DGLJDG5";
	const ADDRESS = "http://http://myadmin.loc/";
	const ADM_NAME = "Саид Вальц";
	const ADM_EMAIL = "admin@myrusakov.ru";
	
	const API_KEY = "DKEL39DL";
	
	const DB_HOST = "localhost";
	const DB_USER = "root";
	const DB_PASSWORD = "root";
	const DB_NAME = "admin";
	const DB_PREFIX = "ggg_";
	const DB_SYM_QUERY = "?";
	
	const DIR_IMG = "/images/";
	const DIR_IMG_ARTICLES = "/images/articles/";
	const DIR_AVATAR = "/images/avatars/";
	const DIR_TMPL = "C:\OpenServer\domains/myadmin.loc/tmpl/";
	const DIR_EMAILS = "C:\OpenServer\domains/myadmin.loc/tmpl/emails/";
	
	const LAYOUT = "main";
	const CONTENT = "content_";
	const FILE_MESSAGES = "C:\OpenServer\domains/myadmin.loc/text/messages.ini";
	
	const FORMAT_DATE = "%d.%m.%Y %H:%M:%S";
	
	const COUNT_ARTICLES_ON_PAGE = 3;
	const COUNT_SHOW_PAGES = 10;
	
	const MIN_SEARCH_LEN = 3;
	const LEN_SEARCH_RES = 255;
	
	const SEF_SUFFIX = ".html";
	
	const DEFAULT_AVATAR = "default.png";
	const MAX_SIZE_AVATAR = 51200;
}

?>