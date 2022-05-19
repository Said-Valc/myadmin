<?php

class UseSEF{
	
	
	public static function getRequest($uri) {
		if (strpos($uri, Config::ADDRESS) !== false)
			$uri = substr($uri, strlen(Config::ADDRESS));
		if ($uri === "/") return $uri;
		$uri = substr($uri, 1);
		$uri = str_replace(Config::SEF_SUFFIX, "", $uri);
		if (preg_match("/^page-(\d+)$/i", $uri, $matches)) return "/?page=".$matches[1];
		$result = SefDB::getLinkOnAlias($uri);
		if (!$result) {
			$uri = substr($uri, 0, strpos($uri, "?"));
			$result = SefDB::getLinkOnAlias($uri);
		}
		if ($result) return $result;
		return false;
	}
	
}