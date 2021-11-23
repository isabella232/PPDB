<?php
function removerDirFile($dir) {
 $dh = opendir($dir);
 if ($dh) {
  while($file = readdir($dh)) {
   if (!in_array($file, array('.', '..'))) {
    if (is_file($dir.$file)) {
     unlink($dir.$file);
    }
    else if (is_dir($dir.$file)) {
     rmdir_files($dir.$file);
    }
   }
  }
  rmdir($dir);
 }
}
?>