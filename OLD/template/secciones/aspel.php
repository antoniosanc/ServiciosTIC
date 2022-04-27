<div class="aspel">
	<?=$contenido->contenido_obten_contenido_full_nombre( "aspel" ) ?>
</div>

 <div class="row">
	 <div class="col-md-3">
	 </div>
	 <div class="col-md-6" id="contacto">
		<h2 style="text-align:center;">Cont&aacute;ctanos</h2>
		<p style="text-align:center;">Favor de completar el siguiente formulario y nosotros nos comunicaremos contigo a la brevedad:</p>
		
		<script src='https://www.google.com/recaptcha/api.js'></script>
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
							<!--td>Ciudad:</td-->
							<td>
								<input type="hidden" name="contacto_direccion" id="contacto_direccion" value="N/A" class="input-xxlarge" placeholder="Escribe de d&oacute;nde nos contactas "/>
							</td>
						</tr>
						<tr>
							<!--td>Motivo de contacto:</td-->
							<td>
								<input type="hidden" name="contacto_asunto" id="contacto_asunto" value="Solicitud de informaci&oacute;n Aspel SAE" class="input-xxlarge" placeholder="Escribe el motivo de contacto (Solicitud de informaci&oacute;n, duda, etc)"/>
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
								<p align="center"> <button class="btn btn-primary btn_class"  onsubmit="return gtag_report_conversion()" type="submit">Cotiza</button></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>
<p><a href="http://www.serviciostic.com.mx/index.php?q=software" class="btn btn-primary">Regresar a Software</a></p>