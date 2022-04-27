<?php 
	include 'header.php';
 ?>
				
<div class="wrapper">
	<div class="main">
		<section class="content">
				<div class="parallax img-acerca" id="m">
					<div class="titulo_principal">
						<div class="container">
							<div class="col-md-12">
								<h1>Acerca</h1>
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
										<li class="active">Acerca</li>
				</ol>			
			</div>
		</div>
	</div>
</div>
<div id="no-more-tables">
				<div class="container contenido">
					<div class="row">				
						<div class="col-md-12">






		
	<table width="100%" cellspacing="1" cellpadding="20" border="0" align="center">
    <tbody>
        <tr>
            <td width="33%" valign="top">
            <p style="text-align: center;"><img src="userfiles/servicios_tic20/image/objetivos.jpg" alt="Objetivos" class="img-responsive" border="0" /></p>
            <h2 style="text-align: center;">Objetivos</h2>
            <p style="text-align: justify;">Incrementar nuestra participaci&oacute;n en el mercado nacional y posicionarnos como la mejor opci&oacute;n de empresa prestadora de Servicios de Tecnolog&iacute;as de la Informaci&oacute;n y Comunicaciones.</p>
            <p style="text-align: justify;">Atender a nuestros clientes con total disponibilidad y atenci&oacute;n personalizada.</p>
            </td>
            <td width="33%" valign="top">
            <p style="text-align: center;"><img src="userfiles/servicios_tic20/image/mision.jpg" alt="Misi&oacute;n" class="img-responsive" border="0" /></p>
            <h2 style="text-align: center;">Misi&oacute;n</h2>
            <p style="text-align: justify;">Somos una empresa dedicada a proporcionar servicios de soporte t&eacute;cnico, venta de equipo de c&oacute;mputo, telecomunicaciones y suministro de accesorios y/o consumibles.</p>
            <p style="text-align: justify;">Nuestro prop&oacute;sito es orientar y apoyar a nuestros clientes en la implantaci&oacute;n de seguridad inform&aacute;tica y manejo de informaci&oacute;n; ofreci&eacute;ndoles soluciones integrales en el manejo e implementaci&oacute;n de tecnolog&iacute;as de la informaci&oacute;n, a fin de satisfacer sus necesidades con un excelente esp&iacute;ritu de servicio.</p>
            </td>
            <td width="33%" valign="top">
            <p style="text-align: center;"><img src="userfiles/servicios_tic20/image/vision.jpg" alt="Vision" class="img-responsive" border="0" /></p>
            <h2 style="text-align: center;">Visi&oacute;n</h2>
            <p style="text-align: justify;">Lograr un posicionamiento e incrementar nuestra participaci&oacute;n en el mercado nacional como una empresa que comprende y satisface, de manera profesional y responsable, las necesidades de sus clientes respecto al suministro de asesor&iacute;a tecnol&oacute;gica.</p>
            </td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p></div>
			</div>
		</div>
	</div><script src='https://www.google.com/recaptcha/api.js'></script>




<div class="hm-contacto">
	<div class="container">
		<div class="row">
						<div class="col-md-offset-1 col-md-10 bg-contacto">
				<h2>Cont&aacute;ctanos</h2>
				<form action="index.php?q=contacto&g=g" method="POST" name="frm_contacto" id="frm_contacto">
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

<?php include 'footer.php' ?>