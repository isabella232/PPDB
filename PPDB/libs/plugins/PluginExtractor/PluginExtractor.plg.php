<?php
function PluginExtractor_config(){
	foreach($_GET['field'] as $field){
		if(preg_match('/^(upload_)/',$field)){
		if(!isset($_POST['upload_'.preg_replace('/^(upload_)/','',$field)])){
			//upload files
			$target_dir = "libs/uploads/";
			$target_file = $target_dir . basename($_FILES[$field]["name"]);
			$uploadOk = 1;
			$zipFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			//500MB file size
			if ($_FILES[$field]["size"] > 500000) {
				echo PPDB::failed("Sorry, your file is too large.");
				$uploadOk = 0;
				}
				//check zip file
				if($zipFileType !== "zip") {
			echo PPDB::failed("Sorry, only ZIP file work");
				$uploadOk = 0;
				}
				if ($uploadOk == 0) {
						echo PPDB::failed("Sorry, your file was not uploaded.");
					// if everything is ok, try to upload file
			} else {
			if (move_uploaded_file($_FILES[$field]["tmp_name"], $target_file)) {
				echo PPDB::success("The file ". htmlspecialchars( basename($_FILES[$field]["name"])). " has been uploaded.");
				//unzip to current
				$zip = new ZipArchive;
				$res = $zip->open("libs/uploads/".basename($_FILES[$field]["name"]));
				if ($res === TRUE) {
					$zip->extractTo('libs/'.$_GET['path'].'/');
					$zip->close();
				} else {
					echo PPDB::failed("Failed to extract ZIP file to invalid location");
				}
			} else {
				echo PPDB::failed("Sorry, there was an error uploading your file.");
			}
			}
		
		}else{
			echo PPDB::failed("Failed to get array key of '".'upload_'.preg_replace('/^(upload_)/','',$field)."'");
		}
		}
	}

	
	echo Plugin::saveRedirect($_GET['savePlugin']);
}
?>