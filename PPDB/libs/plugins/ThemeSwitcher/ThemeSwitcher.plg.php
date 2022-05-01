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
	$out .= '<script>
		document.querySelector("#ThemeSwitcher_profile_changer").addEventListener("click",function(){
			document.querySelector("#themeSwitcherPlugin").click();
		});

	</script>';
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
function ThemeSwitcher_panelList(){
	$out = '<li id="list-item-themes"'.(Utils::getPluginAddon('ThemeSwitcher')['config']['active'] ? '' : 'style="display:none;"').'><hr class="dropdown-divider"><a href="./panel?type=themes" class="nav-list viewThemes" title="Themes"><input type="submit" id="themeSwitcherPlugin" name="viewThemes" value="Themes"/></a></li>';
return $out;
}
function ThemeSwitcher_profile(){
$themes = array_diff(scandir(Utils::getROOT("THEME", Utils::getDS())), [".", ".."]);
$theme = '';
$out = '';
if(PLUGIN::LOST('ThemeSwitcher', true)){
	$out .= '<div class="mb-5">
			<p class="lead fw-normal mb-1">ThemeSwitcher</p>
			  <div class="p-4" style="background-color: #f8f9fa;">
                <p class="font-italic mb-1"><ul class="list-group"><button type="button" id="ThemeSwitcher_profile_changer" class="btn btn-success w-100">View Themes</button></ul></p>
              </div>
			</div>';
}else{
	$out .= 'ThemeSwitcher doesn\'t exists or disabled';
}
	return $out;
}
?>