<?php

# package name
const LIBRARY_NAME = "PPDB";
const LIBRARY_VERSION = "2.0.4";
const LIBRARY_API = [1];
const LIBRARY_SSL_SUPPORT = true;
const LIBRARY_LICENCE = "Apache-2.0 License";
const LIBRARY_AUTHOR = "SurveyBuilderTeams";
const LIBRARY_AUTOUPDATE = true;
const LIBRARY_BUILD = "220330"; # 30(March)2022
const LOGIN_TEMP = 3;
define("LIBRARY_MODULES",apache_get_modules(), false);
//To use debug change DEBUG_MODE[0] to TRUE, FALSE, or NULL; To display alerts change DEBUG_MODE[1] to TRUE, FALSE, NULL
const DEBUG_MODE = FALSE;
const DEFAULT_TIMEZONE = 'UTC';

# render
   function RenderLibrary(){
	   if (DEBUG_MODE) {
    ini_set('error_log', Utils::getROOT('ROOT', Utils::getDS()).'error.log');
    if (DEBUG_MODE === true) {
			   error_reporting(E_ALL | E_STRICT | E_NOTICE);
        ini_set('display_errors', true);
        ini_set('display_startup_errors', true);
        ini_set("track_errors", 1);
        ini_set('html_errors', 1);
		
    } elseif(DEBUG_MODE === false) {
		error_reporting(0);
        ini_set('display_errors', false);
        ini_set('display_startup_errors', false);
    }
}
			# cache LIBRARY values
		try{
		if(LIBRARY_NAME !== "PPDB"){
			throw new PPDBErr(LIBRARY_NAME);
		}
	}catch(PPDBErr $e){
			  echo $e->CHECKLIBSNAME();
	}
	try{
		if(LIBRARY_VERSION !== update::checkUpdate() && LIBRARY_AUTOUPDATE){
			throw new PPDBErr('<span class="outdated-alert" style="position:absolute;text-align:center;top:25%;right:0;background-color:white;font-size:32px;border-radius:15px;">You are out-of-date!<br/><br/><b>Your Version: '.LIBRARY_VERSION.'</b><br/><b style="color:green;text-decoration:underline;">Current Version: '.update::checkUpdate().'</b><br/><a href="https://github.com/surveybuilderteams/PPDB" style="color:lime;">Download on github</a></span>');
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
        if(LIBRARY_AUTHOR !== "SurveyBuilderTeams"){
       throw new PPDBErr(LIBRARY_AUTHOR);
        }
    }catch(PPDBErr $e){
        echo $e->CHECKLIBSAuthor();
    }
	try{
		if(!extension_loaded('openssl')){
			throw new PPDBErr('This app needs the Open SSL PHP extension.');
		}
	}catch(PPDBErr $e){
		echo $e->noOpenSSL();
	}
	try{
		if(LIBRARY_BUILD !== '220330'){
			throw new PPDBErr(LIBRARY_BUILD);
		}
   }catch(PPDBErr $e){
	   echo $e->CHECKLIBSBuild();
   }
   try{
	  if(!date_default_timezone_set(DEFAULT_TIMEZONE)){
		  throw new PPDBErr(DEFAULT_TIMEZONE);
	  }
   }catch(PPDBErr $e){
	   echo $e->invalidTimezone();
   }

	
	
	
}

RenderLibrary();
?>
