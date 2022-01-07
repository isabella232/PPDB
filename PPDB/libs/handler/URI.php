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
	private static function __construct(){
		# nothing
	}
	public static function config($URIS, $cS){
		try{
			if(!PPDBLogic::isString($URIS)){
				throw new PPDBErr($URIS);
			}
		}catch(PPDBErr $e){
			echo $e->isNotString();
			return false;
		}
		try{
			if(!PPDBLogic::isArray($cS)){
				throw new PPDBErr($cS);
			}
		}catch(PPDBErr $e){
			echo $e->isNotArray();
			return false;
		}
		
		
		if($URIS === "bbcolor"){
			try{
			if(!PPDBLogic::hasConfigLength($cS, 2)){
				throw new PPDBErr('BBCOLOR config must have <b>2</b> pramater you have <b>'.count($cS).'</b>');
			}
		}catch(PPDBErr $e){
			echo $e->HAS_CONFIG_LENGHT_FAIL();
			return false;
		}
				function BGColor($color, $sel){
		$runner = PPDB::createJSLink("libs/js/bgcolor.js?v=0.2");
		$runner .= PPDB::createJS('setTimeout(function(){bgcolor("'.$color.'", "'.$sel.'")}, 100);', '');
		return $runner;
			}
			return BGColor($cS[0], $cS[1]);
		}
			
		}
		
	 
}
?>
