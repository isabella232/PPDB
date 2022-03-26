<?php
class Utils{
	protected function __construct(){
		#nothing
	}
	public static function getDS(){
	 if($_SERVER['SERVER_NAME']==="localhost" || $_SERVER['SERVER_NAME']==="128.0.0.1"){
		 return  '\\';
	 }else{
		 return '/';
	 }
	}
	public static function getROOT($name, $data){
		$name = strtoupper($name);
		if($data === '\\'){
			if($name === "ROOT"){
				return constant($name);
			}
			return constant("ROOT_".$name);
		}else{
			if($name === "ROOT"){
				return constant($name."_FORWARD");
			}
			return constant("ROOT_".$name."_FORWARD");
		}
	}
	public static function isPOST($name, $func){
		if(isset($_POST[$name])){
			return $func;
		}
	}
	public static function isGET($name, $func){
		if(isset($_GET[$name])){
			return $func;
		}
	}
	public static function isREQUEST($name, $func){
		if(isset($_request[$name])){
			return $func;
		}
	}
	public static function getPluginAddon($plugin){
		if(file_exists(Utils::getROOT('PLUGIN', Utils::getDS()).$plugin.Utils::getDS().'addon.json')){
			$cont = file_get_contents(Utils::getROOT('PLUGIN', Utils::getDS()).$plugin.Utils::getDS().'addon.json');
			return json_decode($cont, true);
		}else{
			return 'error';
		}
	}
	
	
}
?>