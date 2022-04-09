<?php
function ThemeSwitcher_footerJS(){
	$out = '';
	$out .= '<script>';
	$out .= 'setTimeout(function(){
		/*OnLoad check if checked*/
					if(document.querySelector(".ThemeSwitcher_active").checked){
				document.querySelector("#list-item-themes").style.display = "block";
		}else{
			document.querySelector("#list-item-themes").style.display = "none";
		}
		/*toggle*/
		document.querySelector(".ThemeSwitcher_active").addEventListener("click", function(){
			if(document.querySelector(".ThemeSwitcher_active").checked){
				document.querySelector("#list-item-themes").style.display = "block";
		}else{
			document.querySelector("#list-item-themes").style.display = "none";
		}
	});
	}, 100);';
	
	$out.='</script>';
	return $out;
}
function ThemeSwitcher_view(){
	if(isset($_POST['viewThemes']) && SESSION_USER){
$themes = array_diff(scandir(Utils::getROOT("THEME", Utils::getDS())), [".", ".."]);
$theme = '';
if(PLUGIN::LOST('ThemeSwitcher', true)){
	$theme .= '<form method="post">';
$theme .= '<select name="themeSelector" class="form-control form-select-lg mb-3 mt-5">';
foreach($themes as $t){
	$fileName = preg_replace('/(\.css|\.min\.css)/','',$t);
	if(preg_match('/^.+(\.css|\.min\.css)$/', $t) && !is_dir(Utils::getROOT("THEME", Utils::getDS()).$t)){
		$cookieTheme = isset($_COOKIE['panel_theme']) ? preg_replace('/(\.css|\.min\.css)/','',$_COOKIE['panel_theme']) : 'default';
		$theme .= '<option '.($fileName===$cookieTheme ? 'selected="selected"' : '').' value="'.$t.'">'.$fileName.'</option>';
	}
}
$theme .= '</select>';
$theme .= '<input type="submit" name="saveTheme" class="btn btn-primary"/>';
$theme .= '</form>';
}
return $theme;
	echo '<script>setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?plugin).*/)){
			getUrl = getUrl.replace(/(\?plugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);</script>';
}
if(isset($_POST['saveTheme']) && SESSION_USER){
	$getThemeSelect = $_POST['themeSelector'];
	if(setcookie('panel_theme', $getThemeSelect, time() + (86400 * 80), "/") === TRUE){
		echo PPDB::autoRedirect('theme("'.preg_replace('/(\.css|\.min\.css)/','',$getThemeSelect).'")', 'Saving');
	} else{
		echo PPDB::autoRedirect('theme("'.preg_replace('/(\.css|\.min\.css)/','',$getThemeSelect).'")', 'Failed to save','danger');
	} 
}

}
?>