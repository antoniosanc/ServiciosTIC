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
	
	$arr_galerias = $galeria->galeria_lista_imagenes_galeria( $galeria_id );
	
	
?>
						
<link href="./css/galeria.css" rel="stylesheet">

<div class="page-header">
	  <h1><?=$arr_galerias[0]["galerias_titulo"]?></h1>
</div>


<div class="container-fluid">
	<div class="row-fluid">
			<div class="bs-docs-galeria">
				<form method="POST" action="index.php?q=galerias_edita&s=<?=$_GET["s"]?>" id="frm_nueva_imagen" name="frm_nueva_imagen" enctype="multipart/form-data">
					<div class="span4">
						<input type="file" name="imagen_subir" id="imagen_subir" />
						<p class="text-warning"><small>Solo archivos JPG, GIF o PNG menores a 700Kb</small></p>
						<p>&nbsp;</p>
						<p align="center"><input type="submit" name="imagen_enviar" id="imagen_enviar" value="Agregar imagen" class="btn btn-primary" /></p>
					</div>
					<div class="span8">
						<input type="hidden" name="s" id="s" value="<?=$_GET["s"]?>"/>
						<input type="text" name="imagen_titulo" id="imagen_titulo" class="span12" placeholder="Título de tu imagen" value=""/>
						<input type="text" name="imagen_descripcion" id="imagen_descripcion" class="span12" placeholder="Descripci&oacute;n de tu imagen" value=""/>
						<input type="text" name="imagen_url" id="imagen_url" class="span12" placeholder="Vinculo de la imagen o p&aacute;gina a la que dirigir&aacute; al dar clic" value=""/>
					</div>
				</form>
			</div>
			
			<? 
				if( is_array( $arr_galerias) )
				{
					foreach( $arr_galerias as $galerias )
					{
						echo ' 
						<div class="bs-docs-lista">
							<div class="span4">
								<p align="center"><img src="'.$galerias["galerias_imagenes_url_imagen"].'" class="img-responsiva img-max" border="0" alt="'.$galerias["galerias_imagenes_titulo"].'" /></p>
							</div>
							<div class="span8">
								<p class="galeria_titulo"><strong>'.$galerias["galerias_imagenes_titulo"].'</strong></p>
								<p>'.$galerias["galerias_imagenes_descripcion"].'</p>';
								if( !empty($galerias["galerias_imagenes_url"]) )
									echo '<p><a href="'.$galerias["galerias_imagenes_url"].'" target="_blank">Vinculo</a></p>';
								
								echo '<p align="right"><a href="index.php?q=galerias_edita_imagenes&s='.$generales->encriptar($galerias["galerias_imagenes_id"], "galeria").'" class=" btn btn-primary">Editar</a></p>';
						echo'</div>
						</div>
						' ;
					}
				}
			?>
	</div>
</div>
