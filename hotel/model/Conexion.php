<?php

/*	$conexion = new mysqli("localhost", "admin", "sisfarian2017", "hoteldb");*/
$conexion = new mysqli("localhost", "root", "", "hoteldb");
	
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
