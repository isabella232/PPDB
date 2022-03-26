# PHP Program DataBase(PPDB) 
  
### What is this?

A PHP Program DataBase or PPDB is a simplified version of SQLi. This uses JSON files as a database with 
inclusive security. Along with a admin panel that will require a login/register prompt. Secure
any database if you have SSL(secured socket layer) and more...

[![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/surveybuilderteams/PPDB?color=red&label=Version)](https://surveybuilder.epizy.com/projects/PPDB/PPDB_Build/panel "SurveyBuilderTeams-PPDB")
[![GitHub all releases](https://img.shields.io/github/downloads/surveybuilderteams/PPDB/total?color=blue&label=Downloads)](https://github.com/surveybuilderteams/PPDB/archive/refs/heads/master.zip)
***

### Images

[![Panel_Register](https://github.com/surveybuilderteams/PPDB/blob/master/img/RegisterPanel.png "Panel Register")](https://github.com/surveybuilderteams/PPDB/blob/master/img/RegisterPanel.png)

[![Panel_Login](https://github.com/surveybuilderteams/PPDB/blob/master/img/loginPanel.png "Panel Login")](https://github.com/surveybuilderteams/PPDB/blob/master/img/loginPanel.png)

[![Panel](https://github.com/surveybuilderteams/PPDB/blob/master/img/Panel.png "Panel")](https://github.com/surveybuilderteams/PPDB/blob/master/img/Panel.png)

***
 
### How to install?

In your code enter this line of code:
```php
PPDB::Install($dir, $username, $password);
```
or if `panel.php` use the register/login prompt

$dir = `DS` or `DS_FORWARD`


### How to use?

In your codes enter this line of code what is going to require codes
```html
<?php
 require('./libs/ppdb.lib.php');
?>
<html>
<head>
<title>PPDB - Panel</title>
</head>
<body>
...
</body>
</html>
```

or

You can use our `panel.php` as a baseplate of plugins and other database extentions for non-developers

***

# Developer tools
This can be used as a `Developer tools` This is also be a documentation as well...

***

## Defined variables(defined.php) 

L = Localhost | D = Domain
| Define | output | Allow |
| ------ | ------ | ----- |
| DS     |  "\\"   | L |
| DS_FORWARD | "/" | D |
| ROOT | dirname( __ FILE __ ).DS | L |
| ROOT_FORWARD | dirname( __ FILE __ ).DS_FORWARD | D |
| ROOT_DB | dirname( __ FILE __ ).DS."db".DS | L |
| ROOT_DB_FORWARD | dirname( __ FILE __ ).DS_FORWARD."db".DS_FORWARD | D |
| ROOT_TEMP | dirname( __ FILE __ ).DS."libs".DS."temp".DS | L |
| ROOT_TEMP_FORWARD | dirname( __ FILE __ ).DS_FORWARD."libs".DS_FORWARD."temp".DS_FORWARD | D |
| DOC_ROOT | $_SERVER['DOCUMENT_ROOT'] | D |
| DOC_ROOT_BACKWARDS | str_replace("/","\\", $_SERVER['DOCUMENT_ROOT']) | L |
| PPDB_CONNECT | $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] | D & L |
| PPDB_SERVER_NAME | $_SERVER['SERVER_NAME'] | D & L |
| PPDB_SERVER_PORT | $_SERVER['SERVER_PORT'] | D & L |
| SESSION_USER | $_SESSION['username'] | D & L |
| JUSTIFY | justify | D & L |
| LEFT | left | D & L |
| CENTER | center | D & L |
| RIGHT | right | D & L |
| CAPITALIZE | capitalize | D & L |
| UPPERCASE | uppercase | D & L |
| LOWERCASE | lowercase | D & L |
| FILE_INFO | ["created", "updated", "size", "type"] | D & L |
| VIEW_ALL | -1 | D & L |
| BGCOLOR | bgcolor `URIS usage only` | D & L |
| PREVIEW_IMG | previewImg `URIS usage only` | D & L |
| PREVIEW_VID | previewVid `URIS usage only` | D & L | 
| INCLUDE_WHITESPACE | true | D & L |
| ROOT_HISTORY | dirname( __ FILE __ ).DS."libs".DS."history".DS | L |
| ROOT_HISTORY_FORWARD | dirname( __ FILE __ ).DS_FORWARD."libs".DS_FORWARD."history".DS_FORWARD | D |
| ROOT_DATA |  dirname( __ FILE __ ).DS."libs".DS."data".DS | L |
| ROOT_DATA_FORWARD | dirname( __ FILE __ ).DS_FORWARD."libs".DS_FORWARD."data".DS_FORWARD | D |
| ROOT_UPLOAD | dirname( __FILE__ ).DS."libs".DS."uploads".DS | L |
| ROOT_UPLOAD_FORWARD | dirname( __FILE __ ).DS_FORWARD."libs".DS_FORWARD."uploads".DS_FORWARD | D |
| ROOT_PLUGIN | dirname( __ FILE __ ).DS."libs".DS."plugins".DS | L |
| ROOT_PLUGIN_FORWARD |  dirname( __ FILE __ ).DS_FORWARD."libs".DS_FORWARD."plugins".DS_FORWARD | D |
| ROOT_THEME | dirname( __ FILE __ ).DS."libs".DS."themes".DS | L |
| ROOT_THEME_FORWARD | dirname( __ FILE __ ).DS_FORWARD."libs".DS_FORWARD."themes".DS_FORWARD | D |
***

## Defined Variables(init.php)
| Define | Default | changable | type |
| ------ | ------ | --------- | ---- |
| LIBRARY_NAME | PPDB | :x: | string |
| LIBRARY_VERSION | {YOUR_CURRENT_VERSION} | :heavy_check_mark: | string |
| LIBRARY_API | [1] | :x: | array |
| LIBRARY_SSL_SUPPORT | true | :heavy_check_mark: | boolean |
| LIBRARY_LICENCE | Apache-2.0 License | :x: | string |
| LIBRARY_AUTHOR | SurveyBuilderTeams | :x: | string |
| LIBRARY_AUTOUPDATE | true | :heavy_check_mark: | boolean |
| LIBRARY_BUILD | 220325 | :x: | boolean |
| LOGIN_TEMP | 3 | :heavy_check_mark: | int |
| DEBUG_MODE | FALSE | :heavy_check_mark: | boolean |

## PDDB FUNCTIONS

### 1. Creating/Removing storage
Creating storage is the first step, this will make it easier to store data, by your custom name of file, folder will always be `db`

Creating:
```php
PPDB::createStorage($dir)
```
Removing:
```php
PPDB::removeStorage($dir, $Slash);
```

`$dir` can be either `ROOT` or `ROOT_FORWARD` 

`$Slash` can be eaither `DS` or `DS_FORWARD`

### 2. User UI(only Panel use)
This line of code only works for panel uses aka: `panel.php`

Build prompt/panel (`panel.php`):
```php
<?php 
session_start();
 
require('libs/ppdb.lib.php');
 ?>
<html>
	<head>
		<title>Panel -
			<?php echo $_SERVER['HTTP_HOST'];?>
</title>
<!--Javascript-->
<?php
echo PPDB::createJSLink("https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js");
?>

		<!-- CSS only -->
			<?php
			echo PPDB::createCSSLink("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css","sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3", "anonymous");
			echo PPDB::createCSSLink("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css");
			echo PPDB::createCSSLink("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css");
			echo PPDB::createPanelCSS();
			?>
		</head>
		<body>
			<?php
			/*runner*/
echo PPDB::userUI(Utils::getROOT('ROOT',Utils::getDS()));
PPDB::checkDeletedFile(Utils::getROOT('ROOT',Utils::getDS()));
if(isset($_POST['regbtn'])){
		$username = $_POST['username'];
		$psw = $_POST['psw'];
		# Password, min, max, lower, upper, number, symbols
		if(PPDB::CHECK_VALID_PASSWORD($psw, 8, 20, true, true, true, false)){
			PPDB::INSTALL(Utils::getROOT('ROOT',Utils::getDS()), $username, $psw);
		$_SESSION['username'] = $username;
		}
	}
	if(!isset($_COOKIE['ppdb_session_temp'])){
	 setcookie('ppdb_session_temp', 0, time() + (3600 * 5), "/"); //expires in 5 hour
	}else{
	$temps = $_COOKIE['ppdb_session_temp'];
	}
	if(isset($_POST['logbtn'])){
		$username = $_POST['username'];
		$psw = $_POST['psw'];
		$json = file_get_contents(Utils::getROOT('ROOT',Utils::getDS())."user.json");
		$query = json_decode($json);
		if($username === $query->user && PPDB::PSW_VARIFY($psw, $query->password)){
			$_SESSION['username'] = $username;
				$file = fopen(Utils::getROOT("HISTORY", Utils::getDS()).count(array_diff(scandir(Utils::getROOT("HISTORY", Utils::getDS())), [".", ".."])).'.json', 'w+');
				fwrite($file,'{"loggedinUser":"'.$username.'","loggedinTime":"'.date("Y/m/d")."T".date("H:i:s").'", "loggedinIP":"'.PPDB::GETIP().'"}');
				fclose($file);
				chmod(Utils::getROOT("HISTORY", Utils::getDS()).count(array_diff(scandir(Utils::getROOT("HISTORY", Utils::getDS())), [".", ".."])).'.json', 0600);
			
				Reload::run();
		}else{
			if(floatval($_COOKIE['ppdb_session_temp']) < LOGIN_TEMP){
		setcookie('ppdb_session_temp', floatval($_COOKIE['ppdb_session_temp'])+1, time() + (3600 * 1), "/"); //expires in 1 hour
			echo PPDB::failed("Error: cannot login correctly! ".LOGIN_TEMP-floatval($_COOKIE['ppdb_session_temp']) ." attemps left");
			}else{
		setcookie('ppdb_session_temp', floatval($_COOKIE['ppdb_session_temp'])+1, time() + (86400 * 1), "/"); //expires in 1 day
		echo PPDB::failed("Error: cannot login correctly and logged in to many times! Try again tomorrow.");
		Reload::run();
			}
		
		}
		
	}
	
	echo PPDB::loadPanel();
	echo PPDB::logout();
	
	# Storage
	if(isset($_POST['store']) && SESSION_USER){
		echo "<br/><br/><form method='post'>
		<input type='submit' class='btn btn-success' value='Create Storage' name='cs'/><br/><br/>
		<input type='submit' class='btn btn-danger' value='Remove Storage' name='rs'/>
		</form>";
				echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?plugin).*/)){
			getUrl = getUrl.replace(/(\?plugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
		echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?savePlugin).*/)){
			getUrl = getUrl.replace(/(\?savePlugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
	}
		if(isset($_POST['cs'])){
			if(!PPDBLogic::storageExists(Utils::getROOT('ROOT',Utils::getDS()))){
				PPDB::createStorage(Utils::getROOT('ROOT',Utils::getDS()));
		echo PPDB::success("Storage created");	
		}else{
		echo PPDB::failed("Storage already exists.");	
		}
		}
		if(isset($_POST['rs'])){
		if(PPDBLogic::storageExists(Utils::getROOT('ROOT',Utils::getDS()))){
		PPDB::removeStorage(Utils::getROOT('ROOT',Utils::getDS()), Utils::getDS()); # ROOT/ROOT_FORWARD || DS/DS_FORWARD
		echo PPDB::success("Storage Removed.");	
		}else{
		echo PPDB::failed("Storage does not exist.");	
		}
		
			
		}
	/* Database */
	
	if(isset($_POST['db']) && SESSION_USER){
			echo "<br/><br/><form method='post'>
			<select name='dbname' class='form-control' require>
			";
			$getDb = array_values(array_diff(scandir(Utils::getROOT("DB", Utils::getDS())),[".", ".."]));
			foreach($getDb as $db){
				if($db !== ".htaccess") 
					echo "<option value='".str_replace(".json","",$db)."'>".str_replace(".json","",$db)."</option>";
			}
			echo "
			</select><br/>
			<br/>
			<input type='text' class='form-control' placeholder='Replace Name(use only replacing name)' name='dbvrename'/><br/>
			<br/>
			<input type='text' class='form-control' placeholder='Enter Table Name' onchange='writeTable(this.value)' name='tbname' require/><br/>
			<br/>
			<textarea class='form-control' placeholder='Enter JSON code' id='dbarr' name='dbarr' style='margin-left:5px;width:60%;height:40%;'></textarea>
			<br/>
			<br/>
			<input type='submit' class='btn btn-primary' value='Create/Update' name='dbsubmit'/><br/><br/>
			<input type='submit' class='btn btn-danger' class='btn' value='Remove' name='dbremove'/><br/><br/>
			<input type='submit' class='btn btn-warning' value='Rename' name='dbrename'/><br/><br/>
			<input type='submit' class='btn btn-info' value='Info' name='dbinfo'/><br/><br/>
			<input type='submit' class='btn btn-dark' value='Export as JSON' name='exportasjson'/><br/><br/>
			<input type='submit' class='btn btn-light' value='Export as PHP_ARRAY' name='exportasphp_array'/><br/><br/>
		</form>
			<a href='./panel?savePlugin=backup&createBackup=true'><button type='button' class='btn btn-success'>Backup DB</button></a>
	"; 
		echo '<br/><h1>Backup\'s</h1><ul class="list-group">';
		if(is_dir(Utils::getROOT("DOC", Utils::getDS()).'ppdb_backup'.Utils::getDS())){
			$backup = array_values(array_diff(scandir(Utils::getROOT("DOC", Utils::getDS()).'ppdb_backup'.Utils::getDS()),[".",".."]));
		foreach($backup as $bk){
			echo '<li class="list-group-item list-group-item-action">'.$bk.' <a href="'.Utils::getDS().'ppdb_backup'.Utils::getDS().$bk.'"><button type="button" class="btn btn-secondary"><i class="fa-solid fa-download"></i></button></a><a href="./panel?savePlugin=backup&backupname='.$bk.'"><button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></a></li>';
		}
		}
		echo '</ul>';
		echo "<hr style=' border: 10px solid cyan;border-radius: 5px;'/>
		<br/>
		<form method='post' enctype='multipart/form-data'>
		<h5>Upload exported JSON file</h5>
			<input type='file' class='form-control' required class='form-group' name='reg_db_import'/>
			<br/><br/>
			<input type='submit' class='btn btn-success' value='Upload JSON fie' name='upload_reg_import'/>
			</form>";
				echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?plugin).*/)){
			getUrl = getUrl.replace(/(\?plugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
		echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?savePlugin).*/)){
			getUrl = getUrl.replace(/(\?savePlugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
	}
	if(isset($_GET['savePlugin']) && isset($_GET['backupname'])){
		if(file_exists(Utils::getROOT('DOC', Utils::getDS()).'ppdb_backup'.Utils::getDS().$_GET['backupname'])){
			if(unlink(Utils::getROOT('DOC', Utils::getDS()).'ppdb_backup'.Utils::getDS().$_GET['backupname'])){
				echo Plugin::deleteRedirect($_GET['backupname']);
			}
		}
	}
	if(isset($_POST['upload_reg_import'])){
		$target_dir = "db/";
$target_file = $target_dir . preg_replace("/\d{4}-\d{2}-\d{2}-/",'',basename($_FILES["reg_db_import"]["name"]));
$uploadOk = 1;
$extend = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if (file_exists($target_file)) {
  echo PPDB::failed("Sorry, ".$target_file." already exists.");
  $uploadOk = 0;
}
if($extend != "json") {
  echo PPDB::failed("Sorry, only JSON files are allowed.");
  $uploadOk = 0;
}
if ($uploadOk == 0) {
  echo PPDB::failed("Sorry, your file was not uploaded.");
} else {
  if (move_uploaded_file($_FILES["reg_db_import"]["tmp_name"], $target_file)) {
    echo PPDB::success("The file ". htmlspecialchars(str_replace($target_dir,'',$target_file)). " has been uploaded.");
  } else {
    echo PPDB::failed("Sorry, there was an error uploading your file.");
  }
	}
}
	if(isset($_POST['dbsubmit'])){
		$fileName = $_POST['tbname'];
				$args = PPDB::JSONTOARRAY($_POST['dbarr']);
		if(!PPDBLogic::dbExists(Utils::getROOT("DB", Utils::getDS()), $fileName)){ # ROOT_DB/ROOT_DB_FORWARD
			PPDB::createDB(Utils::getROOT("DB", Utils::getDS()), $fileName, $args); # ROOT_DB/ROOT_DB_FORWARD
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Created<p>';
		}else{
			$READER->select(Utils::getROOT("DB", Utils::getDS()), $fileName)->update($args);
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Updated<p>';
		}
	
}
	if(isset($_POST['dbremove'])){
			$fileName = $_POST['dbname'];
		if(PPDBLogic::dbExists(Utils::getROOT("DB", Utils::getDS()), $fileName)){
			PPDB::removeDB(Utils::getROOT("DB", Utils::getDS()), $fileName);
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Removed<p>';
		}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';	
		}
	}
if(isset($_POST['dbrename'])){
	if(isset($_POST['dbvrename']) && $_POST['dbvrename'] !== ''){
		$fileName = $_POST['dbname'] . '>' . $_POST['dbvrename'];
			$replace = explode(">", $fileName);
		if(PPDBLogic::dbExists(Utils::getROOT("DB", Utils::getDS()), $replace[0])){
			if(strpos($fileName, ">")){

			PPDB::renameDB(Utils::getROOT("DB", Utils::getDS()), $replace[0], $replace[1]);
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Renamed<p>';
			}else{
				echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Textbox does not have ">" to change name<p>';
			}

		}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';	
		}
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Can\'t have rename string null.<p>';	
	}
			
	}
if(isset($_POST['dbinfo'])){
	$fileName = $_POST['dbname'];
	if(PPDBLogic::dbExists(Utils::getROOT('DB',Utils::getDS()), $fileName)){
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(15).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'"> Created: '.PPDB::infoDB(ROOT_DB,$fileName)['created'].'<br/> Updated: '.PPDB::infoDB(ROOT_DB,$fileName)['updated'].'<br/> Size: '.PPDB::infoDB(ROOT_DB,$fileName)['size'].'<br/> Type: '.PPDB::infoDB(ROOT_DB,$fileName)['type'].'<p>';
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
}
if(isset($_POST['exportasjson'])){
	$fileName = $_POST['dbname'];
	if(PPDBLogic::dbExists(Utils::getROOT('DB',Utils::getDS()), $fileName)){
		$READER->export(Utils::getROOT('DB',Utils::getDS()), Utils::getROOT('DATA',Utils::getDS()), Utils::getDS(), $fileName, "JSON");
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database has been exported.<p>';
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
}
if(isset($_POST['exportasphp_array'])){
	$fileName = $_POST['dbname'];
	if(PPDBLogic::dbExists(Utils::getROOT('DB',Utils::getDS()), $fileName)){
		$READER->export(Utils::getROOT('DB',Utils::getDS()), Utils::getROOT('DATA',Utils::getDS()), Utils::getDS(), $fileName, "PHP_ARRAY");
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database has been exported.<p>';
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
}
if(isset($_GET['savePlugin']) && isset($_GET['createBackup'])){
	$dbdir = Utils::getROOT("DB", Utils::getDS());
	$root = Utils::getROOT("DOC", Utils::getDS()).Utils::getDS();
	if(!is_dir($root."PPDB_backup")){
		if(!mkdir($root."PPDB_backup")){
			echo PPDB::failed("Failed to create backup");
		}else{
			echo PPDB::success("Successfully to created backup");
		}
	}
	$zipTitle = $root."PPDB_backup".Utils::getDS().date_format(date_create(date('Y-m-d H:i:s')), "m-d-YH_i_s").".zip";
	$createZIP = new ZipArchive();
	if($createZIP->open($zipTitle, ZipArchive::CREATE || ZipArchive::OVERWRITE) === TRUE) {
      $dir = opendir($dbdir);
      while($file = readdir($dir)) {
         if(is_file($dbdir.$file)) {
            $createZIP -> addFile($dbdir.$file, $file);
         }
      }
      $createZIP ->close();
	  echo Plugin::saveRedirect(date_format(date_create(date('Y-m-d H:i:s')), "m-d-YH_i_s").".zip", 'created');
   }else{
	  echo Plugin::deleteRedirect(date_format(date_create(date('Y-m-d H:i:s')), "m-d-YH_i_s").".zip", 'failed to create'); 
   }
}
/* Table */

if(isset($_POST['table']) && SESSION_USER){
	echo '<br/><br/><form method="post">
	<select name="dbname" class="form-control">';
	$getDb = array_values(array_diff(scandir(Utils::getROOT("DB", Utils::getDS())),[".", ".."]));
			foreach($getDb as $db){
				if($db !== ".htaccess") 
					echo "<option value='".str_replace(".json","",$db)."'>".str_replace(".json","",$db)."</option>";
			}
	echo '</select><br/></br>
	<input type="text" class="form-control" name="dbarr" placeholder="Enter data(use \',\' split)"/><br/></br>
	<input type="text" class="form-control" name="dbmain" placeholder="Enter Table Name"/><br/></br>
	<input type="submit" class="btn btn-primary" name="LoadTable" value="Load Table"/><br/></br>
	<input type="submit" class="btn btn-primary" name="LoadLinkedTable" value="Load Linked Table"/>
	</form>';
				echo '<script>setTimeout(function(){
		let getUrl = window.location.href;b
		if(getUrl.match(/(\?plugin).*/)){
			getUrl = getUrl.replace(/(\?plugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
		echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?savePlugin).*/)){
			getUrl = getUrl.replace(/(\?savePlugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
}
if(isset($_POST['LoadTable'])){
	$name = $_POST['dbname'];
	$isdata = preg_replace("/\s*/m","",$_POST['dbarr']);
	$data = explode(",",$isdata);
	$main = $_POST['dbmain'];
	if(PPDBLogic::dbExists(ROOT_DB,$name)){
		echo $READER->allowSearch(0);
		echo $READER->allowPageLimit([5,10,20,50,100]);
		echo $READER->createTable($data, PPDB::JSONTOARRAY(file_get_contents(ROOT_DB.$name.'.json')), $main ,$data)->view(VIEW_ALL);
	}else{
		echo PPDB::failed("Database does not exist");
	}
}
if(isset($_POST['LoadLinkedTable'])){
	$name = $_POST['dbname'];
	$isdata = preg_replace("/\s*/m","",$_POST['dbarr']);
	$data = explode(",",$isdata);
	$main = $_POST['dbmain'];
	if(PPDBLogic::dbExists(Utils::getROOT('DB',Utils::getDS()),$name)){
		echo $READER->allowSearch(0);
		echo $READER->allowPageLimit([5,10,20,50,100]);
		echo $READER->createLinkedTable($data, PPDB::JSONTOARRAY(file_get_contents(Utils::getROOT('DB',Utils::getDS()).$name.'.json')), $main ,$data)->view(VIEW_ALL);
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
}

/* export SQL */
if(isset($_POST['mySQL']) && SESSION_USER){
	echo '<br/><br/><form method="post">
	<input type="text" class="form-control" name="sql_host" placeholder="Enter mySQL host" required=""/><br/></br>
	<input type="text" class="form-control" name="sql_user" placeholder="Enter mySQL username" required=""/><br/></br>
	<input type="password" class="form-control" name="sql_psw" placeholder="Enter mySQL password"/><br/></br>
	<input type="text" class="form-control" name="sql_db" placeholder="Enter mySQL database" required=""/><br/></br>
	<input type="text" class="form-control" name="sql_table" placeholder="Enter mySQL table" required=""/><br/></br>
	<input type="submit" class="btn btn-primary" name="sql_import" value="Import Database"/>
	</form>';
				echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?plugin).*/)){
			getUrl = getUrl.replace(/(\?plugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
		echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?savePlugin).*/)){
			getUrl = getUrl.replace(/(\?savePlugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
}
if(isset($_POST['sql_import'])){
	$host = $_POST['sql_host'];
	$user = $_POST['sql_user'];
	$psw = $_POST['sql_psw'];
	$db = $_POST['sql_db'];
	$table = $_POST['sql_table'];
	$msql->connect($host, $user, $psw, $db)->importAll(ROOT_DB, $table);
}
/*Account*/
if(isset($_POST['delteAccount']) && SESSION_USER){
	PPDB::deleteAccount(Utils::getROOT('ROOT',Utils::getDS()));
	PPDB::checkDeletedFile(Utils::getROOT('ROOT',Utils::getDS()));
				echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?plugin).*/)){
			getUrl = getUrl.replace(/(\?plugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
}
/*password*/
if(isset($_POST['changePassword']) && SESSION_USER){
	echo '<br/><br/><form method="post">
	<input type="password" class="form-control" name="old_psw" placeholder="Enter Old Password" required=""/><br/></br>
	<input type="password" class="form-control" name="new_psw" placeholder="Enter New Password" required=""/><br/></br>
	<input type="password" class="form-control" name="new_psw_copy" placeholder="Renter New Password" required=""/><br/></br>
	<input type="submit" class="btn btn-warning" name="exec_change_psw" value="Change Password"/>
	</form>';
				echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?plugin).*/)){
			getUrl = getUrl.replace(/(\?plugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
		echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?savePlugin).*/)){
			getUrl = getUrl.replace(/(\?savePlugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
}
if(isset($_POST['exec_change_psw']) && SESSION_USER){
	$old = $_POST['old_psw'];
	$new = $_POST['new_psw'];
	$copyNew = $_POST['new_psw_copy'];
	$json = file_get_contents(Utils::getROOT('ROOT',Utils::getDS())."user.json");
	$query = json_decode($json);
	if(PPDB::CHECK_VALID_PASSWORD($new, 8, 20, true, true, true, false)){
			if($copyNew === $new){
		 PPDB::CHANGE_PSW(Utils::getROOT('ROOT',Utils::getDS()), $old, $new);
		}else{
			echo PPDB::failed("The New Password does not match");
		}
	}
	
}
/*Plugins*/
if(isset($_POST['viewPlugins']) && SESSION_USER){
	$plist = [];
	global $plugins;
	//$plugins = array_diff(scandir(Utils::getROOT("PLUGIN", Utils::getDS())), [".", ".."]);
	foreach($plugins as $plugin){
		if(is_dir(Utils::getROOT("PLUGIN", Utils::getDS()).$plugin)){
			$plist[] = $plugin;
			 if(Utils::getROOT("PLUGIN", Utils::getDS()).$plugin.Utils::getDS().$plugin.".plg.php"){
				include Utils::getROOT("PLUGIN", Utils::getDS()).$plugin.Utils::getDS().$plugin.".plg.php";
			 }else{
				 echo "can't find ".$plugin.".plg.php to run function";
			 }
		}
	}	
	$depend = '';
	echo '<h2 class="mb-5">Plugins <small class="badge bg-primary">'.count($plist).'</small></h2>';
	echo '<div class="row"><div class="col-12"><div class="card-columns">';
	$id = -1;
	foreach($plugins as $plugin){
		if(is_dir(Utils::getROOT("PLUGIN", Utils::getDS()).$plugin)){
		$id = $id+1;
		if(!file_exists(Utils::getROOT("PLUGIN", Utils::getDS()).$plugin.Utils::getDS()."addon.json")){
			echo PPDB::failed($plugin." doesn't have addon.json");
			return false;
		}
		$getData = file_get_contents(Utils::getROOT("PLUGIN", Utils::getDS()).$plugin.Utils::getDS()."addon.json");
		$data = json_decode($getData, true);
		$toggle = $data['togglable'] ? '' : 'disabled="true"';
		$toggleTitle = $data['togglable'] ? 'Activate the plugin' : 'You can not switch this';
		$active = $data['config']['active'] ? "checked" : "";
		if($toggleTitle !== "You can not switch this"){
		$toggleTitle = $data['config']['active'] ? "Deactivate the Plugin" : "Activate the plugin";
		}
		if(!array_key_exists('dependencies',$data)){
			$card = '<div id="plugin-success" class="card border border-secondary border-4 mb-2" data-pluginid="'.$plugin.'" data-plugincardroot="true">';
		$card .= '<div class="card-header">
			<div class=" form-check form-switch float-end" data-html="true"   title="'.$toggleTitle .'">
						<input class="'.$plugin.'_active form-check-input" '.$toggle.' type="checkbox" id="pluginactivtor" '.$active.' onclick="ToggleCheckBox(this.checked, '.$id.', \''.$plugin.'\', \''.(PPDB::strMultiplyer(2,DS)).'\');">
					<script>
					setTimeout(function(){
						ToggleisChecked('.$id.');
					},100);
					</script>
					</div>
			<h6>'.$data['name'].' v.'.$data['version'].'</h6> <span>created: <a href="'.$data['webpage'].'" target="_blanl">'.$data['author'].'</a> <a href="mailto:'.$data['mail'].'" class="float-end btn btn-secondary btn-sm" role="button"><i class="fa-solid fa-envelope"></i> Email</a><a id="plugin-config-info"    title="'.date_format(date_create($data['L_updated']), "m-d-Y").'" class="float-end btn btn-info btn-sm text-white" role="button"><i class="bi bi-info-square" id="plugin-c-icon"></i> Info</a></span>
		</div>';
		$hide_btn = $data['config']['include_btn'] ? '' : 'hidden="true"';
		$card .= '<div class="card-body">
		<span class="plugin-description">'.htmlentities($data['description']).'<br/><span style="color:gray;font-size:10px;">Last Updated: '.date_format(date_create($data['L_updated']), "m-d-Y").'</span></span>
		<a id="plugin-config-btn" class="btn btn-secondary btn-lg" '.$hide_btn.' href="./panel?plugin='.$plugin.'&page='.$data['config']['page'].'" role="button"><i class="bi bi-plus-square" id="plugin-c-icon"></i> <span>Install</span></a>

		<img class="card-image float-end" alt="'.$data['icon'].'" title="" width="150" height="150" src="libs/plugins/'.$plugin.'/'.$data['icon'].'"/>
		</div>';
		$card .= '</div>';
		}else{
		
			if($data['dependencies']['yaml'] && !extension_loaded('yaml')){
				foreach($data['dependencies'] as $k => $v){
					$depend .= $k . ", ";
				}
					$card = '<div id="plugin-success" style="display:none;" class="card border border-secondary border-4 mb-2" data-pluginid="'.$plugin.'" data-plugincardroot="true">';
		$card .= '<div class="card-header"  title="Dependencies: '.$depend.'">
			<div class="form-check form-switch float-end" data-html="true"    title="'.$toggleTitle .'">
						<input class="'.$plugin.'_active form-check-input" '.$toggle.' type="checkbox" id="pluginactivtor" '.$active.' onclick="ToggleCheckBox(this.checked, '.$id.', \''.$plugin.'\', \''.(PPDB::strMultiplyer(2,DS)).'\');">
					<script>
					setTimeout(function(){
						ToggleisChecked('.$id.');
					},0);
					</script>
					</div>
			<h6>'.$data['name'].' v.'.$data['version'].'</h6> <span>created: <a href="'.$data['webpage'].'" target="_blanl">'.$data['author'].'</a> <a href="mailto:'.$data['mail'].'" class="float-end btn btn-secondary btn-sm" role="button"><i class="fa-solid fa-envelope"></i> Email</a>	<a id="plugin-config-info"   title="'.date_format(date_create($data['L_updated']), "m-d-Y").'" class="float-end btn btn-secondary btn-sm text-white" role="button"><i class="bi bi-info-square" id="plugin-c-icon"></i> Info</a></span>
		</div>';
		$hide_btn = $data['config']['include_btn'] ? '' : 'hidden="true"';
		$card .= '<div class="card-body">
		<span class="plugin-description">'.$data['description'].'</span>
		<a id="plugin-config-btn" class="btn btn-secondary btn-lg" '.$hide_btn.' href="./panel?plugin='.$plugin.'&page='.$data['config']['page'].'" role="button"><i class="bi bi-plus-square" id="plugin-c-icon"></i> <span>Install</span></a>
		<img class="card-image float-end" alt="'.$data['icon'].'" title="" width="150" height="150" src="libs/plugins/'.$plugin.'/'.$data['icon'].'"/>
		</div>';
		$card .= '</div>';
			}else{
				foreach($data['dependencies'] as $k => $v){
					$depend .= $k . ", ";
				}
					$card = '<div id="plugin-success" class="card border border-secondary border-4 mb-2" data-pluginid="'.$plugin.'" data-plugincardroot="true">';
		$card .= '<div class="card-header"    title="Dependencies: '.$depend.'">
			<div class="form-check form-switch float-end" data-html="true"    title="'.$toggleTitle .'">
						<input class="'.$plugin.'_active form-check-input" '.$toggle.' type="checkbox" id="pluginactivtor" '.$active.' onclick="ToggleCheckBox(this.checked, '.$id.', \''.$plugin.'\', \''.(PPDB::strMultiplyer(2,DS)).'\');">
					<script>
					setTimeout(function(){
						ToggleisChecked('.$id.');
					},0);
					</script>
					</div>
			<h6>'.$data['name'].' v.'.$data['version'].'</h6> <span>created: <a href="'.$data['webpage'].'" target="_blanl">'.$data['author'].'</a> <a href="mailto:'.$data['mail'].'" class="float-end btn btn-secondary btn-sm" role="button"><i class="fa-solid fa-envelope"></i> Email</a>	<a id="plugin-config-info"   title="'.date_format(date_create($data['L_updated']), "m-d-Y").'" class="float-end btn btn-info btn-sm text-white" role="button"><i class="bi bi-info-square" id="plugin-c-icon"></i> Info</a></span>
		</div>';
		$hide_btn = $data['config']['include_btn'] ? '' : 'hidden="true"';
		$card .= '<div class="card-body">
		<span class="plugin-description">'.$data['description'].'<br/><span style="color:gray;font-size:10px;">Last Updated: '.date_format(date_create($data['L_updated']), "m-d-Y").'</span></span>
		<a id="plugin-config-btn" class="btn btn-secondary btn-lg" '.$hide_btn.' href="./panel?plugin='.$plugin.'&page='.$data['config']['page'].'" role="button"><i class="bi bi-plus-square" id="plugin-c-icon"></i> <span>Install</span></a>
		<img class="card-image float-end" alt="'.$data['icon'].'" title="" width="150" height="150" src="libs/plugins/'.$plugin.'/'.$data['icon'].'"/>
		</div>';
		$card .= '</div>';
			}
		}
		
		echo $card;
	}
	}
	echo '</div></div></div>';
	//config
				echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?plugin).*/)){
			getUrl = getUrl.replace(/(\?plugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
		echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?savePlugin).*/)){
			getUrl = getUrl.replace(/(\?savePlugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
}
if(isset($_GET['savePlugin']) && SESSION_USER){
	function switchForm($bool){
	switch($bool){
		case 1:
		return "false";
		break;
		case 0:
		return "true";
		break;
	}
}
function boolToStr($bool){
	switch($bool){
		case 0:
		return 'false';
		break;
		case 1:
		return 'true';
		break;
	}
}
if(isset($_POST['submit_config'])){
	if(isset($_POST['activate']) || !isset($_POST['activate'])){
		$file = Utils::getROOT("PLUGIN", Utils::getDS()).$_GET['savePlugin'].Utils::getDS()."addon.json";
		$f = file_get_contents($file);
		$data = json_decode($f, true);
		$open = fopen($file, "w+");
		$key = isset($_POST['activate']) ? 1 : 0;
			fwrite($open, str_replace('"active":'.boolToStr($data['config']['active']), '"active":'.boolToStr($key), $f));
			fclose($open);
	}else{
		echo PPDB::failed("activate was not found");
	}
include Utils::getROOT("PLUGIN", Utils::getDS()).$_GET['savePlugin'].Utils::getDS().$_GET['savePlugin'].'.plg.php';
$func = $_GET['savePlugin'].'_config';
if(function_exists($func)){$func();}else{PPDB::failed("cannot run function correctly!");}

}

}

if(isset($_GET['plugin']) && isset($_GET['page'])){
	if(PLUGIN::LOST($_GET['plugin'])){
		include Utils::getROOT('PLUGIN',Utils::getDS()).$_GET['plugin'].Utils::getDS().$_GET['page'];
	}
}
/*Themes*/
if(isset($_POST['viewThemes']) && SESSION_USER){
$themes = array_diff(scandir(Utils::getROOT("THEME", Utils::getDS())), [".", ".."]);
$theme = '';
if(PLUGIN::LOST('ThemeSwitcher', true)){
	$theme .= '<form method="post">';
$theme .= '<select class="form-control form-select-lg mb-3 mt-5">';
$theme .= '<option value="">Default</option>';
foreach($themes as $t){
	if(preg_match('/^.+(\.css)$/', $t) && !is_dir(Utils::getROOT("THEME", Utils::getDS()).$t)){
		$theme .= '<option value="'.str_replace('.css','',$t).'">'.str_replace('.css','',$t).'</option>';
	}
}
$theme .= '</select>';
$theme .= '</form>';
}
echo $theme;
	echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?plugin).*/)){
			getUrl = getUrl.replace(/(\?plugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
}

/*Dashboard*/
if(isset($_POST['viewDashboard']) && SESSION_USER){
	echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?plugin).*/)){
			getUrl = getUrl.replace(/(\?plugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
	/*Writeable*/
	function isFWritable($folder){
		if(is_writable($folder)){
			return '<span style="color:lime">Writtable</span>';
		}else{
			return '<span style="color:red">Not writtable</span>';
		}
	}
	function isFExists($folder){
		if(file_exists($folder)){
			return '<span style="color:lime">Exists</span>';
		}else{
			return '<span style="color:red">Not Exists</span>';
		}
	}
	function getDepend($extend, $title=''){
		return extension_loaded($extend)||file_exists($extend) ? '<span style="color:lime">'.($title!=='' ? $title : $extend).'(exists)</span>' : '<span style="color:red">'.($title!=='' ? $title : $extend).'(not exists)</span>';
	}
	$t = '<table class="table table-dark table-bordered border-secondary table-hover">
	 <thead>
    <tr>
      <th scope="col">Query</th>
      <th scope="col">Value</th>
    </tr>
  </thead>
  <tbody>
   <tr>
      <th scope="row">PHP version</th>
      <td>'.phpversion().'</td>
    </tr>
	   <tr>
      <th scope="row">PPDB Build</th>
      <td>'.LIBRARY_BUILD.'</td>
    </tr>
	 <tr>
      <th scope="row">Server Software</th>
      <td>'.(!empty($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '').'</td>
    </tr>
	<tr>
      <th scope="row">PHP Modules</th>
      <td class="word-wrap">'.implode(', ',LIBRARY_MODULES).'</td>
    </tr>
	<tr>
      <th scope="row">Memory</th>
      <td>Current memory usage is '.sizeFormat(memory_get_usage()).' ('.sizeFormat(memory_get_usage()).') out of '.sizeFormat(memory_get_peak_usage(true)).'
    </tr>
	<tr>
	 <th scope="row">PPDB version</th>
      <td>'.update::compareUpdate(LIBRARY_VERSION, update::checkUpdate()).'</td>
	</tr>
	<tr>
	 <th scope="row">PPDB storage(DB)</th>
      <td> Currently using '.sizeFormat(folderSize(Utils::getROOT("DB", Utils::getDS()))).' in the database folder</td>
	</tr>
	<tr>
	 <th scope="row">PPDB folders</th>
      <td>
	  Plugins: '.isFWritable(Utils::getROOT("PLUGIN", Utils::getDS())). ', '.isFExists(Utils::getROOT("PLUGIN", Utils::getDS())).'<br/>
	  Themes: '.isFWritable(Utils::getROOT("THEME", Utils::getDS())). ', '.isFExists(Utils::getROOT("THEME", Utils::getDS())).'<br/>
	  Uploads: '.isFWritable(Utils::getROOT("UPLOAD", Utils::getDS())). ', '.isFExists(Utils::getROOT("UPLOAD", Utils::getDS())).'<br/>
	 </td>
	</tr>
		<tr>
	 <th scope="row">PHP Extensions</th>
      <td>'.implode(', ', get_loaded_extensions()).'</td>
	</tr>
	<tr>
	 <th scope="row">PPDB dependencies</th>
      <td>'.getDepend('zip', 'ZIP[Extension]').','.getDepend('yaml', 'YAML[Extension]').','.getDepend(Utils::getROOT("PLUGIN", Utils::getDS())."Core".Utils::getDS(), "PPDB Core[Plugin]").'</td>
	</tr>
	</table>';
	echo $t;
}
/*History*/
if(isset($_POST['viewHistory']) && SESSION_USER){
	echo '<table class="table table-light table-bordered table-hover table-striped">';
	echo '<thead>
	<tr>
	  <th scope="col">ID</th>
	  <th scope="col">Username</th>
      <th scope="col">LoggedIn</th>
      <th scope="col">IP</th>
	 </tr>
	</thead>';
	echo '<tbody>';
	$Historys = array_values(array_diff(scandir(Utils::getROOT("HISTORY", Utils::getDS())),[".",".."]));
	foreach($Historys as $history){
		if(strpos($history, '.json')){
				echo "<tr>
		<th scope='row'>".str_replace(".json","",$history)."</th>";
		$h = file_get_contents(Utils::getROOT("HISTORY",Utils::getDS()).$history);
		$buildHistory = json_decode($h, true);
		echo '<td>'.$buildHistory['loggedinUser'].'</td>';
		echo '<td>'.$buildHistory['loggedinTime'].'</td>';
		echo '<td>'.$buildHistory['loggedinIP'].'</td>';
		echo "</tr>";
		}
	}
	echo '</tbody>';
	echo '</table>';
}

if(isset($_POST['viewProfile'])){
	$getUser = file_get_contents(Utils::getROOT("ROOT", Utils::getDS()).'user.json');
	$userInfo = json_decode($getUser, true);
	$getLoc = file_get_contents("https://ipinfo.io/".$userInfo['ip']."/json");
	$getLocJSON = json_decode($getLoc, true);
	$displayLoc =  !$getLocJSON['bogon'] ? $getLocJSON['city'] . ", " . $getLocJSON['region'] . ", " . $getLocJSON['country'] : 'Private IP, can\'t display data';
	$getAvatars = Utils::getROOT("UPLOAD", Utils::getDS()).'avatars'.Utils::getDS();
	
	//get latest history
	$historyDir = array_values(array_diff(scandir(Utils::getROOT("HISTORY", Utils::getDS())), [".", ".."]));
	$listTimeStamp = '';
	foreach($historyDir as $h){
		if(strpos($h, ".json")){
			$getHistoryData = file_get_contents(Utils::getROOT("HISTORY", Utils::getDS()).$h);
			$history = json_decode($getHistoryData, true);
			$listTimeStamp .= '<li class="list-group-item list-group-item-action">'.str_replace("T", " ",$history['loggedinTime']).'; '.$history['loggedinIP'].'</li>';
		}
	}
	echo '<h1 class="text-center">Profile</h1>';
	$profile = '<form method="post"><section class="h-100 gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card">
          <div class="rounded-top text-white d-flex flex-row" style="background-color: #0476f7; height:200px;">
            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
			<span id="status" style="'.($userInfo['ip']!==PPDB::getIP()&&SESSION_USER===''?'background-color:red;':'background-color:lime;').'z-index:2;border-radius:50%;width:30px;height:30px;position:absolute;top:9%;left:22%;">&nbsp;</span>
           
		   <img src="'.PPDB::removeDOC($getAvatars).(file_exists($getAvatars.SESSION_USER.'.png') ? SESSION_USER : 'default').'.png?imgID='.uniqid().'" alt="User image" class="image img-fluid img-thumbnail rounded mt-4 mb-2" style="width: 150px; z-index: 1">
			  <button type="button" data-bs-toggle="modal" data-bs-target="#profileEditor" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">
                Edit profile
              </button>
			 '.(file_exists($getAvatars.SESSION_USER.'.png') ? '<button type="submit" name="removeLogo" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">Remove Image</button>' : '').'
            </div>
            <div class="ms-3" style="margin-top: 130px;">
              <h5>'.($userInfo['displayName']!=='' ? $userInfo['displayName'] : SESSION_USER).($userInfo['email']!==''?' <a title="email" href="mailto:'.$userInfo['email'].'"><button class="btn btn-secondary"><i class="fa-solid fa-envelope"></i></button></a>':'').'</h5>
              <p>'.$displayLoc.'</p>
            </div>
			
          </div>
          <div class="p-4 text-black" style="background-color: #f8f9fa;">
            <div class="d-flex justify-content-end text-center py-1">
              <div>
                <p class="mb-1 h5">'.count(glob(Utils::getROOT('DB', Utils::getDS()).'*.{json}', GLOB_BRACE)).'</p>
                <p class="small text-muted mb-0">Databases</p>
              </div>
            </div>
          </div>
          <div class="card-body p-4 text-black">
            <div class="mb-5">
              <p class="lead fw-normal mb-1">About</p>
              <div class="p-4" style="background-color: #f8f9fa;">
                <p class="font-italic mb-1">'.($userInfo['about']!==''?$userInfo['about']:'Enter Your description').'</p>
              </div>
            </div>
			<div class="mb-5">
			<p class="lead fw-normal mb-1">History</p>
			  <div class="p-4" style="background-color: #f8f9fa;">
                <p class="font-italic mb-1"><ul class="list-group">'.$listTimeStamp.'</ul></p>
              </div>
			</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section></form>';
echo $profile;
echo PPDB::PROFILE_EDIT();
}
if(isset($_POST['removeLogo'])){
		$getAvatars = Utils::getROOT("UPLOAD", Utils::getDS()).'avatars'.Utils::getDS();
		if(unlink($getAvatars.SESSION_USER.'.png')){
			echo PPDB::success("Removed avatar");
		}else{
			echo PPDB::failed("Failed to removed avatar");
		}
}
	
if(isset($_POST['saveProfile'])){
		$getUser = file_get_contents(Utils::getROOT("DOC", Utils::getDS()).'PPDB'.Utils::getDS().'user.json');
	$info = json_decode($getUser, true);
	
	$email = $_POST['emailaddress'];
	$display = $_POST['displayName'];
	$about = $_POST['about'];
		$getAvatars = Utils::getROOT("UPLOAD", Utils::getDS()).'avatars'.Utils::getDS();
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) && $email!==''){
		echo PPDB::failed('Invalid email address');
	}else{
		
	

// Check if image file is a actual image or fake image
if(isset($_FILES['propic']) && $_FILES['propic']["name"] >= 1){
$target_dir = $getAvatars;
$target_file = $target_dir . basename($_FILES["propic"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$check = getimagesize($_FILES["propic"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo PPDB::failed("File is not an image.");
    $uploadOk = 0;
  }

// Check if file already exists
if (file_exists($target_file)) {
  echo PPDB::failed("Sorry, file already exists.");
  $uploadOk = 0;
}

// Check file size
if ($_FILES["propic"]["size"] > 500000) {
  echo PPDB::failed("Sorry, your file is too large.");
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  echo PPDB::failed("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["propic"]["tmp_name"], $target_file)) {
	  if(rename($getAvatars.$_FILES["propic"]["name"], $getAvatars.SESSION_USER.".png")){
		  $data = array("user"=>$info['user'], "password"=>$info['password'], "email"=>$email, "ip"=>$info['ip'] ,'displayName'=>($display!==''?$display:SESSION_USER), 'about'=>$about);
	$query = json_encode($data);
	$file = fopen(Utils::getROOT("ROOT",Utils::getDS())."user.json", "w+");
	fwrite($file, $query);
	fclose($file);
	Reload::run();
	  }else{
		  PPDB::failed("Failed to rename item");
	  }
 	
  } else {
    echo PPDB::failed("Sorry, there was an error uploading your file.");
  }
}
  
}else{
	$data = array("user"=>$info['user'], "password"=>$info['password'], "email"=>$email, "ip"=>$info['ip'] ,'displayName'=>($display!==''?$display:SESSION_USER), 'about'=>$about);
	$query = json_encode($data);
	$file = fopen(Utils::getROOT("ROOT",Utils::getDS())."user.json", "w+");
	fwrite($file, $query);
	fclose($file);
	Reload::run();
}



		
		
	}	
}
?>




			<!-- JavaScript Bundle with Popper -->
			<?php
			echo PPDB::createJSLink("libs/js/base.lib.js?v1.0.6");
			echo PPDB::createJSLink("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", true, "sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p", "anonymous");
			echo PPDB::createJSLink("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js");
			echo PPDB::createJS("function writeTable(type){document.querySelector('#dbarr').value = '{\\n\"'+type+'\": [{\\n\\n}]\\n}';}","");
			echo PPDB::createJSLink("libs/js/previewImg.js?v1.2.4");
			echo PPDB::createJSLink("libs/js/previewVid.js?v1.0.1");
			echo URIS::config(BGCOLOR,["#696a69","body"]);
			echo PPDB::createJS('setTimeout(function(){
				let t = document.querySelectorAll("#portTable tr td");
				for(let i=0;i<t.length;i++){
					if(/(https?:\/\/.*\.(?:png|jpg|gif|tiff|pdf|raw))/g.test(t[i].innerHTML)){
						t[i].innerHTML = returnImg(t[i].innerHTML, 320, 320, t[i].innerHTML);
					}
				}
			}, 0)', '');
			
			
			echo PPDB::createJS('setTimeout(function(){
				let t = document.querySelectorAll("#portTable tr td");
				for(let i=0;i<t.length;i++){
					if(/(https?:\/\/.*\.(?:mp4|mov?|wmv|avi|avchd))/g.test(t[i].innerHTML)){
						t[i].innerHTML = returnVid(t[i].innerHTML, 320, 320, t[i].innerHTML);
					}
				}
			}, 0)', '');
			echo plugin::hook('footerJS', 'ThemeSwitcher');
			?>
		</body>
	</html>
```

ok, lets break it down

creating the prompt:
```php
PPDB::ueserUI(ROOT/ROOT_FOWARD)
```

Creating user data: 
```php
PPDB::INSTALL((ROOT/ROOT_FORWARD), $username, $psw);
```

Encrypting Password:
```php
PPDB::PSW_ENCRYPT($psw);
```

Changing Password:
```php
PPDB::CHANGE_PSW((ROOT/ROOT_FORWARD), $old, $new);
```

Check valid Password:
```php
PPDB::CHECK_VALID_PASSWORD($psw, $min_length, $max_length, $include_lowercase_str, $include_uppercase_str, $include_int, $include_symbol);
```

Varify Password:
```php
PPDB::PSW_VARIFY($str, $hash);
```

Reloading Page:
```php
Reload::run();
```

Loading panel:
```php
echo PPDB::loadPanel();
```

Logout function/button:
```php
echo PPDB::logout();
```

That is the basic parts of the panel

### 3. Logics

isNumber():
```php
if(PPDBLogic::isNumber($value)){
//return true
}else{
//false
}
```

isString():
```php
if(PPDBLogic::isString($value)){
//return true
}else{
//false
}
```

isBoolean():
```php
if(PPDBLogic::isBoolean($value)){
//return true
}else{
//false
}
```

isArray():
```php
if(PPDBLogic::isArray($value)){
//return true
}else{
//false
}
```

hasConfigLength();
```php
if(PPDBLogic::hasConfigLength($array, $arrayCount)){
return true;
}else{
return false;
}
```

### 4. creating/removing/renaming Database

This is easy

creating database:
```php
PPDB::createDB($dir, $name, $arr)
```

Removing database:
```php
PPDB::removeDB($dir, $name);
```

Renaming database:
```php
PPDB::renameDB($dir, $oldName, $newName);
```

`$dir` eaither is`ROOT_DB` or `ROOT_DB_FORWARD`

`$name` is the name of your database

`$oldName` is the current database name

`$newName` is to set a new name for the old database

`$arr` is the array which converts to JSON

### 5. Converting JSON to Array / ARRAY TO JSON

JSONTOARRAY():
```php
PPDB::JSONTOARRAY($JSON);
```
ARRAYTOJSON():
```php
PPDB::ARRAYTOJSON($ARRAY);
```

### 6. Query

This is defaulted to use `$READER` before doing a task

Selecting:
```php
$READER->select($sdir, $sname)
```

`$sdir` is eaither `ROOT_DB` or `ROOT_DB_FORWARD`

`$sname` is your database name

Reading:
```php
$READER->select($sdir, $sname)->read()
```

this will be converted to an array after read, put an array of items to access what needs to be shown

example(find user at array 0 name):
```php
echo $READER->select($sdir, $sname)->read()['user'][0]['name'];
```

Updating:

```php
$READER->select($sdir, $sname)->update($arr);
```

same variables but `$arr` means PHP array to convert to JSON

Export:

```php
$READER->export($dir, $tdir, $Split, $name, $type);
```


more variables

`$dir` eaither `ROOT_DB` or `ROOT_DB_FORWARD`

`$tdir` eaither `ROOT_TEMP` or `ROOT_TEMP_FORWARD`

`$Split` eaither `DS` or `DS_FORWARD`

`$name` is database name

`$type` eaither is `JSON` or `PHP_ARRAY`


Create Tabele:

```php
$READER->createTable($tbs, $trs, $main, $cels)->view($int);
```

or 

```php
$READER->createLinkedTable($tbs, $trs, $main, $cels)->view($int)
```

`$tbs` is the array to display as the "&lt;th&gt;" tag (array)
	
`$trs` user PPDB::JSONTOARRAY(file_get_contents(file-to-database))
	
`$main` your table name/first name of your array: go to [Coding PHP and JSON format](https://github.com/surveybuilderteams/PPDB#9-coding-php-and-json-format) to learn more
	
`$cels` list what needs to be displated (exact as `$tbs`)

`$int` displays what row you want to view use `-1` or `VIEW_ALL` to list all values

Search bar Table:

```php
$READER->allowSearch($int);
```

`$int` displays what row column you want to search by


Limiting Viewing Table:

```php
$READER->allowPageLimit($arg);
```

`$arg` is the array of numbers that will display on a select box to limit on how much you want to see

List Database Files:

```php
$READER->listFiles($dir)[$int];
```

`$dir` is eaither a ROOT_DB or ROOT_DB_FORWARD

`$int` is the index of the selector you want

### 7. Styling(CSS)

Styling your page is simple as well

Linking:

```php 
PPDB::createCSSLink($url, $inter="", $crossorigin="");
```

`$url` enter valid css `URL/path`
`$inter` enter a valid `integrity`
`$crossorgin` enter a vlaid `crossorigin setting`

Creating:

```php
PPDB::createCSS($css);
```

`$css` enter CSS code, YOU DO NOT NEED THE STYLE TAG

### 8. scripting(JS)

Same thing as [Styling](#7-stylingcss)

Linking:

```php
PPDB::createJSLink($url, $onLoad=true, $integrity="", $crossorigin="", $referrerpolicy="");
```

`$url` enter valid JS `url/path`

`$onLoad` run code on load

`$integrity` enter valid `integrity`

`$crossorigin` enter valid `crossorigin setting`

`$referrerpolicy` enter valid `referrerpolicy`

Creating:

```php
PPDB::createJS($JS, $id, $onLoad=true);
```

`$JS` enter `JavaScript code`

`$id` enter `ID`

`$onLoad` run code on load

### 9. Coding PHP and JSON format

This is a strict type of database, all database are required to have a table

JSON example: 

```json
{
"table_1": [{
"item_1":"value",
"item_2":"value"
}],
"table_2":[{
"item_1":"value",
"item_2":"value"
}]
}
```
This is an example of a database of mutiple tables

PHP example:

```php
array(
    "table_1" => array(
        array(
            "item_1" => "value",
            "item_2" => "value"
        )
    ),
    "table_2" => array(
        array(
            "item_1" => "value",
            "item_2" => "value"
        )
    )
);
```

This is an example of a database of multiple tables as `arrays`

### 10. Syntax Errors

To build a custom syntax error, use this line of code below

```php
class {CustomClass} extends PPDBErr{
# Write syntax line here
}
```

### 11. mySQL importer

Export your mySQL database table as a JSON file

Connect to mySQL:

```php
$msql->connect($host, $user, $psw, $db);
```

Get mySQL Info:

```php
echo $msql->connect($host, $user, $psw, $db)->getInfo();
```

exportAll:

```php
$msql->connect($host, $user, $psw, $db)->importAll($db,$table);
```

export:
```php
$msql->connect($host, $user, $psw, $db)->import($db, $table, $sel);
```

`$db` is the eaither `ROOT_DB` or `ROOT_DB_FORWARD`


`$sel` is an array of selector of items in a table

### 12. Minifing files or text

```php
PPDB::minify($txt, $allowWS);
```

`$txt` is the string/array that you are minifying removing linebreaks,spaces,tabs
`$allowWS` is to allow whitespaces by adding `INCLUDE_WHITESPACE` or just leave blank

### 13. URI(URL)

There is 2 functions for this

1. URI(URI)::
2. URLS(URI_SCRIPT)::

recive URL:
```php
URI::getCurrent();
```

recive Query:
```php
URI::getQuery();
```

check valid URL:
```php
URI::checkValid($url);
```

adding scripts:

_These are valid functions_
```php
URIS::config(BGCOLOR,["#696a69","body"]);
```

### 14.Creating URIS

`URIS` is a __javascript__ file plugin, this is how you make it.
1. Create a `js` file
2. insert it into `libs/js/` folder
3. go to `libs/handler/URI.php`
4. Scroll to `class URIS extends URI`
5. type after
```php
	try{
			if(!PPDBLogic::isString($URIS)){
				throw new PPDBErr($URIS);
			}
		}catch(PPDBErr $e){
			echo $e->isNotString();
			return false;
		}
		try{
			if(!PPDBLogic::isArray($cS)){
				throw new PPDBErr($cS);
			}
		}catch(PPDBErr $e){
			echo $e->isNotArray();
			return false;
		}
```
6. insert:
```php
if($URIS === $script_file){
```
7. type config limitation
```php
	try{
     if(!PPDBLogic::hasConfigLength($cS, PRAMA_COUNT)){
	throw new PPDBErr('SCRIPT_NAME config must have <b>PRAMA_COUNT</b> pramater you have <b>'.count($cS).'</b>');
	}
}catch(PPDBErr $e){
	echo $e->HAS_CONFIG_LENGHT_FAIL();
}
```
8. type:
```php
		function SCRIPT_NAME($config_prama){
		$runner = PPDB::createJSLink("libs/js/SCRIPT_NAME.js?v=VERSION");
		$runner .= PPDB::createJS('setTimeout(function(){SCRIPT_NAME("'.$config_prama.'")}, 100);', '');
		return $runner;
			}
			return SCRIPT_NAME($config_parma);
 }
```

Finish:
```php
	if($URIS === "SCRIPT_NAME"){
			try{
			if(!PPDBLogic::hasConfigLength($cS, PRAMA_COUNT)){
				throw new PPDBErr('SCRIPT_NAME config must have <b>PRAMA_COUNT</b> pramater you have <b>'.count($cS).'</b>');
			}
		}catch(PPDBErr $e){
			echo $e->HAS_CONFIG_LENGHT_FAIL();
			return false;
		}
				function SCRIPT_NAME(PRAMA){
		$runner = PPDB::createJSLink("libs/js/SCRIPT_NAME.js?v=VERSION");
		$runner .= PPDB::createJS('setTimeout(function(){SCRIPT_NAME("'.PRAMA.'")}, 100);', '');
		return $runner;
			}
			return SCRIPT_NAME(PRAMA);
		}
```

### 15. rawText and encodeText

Converting random string to raw or encode is easy.

Raw text:

```php
PPDB::rawText($str);
```

Encode text: 

```php
PPDB::encodeText($str);
```

### 16. alerts

You can give yourself an alert by using these functions

onSuccess:
```php
echo PPDB::success($str);
```

onFailed:
```php
echo PPDB::failed($str);
```

`$str` is the string that is going to be outputted

### 17. Utils

`utilities` make things easier instend of using (SELECTOR) and (SELECTOR)_ Forward

`utils/utils.php`:

get DS
```php
Utils::getDS();
```

get Root:
```php
Utils::getRoot($name, $data)
```

`$name` is the name of the defined item for locations
* DS
* ROOT
* DB
* HISTORY
* DATA
* DOC
* UPLOAD
* PLUGIN
* THEME

`$data` is just `Utils::getDS()` - this will automatically define which one your using for Dictionary seperator

### 18. Plugins

Plugins are most helpful tools to be using on a lot of databasing, customizing themes, to uploading data, etc. to make things even easier

3 plugins are pre-made for you

1. Core(required/can't be disabled)
2. PluginExtractor
3. ThemeSwitcher

all you have to do is activate, config, finished!

### Making your plugins:

This is how you make your own plugin

required/optional elements:
* addon.json('required')
* icon.png('required')
* {PLUGIN_NAME}.plg.php
* {CONFIG_PAGE_NAME}.php(optional)
* config/config.yml(optional)

find examples in the `/plugin` folder(I did have a way of doing this, but github is not responding this long documentation and kept crashing)

### 19. Themes

You can place custom theme in the `/themes` folder
