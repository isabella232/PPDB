<?php
class mySQL{
	private $host;
	private $user;
	private $psw;
	private $db;
	public function __construct(){
	# Nothing
	}
	public function connect($host, $user, $psw, $db){
		$this->host = $host;
		$this->user = $user;
		$this->psw = $psw;
		$this->db = $db;
		filter_var($this->host, FILTER_SANITIZE_STRING);
		filter_var($this->user, FILTER_SANITIZE_STRING);
		filter_var($this->psw, FILTER_SANITIZE_STRING);
		filter_var($this->db, FILTER_SANITIZE_STRING);
		return $this;
	}
	public function getInfo(){
		$info = "Host: " . $this->host . "<br/> Username: " . $this->user . "<br/> Password: " . $this->psw . "<br/> Database: " . $this->db;
		return $info;
	}
	public function importAll($db,$table){
		$conn = mysqli_connect($this->host, $this->user, $this->psw, $this->db);
		try{
		if(!$conn){
			throw new PPDBErr();
		}
	}catch(PPDBErr $e){
		echo $e->mySQL_DB_FAIL();
		return false;
	}
		
		$query = "SELECT * FROM ".filter_var($table, FILTER_SANITIZE_STRING)."";
		$result = mysqli_query($conn, $query);
		if(!$result){ echo "Couldn't execute the query"; die();}
			else{

				//creates an empty array to hold data
				$data = array();
				while($row = mysqli_fetch_assoc($result)){
				$data[]=$row;
				}
			$currentDB = str_replace($this->user."_", "", $this->db);
			$fp = fopen($db.$currentDB.".json", "w+");
			fwrite($fp, '{"'.$table.'":'.json_encode($data, JSON_PRETTY_PRINT).'}');
			fclose($fp);
	}
}
public function import($db, $table, $sel){
	$conn = mysqli_connect($this->host, $this->user, $this->psw, $this->db);
		try{
		if(!$conn){
			throw new PPDBErr();
		}
	}catch(PPDBErr $e){
		echo $e->mySQL_DB_FAIL();
		return false;
	}
	$currentDB = str_replace($this->user."_", "", $this->db);
		if(file_exists($db.$currentDB.".json")){
			unlink($db.$currentDB.".json");
		}
		foreach($sel as $s){
			$query = "SELECT ".$s." FROM ".filter_var($table, FILTER_SANITIZE_STRING)."";
		$result = mysqli_query($conn, $query);
		if(!$result){ echo "Couldn't execute the query"; die();}
			else{

				//creates an empty array to hold data
				$data = array();
				while($row = mysqli_fetch_assoc($result)){
				$data[]=$row;
				}
			$fp = fopen($db.$this->db.".json", "a+");
			fwrite($fp, '{"'.filter_var($table, FILTER_SANITIZE_STRING).'":'.json_encode($data, JSON_PRETTY_PRINT).'}');
			fclose($fp);
	}
		}
		
}

}
$msql = new mySQL();
?>