<?php
require(dirname(__DIR__)."/defined.php");
require("handler/Exception.php");
require("bin/init.php");
class PDB{
	private function __construct(){
	 #nothing	
	}
	public static function INSTALL($user, $psw, $host=PDB_CONNECT){
		$pass = 1;
		try{
			if($host !== PDB_CONNECT){
				throw new PDBErr($host);
			}
		}catch(PDBErr $e){
			echo $e->CONNECT_ERR();
			$pass = 0;
		}
		if($pass == 1){
			$psw = hash("gost", $psw);
			$psw = hash("sha1", $psw);
			$psw = hash("md5", $psw);
			$psw = hash("crc32b", $psw);
			$psw = hash("ripemd128", $psw);
			if(!file_exists(ROOT."user.json")){
				
				
			}
		}
		
		
		
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