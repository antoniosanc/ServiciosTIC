<?
	include_once(URL_SERVIDOR."/libs/FCKeditor/fckeditor.php") ;
	$oFCKeditor = new FCKeditor('contenido_editor');
	$oFCKeditor->Width = '100%' ;
	$oFCKeditor->Height = '690';
	$oFCKeditor->BasePath = 'libs/FCKeditor/';
?>
<div class="col-md-4">
	<?
		$mensaje_imagen ="Subir imagen";
		if( !empty($arr_contenido[0]["contenido_imagen"]) )
		{
			$mensaje_imagen ="Cambiar imagen";
			echo '<p align="center"><img src="'.URL_USERFILES."/image/".$arr_contenido[0]["contenido_imagen"].'" border="0" alt="'.$arr_contenido[0]["contenido_titulo"].'" class="imagen_destacada" /></p>';
		}
	?>
	<div id="mulitplefileuploader"><?=$mensaje_imagen ?></div>
	<?
		if( !empty($arr_contenido[0]["contenido_imagen"]) )
		{
			echo '<p align="center"><small><a data-url="index.php?q=contenidos_edita&s='.$_GET["s"].'&eid='.md5(1).'" class="delimgd">Eliminar imagen</a></small></p>';
		}
	?>
	<div id="status"></div>
</div>
	
<form action="index.php?q=contenidos_edita&s=<?=$_GET["s"]?>" method="POST" id="formeditacont" name="formeditacont" >
	<div class="col-md-8">
		<p align="right"><a href="#" data-toggle="modal" data-target="#mdl_secciones">Conoce las secciones de tu sitio <small><span class=' glyphicon glyphicon-new-window'></span></small></a></p>
		<p align="right"><input type="text" placeholder="Ingresa un t&iacute;tulo para la secci&oacute;n" class="form-control required" id="contenido_titulo" name="contenido_titulo" value="<?=$arr_contenido[0]["contenido_titulo"]?>" /></p>

		<input type="hidden" class="required" id="vs" name="vs" value="<?=md5(1)?>" />
		<input type="hidden" class="required" id="sid" name="sid" value="<?=$_GET["s"]?>" />
		<p align="right">
			<textarea rows="6" id="contenido_descripcion" name="contenido_descripcion" class="form-control required" Placeholder="Ingresa una descripci&oacute;n para la secci&oacute;n"><?=$arr_contenido[0]["contenido_descripcion"]?></textarea>
		</p>
	</div>
	<div class="col-md-12">
		<p align="right">
		<?
			$oFCKeditor->Value = $arr_contenido[0]["contenido_contenido"];
			$oFCKeditor->Create();
		?>
		</p>
		
		<p align="right"><input type="text" placeholder="Escribe de tres a cinco palabras clave. Cada una separadas por coma" class="form-control required" id="contenido_keywords" name="contenido_keywords" value="<?=$arr_contenido[0]["contenido_palabras_clave"]?>" /></p>
		<div class="col-md-4">
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p align="left"><a href="index.php?q=contenidos_edita_historia&s=<?=$_GET["s"]?>" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-share-alt"></i> Restaurar a una versi&oacute;n anterior... </a></p>
		</div>
		<div class="col-md-8">
			<p>&nbsp;</p>
			<div class="form-group">
				<label>Mostrar men&uacute; de compartir en redes sociales :</label>
				<input type="checkbox" id="contenido_social" name="contenido_social" style="margin: 0px;" <? if( $arr_contenido[0]["contenido_btn_compartir"] ){ echo ' checked';} ?>/>
			</div>
		</div>
		<p align="right">  <button name="bt_submit" id="bt_submit" class="btn btn-warning"> <i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button></p>
	</div>
</form>

<div class="modal fade" id="mdl_secciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Secciones Creadas</h4>
      </div>
      <div class="modal-body" style="overflow-y: auto !important; max-height: 400px;">
        <?	echo $contenidos->contenido_lista_secciones_linkear();?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger"  data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
