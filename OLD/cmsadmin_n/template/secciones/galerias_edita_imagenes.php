<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	$imagen_id = $generales->desencriptar($_GET["s"], "galeria");
	if( intval($imagen_id) == 0 )
		return false;
	
	include_once( URL_SERVIDOR."/class/galeria.class.php");
	$galeria = new galeria ();
	
	if( !empty($_POST) )
	{
		if( $galeria->galeria_edita_imagen_seleccionada( $_POST, $_FILES ) )
		{
			echo correcto("Tu imagen ha sido actualizada con &eacute;xito");
		}
		else
		{
			echo alerta("Ocurrio un error al actualizar tu imagen, por favor intenta nuevamente");
		}
	}
	
	$arr_galerias = $galeria->galeria_lista_imagen( $imagen_id );
	
	
?>
						
<link href="./css/galeria.css" rel="stylesheet">

<div class="page-header">
	  <h1><?=$arr_galerias[0]["galerias_imagenes_titulo"]?></h1>
</div>


<div class="container">
	<div class="row">
			<div class="bs-docs-imagen">
				<form method="POST" action="index.php?q=galerias_edita_imagenes&s=<?=$_GET["s"]?>&b=<?=$_GET["b"]?>" id="frm_nueva_imagen" name="frm_nueva_imagen" enctype="multipart/form-data">
					<div class="col-md-4">
						<p align="center"><img src="<?=$arr_galerias[0]["galerias_imagenes_url_imagen"]?>" class="img-responsiva img-max" border="0" alt="<?=$arr_galerias[0]["galerias_imagenes_titulo"]?>" /></p>
						<input type="file" name="imagen_subir" id="imagen_subir" />
						<p class="text-warning"><small>Para reemplazar subir un archivo JPG, GIF o PNG menor a 700Kb</small></p>
					</div>
					<div class="col-md-8">
						<input type="hidden" name="s" id="s" value="<?=$_GET["s"]?>"/>
						<input type="hidden" name="i" id="i" value="<?=$arr_galerias[0]["galerias_imagenes_id"]?>"/>
						<input type="text" name="imagen_titulo" id="imagen_titulo" class="form-control" placeholder="Título de tu imagen" value="<?=$arr_galerias[0]["galerias_imagenes_titulo"]?>"/>
						<input type="text" name="imagen_descripcion" id="imagen_descripcion" class="form-control" placeholder="Descripci&oacute;n de tu imagen" value="<?=$arr_galerias[0]["galerias_imagenes_descripcion"]?>"/>
						<input type="text" name="imagen_url" id="imagen_url" class="form-control" placeholder="Vinculo de la imagen o p&aacute;gina a la que dirigir&aacute; al dar clic" value="<?=$arr_galerias[0]["galerias_imagenes_url"]?>"/>
						<p>&nbsp;</p>
						<p align="center"><button name="imagen_enviar" id="imagen_enviar" class="btn btn-warning" > <i class="glyphicon glyphicon-floppy-disk"></i> Editar imagen </button></p>
					</div>
				</form>
				
				<p align="right"> <a href="index.php?q=galeria&i=<?=$_GET["s"]?>&e=<?=md5(1)?>" class="btn btn-danger  btn-xs"><i class="glyphicon glyphicon-remove"></i> Eliminar </a></p>
			</div>
			<p align="left"><a href="index.php?q=galerias_edita&s=<?=$_GET["b"]?>" class="btn btn-xs btn-success"> <i class="glyphicon glyphicon-menu-left"></i> Regresar</a></p>
	</div>
</div>
