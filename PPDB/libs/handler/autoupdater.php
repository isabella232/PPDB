<?php
class update{
	private function __construct(){
		
	}
	public static function checkUpdate(){
		$data = file_get_contents("https://raw.githubusercontent.com/surveybuilderteams/PPDB/master/LATEST_VERSION");
		$data = str_replace(array("\r\n","\n","\r"), "", $data);
		return $data;
	}
}
?>