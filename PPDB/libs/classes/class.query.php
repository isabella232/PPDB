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

function export($root, $dir, $tdir, $name, $type){
	 try{
		if(!PPDB::isString($root)){
			throw new PPDBErr($root);
		}
	}catch(PPDBErr $e){
		echo $e->isNotString();
	}
	 try{
		if(!PPDB::isString($dir)){
			throw new PPDBErr($dir);
		}
	}catch(PPDBErr $e){
		echo $e->isNotString();
	}
	 try{
		if(!PPDB::isString($tdir)){
			throw new PPDBErr($tdir);
		}
	}catch(PPDBErr $e){
		echo $e->isNotString();
	}
	try{
		if(!PPDB::isString($name)){
			throw new PPDBErr($name);
		}
	}catch(PPDBErr $e){
		echo $e->isNotString();
	}
	 try{
		if(!PPDB::isString($type)){
			throw new PPDBErr($type);
		}
	}catch(PPDBErr $e){
		echo $e->isNotString();
	}
	try{
		if(!file_exists($dir.$name.".json")){
			throw new PPDBErr($dir.$name);
		}
	}catch(PPDBErr $e){
		echo $e->fileNotFound();
	}
	 try{
		if($type !== "JSON" && $type !== "PHP_ARRAY"){
			throw new PPDBErr($type);
		}
	}catch(PPDBErr $e){
		$e->invalidExportFormat();
	}
	
	if($type === "JSON"){
		$date = date("Y-m-d");
		$path = $root."libs".DS."temp".DS.$date.DS;
		if(!is_dir($path)){
			mkdir($path, 0777, true);
			$data = file_get_contents($dir.$name.".json");
			$file = fopen($path.$name.".json", "w+");
			fwrite($file, $data);
			fclose($file);
		}else{
			$data = file_get_contents($dir.$name.".json");
			$file = fopen($path.$name.".json", "w+");
			fwrite($file, $data);
			fclose($file);
		}
		$id = uniqid();
		$getMoved = str_replace(DOC_ROOT_FORWARD,"", $path);
		echo '<a href="'.$getMoved.$name.".json".'" class="backup_'.$id.'" download="'.$date.'-'.$name.'.json"></a>'.PPDB::createJS('setTimeout(function(){
			let download = document.querySelector(".backup_'.$id.'");
			download.click();
			download.remove();
			document.querySelector("#DownloadScript").remove();
		});', "DownloadScript");
	}
	if($type === "PHP_ARRAY"){
			$date = date("Y-m-d");
		$path = $root."libs".DS."temp".DS.$date.DS;
		if(!is_dir($path)){
			mkdir($path, 0777, true);
			$data = file_get_contents($dir.$name.".json");
			$data = PPDB::JSONTOARRAY($data);
			$file = fopen($path.$name.".php", "w+");
			fwrite($file, print_r($data, true));
			fclose($file);
		}else{
			$data = file_get_contents($dir.$name.".json");
			$data = PPDB::JSONTOARRAY($data);
			$file = fopen($path.$name.".php", "w+");
			fwrite($file, print_r($data, true));
			fclose($file);
		}
		$id = uniqid();
		$getMoved = str_replace(DOC_ROOT_FORWARD,"", $path);
		echo '<a href="'.$getMoved.$name.".php".'" class="backup_'.$id.'" download="'.$date.'-'.$name.'.php"></a>'.PPDB::createJS('setTimeout(function(){
			let download = document.querySelector(".backup_'.$id.'");
			download.click();
			download.remove();
			document.querySelector("#DownloadScript").remove();
		});', "DownloadScript");
	}
	
}

}
$data = new query();
$READER = $data;
	
?>