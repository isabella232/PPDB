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
			PPDB::createStorage(ROOT);
echo PPDB::userUI(ROOT);
if(!file_exists(ROOT.'user.json')){
		session_unset();
}
if(isset($_POST['regbtn'])){
		$username = $_POST['username'];
		$psw = $_POST['psw'];
		
		PPDB::INSTALL($username, $psw);
		$_SESSION['username'] = $username;
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
	# Demo
	$args = array("user"=>array(0=>array("name"=>"hello","age"=>32,"expire"=>"01-21"), 1=>array("name"=>"world","age"=>21,"expire"=>"02-21")));
	PPDB::createDB(ROOT_DB, "data",  $args);

	//echo $READER->select(ROOT_DB, "data")->read()["user"][0]['name'];
	echo $READER->select(ROOT_DB, "data")->update(array("user"=>array(0=>array("name"=>"hello","age"=>32,"expire"=>"01-21"), 1=>array("name"=>"world","age"=>21,"expire"=>"02-21"))));

?>
			<!-- JavaScript Bundle with Popper -->
			<?php
			echo PPDB::createJSLink("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", true, "sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p", "anonymous");
			?>
		</body>
	</html>
