<?php

# package name
const LIBRARY_NAME = "PPDB";
const LIBRARY_VERSION = "1.2.3";
const LIBRARY_API = [1];
const LIBRARY_SSL_SUPPORT = true;
const LIBRARY_LICENCE = "Apache-2.0 License";


# render
   function RenderLibrary(){
			# cache LIBRARY values
		try{
		if(LIBRARY_NAME !== "PPDB"){
			throw new PPDBErr(LIBRARY_NAME);
		}
	}catch(PPDBErr $e){
			  echo $e->CHECKLIBSNAME();
	}
	try{
		if(LIBRARY_VERSION !== update::checkUpdate()){
			throw new PPDBErr('You are out-of-date!<br/><br/><b>Your Version: '.LIBRARY_VERSION.'</b><br/><b>Current Version: '.update::checkUpdate().'</b><br/><a href="https://github.com/surveybuilderteams/PPDB" style="color:lime;">Download on github</a>');
		}
	}catch(PPDBErr $e){
		echo $e->neededUpdate();
	}
	try{
		if(LIBRARY_API[0] !== 1){
			throw new PPDBErr(LIBRARY_API[0]);
		}
	}catch(PPDBErr $e){
			  echo $e->CHECKLIBSAPI();
	}
		try{
		if(gettype(LIBRARY_SSL_SUPPORT) !== "boolean"){
			throw new PPDBErr(LIBRARY_SSL_SUPPORT);
		}
	}catch(PPDBErr $e){
			  echo $e->CHECKLIBSSL();
	}
	
		try{
		if(LIBRARY_LICENCE !== "Apache-2.0 License"){
			throw new PPDBErr(LIBRARY_LICENCE);
		}
	}catch(PPDBErr $e){
			  echo $e->CHECKLIBSLICENCE();
	}
	try{
		if(!extension_loaded('openssl')){
			throw new PPDBErr('This app needs the Open SSL PHP extension.');
		}
	}catch(PPDBErr $e){
		echo $e->noOpenSSL();
	}

	
	
	
}

RenderLibrary();
?>
