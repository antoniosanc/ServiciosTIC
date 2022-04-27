<?php include 'header.php' ?>
<div class="wrapper">
	<div class="main">
		<section class="content">
				<div class="parallax img-solicitud" id="m">
					<div class="titulo_principal">
						<div class="container">
							<div class="col-md-12">
								<h1>SOLICITA SOPORTE TÉCNICO</h1>
							</div>			
						</div>			
					</div>
				</div><!-- .parallax -->
		</section> <!-- .content -->
	</div><!--.main -->
</div>  <!-- wrapper -->

<p>&nbsp;</p>
 <div class="hm-contacto">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-8 bg-contacto">
				<h2><strong>Soporte t&eacute;cnico</strong></h2>
				<form action="control/soporte.php" method="POST" name="frm_solicita_soporte" id="frm_solicita_soporte"  >
					<div class="form-group">
						<input class="form-control" id="solicita_soporte_nombre" name="solicita_soporte_nombre" type="text" placeholder="Nombre"/></div>
					<div class="form-group">
						<input class="form-control" id="solicita_soporte_email" name="solicita_soporte_email" type="email" placeholder="Correo electr&oacute;nico"/>
					</div>					
					<div class="form-group">
						<input class="form-control" id="solicita_soporte_telefono" name="solicita_soporte_telefono" type="tel" placeholder="Tel&eacute;fono"/>
					</div>
					<div class="form-group">
						<textarea class="form-control" id="solicita_soporte_comentario" name="solicita_soporte_comentario" placeholder="Falla o Problema" cols="48"/></textarea>
					</div>					
					<div class="form-group">
						<p align="center"><button class="btn btn-servicios"  onsubmit="return gtag_report_conversion()" type="submit">Enviar ></button></p>
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>