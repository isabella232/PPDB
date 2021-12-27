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
		return $this;
	}
	public function getInfo(){
		$info = "Host: " . $this->host . "<br/> Username: " . $this->user . "<br/> Password: " . $this->psw . "<br/> Database: " . $this->db;
		return $info;
	}
	public function exportAll($db,$table){
		$conn = @mysqli_connect($this->host, $this->user, $this->psw, $this->db) or die("Cannot connect to mySQL server");
		$query = "SELECT * FROM ".$table."";
		$result = mysqli_query($conn, $query);
		if(!$result){ echo "Couldn't execute the query"; die();}
			else{

				//creates an empty array to hold data
				$data = array();
				while($row = mysqli_fetch_assoc($result)){
				$data[]=$row;
				}
			$fp = fopen($db.$table.".json", "w+");
			fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
			fclose($fp);
	}
}
public function export($db, $table, $sel){
		$conn = @mysqli_connect($this->host, $this->user, $this->psw, $this->db) or die("Cannot connect to mySQL server");
		if(file_exists($db.$table.".json")){
			unlink($db.$table.".json");
		}
		foreach($sel as $s){
			$query = "SELECT ".$s." FROM ".$table."";
		$result = mysqli_query($conn, $query);
		if(!$result){ echo "Couldn't execute the query"; die();}
			else{

				//creates an empty array to hold data
				$data = array();
				while($row = mysqli_fetch_assoc($result)){
				$data[]=$row;
				}
			$fp = fopen($db.$table.".json", "a+");
			fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
			fclose($fp);
	}
		}
		
}

}
$msql = new mySQL();
?>