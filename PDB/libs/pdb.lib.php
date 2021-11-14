<?php
require("defined.php");
require("handler/Exception.php");
require("bin/init.php");
class PDB{
	private function __construct(){
	 #nothing	
	}
	public static function createStorage(){
		#Check if dictionary 
		if(!file_exists(ROOT_DB)){
			mkdir(ROOT.DS."db");
		}else{
			#Nothing
		}
			
		
	}


}


?>