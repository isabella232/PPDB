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
		
		$query = "SELECT * FROM ".$table."";
		$result = mysqli_query($conn, $query);
		if(!$result){ echo "Couldn't execute the query"; die();}
			else{

				//creates an empty array to hold data
				$data = array();
				while($row = mysqli_fetch_assoc($result)){
				$data[]=$row;
				}
			$fp = fopen($db.$this->db.".json", "w+");
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
		if(file_exists($db.$this->db.".json")){
			unlink($db.$this->db.".json");
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
			$fp = fopen($db.$this->db.".json", "a+");
			fwrite($fp, '{"'.$table.'":'.json_encode($data, JSON_PRETTY_PRINT).'}');
			fclose($fp);
	}
		}
		
}

}
$msql = new mySQL();
?>