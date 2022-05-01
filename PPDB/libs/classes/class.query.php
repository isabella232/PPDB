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

function export($dir,$tdir, $Split, $name, $type){
	 try{
		if(!PPDBLogic::isString($dir)){
			throw new PPDBErr($dir);
		}
	}catch(PPDBErr $e){
		echo $e->isNotString();
	}
	 try{
		if(!PPDBLogic::isString($tdir)){
			throw new PPDBErr($tdir);
		}
	}catch(PPDBErr $e){
		echo $e->isNotString();
	}
	try{
		if(!PPDBLogic::isString($name)){
			throw new PPDBErr($name);
		}
	}catch(PPDBErr $e){
		echo $e->isNotString();
	}
	 try{
		if(!PPDBLogic::isString($type)){
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
		$path = $tdir.$date.$Split;
		if(!is_dir($path)){
			mkdir($path, 0777, true);
			$data = PPDB::minify(file_get_contents($dir.$name.".json"));
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
		if($Split === DS){
		$getMoved = str_replace(DOC_ROOT_BACKWARDS,"", $path);
		}
		if($Split === DS_FORWARD){
		$getMoved = str_replace(DOC_ROOT,"", $path);
		}
		echo '<a href="'.$getMoved.$name.".json".'" class="backup_'.$id.'" download="'.$date.'-'.$name.'.json"></a>'.PPDB::createJS('setTimeout(function(){
			let download = document.querySelector(".backup_'.$id.'");
			download.click();
			download.remove();
			document.querySelector("#DownloadScript").remove();
		});', "DownloadScript");
	}
	if($type === "PHP_ARRAY"){
			$date = date("Y-m-d");
		$path = $tdir.$date.$Split;
		if(!is_dir($path)){
			mkdir($path, 0777, true);
			$data = PPDB::minify(file_get_contents($dir.$name.".json"));
			$data = PPDB::JSONTOARRAY($data);
			$file = fopen($path.$name.".php", "w+");
			fwrite($file, PPDB::minify(htmlspecialchars_decode("&lt;?php exit();?&gt;")."\n".str_replace("Array","array",print_r($data))));
			fclose($file);
		}else{
			$data = file_get_contents($dir.$name.".json");
			$data = str_replace(array("\n","\t","\t\n"),"",PPDB::JSONTOARRAY($data));
			$file = fopen($path.$name.".php", "w+");
			fwrite($file, PPDB::minify(htmlspecialchars_decode("&lt;?php exit();?&gt;")."\n".str_replace("Array","array",print_r($data))));
			fclose($file);
		}
		$id = uniqid();
		if($Split === DS){
		$getMoved = str_replace(ROOT_DOC_FORWARD,"", $path);
		}
		if($Split === DS_FORWARD){
		$getMoved = str_replace(ROOT_DOC,"", $path);
		}
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
		if(!PPDBLogic::isArray($tbs)){
			throw new PPDBErr($tbs);
		}
	}catch(PPDBErr $e){
		echo $e->isNotArray();
		return false;
	}
	try{
		if(!PPDBLogic::isArray($trs)){
			throw new PPDBErr($trs);
		}
	}catch(PPDBErr $e){
		echo $e->isNotArray();
		return false;
	}
	try{
		if(!PPDBLogic::isString($main)){
			throw new PPDBErr($main);
		}
	}catch(PPDBErr $e){
		echo $e->isNotString();
		return false;
	}
		try{
		if(!PPDBLogic::isArray($cels)){
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

public function createLinkedTable($tbs, $trs, $main, $cels){
	$table = '';
	try{
		if(!PPDBLogic::isArray($tbs)){
			throw new PPDBErr($tbs);
		}
	}catch(PPDBErr $e){
		echo $e->isNotArray();
		return false;
	}
	try{
		if(!PPDBLogic::isArray($trs)){
			throw new PPDBErr($trs);
		}
	}catch(PPDBErr $e){
		echo $e->isNotArray();
		return false;
	}
	try{
		if(!PPDBLogic::isString($main)){
			throw new PPDBErr($main);
		}
	}catch(PPDBErr $e){
		echo $e->isNotString();
		return false;
	}
		try{
		if(!PPDBLogic::isArray($cels)){
			throw new PPDBErr($cels);
		}
	}catch(PPDBErr $e){
		echo $e->isNotArray();
		return false;
	}
	
	$table .= '<table id="portTable" class="table table-hover table-dark table-bordered">';
    $table .= '<caption class="text-primary bg-dark">PPDB Table viewer - ©SurveyBuilder</caption>';
	$table .= '<tr class="table-success">';
	foreach($tbs as $tb){
		$table.='<th scope="col">'.$tb.'</th>';
	}
	$table .= '</tr>';

	for($i=0;$i<sizeof($trs[$main]);$i++){
        $valLine = $i+1;
			$table .= '<tr onclick="hightlightQuery('.$valLine.')">';
		foreach($cels as $cel){
			$table .= '<td scope="row">'.$trs[$main][$i][$cel].'</td>';
		}
		$table .= '</tr>';
        $table .= '</a>';
	}
	$this->isTab = true;
    $this->table = $table;
	return $this;
}


public function view($line){
  try{
			if(!PPDBLogic::isNumber($line)){
				throw new PPDBErr($line);
			}
		}catch(PPDBErr $e){
			echo $e->isNotNumber();
			return false;
		}
if($line === -1){
	$arg = '';
    $arg .= $this->table;
    $arg .= '<script>
      function hightlightQuery(n){
          location.hash = "#L"+n;
            let table = document.querySelector("#portTable");
        let tr = table.querySelectorAll("tr");
        for(let i=1;i<tr.length;i++){
            if(parseInt(location.hash.replace("#L", "")) === tr[i].rowIndex){
                tr[i].setAttribute("class", "table-primary");
            }else{
            tr[i].removeAttribute("class");
            }
        }
  }
hightlightQuery(location.hash.replace("#L", ""));
    </script>';
return $arg;
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

public function allowSearch($searchBy=0){
    try{
        if(!PPDBLogic::isNumber($searchBy)){
            throw new PPDBErr($searchBy);
        }
    }catch(PPDBErr $e){
        $e->isNotNumber();
    }
    $out = '';
    $rowsPlace = $searchBy+1;
    $out.='<input type="search" id="searchBarFilter" placeholder="Search(row '.$rowsPlace.')..." oninput="filterTable('.$searchBy.')"/>';
    $out .= "<script>
function filterTable(n) {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('searchBarFilter');
  filter = input.value.toUpperCase();
  table = document.getElementById('portTable');
  tr = table.getElementsByTagName('tr');

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[n];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }
  }
}
</script>";
    return $out;
}

public function allowPageLimit($data=[5,10,15,20]){
        try{
        if(!PPDBLogic::isArray($data)){
            throw new PPDBErr($data);
        }
    }catch(PPDBErr $e){
        $e->isNotArray();
    }
$out = '';
$out .= '<select class="form-select limitTable" style="width:50%;" onchange="limitPage()">';
foreach($data as $d){
    $out .= '<option value="'.$d.'">'.$d.'</option>';
}
$out .= '</select>';
$out .= '<script>
function limitPage(){
   let table = document.querySelector("#portTable");
        let tr = table.querySelectorAll("tr");
        let select = document.querySelector(".limitTable").selectedIndex;
        let str = document.querySelector(".limitTable").options;
        for(let i=1;i<tr.length;i++){
            if(tr[i].rowIndex > parseInt(str[select].text)){
                tr[i].hidden = true;
            }else{
                 tr[i].hidden = false;
            }
        }
}
setTimeout(limitPage, 0);
</script>';
return $out;
}


}

$READER = new query();

?>