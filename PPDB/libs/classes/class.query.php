<?php
class query{
	# Properties
 public $path;
 public $args;
  
  # Methods
 function select($sdir, $sname) {
      $this->path = $sdir . $sname . ".json";
	  return $this;
  }
  
function read(){
	$getContents = file_get_contents($this->path);
	
			$this->args = json_decode($getContents, true);
			return $this->args;
}
function update($update){
		$encode = json_encode($update);
		$data = fopen($this->path, "w+");
		fwrite($data, $encode);
		fclose($data);
}


}
$data = new query();
$READER = $data;
	
?>