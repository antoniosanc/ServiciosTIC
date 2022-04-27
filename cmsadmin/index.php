<?php

	session_start();

	

	include_once( "../configuration.php");





	if( strlen( $_SESSION["ssid"] ) == 8 && intval($_SESSION["reauth"]) == 1 && intval($_SESSION["uid"]) > 0 )

	{

		if (!include_once ( URL_SERVIDOR."/template/header.php" ) )

			echo alerta("<strong>Error:</strong> No se encontro el archivo de la cabecera");



		if (!include_once ( URL_SERVIDOR."/template/contenido.php" ) )

			echo alerta("<strong>Error:</strong> No se encontro el archivo de la cabecera");



		if (!include_once ( URL_SERVIDOR."/template/footer.php" ) )

			echo alerta("<strong>Error:</strong> No se encontro el archivo de la cabecera");

	}

	else

	{

		session_destroy();

		include_once ( URL_SERVIDOR."/admin-login.php" );

	}

?>