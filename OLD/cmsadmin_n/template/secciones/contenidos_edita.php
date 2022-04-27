<link href="./css/contenidos_edita.css" rel="stylesheet">

<?
	include_once(URL_SERVIDOR."/class/contenidos.class.php");
	$contenidos = new contenidos();
	
	include_once(URL_SERVIDOR."/class/generales.class.php");
	$generales = new generales();
	
	$_SESSION["sid"] = "";
	$seccion_id = $generales->desencriptar( $_GET["s"] ,"contenidos");
	$_SESSION["sid"] = $seccion_id; //Para guardar imagen destacada

	if(intval($seccion_id) <= 0)
	{
		echo alerta('Ocurrio un error al cargar la secci&oacute;n. Favor de intentar nuevamente haciendo <a href="index.php?q=contenidos">clic aqu&iacute;</a>');
		return false;
	}
	
	if( $_GET["eid"] == md5(1) )
	{
		$arr_datos = array();
		$arr_datos["seccion"] = intval($seccion_id) ;
		if( $contenidos->contenidos_elimina_imagen_destacada ( $arr_datos ) )
			echo correcto("La imagen destacada ha sido eliminada con &eacute;xito");
		else
			echo alerta("Ocurri&oacute; un error al eliminar tu imagen destacada");
	}
	
	if(!empty($_POST) && $_SESSION["permiso_contenido"] == 1)
	{
		
		if( $_POST["sid"] == $_GET["s"] && $_POST["vs"] == md5(1) )
		{
			
			$arr_datos = array_merge( $_FILES, $_POST);
			
			if($seccion_url = $contenidos->contenidos_guarda_contenido( $arr_datos ) )
			{
				echo correcto('Informaci&oacute;n guardada correctamente. Entra <a href="../index.php?q='.strtolower($seccion_url).'" target="_blank">aqu&iacute; para revisarla</a>.');
			}
			else
			{
				echo alerta('Ocurri&oacute; un error al guardar la secci&oacute;n (1) <a href="index.php?q=contenidos_edita">Intenta nuevamente</a>.');
			}
		}
		else
		{
			echo alerta('Ocurri&oacute; un error al guardar la secci&oacute;n <a href="index.php?q=contenidos_edita">Intenta nuevamente</a>.');
		}
	}
	
	if( !$arr_contenido = $contenidos->contenidos_busca_contenido_id( $seccion_id ) )
	{
		echo alerta('Ocurri&oacute; un error al cargar la secci&oacute;n. Favor de intentar nuevamente haciendo <a href="index.php?q=contenidos">clic aqu&iacute;</a> (1)');
		return false;
	}
	
	
?>
<div class="page-header">
	<h1><?=intval($seccion_id)?> - <?=ucfirst($arr_contenido[0]["contenido_titulo"])?> <small> <abbr title="URL de la secci&oacute;n">index.php?q=<?=$arr_contenido[0]["secciones_url"]?></abbr> </small></h1>
</div>
<div class="container">

	<div class="row">
	
		<?
		if( $_SESSION["permiso_contenido"] == 1 )
		{
			include_once(URL_SERVIDOR."/template/secciones/contenidos_forma.php");
		}
		else if ( $_SESSION["permiso_contenido"] == 2 )
		{
			include_once(URL_SERVIDOR."/template/secciones/contenidos_ver.php");
		}
	?>
	</div>
</div>
<p>&nbsp;</p>