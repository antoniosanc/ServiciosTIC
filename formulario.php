
<div class="hm-contacto">
	<div class="container">
		<div class="row">
						<div class="col-md-offset-1 col-md-10 bg-contacto">
				<h2>Cont&aacute;ctanos</h2>
				<form action="control/formulario.php" method="POST" name="frm_contacto" id="frm_contacto">
					<div class="col-md-6">
						<div class="form-group">
						<div>
							<input type="text" name="contacto_nombre" id="contacto_nombre" value="" class="form-control" placeholder="Nombre"/>
						</div>
						</div>
						<div class="form-group">
							<div >
								<input type="text" name="contacto_email" id="contacto_email" value="" class="form-control" placeholder="Correo"/>
							</div>
						</div>
						<div class="form-group">
							<div>
								<input type="text" name="contacto_telefono" id="contacto_telefono" value="" class="form-control" placeholder="Tel&eacute;fono"/>
							</div>
						</div>
						<div class="form-group">
							<div>
								<input type="text" name="contacto_direccion" id="contacto_direccion" value="" class="form-control" placeholder="Direcci&oacute;n" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div>
								<input type="text" name="contacto_asunto" id="contacto_asunto" value="" class="form-control" placeholder="Motivo de cont&aacute;cto" />
							</div>
							<div class="form-group">
								<div >
									<textarea class="form-control" cols="48" id="contacto_comentario" name="contacto_comentario" placeholder="Comentarios"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12 mr_captcha">
							<center><div class="g-recaptcha" data-sitekey="6Ld4g_QUAAAAAM3jmOQmNn3VAMGGnbwyRvzR7Pu4"></div></center>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<center><button onsubmit="return gtag_report_conversion()" type="submit" class="btn btn-servicios">Enviar <span class="glyphicon glyphicon-chevron-right"></span></button></center>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><script src='https://www.google.com/recaptcha/api.js'></script>
