<?=alerta("No cuentas con los permisos necesarios para editar esta secci&oacute;n. Solo se muestra una vista previa")?>
<div class="span4">
	<p align="center"><img src="/userfiles/image/nuevo_cms/<?=$arr_contenido[0]["contenido_imagen"]?>" border="0" alt="<?$arr_contenido[0]["contenido_titulo"]?>" class="imagen_destacada" /></p>
</div>
<div class="span8">
	<h2><?=ucwords($arr_contenido[0]["contenido_titulo"])?></h2>

	<p><?=ucwords($arr_contenido[0]["contenido_descripcion"])?></p>
</div>
<div class="span12">

	<?=ucwords($arr_contenido[0]["contenido_contenido"])?>
	
	<p><strong> Palabras Clave:</strong> <?=ucwords($arr_contenido[0]["contenido_palabras_clave"])?> </p>

</div>

</div>