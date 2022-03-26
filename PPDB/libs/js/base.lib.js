function runActive(p, bool){
	switch(bool){
		case true:
		p.parentElement.parentElement.className = p.parentElement.parentElement.className.replace("border-secondary", "border-success");
		p.parentElement.parentElement.children[1].querySelector("#plugin-config-btn i").className = 'bi bi-gear';
		p.parentElement.parentElement.children[1].querySelector("#plugin-config-btn span").innerHTML = 'Config';
		p.parentElement.parentElement.children[1].querySelector("#plugin-config-btn").className = p.parentElement.parentElement.children[1].querySelector("#plugin-config-btn").className.replace("btn-secondary", "btn-success");
		break;
		case false:
		    p.parentElement.parentElement.className = p.parentElement.parentElement.className.replace("border-success", "border-secondary");
			p.parentElement.parentElement.children[1].querySelector("#plugin-config-btn i").className = 'bi bi-plus-square';
		p.parentElement.parentElement.children[1].querySelector("#plugin-config-btn span").innerHTML = 'Install';
		p.parentElement.parentElement.children[1].querySelector("#plugin-config-btn").className = p.parentElement.parentElement.children[1].querySelector("#plugin-config-btn").className.replace("btn-success", "btn-secondary");
		break;
	}
}
function ToggleCheckBox(isChecked, id, path, dom){
	let p =  document.querySelectorAll("#pluginactivtor")[id].parentElement;
	let c =  document.querySelectorAll("#pluginactivtor")[id];
	if(isChecked){
		  var xmlhttp = new XMLHttpRequest();
		p.setAttribute("data-bs-original-title","Deactivate the Plugin");
		p.title = "Deactivate the Plugin";
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        let data = this.responseText.split("::");
		if(data[0] === "true" || data[0] === true){
		runActive(p, true);
		}
      }
    };
    xmlhttp.open("GET", "libs/bin/pluginBase.php?t=" + isChecked + "&p=" + path + "&d=" + dom, true);
    xmlhttp.send();
	}else{
  var closer = new XMLHttpRequest();
		p.setAttribute("data-bs-original-title", "Activate the Plugin");
     	p.title = "Activate the Plugin";
    closer.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200){ 
		    let data = this.responseText.split("::");
		  if(data[0] === "false" || data[0] === false){
		runActive(p, false);
		}
      }
	
    };
    closer.open("GET", "libs/bin/pluginBase.php?t=" + isChecked + "&p=" + path + "&d=" + dom, true);
    closer.send();
	}
}
function ToggleisChecked(id){
	let p =  document.querySelectorAll("#pluginactivtor")[id].parentElement;
	let isChecked = document.querySelectorAll("#pluginactivtor")[id].checked;
	if(isChecked){
runActive(p, true);
	}else{
	runActive(p, false);	
	}
}
