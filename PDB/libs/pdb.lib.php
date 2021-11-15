<?php
require(dirname(__DIR__)."/defined.php");
require("handler/Exception.php");
require("bin/init.php");
class PDB{
	private function __construct(){
	 #nothing	
	}
	public static function userUI(){
		#register
		if(!file_exists(ROOT."user.json")){
			$form = "<form method='post'>";
			$form .= "<h1 class='text-center'>Register</h1>";
			$form .= '  <div class="form-group">';
		$form .= "<input type='text' class='form-control' name='username' required='' id='username' placeholder='Username'/><br/>";
		$form .= "</div>";
		$form .= '  <div class="form-group">';
		$form .= "<input type='password' class='form-control' name='psw' required='' id='psw' placeholder='Password'/><br/>";
		$form .= "</div>";
		$form .= "<input type='submit' class='form-control' value='Register' name='regbtn'/>";
			
		$form .= "</form>";
	
		return $form;
		}else{
			if(!SESSION_USER){
				$form = "<form method='post' action='#'>";
			$form .= "<h1 class='text-center'>Login</h1>";
			$form .= '  <div class="form-group">';
		$form .= "<input type='text' class='form-control' name='username' required='' id='username' placeholder='Username'/><br/>";
		$form .= "</div>";
		$form .= '  <div class="form-group">';
		$form .= "<input type='password' class='form-control' name='psw' required='' id='psw' placeholder='Password'/><br/>";
		$form .= "</div>";
		$form .= "<input type='submit' class='form-control' value='Login' name='logbtn'/>";
			
		$form .= "</form>";
		return $form;
			}
		}
		
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
				$file = fopen(ROOT."user.json", "w+");
				$data = array("user"=>$user, "password"=>$psw);
				$query = json_encode($data);
				fwrite($file, $query);
				fclose($file);
				return "<script>window.location.reload();</script>";
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
	public static function loadPanel(){
		if(SESSION_USER){
			$panel = '<div class="container-fluid panelCon">';
			$panel .= '<div class="heading">
			<h1 class="text-center text-primary">Panel</h1>
			</div>';
			
			$panel .= '</div>';
			return $panel;
		}
	}


}


?>