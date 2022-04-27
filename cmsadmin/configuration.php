<?php



	if( intval($sim_mostrar_errores) == 1)

	{

		ini_set ('display_errors', 'on');

		ini_set ('log_errors', 'on');

		ini_set ('display_startup_errors', 'on');

		ini_set ('error_reporting', E_ALL);

	}

	else

	{

		error_reporting(0);

	}

		

	define("URL_SERVIDOR", dirname(__FILE__) );

	

	$url_servidor_fijo = str_replace("cmsadmin","",URL_SERVIDOR);



	define("URL_SECCION_ESTATICA", $url_servidor_fijo );

	define("URL_SITEMAP", $_SERVER["DOCUMENT_ROOT"] );

	define("URL_USERFILES", '/userfiles/'.$sim_carpeta_userfiles.'/' );

	define("NOMBRE_SITIO", $sim_nombre_proyecto );

	define("CORREO_CONTACTO", $sim_correo_electronico_proyecto );

	define("SESSION","true");

	define("HOST_DB_CMS", $sim_host_base_datos);

	define("PUERTO_DB_CMS", $sim_puerto_base_datos);

	define("BASE_DB_CMS", $sim_nombre_base_datos);

	define("USER_DB_CMS", $sim_usuario_base_datos);

	define("PASSWORD_DB_CMS", $sim_password_base_datos);

	

	define("HOST_MAIL", $sim_host_mail);

	define("EMAIL_MAIL", $sim_email_mail);

	define("PASSWORD_MAIL", $sim_password_mail);

	define("SEGURIDAD_MAIL", $sim_seguridad_mail);

	define("PUERTO_MAIL", $sim_puerto_mail);

	define("CORREO_CCO_MAIL", $sim_copia_correo_mail);



	include_once(URL_SERVIDOR."/functions.php");



?>