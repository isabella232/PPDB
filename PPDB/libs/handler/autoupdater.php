<?php
class update{
	private function __construct(){
		
	}
	public static function checkUpdate(){
		$data = file_get_contents("https://raw.githubusercontent.com/surveybuilderteams/PPDB/master/LATEST_VERSION");
		$data = str_replace(array("\r\n","\n","\r"), "", $data);
		return $data;
	}
	public static function compareUpdate($current, $newVersion){
		if($current !== $newVersion){
			return '<span style="color:red">PPDB needs an update to version ('.$current.' > '.$newVersion.')</span>';
		}else{
			return '<span style="color:lime;">PPDB is up-to-date('.$current.')</span>';
		}
	}
}
?>