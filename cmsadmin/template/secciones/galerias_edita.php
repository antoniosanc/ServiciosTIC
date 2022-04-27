<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	$galeria_id = $generales->desencriptar($_GET["s"], "galeria");
	if( intval($galeria_id) == 0 )
		return false;
	
	include_once( URL_SERVIDOR."/class/galeria.class.php");
	$galeria = new galeria ();
	
	if( !empty($_POST) && $_GET["e"] == md5(3) )
	{
		if( $galeria->galeria_guarda_nueva_imagen( $_POST, $_FILES ) )
		{
			echo correcto("Tu imagen ha sido almacenada con &eacute;xito");
		}
		else
		{
			echo alerta("Ocurrio un error al guardar tu imagen, por favor intenta nuevamente (1)");
		}
	}
	
	if( $_GET["e"] == md5(4) )
	{
		$imagen_id = $generales->desencriptar($_GET["i"], "restaurar");
		
		if( $galeria->galeria_recupera_imagen_seleccionada( $imagen_id ) )
		{
			echo correcto("Tu imagen ha sido restaurada con &eacute;xito");
		}
		else
		{
			echo alerta("Ocurrio un error al restaurar tu imagen, por favor intenta nuevamente (3)");
		}
	}
	
	if( !empty($_POST) && $_GET["e"] == md5(2) )
	{
		if( $galeria->galeria_edita_imagen_seleccionada( $_POST, $_FILES ) )
		{
			echo correcto("Tu imagen ha sido actualizada con &eacute;xito");
		}
		else
		{
			echo alerta("Ocurrio un error al actualizar tu imagen, por favor intenta nuevamente (2)");
		}
	}
	
	if( $_GET["e"] == md5(1) )
	{
		
		$imagen_id = $generales->desencriptar($_GET["i"], "galeria");
		
		if( $galeria->galeria_elimina_imagen_seleccionada( $imagen_id  ) )
		{
			echo correcto("La imagen fue eliminada con &eacute;xito");
		}
		else
		{
			echo alerta("Ocurrio un error al eliminada la imagen, por favor <a href='index.php?q=galerias_edita&s=".$_GET["s"]."'>intenta nuevamente</a>");
		}
	}
	
	
	$arr_galerias = $galeria->galeria_lista_imagenes_galeria( $galeria_id );
	$arr_galeria_datos = $galeria->galeria_lista_galerias_id( $galeria_id );
	
?>
						
<link href="./css/galeria.css" rel="stylesheet">
<link href="./libs/datepicker/css/datepicker.css" rel="stylesheet">

<div class="page-header">
	<h1><?=intval( $galeria_id )?> - <?=$arr_galeria_datos[0]["galerias_titulo"]?></h1>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-2">&nbsp;</div>
		<div class="col-md-8">
			<div class="bs-docs-galeria-imagenes">
				<form method="POST" action="index.php?q=galerias_edita&s=<?=$_GET["s"]?>&e=<?=md5(3)?>" id="frm_edita_imagen" name="frm_edita_imagen" enctype="multipart/form-data">
					<div class="col-md-5">
						<input type="file" name="imagen_subir" id="imagen_subir" />
						<p class="text-warning"><small>Solo archivos JPG, GIF o PNG menores a 700Kb</small></p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p align="center"><button name="imagen_enviar" id="imagen_enviar" class="btn btn-warning btn-sm" > <i class="glyphicon glyphicon-floppy-disk"></i> Guardar imagen </button></p>
						<p>&nbsp;</p>
					</div>
					<div class="col-md-7">
						<input type="hidden" name="s" id="s" value="<?=$_GET["s"]?>"/>
						<div class="form-group">
							<input type="text" name="imagen_titulo" id="imagen_titulo" class="form-control" placeholder="T&iacute;tulo de tu imagen" value=""/>
						</div>
						<div class="form-group">
							<input type="text" name="imagen_descripcion" id="imagen_descripcion" class="form-control" placeholder="Descripci&oacute;n de tu imagen" value=""/>
						</div>
						<div class="form-group">
							<input type="text" name="imagen_url" id="imagen_url" class="form-control" placeholder="Vinculo de la imagen o p&aacute;gina a la que dirigir&aacute; al dar clic" value=""/>
						</div>
						<div class="form-group">
							<input type="text" name="imagen_vigencia" id="imagen_vigencia" class="form-control" placeholder="Imagen Vigente hasta...(DD/MM/AAAA) " value=""/>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-2">&nbsp;</div>
	</div>
	
		<h2>Im&aacute;genes</h2>
		<? 
			$contador_col = 0;
			if( is_array( $arr_galerias) )
			{
				echo '<div class="row">';
				foreach( $arr_galerias as $galerias )
				{
					echo ' 
					
							<div class="col-md-3 col-xs-12 col-sm-6 bs-docs-lista">
								<p align="center"><img src="'.$galerias["galerias_imagenes_url_imagen"].'" class="img-responsiva img-max" border="0" alt="'.$galerias["galerias_imagenes_titulo"].'" /></p>
								<p class="galeria_titulo"><strong>'.$galerias["galerias_imagenes_titulo"].'</strong></p>';
								
							if( $galerias["galerias_imagenes_descripcion"] != "" )
								echo '<p>'.$galerias["galerias_imagenes_descripcion"].'</p>';
							else
								echo '<p><small><i>Sin descripci&oacute;n</i></small></p>';

							if( $galerias["galerias_imagenes_vigencia"] != "" &&  $galerias["galerias_imagenes_vigencia"] != "0000-00-00")									
								echo '<p><small>Hasta: <i>'.$generales->fecha_formato_humano($galerias["galerias_imagenes_vigencia"]).'</i></small></p>';
							else
								echo '<p><small><i>Se muestra indefinidamente</i></small></p>';
							
							if( $galerias["galerias_imagenes_url"] != "" )	
								echo '<p><small>'.$galerias["galerias_imagenes_url"].'</small></p>';
							else
								echo '<p><small><i>Sin vinculo</i></small></p>';
							
								echo '<p>';
								
									echo '<a href="index.php?q=galerias_edita_imagenes&s='.$generales->encriptar($galerias["galerias_imagenes_id"], "galeria").'&b='.$_GET["s"].'" class=" btn btn-warning  btn-xs"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
									
										<a href="#" data-url="index.php?q=galerias_edita&s='.$_GET["s"].'&i='.$generales->encriptar($galerias["galerias_imagenes_id"], "galeria").'&e='.md5(1).'" class="btn btn-danger btn-xs delimg"><i class="glyphicon glyphicon-remove"></i> Eliminar </a>
									</p>
								';
					echo'	</div> ' ;
					
					if( $contador_col == 3 )
					{
						echo '</div>
							<div class="row " >';
						$contador_col = 0;
					}
					else
					{
						$contador_col++;
					}
				}
					echo '</div> ';
			}
		?>
		<p align="right"><a href="index.php?q=galerias_recuperar&s=<?=$_GET["s"]?>" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-share-alt"></i> Recupera una imagen borrada</a></p>
		<p>&nbsp;</p>
		<p align="left"><a href="index.php?q=galeria" class="btn btn-xs btn-success"> <i class="glyphicon glyphicon-menu-left"></i> Regresar</a></p>
	</div>
</div>
