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


}
$data = new query();
$READER = $data;
	
?>