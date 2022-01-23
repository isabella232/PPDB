<?php
if(session_status() === PHP_SESSION_NONE || session_id() == ''){
	session_start();
}
require("handler/autoupdater.php");
require(dirname(__DIR__)."/defined.php");
require("handler/Exception.php");
require("handler/removeFileFolder.php");
require("handler/ReturnfileSize.php");
require("handler/URI.php");
require("bin/init.php");
require("bin/reload.php");
require("bin/logic.php");
require("classes/class.query.php");
require("classes/class.mysql.php");
class PPDB{

	private function __construct(){
	 #nothing	
	}
public static function userUI($dir){
		#register
		if(!file_exists($dir."user.json")){
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
	
	
	
	public static function INSTALL($dir, $user, $psw, $host=PPDB_CONNECT){
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
			$psw = password_hash($psw, PASSWORD_BCRYPT, ["cost"=>12]);
		
			if(!file_exists($dir."user.json")){
				$file = fopen($dir."user.json", "w+");
				$data = array("user"=>$user, "password"=>$psw);
				$query = json_encode($data);
				fwrite($file, $query);
				fclose($file);
				Reload::run();
			}
		}
		
		
		
	}
	public static function CHECK_VALID_PASSWORD($psw, $min_length=8, $max_length=25, $include_lower_str=true, $include_upper_str=true, $include_int=true, $include_symbol=true){
		try{
			if(!PPDBLogic::isString($psw)){
				throw new PPDBErr($psw);
			}
		}catch(PPDBErr $e){
			$e->isNotString();
			return false;
		}
		try{
			if(!PPDBLogic::isNumber($min_length)){
				throw new PPDBErr($min_length);
			}
		}catch(PPDBErr $e){
			$e->isNotNumber();
			return false;
		}
		try{
			if(!PPDBLogic::isNumber($max_length)){
				throw new PPDBErr($max_length);
			}
		}catch(PPDBErr $e){
			$e->isNotNumber();
			return false;
		}
		try{
			if(!PPDBLogic::isBoolean($include_lower_str)){
				throw new PPDBErr($include_lower_str);
			}
		}catch(PPDBErr $e){
			$e->isNotBoolean();
			return false;
		}
		try{
			if(!PPDBLogic::isBoolean($include_upper_str)){
				throw new PPDBErr($include_upper_str);
			}
		}catch(PPDBErr $e){
			$e->isNotBoolean();
			return false;
		}
		try{
			if(!PPDBLogic::isBoolean($include_int)){
				throw new PPDBErr($include_int);
			}
		}catch(PPDBErr $e){
			$e->isNotBoolean();
			return false;
		}
		try{
			if(!PPDBLogic::isBoolean($include_symbol)){
				throw new PPDBErr($include_symbol);
			}
		}catch(PPDBErr $e){
			$e->isNotBoolean();
			return false;
		}
		
		if($min_length >= 6 && $max_length > $min_length){
			try{
				if(strlen($psw) < $min_length){
					throw new PPDBErr("<span style='color:red;'>Password:".$psw . " | is to short</span>");
				}
			}catch(PPDBErr $e){
				echo $e->passwordToShort();
				return false;
			}
			try{
				if(strlen($psw) > $max_length){
					throw new PPDBErr("<span style='color:red;'>Password:".$psw . " | is to long</span>");
				}
			}catch(PPDBErr $e){
				echo $e->passwordToLong();
				return false;
			}
		}
		 if($include_lower_str){
			try{
				if(!preg_match("/(?=[a-z])/", $psw)){
					throw new PPDBErr("<span style='color:red;'>".$psw . " must include lowercase letter</span>");
				}
			}catch(PPDBErr $e){
				echo $e->regexpErr();
				return false;
			}
		}
		 if($include_upper_str){
			try{
				if(!preg_match("/(?=[A-Z])/", $psw)){
					throw new PPDBErr("<span style='color:red;'>".$psw . " must include uppercase letter</span>");
				}
			}catch(PPDBErr $e){
				echo $e->regexpErr();
				return false;
			}
		}
		 if($include_int){
			try{
				if(!preg_match("/(?=[0-9])/", $psw)){
					throw new PPDBErr("<span style='color:red;'>".$psw . " must include number(s)</span>");
				}
			}catch(PPDBErr $e){
				echo $e->regexpErr();
				return false;
			}
		}
		 if($include_int){
			try{
				if(!preg_match("/(?=[0-9])/", $psw)){
					throw new PPDBErr("<span style='color:red;'>".$psw . " must include number(s)</span>");
				}
			}catch(PPDBErr $e){
				echo $e->regexpErr();
				return false;
			}
		}
		 if($include_symbol){
			try{
				if(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $psw)){
					throw new PPDBErr("<span style='color:red;'>".$psw . " must include symbols</span>");
				}
			}catch(PPDBErr $e){
				echo $e->regexpErr();
				return false;
			}
		}
		
			return true;
	}
	public static function PSW_ENCRYPT($psw){
			$psw = password_hash($psw, PASSWORD_BCRYPT, ["cost"=>12]);
			return $psw;
	}
	public static function PSW_VARIFY($psw, $checkPsw){
		if(password_verify($psw, $checkPsw)){
			return true;
		}else{
			return false;
		}
	}
	public static function CHANGE_PSW($dir, $old, $new){
		$get = file_get_contents($dir."user.json");
		$d = json_decode($get);
		try{
			if(!PPDBLogic::isString($dir)){
				throw new PPDBErr($dir);
			}
		}catch(PPDBErr $e){
			echo $e->isNotString();
		}
		try{
			if(!PPDBLogic::isString($old)){
				throw new PPDBErr($old);
			}
		}catch(PPDBErr $e){
			echo $e->isNotString();
		}
		try{
			if(!PPDBLogic::isString($new)){
				throw new PPDBErr($new);
			}
		}catch(PPDBErr $e){
		echo $e->isNotString();
		}
		try{
			if(!PPDB::PSW_VARIFY($old, $d->password)){
			throw new PPDBErr('<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">The Old Password does not match.<p>');
		}
		}catch(PPDBErr $e){
			echo $e->passwordNotMatches();
			return false;
		}
	
		
		
		$update = '{"user": "'.$d->user.'", "password": "'.PPDB::PSW_ENCRYPT($new).'"}';
		$data = fopen($dir."user.json", "w+");
		fwrite($data, $update);
		fclose($data);
	}
		public static function minify($a, $allowWS=false){
        	$min = preg_replace("(\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+)", "", $a); //remove block comments
		$min = preg_replace("(\<!--(.|\n)*?-->)", "", $min); //remove <!--.--> comments
		$min = preg_replace("(\/\/.*)", "", $min); //remove single line
        if(preg_match("(\"\#.*\")", $min) || preg_match("(=> \#.*)", $min)){

        }else{
        $min = preg_replace("(\#.*)", "", $min); //hashtag comment
        }
        if($allowWS === INCLUDE_WHITESPACE){
            	$min = str_replace(array("\n","\r","\r\n"), "", $min);
        }else{
	        $min = str_replace(array("\n","\r","\r\n", " "), "", $min);
        }
		$min = str_replace("<br/>", " ", $min);
		return $min;
	}
public static function rawText($str){
        return htmlspecialchars($str);
    }
    public static function encodeText($str){
        return htmlspecialchars_decode($str);
    }
	
	public static function createStorage($dir){
		#Check if dictionary 
		if(!is_dir($dir."db")){
			mkdir($dir."db");
		$deny = fopen($dir.".htaccess");
			fwrite($deny, "Deny from all");
			fclose($deny);
		}else{
			
		}
	}
	public static function removeStorage($dir, $Slash){
		#Check if dictionary 
		if(is_dir($dir."db")){
			removerDirFile($dir."db".$Slash);
		}else{
			
		}
	}
	
	public static function createDB($dir, $name, $arr){
			try{
				if(!PPDBLogic::isString($name)){
					throw new PPDBErr($name);
				}
			}catch(PPDBErr $e){
				echo $e->isNotString();
				return false;
			}
			try{
				if(!PPDBLogic::isArray($arr)){
					throw new PPDBErr($arr);
				}
			}catch(PPDBErr $e){
				echo $e->isNotArray();
				return false;
			}
			
			$encode = json_encode($arr);
			$file = fopen($dir.$name.".json", "w+");
			fwrite($file, $encode);
			fclose($file);
			
	}
	public static function removeDB($dir, $name){
		try{
				if(!PPDBLogic::isString($name)){
					throw new PPDBErr($name);
				}
			}catch(PPDBErr $e){
				echo $e->isNotString();
				return false;
			}
		try{
			if(!unlink($dir.$name.".json")){
				throw new PPDBErr($dir.$name.".json");
			}
		}catch(PPDBErr $e){
			echo $e->fileNotFound();
			return false;
		}	
	}
	public static function renameDB($dir, $oldName, $newName){
			try{
				if(!PPDBLogic::isString($oldName)){
					throw new PPDBErr($oldName);
				}
			}catch(PPDBErr $e){
				echo $e->isNotString();
				return false;
			}
				try{
				if(!PPDBLogic::isString($newName)){
					throw new PPDBErr($newName);
				}
			}catch(PPDBErr $e){
				echo $e->isNotString();
				return false;
			}
			
			try{
				if(!rename($dir.$oldName.".json", $dir.$newName.".json")){
					throw new PPDBErr($dir.$oldName.".json" . " > " . $dir.$newName.".json");
				}
			}catch(PPDBErr $e){
				echo $e->isNotRenamed();
				return false;
			}
			
	}
	public static function infoDB($dir, $name, $info=FILE_INFO){
		try{
				if(!PPDBLogic::isString($name)){
					throw new PPDBErr($name);
				}
			}catch(PPDBErr $e){
				echo $e->isNotString();
				return false;
			}
		try{
				if(!PPDBLogic::isArray($info)){
					throw new PPDBErr($info);
				}
			}catch(PPDBErr $e){
				echo $e->isNotArray();
				return false;
			}
		return array("created"=>date("F d Y H:i:s", filectime($dir.$name.".json")),"updated"=>date ("F d Y H:i:s", filemtime($dir.$name.".json")),"size"=>sizeFormat(filesize($dir.$name.".json")), "type"=>"json");
	}
	
	public static function JSONTOARRAY($JSON){
		try{
			if(!PPDBLogic::isString($JSON)){
				throw new PPDBErr($JSON);
			}
		}catch(PPDBErr $e){
			$e->isNotString();
			return false;
		}
		$JSON = str_replace(array("\r\n", "\n", "\r"), "", $JSON);
		return json_decode($JSON, true);
	}
	public static function ARRAYTOJSON($ARRAY){
		try{
			if(!PPDBLogic::isArray($ARRAY)){
				throw new PPDBErr($ARRAY);
			}
		}catch(PPDBErr $e){
			$e->isNotArray();
			return false;
		}
		return json_encode($ARRAY);
	}
	
	
	
	
	public static function Encrypt($data, $cipher_algo, $passphrase, $options = 0, $iv = "", $tag = null, $aad = "", $tag_length = 16){
		return openssl_encrypt($data, $cipher_algo, $passphrase, $options, $iv, $tag, $aad, $tag_length);	
	}
	public static function Decrypt($data, $cipher_algo, $passphrase, $options = 0, $iv = "", $tag = null, $aad = ""){
		return openssl_decrypt($data, $cipher_algo, $passphrase, $options, $iv, $tag, $aad);	
	}
	
	public static function loadPanel(){
		$READER = new query();
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
			<form method="post">
			<a href="./panel?type=storage" class="nav-list storageTab" title="Storage"><input type="submit" name="store" value="Storage"/></a>
			<span class="seperator">|</span>
			<a href="./panel?type=db" class="nav-list dbTab" title="Database"><input type="submit" name="db" value="DataBase"/></a>
			<span class="seperator">|</span>
			<a href="./panel?type=table" class="nav-list tableTab" title="Table Viewer"><input type="submit" name="table" value="Table"/></a>
			<span class="seperator">|</span>
			<a href="./panel?type=mysql" class="nav-list sqlTab" title="Import mySQL"><input type="submit" name="mySQL" value="Import mySQL"/></a>
			<span class="seperator">|</span>
			<a href="./panel?type=delete+accunt" class="nav-list deleteAccount" title="Delete Account"><input type="submit" name="delteAccount" value="Delete Account"/></a>
			<span class="seperator">|</span>
			<a href="./panel?type=change+password" class="nav-list changePassword" title="Change Password"><input type="submit" name="changePassword" value="Change Password"/></a>
			</form>
			</nav>
			</div>';
			$panel .= '</div>';
			return $panel;
		}
	}
	
	#Stylesheet
	public static function COLOR($r, $g, $b, $a=1){
		
		try{
			if(!PPDBLogic::isNumber($r)){
				throw new PPDBErr($r);
			}
		}catch(PPDBErr $e){
			echo $e->isNotNumber();
			return false;
		}
		try{
			if(!PPDBLogic::isNumber($g)){
				throw new PPDBErr($g);
			}
		}catch(PPDBErr $e){
			echo $e->isNotNumber();
			return false;
		}
		try{
			if(!PPDBLogic::isNumber($g)){
				throw new PPDBErr($g);
			}
		}catch(PPDBErr $e){
			echo $e->isNotNumber();
			return false;
		}
		try{
			if(!PPDBLogic::isNumber($a)){
				throw new PPDBErr($a);
			}
		}catch(PPDBErr $e){
			echo $e->isNotNumber();
			return false;
		}

		
		
		return 'color:rgba('.$r.', '.$g.', '.$b.', '.$a.');';
		
	}
	public static function createPanelCSS(){
		return '<style>	*{ margin:0; padding:0; } 
			body{ background-color:rgb(105, 106, 105); } 
			.heading{
				width:100%;
			}
			.panelForm{ width:50%; height:50%; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); background-color: rgb(0, 167, 232); } 
			h1{ font-size:52px; color:rgb(115, 234, 7); } 
			.panelCon{ background-color:rgba(16, 213, 5, 0.5); } 
			.logoutbtn{ position:absolute; top:0; right:0; font-size:32px; }
			.panel-header{width:100%;}
			.nav-con{
				background-color:rgb(3, 252, 218);
				width:100%;
			}
			.nav-con input[type=submit]{
				background-color:transparent;
				border:0;
				color:yellow;
			}
			.nav-con a{
				text-decoration:none;
				font-size:32px;
				margin-right:8px;
				color:rgb(255, 213, 0);
				font-weight: bold;
			}
			.seperator{
				font-size:32px;
				color:yellow;
				marign-left:5px;
				margin-right: 5px;
			}
			/*Table*/

            /*Search*/
            input[type=search] {
                  padding: 6px;
                     margin-top: 8px;
                    font-size: 17px;
                 border: 1px solid #ccc;  
                 width:50%;
                 outline:none;
                }
			</style>';
	}
	public static function createCSSLink($url, $inter="", $crossorigin=""){
		return '<link href="'.$url.'" rel="stylesheet" integrity="'.$inter.'" crossorigin="'.$crossorigin.'"/>';
	}
	public static function createCSS($CSS){
		return '<style>'.$CSS."</style>";
	}
	
	public static function createJSLink($url, $onLoad=true, $integrity="", $crossorigin="", $referrerpolicy=""){
		if($onLoad){
			return '<script src="'.$url.'" type="text/javascript" defer integrity="'.$integrity.'" crossorigin="'.$crossorigin.'" referrerpolicy="'.$referrerpolicy.'"></script>';
		}else{
				return '<script src="'.$url.'" type="text/javascript" async integrity="'.$integrity.'" crossorigin="'.$crossorigin.'" referrerpolicy="'.$referrerpolicy.'"></script>';
		}
		
	}
	public static function createJS($JS, $id, $onLoad=true){
		if($onLoad){
			return '<script id="'.$id.'" type="text/javascript" defer>'.$JS.'</script>';
		}else{
			return '<script id="'.$id.'" type="text/javascript" async>'.$JS.'</script>';
		}
	}
	
	public static function BOLD(){
		return 'font-weight:bold;';
	}
	
	public static function ITALIC(){
		return 'font-style:italic;';
	}
	public static function SIZE($size){
		try{
			if(!PPDBLogic::isNumber($size)){
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
		try{
			if($align !== "justify" && $align !== "left" && $align !== "center" && $align !== "right"){
				throw new PPDBErr($align);
			}
		}catch(PPDBErr $e){
			echo $e->isNotAlign();
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
	public static function checkDeletedFile($dir){
		if(!file_exists($dir.'user.json') && SESSION_USER){
		session_unset();
		Reload::run();
		return true;
       }else{
		   return false;
	   }
	}
	public static function deleteAccount($dir){
		if(!unlink($dir."user.json")){
			session_unset();
			Reload::run();
		}else{
			
		}
	}
	public static function removeSource($url){
		$src = str_replace(dirname(__FILE__), ".", $url);
		return $src;
	}


}


?>
