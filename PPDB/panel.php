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
if(!file_exists(ROOT.'user.json') && SESSION_USER){
		session_unset();
		Reload::run();
}
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
		$psw = PPDB::PSW_ENCRYPT($psw);
		$json = file_get_contents(ROOT."user.json");
		$query = json_decode($json);
		if($username === $query->user && $psw === $query->password){
			$_SESSION['username'] = $username;
				Reload::run();
		}else{
			echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(42).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Error: cannot login correctly!</p>';
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
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Storage created<p>';	
		}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Storage already exists<p>';	
		}
		}
		if(isset($_POST['rs'])){
		if(PPDBLogic::storageExists(ROOT)){
		PPDB::removeStorage(ROOT, DS); # ROOT/ROOT_FORWARD || DS/DS_FORWARD
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Storage Removed<p>';	
		}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Storage does not exist.<p>';	
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
			<input type='submit' value='Info' name='dbinfo'/>
		</form>"; 
	}
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
		echo $READER->allowPageLimit();
		echo $READER->createTable($data, PPDB::JSONTOARRAY(file_get_contents(ROOT_DB.$name.'.json')), $main ,$data)->view(VIEW_ALL);
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
}
if(isset($_POST['LoadLinkedTable'])){
	$name = $_POST['dbname'];
	$isdata = preg_replace("/\s*/m","",$_POST['dbarr']);
	$data = explode(",",$isdata);
	$main = $_POST['dbmain'];
	if(PPDBLogic::dbExists(ROOT_DB,$name)){
		echo $READER->allowSearch(0);
		echo $READER->allowPageLimit();
		echo $READER->createLinkedTable($data, PPDB::JSONTOARRAY(file_get_contents(ROOT_DB.$name.'.json')), $main ,$data)->view(VIEW_ALL);
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
	
}

?>




			<!-- JavaScript Bundle with Popper -->
			<?php
			echo PPDB::createJSLink("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", true, "sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p", "anonymous");
			echo PPDB::createJS("function writeTable(type){document.querySelector('#dbarr').value = '{\\n\"'+type+'\": [{\\n\\n}]\\n}';}","");
			echo URIS::config(BGCOLOR,["#696a69","body"]);
			//echo URIS::config(PREVIEW_IMG, ["body", "https://www.hdnicewallpapers.com/Walls/Big/Rainbow/Rainbow_on_Mountain_HD_Image.jpg", 320, 320, "Rainbow on Mountain"]);
		
			?>
		</body>
	</html>
