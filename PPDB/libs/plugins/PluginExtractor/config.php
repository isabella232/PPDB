<?php
$paseYAML = yaml_parse_file(Utils::getROOT('PLUGIN', Utils::getDS()).$_GET['plugin'].Utils::getDS().'config'.Utils::getDS().'config.yml')[$_GET['plugin']];
$value = plugin::GET_ADDON($_GET['plugin'], 'plugin', 'active', true);
$out = '<form method="post" action="'.Utils::getDS().str_replace(Utils::getROOT("DOC", Utils::getDS()),'',Utils::getROOT("ROOT", Utils::getDS()))."panel?savePlugin=".$_GET['plugin']."&field[]=activate&field[]=upload_plugin&path=plugins\"".' enctype="multipart/form-data">
<div class="form-group">
<div class="form-check form-switch">
  <input class="form-check-input" name="activate" '.($value ? 'checked="checked"' : '').' type="checkbox" role="switch" id="activate_'.$_GET['plugin'].'">
  <label class="form-check-label" for="activate">On/Off</label>
</div>
</div>
<div class="form-group mt-2">
<label for="upload_plugin" class="form-label">Upload ZIP folder</label>
<input class="form-control form-control-lg" type="file" id="upload_plugin" name="upload_plugin" accept="'.$paseYAML['fileTypeAllow'].'"/>
</div>
<button class="mt-5 btn btn-primary" type="submit" name="submit_config">submit</button>
</form>';
echo $out;
?>
