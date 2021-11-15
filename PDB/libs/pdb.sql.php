<?php
class mySQL{
	private $host;
	private $user;
	private $psw;
	private $db;
	public $conn;
	
	private function __contruct(){
		#nothing
	}
	public static function connect($host, $user, $psw, $db){
		$conn = new sqli($host, $user, $psw, $db);
	if ($conn->connect_error) {
  		die("Connection failed: " . $conn->connect_error);
		}
	}
	public static function exportAll($table){
	  $sql = "select * from '.$table.'";
    	  $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
		$arr = array();
		while($row = mysqli_fetch_assoc($result)){
		  $result[] = $row;
		}
		$encode = json_encode($arr);
		$export = fopen(ROOT_DB.DS."SQLALL.json", "w+");
		fwrite($export, $encode);
		fclose($export);
	}
       public static function export($table, $selector){
       	$sql = "select '.$selector.' from '.$table.'";
    	  $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
		$arr = array();
		while($row = mysqli_fetch_assoc($result)){
		  $result[] = $row;
		}
		$encode = json_encode($arr);
		$export = fopen(ROOT_DB.DS."SQLALL.json", "w+");
		fwrite($export, $encode);
		fclose($export);
	}
       }
}
?>
