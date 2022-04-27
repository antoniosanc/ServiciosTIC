<?

	$seccion_contenido_estatica = 0;
	$seccion_contenido_dinamica = 0;
	

	switch ( $url_seccion ) 
	{
	
		case "inicio":
		case "aspel":
		case "contacto":
		case "ventajas_competitivas":
		case "logros":
		case "solicita_soporte_tecnico":
			$seccion_contenido_estatica = 1;
		break;
		default:
			$seccion_contenido_dinamica = 1;
		break;
	}
	
	
	if( intval($seccion_contenido_dinamica) == 1 &&  intval($seccion_contenido_estatica) == 0 ) //Carga contenido de base de datos
	{
		if( $contenido_seccion = $contenido->contenido_obten_contenido_full_nombre( $url_seccion ) )
			echo $contenido_seccion;
		else
			echo '<p align="center"><img class="img-responsiva" src="./imgusr/404.gif" border="0" alt="Pagina no encontrada"/></p>';
	}
	else if ( intval($seccion_contenido_dinamica) == 0 &&  intval($seccion_contenido_estatica) == 1 ) //Carga contenido de archivo
	{
		if (file_exists( URL_SERVIDOR_FRONT."/template/secciones/".strtolower( $generales->limpia_cadena($url_seccion) ).".php") )
			include_once(URL_SERVIDOR_FRONT."/template/secciones/".strtolower( $generales->limpia_cadena($url_seccion) ).".php");
		else
			echo '<p align="center"><img class="img-responsiva" src="./imgusr/404.gif" border="0" alt="Pagina no encontrada"/></p>';
	}
?>
