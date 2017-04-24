<?php
	 error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	$conexion = mysql_connect("127.0.0.1","admin","sharian2017");
	mysql_select_db("hoteldb",$conexion);
	
	date_default_timezone_set("America/Guayaquil");
    mysql_query("SET NAMES utf8");
	mysql_query("SET CHARACTER_SET utf");
	$s='$';
	
	function limpiar($tags){
		$tags = strip_tags($tags);
		$tags = stripslashes($tags);
		$tags = htmlentities($tags, ENT_QUOTES, 'UTF-8');
		$tags = trim($tags);
		return $tags;
	}

	
?>