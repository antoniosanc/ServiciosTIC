<?php include 'header.php' ?>
					
<div class="wrapper">
	<div class="main">
		<section class="content">
				<div class="parallax img-contacto" id="m">
					<div class="titulo_principal">
						<div class="container">
							<div class="col-md-12">
								<h1>Contacto</h1>
							</div>			
						</div>			
					</div>
				</div><!-- .parallax -->
		</section> <!-- .content -->
	</div><!--.main -->
</div>  <!-- wrapper -->


<div class="hd_navegacion">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<ol class="breadcrumb">
					<li><a href="index.php?q=inicio">Inicio</a></li>
					<li >Contacto</li>
				</ol>			
			</div>
		</div>
	</div>
</div>



	<script src='https://www.google.com/recaptcha/api.js'></script>




<div class="hm-contacto">
	<div class="container">
		<div class="row">
			<div class="col-md-4 contacto-int"><h2 style="text-align: left;">Sucursal CDMX</h2>
				<p><a href="tel:+52-55-9130-1375" target="_blank"><img src="fondos/iconos/llamada.png" alt="Tel&eacute;fono" class="img-responsive animated bouncer" border="0" />&nbsp; (55) 9130 - 1375</a> /<a href="tel:+52-55-6732-4800" target="_blank"> (55) 6732 - 4800</a></p>
				<p><img src="fondos/iconos/correo-electronico.png" alt="Correo" class="img-responsive animated bouncer" border="0" /> soporte@serviciostic.com.mx<br />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ventas@serviciostic.com.mx</p>
				<p><a href="tel:+52-55-1320-5021" target="_blank"><img src="fondos/iconos/telefono-inteligente.png" alt="Celular" class="img-responsive animated bouncer" border="0" /> (55) 1320 - 5021</a></p>
				<p><a href="https://wa.me/525539201357" target="_blank"><img src="fondos/iconos/whatsapp.png" alt="WhatsApp" class="img-responsive animated bouncer" border="0" /> (55) 3920 - 1357</a></p>
			</div>			
		<div class="col-md-8 bg-contacto">
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
</div>

<?php include 'footer.php';?>