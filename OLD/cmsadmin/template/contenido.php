<?
	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales = new generales ();

	if ( !empty($_GET["q"]) && strlen($_GET["q"]) > 3 )
		$cms_seccion_nombre = $generales->limpia_cadena($_GET["q"]);
	else
		$cms_seccion_nombre = "inicio";
	
	$pagina_error = '<p align="center"><img src="img/404.gif" alt="P&aacute;gina no encontrada" border="0"/></p>';
	
	switch( strtolower( $cms_seccion_nombre ) )
	{
		case "inicio":
			include_once(URL_SERVIDOR."/template/secciones/".$cms_seccion_nombre.".php");
		break;
		case "soluciones_im":
			include_once(URL_SERVIDOR."/template/secciones/".$cms_seccion_nombre.".php");
		break;
		case "secciones":
			if( $_SESSION["permiso_secciones"] == 1 || $_SESSION["permiso_secciones"] == 2 )
				include_once(URL_SERVIDOR."/template/secciones/".$cms_seccion_nombre.".php");
			else
				echo $pagina_error;
		break;
		case "contenidos":
		case "contenidos_edita":
			if( $_SESSION["permiso_contenido"] == 1 || $_SESSION["permiso_contenido"] == 2 )
				include_once(URL_SERVIDOR."/template/secciones/".$cms_seccion_nombre.".php");
			else
				echo $pagina_error;
		break;
		case "galeria":
		case "galerias_edita":
		case "galerias_nueva":
		case "galerias_edita_imagenes":
			if( $_SESSION["permiso_contenido"] == 1 || $_SESSION["permiso_contenido"] == 2 )
				include_once(URL_SERVIDOR."/template/secciones/".$cms_seccion_nombre.".php");
			else
				echo $pagina_error;
		break;
		case "contenidos_edita_historia":
		case "contenidos_restaura":
			if( $_SESSION["permiso_contenido"] == 1 )
				include_once(URL_SERVIDOR."/template/secciones/".$cms_seccion_nombre.".php");
			else
				echo $pagina_error;
		break;
		case "negocios":
		case "negocios_responder":
			if( $_SESSION["permiso_centro_negocios"] == 1 || $_SESSION["permiso_centro_negocios"] == 2 )
				include_once(URL_SERVIDOR."/template/secciones/".$cms_seccion_nombre.".php");
			else
				echo $pagina_error;
		break;
		case "configuracion":
		case "usuarios_edita":
		case "usuarios_agrega":
			if( $_SESSION["permiso_configuracion"] == 1 )
				include_once(URL_SERVIDOR."/template/secciones/".$cms_seccion_nombre.".php");
			else
				echo $pagina_error;
		break;
	}

	/*if (file_exists( URL_SERVIDOR."/template/secciones/".$cms_seccion_nombre.".php") )
	{
		include_once(URL_SERVIDOR."/template/secciones/".$cms_seccion_nombre.".php");
	}
	else
	{	
		echo alerta('<p align="center"><img src="./img/404.gif" border="0" alt="Pagina no encontrada"/></p>');
	}*/
?>
