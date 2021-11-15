<?php

# package name
const LIBRARY_NAME = "PPDB";
const LIBRARY_VERSION = "0.0.1";
const LIBRARY_API = [1];
const LIBRARY_SSL_SUPPORT = true;
const LIBRARY_LICENCE = "Apache-2.0 License";


# render
   function RenderLibrary(){
			# cache LIBRARY values
		try{
		if(LIBRARY_NAME !== "PPDB"){
			throw new PDBErr(LIBRARY_NAME);
		}
	}catch(PPDBErr $e){
			  echo $e->CHECKLIBSNAME();
	}
		try{
		if(LIBRARY_VERSION !== "0.0.1"){
			throw new PDBErr(LIBRARY_VERSION);
		}
	}catch(PPDBErr $e){
			  echo $e->CHECKLIBSVERSION();
	}
		try{
		if(LIBRARY_API[0] !== 1){
			throw new PDBErr(LIBRARY_API[0]);
		}
	}catch(PPDBErr $e){
			  echo $e->CHECKLIBSAPI();
	}
		try{
		if(gettype(LIBRARY_SSL_SUPPORT) !== "boolean"){
			throw new PDBErr(LIBRARY_SSL_SUPPORT);
		}
	}catch(PPDBErr $e){
			  echo $e->CHECKLIBSSL();
	}
	
		try{
		if(LIBRARY_LICENCE !== "Apache-2.0 License"){
			throw new PDBErr(LIBRARY_LICENCE);
		}
	}catch(PPDBErr $e){
			  echo $e->CHECKLIBSLICENCE();
	}
	
	
	
	
	
}

RenderLibrary();
?>
