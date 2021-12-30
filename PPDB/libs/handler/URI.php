<?php
class URI{
	private function __construct(){
		
	}
	public static function getCurrent(){
		$domin="";
		if(intval($_SERVER['SERVER_PORT']) === 443){
			$domin = "https://";
			$url = $domin . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			return $url;
		}else if(intval($_SERVER['SERVER_PORT']) === 21){
			$domin = "http://";
				$url = $domin . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				return $url;
		}else if(intval($_SERVER['SERVER_PORT']) === 80){
			$domin = "http://";
				$url = $domin . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				return $url;
		}else{
			return "Cannot find correct port " . $_SERVER['SERVER_PORT'];
			}	
		}
	public static function getQuery(){
			$query = $_SERVER['QUERY_STRING'];
			return $query;
	}
	public static function checkValid($URI){
		if(filter_var($URI, FILTER_VALIDATE_URL)){
			return true;
		}else{
			return false;
		}
	}
}
class URIS extends URI{
	private function __construct(){
		# nothing
	}
	public function PUSH_URL(){
		$runner = PPDB::createJSLink("libs/js/pushURI.js?v=0.2");
		return $runner;
	}
}
?>