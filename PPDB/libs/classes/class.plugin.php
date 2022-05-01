<?php
class plugin{
	private function __construct(){
		# Nothing
	}
	public static function Extract($file){
		$file = basename($file);
		echo $file;
	}
	public static function ExtractURL($url, $uploadPath, $pluginPath){
		if(filter_var($url, FILTER_VALIDATE_URL)){
			$base = explode(".",basename($url));
			if($base[1] === "zip"){
				$newfile = $base[0].".".$base[1];
				if (!copy($url, $uploadPath.$newfile)) {
					echo PPDB::filed("failed to copy ".$url."...");
					}
					#remove Archive
				 $zip = new ZipArchive();
				if ($zip->open($newfile, ZIPARCHIVE::CREATE) !== TRUE) {
					PPDB::failed("Cannot open ".$base[0].".".$base[1]."");
				}
				if($zip->open($uploadPath.$newfile) === TRUE){
						$zip->extractTo($pluginPath);
						$zip->close();
						}else{
						PPDB::failed("Cannot open ".$base[0].".".$base[1]."");
						}
			}else{
				echo PPDB::failed("The file must be a <u><b>zip</b></u> not <b style='color:black;'>".$base[1]."</b> file");
			}
		}else{
			echo PPDB::failed("This must be a valid URL");
		}
	}
	public static function CONFIG_PLUGIN($name, $file){
		$xfile = yaml_parse_file(Utils::getROOT('PLUGIN',Utils::getDS()).$name.Utils::getDS()."config".Utils::getDS().$file.".yml");
		return $xfile[$name];
	}
	public static function GET_ADDON($name, $type, $data, $isConfig=false){
		$file = file_get_contents(Utils::getROOT($type, Utils::getDS()).$name.Utils::getDS()."addon.json");
		$file = json_decode($file, true);
		if($isConfig){
			return $file['config'][$data];
		}
		return $file[$data];
	}
	public static function hook($name, $plugin, $parma=null){
		if(function_exists($plugin.'_'.$name)){
			$func = $plugin.'_'.$name;
			return $func($parma);
		}
	}
	public static function myHook($hook, $plugin, $param = null)
	{
		$hookFunc = $plugin. '_' .$hook;
		return $hookFunc($param);
	}
	public static function isValidHook($hook, $plugin)
	{
		return function_exists($plugin. '_' .$hook);
	}
	public static function LOST($plugin, $requireActive=false){
		if($requireActive){
			if(!Utils::getPluginAddon($plugin)['config']['active'] || !file_exists(Utils::getROOT("PLUGIN", Utils::getDS()).$plugin.Utils::getDS())){
			echo '<div class="alert alert-danger" role="alert">Sorry this '.$plugin.' has either been removed, doesn\'t exist, or disabled!</div>';
			return false;
			}else{
				return true;
			}
		}else{
				if(!file_exists(Utils::getROOT("PLUGIN", Utils::getDS()).$plugin.Utils::getDS())){
					echo '<div class="alert alert-danger" role="alert">Sorry this '.$plugin.' has been removed or doesn\'t exist!</div>';
					return false;
				}else{
					return true;
				}
			}	
		}
		
	public static function saveRedirect($plugin,$title="saving"){
			return '<div class="alert alert-success m-5 display-3" role="alert">'.$title.': '.$plugin.' <i class="fa fa-spinner fa-spin"></i></div>
	<script>setTimeout(function(){
		'.'setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?savePlugin).*/)){
			getUrl = getUrl.replace(/(\?savePlugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);'.'
	}, 3000)</script>;
	';
	}
	public static function deleteRedirect($plugin,$title="deleted"){
			return '<div class="alert alert-danger m-5 display-3" role="alert">'.$title.': '.$plugin.' <i class="fa fa-spinner fa-spin"></i></div>
	<script>setTimeout(function(){
		'.'setTimeout(function(){
		let getUrl = window.location.href;
		if(getUrl.match(/(\?savePlugin).*/)){
			getUrl = getUrl.replace(/(\?savePlugin).*/, "");
			history.pushState("", "", getUrl);
			'.Reload::ret().'
		}
	},0);'.'
	}, 3000)</script>;
	';
	}
}
?>
