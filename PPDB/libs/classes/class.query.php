<?php
class query{
	# Properties
 public $path;
 public $args;
 public $isTab = false;
 public $table;
  
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
    $data = [];
	foreach(glob($dir."*.json*") as $file){
        $data[] = $file;
	}
    return $data;
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
	
	$table .= '<table id="portTable" class="table table-hover table-dark table-bordered table-striped">';
    $table .= '<caption class="text-primary bg-dark">PPDB Table viewer - ©SurveyBuilder</caption>';
	$table .= '<tr class="table-success">';
	foreach($tbs as $tb){
		$table.='<th scope="col">'.$tb.'</th>';
	}
	$table .= '</tr>';

	for($i=0;$i<sizeof($trs[$main]);$i++){
			$table .= '<tr>';
		foreach($cels as $cel){
			$table .= '<td scope="row">'.$trs[$main][$i][$cel].'</td>';
		}
		$table .= '</tr>';
	}
	$table .= '</table>';
	$this->isTab = true;
    $this->table = $table;
	return $this;
}
public function view($line){
  try{
			if(!PPDB::isNumber($line)){
				throw new PPDBErr($line);
			}
		}catch(PPDBErr $e){
			echo $e->isNotNumber();
			return false;
		}
if($line === -1){
return $this->table;
}else{
    $t = $this->table;
    $t .= '<script>
    function runQuery(){
        let table = document.querySelector("#portTable");
        let tr = table.querySelectorAll("tr");
        for(let i=1;i<tr.length;i++){
            if(tr[i].rowIndex !== '.$line.'){
                tr[i].style.display = "none";
            }
        }
       
    }
   setTimeout(runQuery, 0);
    </script>';
return $t;
}

}

}

$READER = new query();

?>