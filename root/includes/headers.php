<?php
    if (@$_GET['loc'] == 1) {
      setcookie("loc", 1, time()+60*60*24*30, '/');  /* expire in 30 week */ 	  
	  } 
	
	if (@$_SERVER["HTTP_CF_IPCOUNTRY"]) {
	  $country_code = $_SERVER["HTTP_CF_IPCOUNTRY"]; // to access in PHP  
	  }
	else {
	  $country_code = trim(shell_exec('geoip-lookup '.$_SERVER['REMOTE_ADDR'])); 
	  }
?>