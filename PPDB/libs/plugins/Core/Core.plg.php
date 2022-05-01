<?php
function Core_install(){
	# Nothing
}
function Core_footerJS(){
		if(isset($_POST['viewThemes']) && SESSION_USER){
$themes = array_diff(scandir(Utils::getROOT("THEME", Utils::getDS())), [".", ".."]);
$theme = '';
if(PLUGIN::LOST('ThemeSwitcher', true)){
	return PPDB::createJSLink("libs/js/base.lib.js?v1.0.6");
}
		}
}
?>