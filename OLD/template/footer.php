<?
	if( $url_seccion != "inicio")
		{
			echo'</div> 
					</div>
						</div >
							</div>';
		}
?>

<?
	if ($url_seccion == "servicios" || $url_seccion == "soporte_tecnico" || $url_seccion == "consultoria_y_seguridad_informatica" || $url_seccion == "hosting")
	{
		include_once(URL_SERVIDOR_FRONT."/template/secciones/footer_marcas.php");
	}
?>

<?
	if ($url_seccion == "consumibles")
	{
		include_once(URL_SERVIDOR_FRONT."/template/secciones/footer_marcas_consumibles.php");
	}
?>
	
<div class="logros">
	<div class="container">
		<div class="col-md-12">
			<?include_once(URL_SERVIDOR_FRONT."/template/secciones/logros.php");?>
		</div>
	</div>
</div>

<div class="sim">
	<div class="container">
		<div class="col-md-4 align-left">
			<p><a href="http://www.serviciostic.com.mx/">www.serviciostic.com.mx</a></p>
		</div>
		<div class="col-md-4 align-left">
			<p style="text-align: center;"><button type="button" class="btn btn-aviso" data-toggle="modal" data-target="#exampleModalLong">  Aviso de Privacidad </button>   <!-- Modal --></p>
		</div>
		<div class="col-md-4 align-right">
			<p style="font-size:13px;"><a target="_blank" href="http://www.solucionesim.net/">&copy; Soluciones IM</a><?=date("Y")?></p>
		</div>
	</div>
</div>

<div class="footer">
	<div class="container">
		<div class="col-md-4 align-left">
			<h1><span>Servicios</span> en Tecnolog&iacute;a<br/>
			de la Informaci&oacute;n</h1>
			<p style="font-size:15px;">Somos una empresa dedicada a proporcionar servicios de soporte t&eacute;cnico, venta de equipo de c&oacute;mputo y suministro de accesorios y/o consumibles.</p>
		</div>
		<div class="col-md-4 align-left">
			<h1><span>Men&uacute;</span> principal</h1>
			<ul class="lista">
				<li><a href="index.php">Inicio</a></li>
				<li><a href="index.php?q=quienes_somos">&iquest;Qui&eacute;nes Somos?</a></li>
				<li><a href="index.php?q=servicios">Soporte</a></li>
				<li><a href="index.php?q=servicios">Hardware</a></li>
				<li><a href="index.php?q=servicios">Software</a></li>
				<li><a href="index.php?q=contacto">Contacto</a></li>
			</ul>
		</div>
		<div class="col-md-4 align-right">
			<h1><span>Cont&aacute;ctanos</span></h1>
			 <p>&nbsp;</p>
			<p><strong>Llámanos:</strong> (55) 91301375 / (55) 67324800</p>
			<p><strong>Escr&iacute;benos:</strong> soporte@serviciostic.com.mx</p>
			<p">
				<a href="index.php?q=contacto"><img src="imgusr/icono_mail.jpg" alt="-" border="0"/></a>&nbsp;&nbsp;&nbsp;
				<a target="_blank" href="https://twitter.com/"><img src="imgusr/icono_twitter.jpg" alt="Twitter" border="0"/></a>&nbsp;&nbsp;&nbsp;
				<a target="_blank" href="https://www.facebook.com/"><img src="imgusr/icono_facebook.jpg" alt="Facebook" border="0"/></a>					
			</p>
 
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle" align="center">
				<p><b>Aviso de Privacidad</b></p>
				</h5>
					<div class="modal-body" style="text-align:justify;">
						<p><b>Aviso de privacidad SERVICIOS EN TIC, S.A. DE C.V. (SERTICSA)</b>, con domicilio en Tlacopan Mz. 342 Lote 50, Col. Cd. Azteca Secci&oacute;n Oriente, Municipio de Ecatepec de Morelos, Estado de M&eacute;xico, CP. 55120 (SERTICSA), es responsable de la confidencialidad, uso y protecci&oacute;n de la informaci&oacute;n personal que nos llegar&eacute; a proporcionar por los distintos medios que utilizamos para la prestaci&oacute;n y difusi&oacute;n de nuestros servicios profesionales. Por lo anterior su informaci&oacute;n personal ser&aacute; utilizada para fines de identificaci&oacute;n en cualquier tipo de relaci&oacute;n jur&iacute;dica o de negocios que realice con nosotros, incluyendo la asesor&iacute;a y prestaci&oacute;n de servicios profesionales en materia legal. Para el caso que se desee limitar el uso o divulgaci&oacute;n de su informaci&oacute;n personal, ejercitar sus derechos de acceder, rectificar y cancelar sus datos personales, as&iacute; como de oponerse al tratamiento de los mismos y revocar el consentimiento que para tal fin nos haya otorgado, lo podr&aacute; realizar directamente en nuestras oficinas a los tel&eacute;fonos (55) 91301375 / (55) 67324800; o trav&eacute;s de nuestro correo electr&oacute;nico soporte@serviciostic.com.mx. En ambos casos se le informaran los procedimientos a seguir. Le informamos que sus datos personales no ser&aacute;n transferidos a terceros para fines distintos a los necesarios para brindarle oportunamente los servicios y/o asesor&iacute;a requeridos a SERTICSA, salvaguardando su protecci&oacute;n y confidencialidad, excepto en los casos contemplados en t&eacute;rminos del art&iacute;culo 37 de la Ley Federal de Protecci&oacute;n de Datos Personales en Posesi&oacute;n de los Particulares. Este correo puede contener informaci&oacute;n privilegiada o confidencial. Si usted no es el destinatario de este correo, o cree que ha recibido esta informaci&oacute;n por error, por favor responda al remitente indicando el hecho y borre la copia que recibi&oacute;. Adem&aacute;s, si usted no es el destinatario, no deber&aacute; imprimir, copiar, retransmitir, diseminar o hacer uso de la informaci&oacute;n de este correo.</p>
					</div>
				<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></div>
			</div>
		</div>
	</div>
</div>
