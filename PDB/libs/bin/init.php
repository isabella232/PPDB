<?php
require(dirname(__DIR__)."/handler/Exception.php");

# package name
const LIBRARY_NAME = "";
const LIBRARY_VERSION = "0.0.1";
const LIBRARY_API = ["0.0.1"];
const LIBRARY_SSL_SUPPORT = true;
const LIBRARY_LICENCE = "Apache-2.0 License";





# render
   function RenderLibrary(){
			# cache LIBRARY values
		try{
		if(LIBRARY_NAME !== "PDB"){
			throw new PDBErr(LIBRARY_NAME);
		}
	}catch(PDBErr $e){
			  echo $e->CHECKLIBSNAME();
	}
}

RenderLibrary();
?>