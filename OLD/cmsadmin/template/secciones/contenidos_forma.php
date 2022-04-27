<?
	include_once(URL_SERVIDOR."/libs/FCKeditor/fckeditor.php") ;
	$oFCKeditor = new FCKeditor('contenido_editor');
	$oFCKeditor->Width = '100%' ;
	$oFCKeditor->Height = '400';
	$oFCKeditor->BasePath = 'libs/FCKeditor/';
?>
<div class="span4">
	<?
		$mensaje_imagen ="Subir imagen";
		if( !empty($arr_contenido[0]["contenido_imagen"]) )
		{
			$mensaje_imagen ="Cambiar imagen";
			echo '<p align="center"><img src="'.URL_USERFILES."/image/".$arr_contenido[0]["contenido_imagen"].'" border="0" alt="'.$arr_contenido[0]["contenido_titulo"].'" class="imagen_destacada" /></p>';
		}
	?>
	<div id="mulitplefileuploader"><?=$mensaje_imagen ?></div>
	<div id="status"></div>
</div>
	
<form action="index.php?q=contenidos_edita&s=<?=$_GET["s"]?>" method="POST" id="formeditacont" name="formeditacont" >
	<div class="span8">
		<p align="right"><input type="text" placeholder="Ingresa un t&iacute;tulo para la secci&oacute;n" class="input-xxxlarge required" id="contenido_titulo" name="contenido_titulo" value="<?=$arr_contenido[0]["contenido_titulo"]?>" /></p>

		<input type="hidden" class="required" id="vs" name="vs" value="<?=md5(1)?>" />
		<input type="hidden" class="required" id="sid" name="sid" value="<?=$_GET["s"]?>" />
		<p align="right">
			<textarea rows="5" id="contenido_descripcion" name="contenido_descripcion" class="input-xxxlarge required" Placeholder="Ingresa una descripci&oacute;n para la secci&oacute;n"><?=$arr_contenido[0]["contenido_descripcion"]?></textarea>
		</p>
	</div>
	<div class="span12">
		<p align="right">
		<?
			$oFCKeditor->Value = $arr_contenido[0]["contenido_contenido"];
			$oFCKeditor->Create();
		?>
		</p>
		
		<p align="right"><input type="text" placeholder="Escribe de tres a cinco palabras clave. Cada una separadas por coma" class="input-xxxlarge required" id="contenido_keywords" name="contenido_keywords" value="<?=ucwords($arr_contenido[0]["contenido_palabras_clave"])?>" /></p>
		<div class="span6">
			<p align="left"><a href="index.php?q=contenidos_edita_historia&s=<?=$_GET["s"]?>"> Restaurar a una versi&oacute;n anterior... </a></p>
		</div>
		<div class="span6">
			<p align="right"><label >Mostrar men&uacute; de compartir en redes sociales &nbsp; <input type="checkbox" id="contenido_social" name="contenido_social" style="margin: 0px;" <? if( $arr_contenido[0]["contenido_btn_compartir"] ){ echo ' checked';} ?>/></label></p>
		</div>
		<p align="right">  <input type="submit" value="Guardar" name="bt_submit" id="bt_submit" class="btn btn-primary" /></p>
	</div>
</form>
