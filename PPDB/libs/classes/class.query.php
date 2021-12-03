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

function export($dir, $tdir, $name, $type){
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
		$path = $tdir.$date.DS;
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
		$getMoved = str_replace(DOC_ROOT_BACKWARDS,"", $path);
		echo '<a href="'.$getMoved.$name.".json".'" class="backup_'.$id.'" download="'.$date.'-'.$name.'.json"></a>'.PPDB::createJS('setTimeout(function(){
			let download = document.querySelector(".backup_'.$id.'");
			download.click();
			download.remove();
			document.querySelector("#DownloadScript").remove();
		});', "DownloadScript");
	}
	if($type === "PHP_ARRAY"){
			$date = date("Y-m-d");
		$path = $tdir.$date.DS;
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

public function listFiles($dir){
	foreach(glob($dir."*.json*") as $file){
		return $file;
	}
}

public function createTable($tbs, $trs, $main, $cels){
	$table = '';
	try{
		if(!PPDB::isArray($tbs)){
			throw new PPDBErr($tbs);
		}
	}catch(PPDBErr $e){
		echo $e->isNotArray();
		return false;
	}
	try{
		if(!PPDB::isArray($trs)){
			throw new PPDBErr($trs);
		}
	}catch(PPDBErr $e){
		echo $e->isNotArray();
		return false;
	}
	try{
		if(!PPDB::isString($main)){
			throw new PPDBErr($main);
		}
	}catch(PPDBErr $e){
		echo $e->isNotString();
		return false;
	}
		try{
		if(!PPDB::isArray($cels)){
			throw new PPDBErr($cels);
		}
	}catch(PPDBErr $e){
		echo $e->isNotArray();
		return false;
	}
	
	$table .= '<table>';
	$table .= '<tr>';
	foreach($tbs as $tb){
		$table.='<th>'.$tb.'</th>';
	}
	$table .= '</tr>';

	for($i=0;$i<sizeof($trs[$main]);$i++){
			$table .= '<tr>';
		foreach($cels as $cel){
			$table .= '<td>'.$trs[$main][$i][$cel].'</td>';
		}
		$table .= '</tr>';
	}
	$table .= '</table>';
	
	return $table;
}

}

$READER = new query();

?>