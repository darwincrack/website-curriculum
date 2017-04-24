<?php

	session_start();

	if(isset($_SESSION["idusuario"]) && $_SESSION["mnu_mantenimiento"] == 1){
		
		if ($_SESSION["superadmin"] != "a") {
			include "view/header.html";
			include "modulos/habitacion/consultar.php";
		} else {
			include "view/headeradmin.html";
			include "modulos/habitacion/consultar.php";
		}

		include "view/footer.html";
	} else {
		header("Location:index.html");
	}
		

