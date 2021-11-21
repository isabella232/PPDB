<?php
class Reload{
	private function __contruct(){
		#nothing
	}
	public static function run(){
		$data = $_GET['u'];
		
		if(isset($data) || $data  === $data){
			header("Refresh:0");
			exit;
		}
	}
	
}
?>
