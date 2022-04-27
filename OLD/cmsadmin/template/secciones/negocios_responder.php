<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	include_once( URL_SERVIDOR."/class/negocios.class.php");
	$negocios = new negocios ();
	
	$contacto_id = intval( $generales->desencriptar($_GET["c"],"contacto") );
	
	if( !$arr_informacion = $negocios->negocios_busca_contacto_id ( $contacto_id ) ) 
		return false;


	include_once(URL_SERVIDOR."/libs/FCKeditor/fckeditor.php") ;
	$oFCKeditor = new FCKeditor('contacto_editor');
	
	$oFCKeditor->Width = '800' ;
	$oFCKeditor->Height = '250';
	$oFCKeditor->BasePath = 'libs/FCKeditor/';
	$oFCKeditor->ToolbarSet = 'Basic';
?>
						
<link href="./css/negocios.css" rel="stylesheet">

<div class="page-header">
	  <h1>Centro de negocios</h1>
</div>

<div class="container-fluid">
	<h2>Responder a: <?=ucwords($arr_informacion[0]["contacto_nombre"])?> </h2>
	<div class="row-fluid">
		<p align="right"><a href="#contenido_mail" class="btn btn-mini btn-success" role="button" data-toggle="modal">Ver contenido del correo</a></p>
		<p>&nbsp;</p>
		<form method="POST" action="index.php?q=negocios&g=c" name="frm_contacto" id="frm_contacto">
			<input type="hidden" name="idc" id="idc" value="<?=$generales->encriptar($arr_informacion[0]["contacto_id"],"contacto")?>" />
			<label><span class="span3">Correo de salida:</span> <input type="text" name="correo_empresa" id="correo_empresa" value="<?=$_SESSION["uemail"]?>" class="input-xxlarge" placeholder="Escribe tu correo electr&oacute;nico"/></label>
			<label><span class="span3">Asunto del correo:</span> <input type="text" name="asunto_correo" id="asunto_correo" value="<?=$arr_informacion[0]["contacto_asunto"]?>" class="input-xxlarge" placeholder="Escribe un asunto del correo que piensas enviar"/></label>
			<?
				$oFCKeditor->Value =  'Estimado '.ucwords($arr_informacion[0]["contacto_nombre"]).' : <br/> He recibido tu respuesta en breve te responderemos';
				$oFCKeditor->Create();
			?>
			<br/>
			<p align="center"> <button class="btn btn-primary" type="submit">Enviar</button></p>
		</form>
	</div>
</div>


<div id="contenido_mail" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel"><?=$arr_informacion[0]["contacto_nombre"]?> (<?=$arr_informacion[0]["contacto_correo_electronico"]?>)</h3>
</div>
<div class="modal-body">
<p><?=$arr_informacion[0]["contacto_asunto"]?></p>
<p><?=$arr_informacion[0]["contacto_comentarios"]?></p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
</div>
</div>