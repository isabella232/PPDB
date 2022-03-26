<?php
function ThemeSwitcher_install(){
	# just use this as activator
}
function ThemeSwitcher_footerJS(){
	$out = '';
	$out .= '<script>';
	$out .= 'setTimeout(function(){
		/*OnLoad check if checked*/
					if(document.querySelector(".ThemeSwitcher_active").checked){
				document.querySelector("#list-item-themes").style.display = "block";
		}else{
			document.querySelector("#list-item-themes").style.display = "none";
		}
		/*toggle*/
		document.querySelector(".ThemeSwitcher_active").addEventListener("click", function(){
			if(document.querySelector(".ThemeSwitcher_active").checked){
				document.querySelector("#list-item-themes").style.display = "block";
		}else{
			document.querySelector("#list-item-themes").style.display = "none";
		}
	});
	}, 100);';
	
	$out.='</script>';
	return $out;
}

?>