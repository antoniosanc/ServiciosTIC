<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	$galeria_id = $generales->desencriptar($_GET["s"], "galeria");
	if( intval($galeria_id) == 0 )
		return false;
	
	include_once( URL_SERVIDOR."/class/galeria.class.php");
	$galeria = new galeria ();
	
	if( !empty($_POST) )
	{
		if( $galeria->galeria_guarda_nueva_imagen( $_POST, $_FILES ) )
		{
			echo correcto("Tu imagen ha sido almacenada con &eacute;xito");
		}
		else
		{
			echo alerta("Ocurrio un error al guardar tu imagen, por favor intenta nuevamente");
		}
	}
	
	if( $_GET["e"] == md5(1) )
	{
		
		$imagen_id = $generales->desencriptar($_GET["i"], "galeria");
		
		if( $galeria->galeria_elimina_imagen_seleccionada( $imagen_id  ) )
		{
			echo correcto("Tu imagen ha sido eliminada con &eacute;xito");
		}
		else
		{
			echo alerta("Ocurrio un error al eliminada tu imagen, por favor intenta nuevamente");
		}
	}
	
	
	$arr_galerias = $galeria->galeria_lista_imagenes_galeria( $galeria_id );
	$arr_galeria_datos = $galeria->galeria_lista_galerias_id( $galeria_id );
	
?>
						
<link href="./css/galeria.css" rel="stylesheet">

<div class="page-header">
	<h1><?=intval( $galeria_id )?> - <?=$arr_galeria_datos[0]["galerias_titulo"]?></h1>
</div>


<div class="container">
	<div class="row">
			<p>&nbsp;</p>
			<h2>Agrega nueva imagen</h2>
			<div class="bs-docs-galeria">
				<form method="POST" action="index.php?q=galerias_edita&s=<?=$_GET["s"]?>" id="frm_nueva_imagen" name="frm_nueva_imagen" enctype="multipart/form-data">
					<div class="col-md-4">
						<input type="file" name="imagen_subir" id="imagen_subir" />
						<p class="text-warning"><small>Solo archivos JPG, GIF o PNG menores a 700Kb</small></p>
						<p>&nbsp;</p>
						<p align="center"><button name="imagen_enviar" id="imagen_enviar" class="btn btn-warning" > <i class="glyphicon glyphicon-floppy-disk"></i> Guardar imagen </button></p>
						<p>&nbsp;</p>
					</div>
					<div class="col-md-8">
						<input type="hidden" name="s" id="s" value="<?=$_GET["s"]?>"/>
						<input type="text" name="imagen_titulo" id="imagen_titulo" class="form-control" placeholder="Título de tu imagen" value=""/>
						<input type="text" name="imagen_descripcion" id="imagen_descripcion" class="form-control" placeholder="Descripci&oacute;n de tu imagen" value=""/>
						<input type="text" name="imagen_url" id="imagen_url" class="form-control" placeholder="Vinculo de la imagen o p&aacute;gina a la que dirigir&aacute; al dar clic" value=""/>
					</div>
				</form>
			</div>
			<p>&nbsp;</p>
			<h2>Im&aacute;genes</h2>
			<? 
				if( is_array( $arr_galerias) )
				{
					foreach( $arr_galerias as $galerias )
					{
						echo ' 
						<div class="bs-docs-lista">
							<div class="row">
								<div class="col-md-4">
									<p align="center"><img src="'.$galerias["galerias_imagenes_url_imagen"].'" class="img-responsiva img-max" border="0" alt="'.$galerias["galerias_imagenes_titulo"].'" /></p>
								</div>
								<div class="col-md-8">
									<p class="galeria_titulo"><strong>'.$galerias["galerias_imagenes_titulo"].'</strong></p>
									<p>'.$galerias["galerias_imagenes_descripcion"].'</p>';
									if( !empty($galerias["galerias_imagenes_url"]) )
										echo '<p><a href="'.$galerias["galerias_imagenes_url"].'" target="_blank">Vinculo</a></p>';
									
									echo '<p align="right">
											<a href="index.php?q=galerias_edita_imagenes&s='.$generales->encriptar($galerias["galerias_imagenes_id"], "galeria").'&b='.$_GET["s"].'" class=" btn btn-warning"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
										
											<a href="index.php?q=galerias_edita&s='.$_GET["s"].'&i='.$generales->encriptar($galerias["galerias_imagenes_id"], "galeria").'&e='.md5(1).'" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Eliminar </a>
										</p>
									';
						echo'	</div>
							</div>
						</div>
						' ;
					}
				}
			?>
			
			
		<p align="left"><a href="index.php?q=galerias" class="btn btn-xs btn-success"> <i class="glyphicon glyphicon-menu-left"></i> Regresar</a></p>
	</div>
</div>
