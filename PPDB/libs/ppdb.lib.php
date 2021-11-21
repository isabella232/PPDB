<?php
require(dirname(__DIR__)."/defined.php");
require("handler/Exception.php");
require("bin/init.php");
require("bin/reload.php");
class PPDB{
	private function __construct(){
	 #nothing	
	}
#Logic
	public static function isNumber($int){
		if(gettype($int) === "double" || gettype($int) === "integer"){
			return true;
		}else{
			return false;
		}
	}
	public static function isString($str){
		if(gettype($str) === "string"){
			return true;
		}else{
			return false;
		}
	}
	public static function isBoolean($bool){
		if(gettype($bool) === "boolean"){
			return true;
		}else{
			return false;
		}
	}
#others
	public static function userUI(){
		#register
		if(!file_exists(ROOT."user.json")){
			$form = "<form method='post' action='#' class='panelForm'>";
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
				$form = "<form method='post' action='#' class='panelForm'>";
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
	
	public static function INSTALL($user, $psw, $host=PPDB_CONNECT){
		$pass = 1;
		try{
			if($host !== PPDB_CONNECT){
				throw new PPDBErr($host);
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
				Reload::run();
			}
		}
		
		
		
	}
	public static function PSW_ENCRYPT($psw){
			$psw = hash("gost", $psw);
			$psw = hash("sha1", $psw);
			$psw = hash("md5", $psw);
			$psw = hash("crc32b", $psw);
			$psw = hash("ripemd128", $psw);
			return $psw;
	}
	public static function createStorage(){
		#Check if dictionary 
		if(!is_dir(ROOT.DS."db")){
			mkdir(ROOT.DS."db");
		}else{
			
		}
	}
	public static function Encrypt($data, $cipher_algo, $passphrase, $options = 0, $iv = "", $tag = null, $aad = "", $tag_length = 16){
		return openssl_encrypt($data, $cipher_algo, $passphrase, $options, $iv, $tag, $aad, $tag_length);	
	}
	public static function Decrypt($data, $cipher_algo, $passphrase, $options = 0, $iv = "", $tag = null, $aad = ""){
		return openssl_decrypt($data, $cipher_algo, $passphrase, $options, $iv, $tag, $aad);	
	}
	
	public static function loadPanel(){
		if(SESSION_USER){
			$panel = '<div class="container-fluid panelCon">';
			$panel .= '<div class="heading">
			<h1 class="text-center text-primary">Panel</h1>
			<form method="post">
			<input type="submit" name="logoutbtn" class="btn btn-danger logoutbtn" value="Logout"/>
			</form>
			</div>';
			$panel.= '<div class="panel-nav">
			<nav class="nav-con">
			<a href="#" class="nav-list" title="Table">Table</a>
			<a href="#" class="nav-list" title="Query">Query</a>
			</nav>
			</div>';
			$panel .= '</div>';
			return $panel;
		}
	}
	
	#Stylesheet
	public static function COLOR($r, $g, $b, $a=1){
		
		try{
			if(!PPDB::isNumber($r)){
				throw new PPDBErr($r);
			}
		}catch(PPDBErr $e){
			echo $e->isNotNumber();
			return false;
		}
		try{
			if(!PPDB::isNumber($g)){
				throw new PPDBErr($g);
			}
		}catch(PPDBErr $e){
			echo $e->isNotNumber();
			return false;
		}
		try{
			if(!PPDB::isNumber($g)){
				throw new PPDBErr($g);
			}
		}catch(PPDBErr $e){
			echo $e->isNotNumber();
			return false;
		}
		try{
			if(!PPDB::isNumber($a)){
				throw new PPDBErr($a);
			}
		}catch(PPDBErr $e){
			echo $e->isNotNumber();
			return false;
		}

		
		
		return 'color:rgba('.$r.', '.$g.', '.$b.', '.$a.');';
		
	}
	
	public static function BOLD(){
		return 'font-weight:bold;';
	}
	
	public static function ITALIC(){
		return 'font-style:italic;';
	}
	public static function SIZE($size){
		try{
			if(!PPDB::isNumber($size)){
				throw new PPDBErr($size);
			}
		}catch(PPDBErr $e){
			echo $e->isNotNumber();
			return false;
		}
		return 'font-size:'.$size.'px;';
	}

	public static function ALIGN($align){
		try{
			if(gettype($align) !== "string"){
				throw new PPDBErr($align);
			}
		}catch(PPDBErr $e){
			echo $e->isNotString();
			return false;
		}
		return 'text-align: '.$align.';';
	}
	public static function TXTRANS($transform){
		try{
			if(gettype($transform) !== "string"){
				throw new PPDBErr($transform);
			}
		}catch(PPDBErr $e){
			echo $e->isNotString();
			return false;
		}
		return 'text-transform: '.$transform.';';
		
	}
	
	#Events
	public static function logout(){
		if(isset($_POST['logoutbtn'])){
			session_unset();
		Reload::run();
		}
		
	}

}


?>
