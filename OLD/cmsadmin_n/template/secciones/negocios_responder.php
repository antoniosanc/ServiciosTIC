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
	
	$oFCKeditor->Width = '100%' ;
	$oFCKeditor->Height = '300';
	$oFCKeditor->BasePath = 'libs/FCKeditor/';
	$oFCKeditor->ToolbarSet = 'Basic';
?>
						
<link href="./css/negocios.css" rel="stylesheet">

<div class="page-header">
	  <h1>Centro de negocios</h1>
</div>

<div class="container">
	<h2>Responder a: <?=ucwords($arr_informacion[0]["contacto_nombre"])?> </h2>
	<div class="row">
		<p align="right"><a href="#contenido_mail" class="btn btn-mini btn-success" role="button" data-toggle="modal"> <span class="glyphicon-envelope"></span> Ver contenido del correo</a></p>
		<p>&nbsp;</p>
		<form method="POST" action="index.php?q=negocios&g=c" name="frm_contacto" id="frm_contacto">
			<input type="hidden" name="idc" id="idc" value="<?=$generales->encriptar($arr_informacion[0]["contacto_id"],"contacto")?>" />
			<div class="form-group">
				<label>Correo de salida:</label>
				<input type="text" name="correo_empresa" id="correo_empresa" value="<?=$_SESSION["uemail"]?>" class="form-control" placeholder="Escribe tu correo electr&oacute;nico"/>
			</div>
			<div class="form-group">
				<label>Asunto del correo:</label>
				<input type="text" name="asunto_correo" id="asunto_correo" value="<?=$arr_informacion[0]["contacto_asunto"]?>" class="form-control" placeholder="Escribe un asunto del correo que piensas enviar"/>
			</div>
			<?
				$oFCKeditor->Value =  'Estimado '.ucwords($arr_informacion[0]["contacto_nombre"]).' : <br/> He recibido tu respuesta en breve te responderemos';
				$oFCKeditor->Create();
			?>
			<br/>
			<p align="center"> <button class="btn btn-warning" type="submit">Enviar</button></p>
		</form>
	</div>
</div>


<div id="contenido_mail"  class='modal fade bs-modal-negocios' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
	<div class='modal-dialog modal-lg'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
				<h3 id='myModalLabel'><?=$arr_informacion[0]["contacto_nombre"]?> <small>(<?=$arr_informacion[0]["contacto_correo_electronico"]?> - <?=$arr_informacion[0]["contacto_telefono"]?>)</small></h3>
			</div>
			<div class='modal-body'>
				<p><strong><?=$arr_informacion[0]["contacto_asunto"]?></strong></p>
				<p><?=$arr_informacion[0]["contacto_comentarios"]?></p>
			</div>
			<div class='modal-footer'>
				<button class='btn btn-danger btn-sm' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
			</div>
		</div>
	</div>
</div>