<?php
function switchForm($bool){
	switch($bool){
		case 1:
		return "false";
		break;
		case 0:
		return "true";
		break;
	}
}
function boolToStr($bool){
	switch($bool){
		case 0:
		return 'false';
		break;
		case 1:
		return 'true';
		break;
	}
}
$q = $_REQUEST['t'];
$p = $_REQUEST['p'];
$d = $_REQUEST['d'];
$j = dirname(__DIR__).$d;

$f = file_get_contents($j."plugins".$d.$p."/addon.json");
$data = json_decode($f, true);
$open = fopen($j."plugins".$d.$p."/addon.json", "w+");
fwrite($open, str_replace('"active":'.boolToStr($data['config']['active']), '"active":'.switchForm($data['config']['active']), $f));
fclose($open);
echo $q . "::" .$p . "::". $d . "::" . $j;

?>