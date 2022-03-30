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
		echo PPDB::autoRedirect('Storage', 'Created');	
		}else{
		echo PPDB::autoRedirect('Storage already exists', 'Failed', 'danger');	
		}
		}
		if(isset($_POST['rs'])){
		if(PPDBLogic::storageExists(Utils::getROOT('ROOT',Utils::getDS()))){
		PPDB::removeStorage(Utils::getROOT('ROOT',Utils::getDS()), Utils::getDS()); # ROOT/ROOT_FORWARD || DS/DS_FORWARD
		echo PPDB::autoRedirect('Storage', 'Removed');	
		}else{
		echo PPDB::autoRedirect('Storage dosen\'t exists', 'Failed', 'danger');	
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
			<input type='text' class='form-control' placeholder='Enter Table Name(leave null if changing file)' onchange='writeTable(this.value)' name='tbname' require/><br/>
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
		$fileName = isset($_POST['tbname'])&&$_POST['tbname']!=='' ? $_POST['tbname'] : $_POST['dbname'];
		if(!isset($_POST['tbname']) || $_POST['tbname'] === '' && !isset($_POST['dbname'])){
			echo PPDB::autoRedirect('to update/create Database', 'Failed', 'danger');	
		}else{
				$args = PPDB::JSONTOARRAY($_POST['dbarr']);
		if(!PPDBLogic::dbExists(Utils::getROOT("DB", Utils::getDS()), $fileName)){ # ROOT_DB/ROOT_DB_FORWARD
			PPDB::createDB(Utils::getROOT("DB", Utils::getDS()), $fileName, $args); # ROOT_DB/ROOT_DB_FORWARD
			//echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Created<p>';
			echo PPDB::autoRedirect('Database', 'Created');	
		}else{
			$READER->select(Utils::getROOT("DB", Utils::getDS()), $fileName)->update($args);
			//echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Updated<p>';
			echo PPDB::autoRedirect('Database', 'Updated');	
		}
		}
}
	if(isset($_POST['dbremove'])){
			$fileName = isset($_POST['dbname']) ? $_POST['dbname'] : '';
		if(PPDBLogic::dbExists(Utils::getROOT("DB", Utils::getDS()), $fileName)){
			PPDB::removeDB(Utils::getROOT("DB", Utils::getDS()), $fileName);
			echo PPDB::autoRedirect('Database', 'Removed');
		}else{
		//echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';	
			echo PPDB::autoRedirect('to remove Database', 'Failed', 'danger');	
		}
	}
if(isset($_POST['dbrename'])){
	if(isset($_POST['dbvrename']) && $_POST['dbvrename'] !== ''){
		$fileName = $_POST['dbname'] . '>' . $_POST['dbvrename'];
			$replace = explode(">", $fileName);
		if(PPDBLogic::dbExists(Utils::getROOT("DB", Utils::getDS()), $replace[0])){
			if(strpos($fileName, ">")){

			PPDB::renameDB(Utils::getROOT("DB", Utils::getDS()), $replace[0], $replace[1]);
			echo PPDB::autoRedirect('Database', 'Renamed');	
			}else{
				echo PPDB::autoRedirect('Textbox does not have ">" to change name', 'Failed Queries', 'danger');	
			}

		}else{
		echo PPDB::autoRedirect('to find Database', 'Failed', 'danger');	
		}
	}else{
		echo PPDB::autoRedirect('Can\'t have rename string null.', 'failed', 'danger');	
	}
			
	}
if(isset($_POST['dbinfo'])){
	$fileName = isset($_POST['dbname']) ? $_POST['dbname'] : '';
	if(PPDBLogic::dbExists(Utils::getROOT('DB',Utils::getDS()), $fileName)){
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(15).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'"> Created: '.PPDB::infoDB(Utils::getROOT('DB', Utils::getDS()),$fileName)['created'].'<br/> Updated: '.PPDB::infoDB(Utils::getROOT('DB', Utils::getDS()),$fileName)['updated'].'<br/> Size: '.PPDB::infoDB(Utils::getROOT('DB', Utils::getDS()),$fileName)['size'].'<br/> Type: '.PPDB::infoDB(Utils::getROOT('DB', Utils::getDS()),$fileName)['type'].'<p>';
	}else{
		echo PPDB::autoRedirect('Database doesn\'t exits', 'Failed', 'danger');	
	}
}
if(isset($_POST['exportasjson'])){
	$fileName = isset($_POST['dbname']) ? $_POST['dbname'] : '';
	if(PPDBLogic::dbExists(Utils::getROOT('DB',Utils::getDS()), $fileName)){
		$READER->export(Utils::getROOT('DB',Utils::getDS()), Utils::getROOT('DATA',Utils::getDS()), Utils::getDS(), $fileName, "JSON");
		echo PPDB::autoRedirect('Database has been exported', 'Success');	
	}else{
		echo PPDB::autoRedirect('Database doesn\'t exists', 'Failed', 'danger');	
	}
}
if(isset($_POST['exportasphp_array'])){
	$fileName = isset($_POST['dbname']) ? $_POST['dbname'] : '';
	if(PPDBLogic::dbExists(Utils::getROOT('DB',Utils::getDS()), $fileName)){
		$READER->export(Utils::getROOT('DB',Utils::getDS()), Utils::getROOT('DATA',Utils::getDS()), Utils::getDS(), $fileName, "PHP_ARRAY");
		echo PPDB::autoRedirect('Database has been exported', 'Success');
	}else{
		echo PPDB::autoRedirect('Database doesn\'t exists', 'Failed', 'danger');
	}
}
if(isset($_GET['savePlugin']) && isset($_GET['createBackup'])){
	$dbdir = Utils::getROOT("DB", Utils::getDS());
	$root = Utils::getROOT("DOC", Utils::getDS()).Utils::getDS();
	if(!is_dir($root."PPDB_backup")){
		if(!mkdir($root."PPDB_backup")){
			echo PPDB::autoRedirect('to create backup', 'Failed', 'danger');
		}else{
			echo PPDB::autoRedirect('created backup','Successfully');
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
	$name = isset($_POST['dbname']) ? $_POST['dbname'] : '';
	$isdata = preg_replace("/\s*/m","",isset($_POST['dbarr']) ? $_POST['dbarr'] : '');
	$data = explode(",",$isdata);
	$main = isset($_POST['dbmain']) ? $_POST['dbmain'] : '';
	if(PPDBLogic::dbExists(Utils::getROOT('DB', Utils::getDS()),$name)){
		echo $READER->allowSearch(0);
		echo $READER->allowPageLimit([5,10,20,50,100]);
		echo $READER->createTable($data, PPDB::JSONTOARRAY(file_get_contents(Utils::getROOT('DB', Utils::getDS()).$name.'.json')), $main ,$data)->view(VIEW_ALL);
	}else{
		echo PPDB::autoRedirect('Database doesn\'t exists', 'Failed', 'danger');
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
		echo PPDB::autoRedirect('Database doesn\'t exists', 'Failed', 'danger');
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
	$msql->connect($host, $user, $psw, $db)->importAll(Utils::getROOT('DB', Utils::getDS()), $table);
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
		 if(PPDB::CHANGE_PSW(Utils::getROOT('ROOT',Utils::getDS()), $old, $new)){
			echo PPDB::autoRedirect('Changed Password', 'Successfully');
		 }else{
			echo PPDB::autoRedirect('Old Password Doesn\'t match', 'Failed', 'danger');
		 }
		}else{
			echo PPDB::autoRedirect('New Password does not match', 'Failed', 'danger');
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
			<span id="status" style="'.($userInfo['ip']!==PPDB::getIP()&&SESSION_USER===''?'background-color:red;':'background-color:lime;').'z-index:2;border-radius:50%;width:30px;height:30px;position:absolute;top:5%;left:22%;">&nbsp;</span>
           
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
	echo PPDB::autoRedirect('not an image', 'Failed', 'danger');	
    $uploadOk = 0;
  }

// Check if file already exists
if (file_exists($target_file)) {
  echo PPDB::autoRedirect('file already exists.', 'Failed', 'danger');	
  $uploadOk = 0;
}

// Check file size
if ($_FILES["propic"]["size"] > 500000) {
   echo PPDB::autoRedirect('your file is too large.', 'Failed', 'danger');	
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
   echo PPDB::autoRedirect('only JPG, JPEG, PNG & GIF files are allowed.', 'Failed', 'danger');	
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   echo PPDB::autoRedirect('your file was not uploaded.', 'Failed', 'danger');	
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["propic"]["tmp_name"], $target_file)) {
	  if(rename($getAvatars.$_FILES["propic"]["name"], $getAvatars.SESSION_USER.".png")){
		  $data = array("user"=>$info['user'], "password"=>$info['password'], "email"=>$email, "ip"=>$info['ip'] ,'displayName'=>($display!==''?$display:SESSION_USER), 'about'=>$about);
	$query = json_encode($data);
	$file = fopen(Utils::getROOT("ROOT",Utils::getDS())."user.json", "w+");
	fwrite($file, $query);
	fclose($file);
	
	  }else{
		  echo PPDB::autoRedirect('to rename item', 'Failed', 'danger');	
	  }
 	
  } else {
	echo PPDB::autoRedirect('there was an error uploading your file.', 'Failed', 'danger');	
  }
}
  
}else{
	$data = array("user"=>$info['user'], "password"=>$info['password'], "email"=>$email, "ip"=>$info['ip'] ,'displayName'=>($display!==''?$display:SESSION_USER), 'about'=>$about);
	$query = json_encode($data);
	$file = fopen(Utils::getROOT("ROOT",Utils::getDS())."user.json", "w+");
	fwrite($file, $query);
	fclose($file);
	
}
			echo PPDB::autoRedirect('Profile', 'saving');	
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
