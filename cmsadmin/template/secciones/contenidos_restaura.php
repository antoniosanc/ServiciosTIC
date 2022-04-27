<?
	include_once(URL_SERVIDOR."/class/contenidos.class.php");
	$contenidos = new contenidos();
	
	include_once(URL_SERVIDOR."/class/generales.class.php");
	$generales = new generales();
	
	$seccion_historia_id = $generales->desencriptar( $_GET["s"] ,"contenidos");

	if(intval($seccion_historia_id) < 0)
	{
		echo alerta('Ocurrio un error al restaurar la secci&oacute;n (1). Favor de intentar nuevamente haciendo <a href="index.php?q=contenidos">clic aqu&iacute;</a>');
		return false;
	}
	
	
	if( !$arr_contenido = $contenidos->contenidos_restaura_contenido( $seccion_historia_id ) )
	{
		echo alerta('Ocurrio un error al restaurar tu informaci&oacute;n. Favor de intentar nuevamente haciendo <a href="index.php?q=contenidos_edita&s='.$_GET["n"].'">clic aqu&iacute;</a>');
		return false;
	}
	
	echo correcto('Hemos restaurado correctamente tu informaci&oacute;n.');
	echo '<p align="center"><a class="btn btn-success" href="index.php?q=contenidos_edita&s='.$_GET["n"].'"> <i class="glyphicon glyphicon-share-alt"></i> Continuar editando la secci&oacute;n</a></p>';
?>