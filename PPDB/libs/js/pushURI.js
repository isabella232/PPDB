/*
* pushURI
*
* @aurthor     SurveyBuilderTeams
* @copyright   (c) 2021-2022
* @license     https://www.apache.org/licenses/LICENSE-2.0.html
* @package     PPDB
* @version     2.0
* @update      12-30-21
*/
var arcive = sessionStorage.getItem("once");
setTimeout(function(){
	if(arcive === 1){
	sessionStorage.setItem("once", "1");
	}else{
		sessionStorage.setItem("once", "0");	
	}
},0);
window.addEventListener("load", function(){
	let nav = document.querySelectorAll(".nav-list");
	for(i=0;i<nav.length;i++){
		nav[i].setAttribute("onclick", "javascript:sessionStorage.setItem('type', "+i+");");
	}
	if(parseInt(sessionStorage.getItem("type")) === 0){
		history.pushState(null, null, "./panel?type=storage");
		 if(arcive === "0") {
        window.location.reload();
		sessionStorage.setItem("once", "1");
			}
	}
	if(parseInt(sessionStorage.getItem("type")) === 1){
		history.pushState(null, null, "./panel?type=db");
		if(arcive === "0") {
        window.location.reload();
			sessionStorage.setItem("once", "1");
			}
	}
	if(parseInt(sessionStorage.getItem("type")) === 2){
	history.pushState(null, null, "./panel?type=table");
	 if(arcive === "0"){
        window.location.reload();
		sessionStorage.setItem("once", "1");
		}
	}

});
