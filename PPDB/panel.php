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
			echo PPDB::createPanelCSS();
			?>
		</head>
		<body>
			<?php
echo PPDB::userUI(ROOT);
PPDB::checkDeletedFile(ROOT);
if(isset($_POST['regbtn'])){
		$username = $_POST['username'];
		$psw = $_POST['psw'];
		# Password, min, max, lower, upper, number, symbols
		if(PPDB::CHECK_VALID_PASSWORD($psw, 8, 20, true, true, true, false)){
			PPDB::INSTALL(ROOT, $username, $psw);
		$_SESSION['username'] = $username;
		}
	}
	if(isset($_POST['logbtn'])){
		$username = $_POST['username'];
		$psw = $_POST['psw'];
		$json = file_get_contents(ROOT."user.json");
		$query = json_decode($json);
		if($username === $query->user && PPDB::PSW_VARIFY($psw, $query->password)){
			$_SESSION['username'] = $username;
				Reload::run();
		}else{
			echo PPDB::failed("Error: cannot login correctly!");
		}
		
	}
	
	echo PPDB::loadPanel();
	echo PPDB::logout();
	# Storage
	if(isset($_POST['store']) && SESSION_USER){
		echo "<br/><br/><form method='post'>
		<input type='submit' value='Create Storage' name='cs'/><br/><br/>
		<input type='submit' value='Remove Storage' name='rs'/>
		</form>";
	}
		if(isset($_POST['cs'])){
			if(!PPDBLogic::storageExists(ROOT)){
				PPDB::createStorage(ROOT); # ROOT or ROOT_FORWARD
		echo PPDB::success("Storage created");	
		}else{
		echo PPDB::failed("Storage already exists.");	
		}
		}
		if(isset($_POST['rs'])){
		if(PPDBLogic::storageExists(ROOT)){
		PPDB::removeStorage(ROOT, DS); # ROOT/ROOT_FORWARD || DS/DS_FORWARD
		echo PPDB::success("Storage Removed.");	
		}else{
		echo PPDB::failed("Storage does not exist.");	
		}
		
			
		}
	# Database
	
	if(isset($_POST['db']) && SESSION_USER){
			echo "<br/><br/><form method='post'>
			<input type='text' placeholder='Enter Database Name' name='dbname' require/><br/>
			<br/>
			<input type='text' placeholder='Enter Table Name' onchange='writeTable(this.value)' name='tbname' require/><br/>
			<br/>
			<textarea placeholder='Enter JSON code' id='dbarr' name='dbarr' style='margin-left:5px;width:60%;height:40%;'></textarea>
			<br/>
			<br/>
			<input type='submit' value='Create/Update' name='dbsubmit'/><br/><br/>
			<input type='submit' value='Remove' name='dbremove'/><br/><br/>
			<input type='submit' value='Rename' name='dbrename'/><br/><br/>
			<input type='submit' value='Info' name='dbinfo'/><br/><br/>
			<input type='submit' value='Export as JSON' name='exportasjson'/><br/><br/>
			<input type='submit' value='Export as PHP_ARRAY' name='exportasphp_array'/>
		</form><br/>"; 
		echo "<hr style=' border: 10px solid cyan;border-radius: 5px;'/>
		<br/>
		<form method='post' enctype='multipart/form-data'>
		<h5>Upload exported JSON file</h5>
			<input type='file' required class='form-group' name='reg_db_import'/>
			<br/><br/>
			<input type='submit' value='Upload JSON fie' name='upload_reg_import'/>
			</form>";
	}
	# upload exported file
	if(isset($_POST['upload_reg_import'])){
		$target_dir = "db/";
$target_file = $target_dir . preg_replace("/\d{4}-\d{2}-\d{2}-/",'',basename($_FILES["reg_db_import"]["name"]));
$uploadOk = 1;
$extend = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if file already exists
if (file_exists($target_file)) {
  echo PPDB::failed("Sorry, ".$target_file." already exists.");
  $uploadOk = 0;
}

// Allow certain file formats
if($extend != "json") {
  echo PPDB::failed("Sorry, only JSON files are allowed.");
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo PPDB::failed("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["reg_db_import"]["tmp_name"], $target_file)) {
    echo PPDB::success("The file ". htmlspecialchars(str_replace($target_dir,'',$target_file)). " has been uploaded.");
  } else {
    echo PPDB::failed("Sorry, there was an error uploading your file.");
  }
	}
}
	# reg add
	if(isset($_POST['dbsubmit'])){
		$fileName = $_POST['dbname'];
				$args = PPDB::JSONTOARRAY($_POST['dbarr']);
		if(!PPDBLogic::dbExists(ROOT_DB, $fileName)){ # ROOT_DB/ROOT_DB_FORWARD
			PPDB::createDB(ROOT_DB, $fileName, $args); # ROOT_DB/ROOT_DB_FORWARD
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Created<p>';
		}else{
			$READER->select(ROOT_DB, $fileName)->update($args);
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Updated<p>';
		}
	
}
	if(isset($_POST['dbremove'])){
			$fileName = $_POST['dbname'];
		if(PPDBLogic::dbExists(ROOT_DB, $fileName)){
			PPDB::removeDB(ROOT_DB, $fileName);
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Removed<p>';
		}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';	
		}
	}
if(isset($_POST['dbrename'])){
			$fileName = $_POST['dbname'];
			$replace = explode(">", $fileName);
		if(PPDBLogic::dbExists(ROOT_DB, $replace[0])){
			if(strpos($fileName, ">")){

			PPDB::renameDB(ROOT_DB, $replace[0], $replace[1]);
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Renamed<p>';
			}else{
				echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Textbox does not have ">" to change name<p>';
			}

		}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';	
		}
	}
if(isset($_POST['dbinfo'])){
	$fileName = $_POST['dbname'];
	if(PPDBLogic::dbExists(ROOT_DB, $fileName)){
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(15).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'"> Created: '.PPDB::infoDB(ROOT_DB,$fileName)['created'].'<br/> Updated: '.PPDB::infoDB(ROOT_DB,$fileName)['updated'].'<br/> Size: '.PPDB::infoDB(ROOT_DB,$fileName)['size'].'<br/> Type: '.PPDB::infoDB(ROOT_DB,$fileName)['type'].'<p>';
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
}
if(isset($_POST['exportasjson'])){
	$fileName = $_POST['dbname'];
	if(PPDBLogic::dbExists(ROOT_DB, $fileName)){
		$READER->export(ROOT_DB, ROOT_TEMP, DS, $fileName, "JSON");
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database has been exported.<p>';
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
}
if(isset($_POST['exportasphp_array'])){
	$fileName = $_POST['dbname'];
	if(PPDBLogic::dbExists(ROOT_DB, $fileName)){
		$READER->export(ROOT_DB, ROOT_TEMP, DS, $fileName, "PHP_ARRAY");
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database has been exported.<p>';
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
}
# Table

if(isset($_POST['table']) && SESSION_USER){
	echo '<br/><br/><form method="post">
	<input type="text" name="dbname" placeholder="Enter Database Name"/><br/></br>
	<input type="text" name="dbarr" placeholder="Enter data(use \',\' split)"/><br/></br>
	<input type="text" name="dbmain" placeholder="Enter Table Name"/><br/></br>
	<input type="submit" name="LoadTable" value="Load Table"/><br/></br>
	<input type="submit" name="LoadLinkedTable" value="Load Linked Table"/>
	</form>';
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
	if(PPDBLogic::dbExists(ROOT_DB,$name)){
		echo $READER->allowSearch(0);
		echo $READER->allowPageLimit([5,10,20,50,100]);
		echo $READER->createLinkedTable($data, PPDB::JSONTOARRAY(file_get_contents(ROOT_DB.$name.'.json')), $main ,$data)->view(VIEW_ALL);
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
}

# export SQL
if(isset($_POST['mySQL']) && SESSION_USER){
	echo '<br/><br/><form method="post">
	<input type="text" name="sql_host" placeholder="Enter mySQL host" required=""/><br/></br>
	<input type="text" name="sql_user" placeholder="Enter mySQL username" required=""/><br/></br>
	<input type="password" name="sql_psw" placeholder="Enter mySQL password"/><br/></br>
	<input type="text" name="sql_db" placeholder="Enter mySQL database" required=""/><br/></br>
	<input type="text" name="sql_table" placeholder="Enter mySQL table" required=""/><br/></br>
	<input type="submit" name="sql_import" value="Import Database"/>
	</form>';
}
if(isset($_POST['sql_import'])){
	$host = $_POST['sql_host'];
	$user = $_POST['sql_user'];
	$psw = $_POST['sql_psw'];
	$db = $_POST['sql_db'];
	$table = $_POST['sql_table'];
	$msql->connect($host, $user, $psw, $db)->importAll(ROOT_DB, $table);
}

if(isset($_POST['delteAccount']) && SESSION_USER){
	PPDB::deleteAccount(ROOT);
	PPDB::checkDeletedFile(ROOT);
}
if(isset($_POST['changePassword']) && SESSION_USER){
	echo '<br/><br/><form method="post">
	<input type="password" name="old_psw" placeholder="Enter Old Password" required=""/><br/></br>
	<input type="password" name="new_psw" placeholder="Enter New Password" required=""/><br/></br>
	<input type="password" name="new_psw_copy" placeholder="Renter New Password" required=""/><br/></br>
	<input type="submit" name="exec_change_psw" value="Change Password"/>
	</form>';
}
if(isset($_POST['exec_change_psw']) && SESSION_USER){
	$old = $_POST['old_psw'];
	$new = $_POST['new_psw'];
	$copyNew = $_POST['new_psw_copy'];
	$json = file_get_contents(ROOT."user.json");
	$query = json_decode($json);
	if(PPDB::CHECK_VALID_PASSWORD($new, 8, 20, true, true, true, false)){
			if($copyNew === $new){
		 PPDB::CHANGE_PSW(ROOT, $old, $new);
		}else{
			echo PPDB::failed("The New Password does not match");
		}
	}
	
}
?>




			<!-- JavaScript Bundle with Popper -->
			<?php
			echo PPDB::createJSLink("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", true, "sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p", "anonymous");
			echo PPDB::createJS("function writeTable(type){document.querySelector('#dbarr').value = '{\\n\"'+type+'\": [{\\n\\n}]\\n}';}","");
			echo PPDB::createJSLink("libs/js/previewImg.js");
			echo PPDB::createJSLink("libs/js/previewVid.js");
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
				$(".previewImg").tooltip({ boundary: "window" , placement: "left"})
			}, 100);', '');
			
			
			echo PPDB::createJS('setTimeout(function(){
				let t = document.querySelectorAll("#portTable tr td");
				for(let i=0;i<t.length;i++){
					if(/(https?:\/\/.*\.(?:mp4|mov?|wmv|avi|avchd))/g.test(t[i].innerHTML)){
						t[i].innerHTML = returnVid(t[i].innerHTML, 320, 320, t[i].innerHTML);
					}
				}
			}, 0)', '');
			echo PPDB::createJS('setTimeout(function(){
				$(".previewVid").tooltip({ boundary: "window" , placement: "left"})
			}, 100);', '');
		
			?>
		</body>
	</html>
