<div class="col-md-6">
	<?=$contenido->contenido_obten_contenido_full_nombre( "contacto" ) ?>
</div>
<div class="col-md-6">
	<h2>Formulario de contacto</h2>
	<p>Favor de completar el siguiente formulario y nosotros nos comunicaremos contigo a la brevedad:</p>
	<script src='https://www.google.com/recaptcha/api.js'></script>
<?

    if( !empty($_POST) && strtolower($_GET["g"]) == "g")
    {
       
        $recaptchaResponse = $_POST['g-recaptcha-response'];
        $secretKey = '6Lebe-MUAAAAALERIHn4otklep1Y1WkRKMvs-1K7';
       
        $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$recaptchaResponse);

   
        if(strstr($request,"true"))
        {
			include_once (URL_SERVIDOR_FRONT."/class/mail.class.php");
			$mail = new mail();
			
			if($mail->mail_guarda_datos_contacto( $_POST ) )
				echo correcto('Correo enviado con &eacute;xito. En breve te responderemos');
			else
				echo alerta("Ocurrio un error al enviar tu correo electr&oacute;nico. <a href='index.php?q=contacto'>Intenta nuevamente</a>");
		}
        else
        {
            echo alerta("Ocurrio un error al validar tus datos (La comprobaci&oacute;n de seguridad no es correcta). Por favor <a href='index.php?q=contacto'>intenta nuevamente</a>");
        }
    }
 ?>
	<form action="index.php?q=contacto&g=g" method="POST" name="frm_contacto" id="frm_contacto">
		<div id="no-more-tables">
			<table class="col-md-12 table-condensed">
				<tbody>
					<tr>
						<td> Nombre:</td>
						<td>
							<input type="text" name="contacto_nombre" id="contacto_nombre" value="" class="input-xxlarge" placeholder="Escribe tu nombre"/>
						</td>
					</tr>
					<tr>
						<td>Correo electr&oacute;nico:</td>
						<td>
							<input type="text" name="contacto_email" id="contacto_email" value="" class="input-xxlarge" placeholder="Escribe tu correo electr&oacute;nico"/>
						</td>
					</tr>
					<tr>
						<td>Tel&eacute;fono: </td>
						<td>
							<input type="text" name="contacto_telefono" id="contacto_telefono" value="" class="input-xxlarge" placeholder="Escribe tu tel&eacute;fono"/>
						</td>
					</tr>
					<tr>
						<td>Ciudad:</td>
						<td>
							<input type="text" name="contacto_direccion" id="contacto_direccion" value="" class="input-xxlarge" placeholder="Escribe de d&oacute;nde nos contactas "/>
						</td>
					</tr>
					<tr>
						<td>Motivo de contacto:</td>
						<td>
							<input type="text" name="contacto_asunto" id="contacto_asunto" value="<?=$contactoAsunto?>" class="input-xxlarge" placeholder="Escribe el motivo de contacto (Solicitud de informaci&oacute;n, duda, etc)"/>
						</td>
					</tr>
					<tr>
						<td> Comentario: </td>
						<td>
							<textarea class="input-xxlarge" cols="48" id="contacto_comentario" name="contacto_comentario"><?=$contactoComentario?></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<center>  <div class="g-recaptcha" data-sitekey="6Lebe-MUAAAAALATqkUlYVf8gaVBK6zDw2N-3cN8"></div> </center>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p align="center"> <button class="btn btn-primary btn_class"  onsubmit="return gtag_report_conversion()" type="submit">Enviar</button></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</form>
</div>
