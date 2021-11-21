<?php
class mySQL{
	public $host;
	public $user;
	public $psw;
	public $db;
	public $conn;
	public $arr;
	
	private function __contruct(){		
	# Nothing
	}
	public static function connect($host, $user, $psw, $db){
		$this->host = $host;
		$this->user = $user;
		$this->psw = $psw;
		$this->conn = new sqli($host, $user, $psw, $db);
	if ($this->conn->connect_error) {
  		die("Connection failed: " . $this->conn->connect_error);
		}
	}
	public static function exportAll($table){
	  $sql = "select * from '.$table.'";
    	  $result = mysqli_query($this->conn, $sql) or die("Error in Selecting " . mysqli_error($this->conn));
		$arr = array();
		while($row = mysqli_fetch_assoc($result)){
		  $this->arr[] = $row;
		}
		$encode = json_encode($arr);
		$export = fopen(ROOT_DB.DS."SQLALL.json", "w+");
		fwrite($export, $encode);
		fclose($export);
	}
       public static function export($table, $selector){
       	$sql = "select '.$selector.' from '.$table.'";
    	  $result = mysqli_query($this->conn, $sql) or die("Error in Selecting " . mysqli_error($this->conn));
		$arr = array();
		while($row = mysqli_fetch_assoc($result)){
		  $this->arr[] = $row;
		}
		$encode = json_encode($arr);
		$export = fopen(ROOT_DB.DS."SQL_'.$selector.'.json", "w+");
		fwrite($export, $encode);
		fclose($export);
	}
       }

?>
