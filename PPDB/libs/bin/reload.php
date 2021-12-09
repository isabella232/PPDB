<?php
class Reload{
	private function __contruct(){
		#nothing
	}
	public static function run(){
		
		         if(!$_GET['u']){
            echo "<script>setTimeout(function(){window.open('./panel?u=0', '_self')})</script>";
        }else{
            $getNum = intval($_GET['u']) + 1;
            echo "<script>setTimeout(function(){window.open('./panel?u=".$getNum."', '_self')})</script>";
        }
	}
	
}
?>
