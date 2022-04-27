<div class="col-md-12">
	<?=$contenido->contenido_obten_contenido_full_nombre( "solicita_soporte_tecnico" ) ?>
</div>
<p>&nbsp;</p>
 <?
	if( !empty($_POST) && strtolower($_GET["g"]) == "g") 
	{
		include_once (URL_SERVIDOR_FRONT."/class/mail.class.php");
		$mail = new mail();

		
		$datos = array();
		$datos["contacto_nombre"] = ucwords(strtolower($_POST["solicita_soporte_nombre"]));
		$datos["contacto_email"] = $_POST["solicita_soporte_email"];
		$datos["contacto_telefono"] = $_POST["solicita_soporte_telefono"];
		$datos["contacto_direccion"] = "M&eacute;xico DF";
		$datos["contacto_asunto"] = "Solicitud de Soporte Técnico";
		$datos["contacto_comentario"] = $_POST["solicita_soporte_comentario"];		
		$datos["contacto_correo2"] = " soporte@serviciostic.com.mx";		
		
		if($caso_id = $mail->mail_guarda_datos_contacto( $datos, 1 ) )
			echo correcto('Su solicitud ha sido enviada con el n&uacute;mero de caso '.($caso_id + 1000).', en breve uno de nuestros Ingenieros se pondr&aacute; en contacto con usted');
		else
			echo alerta("Ocurrio un error al enviar tu correo electr&oacute;nico. <a href='index.php?q=solicita_soporte_tecnico'>Intenta nuevamente</a>");
	}
 ?>
<div class="container">
	<div class="col-md-12">
		<form action="index.php?q=solicita_soporte_tecnico&g=g" method="POST" name="frm_solicita_soporte" id="frm_solicita_soporte"  >
			<div class="form-group">
				<label for="solicita_soporte_nombre"> Nombre</label><input class="form-control" id="solicita_soporte_nombre" name="solicita_soporte_nombre" type="text" placeholder="Escribe tu nombre"/></div>
			<div class="form-group">
				<label for="solicita_soporte_email"> Correo electr&oacute;nico:</label><input class="form-control" id="solicita_soporte_email" name="solicita_soporte_email" type="email" placeholder="Escribe tu correo electr&oacute;nico"/>
			</div>					
			<div class="form-group">
				<label for="solicita_soporte_telefono"> Tel&eacute;fono:</label><input class="form-control" id="solicita_soporte_telefono" name="solicita_soporte_telefono" type="tel" placeholder="Escribe tu correo tel&eacute;fono"/>
			</div>
			<div class="form-group">
				<label for="solicita_soporte_comentario"> Falla o Problema:</label><textarea class="form-control" id="solicita_soporte_comentario" name="solicita_soporte_comentario" cols="48"/></textarea>
			</div>					
			<div class="form-group">
				<p align="center"><button class="btn btn-primary btn_class"  onsubmit="return gtag_report_conversion()" type="submit">Enviar</button></p>
			</div>					
		</form>
	</div>
</div>


