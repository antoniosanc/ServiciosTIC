<div class="header">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<p>
					&nbsp;
				</p>
			</div>
			<div class="col-md-6">
				<p style="text-align:center;">
					<a href="index.php">
						<img src="imgusr/logo_servicios_en_tic.png" alt="Servicios en TIC" border="0" class="img-responsiva"/>
					</a>
				</p>
			</div>
			<div class="col-md-3 btn-soporte align-left">
				<p><a href="index.php?q=solicita_soporte_tecnico" class="btn btn-danger btn-lg">Soporte T&eacute;cnico</a></p>

	<p style="text-align:center; margin:20px 0;"><a href="index.php?q=contacto"><img src="imgusr/icono_mail.jpg" alt="-" border="0"/></a>&nbsp;&nbsp;
					<a target="_blank" href="https://twitter.com/"><img src="imgusr/icono_twitter.jpg" alt="Twitter" border="0"/></a>&nbsp;&nbsp;			
					<a target="_blank" href="https://www.facebook.com/"><img src="imgusr/icono_facebook.jpg" alt="Facebook" border="0"/></a>					
			</p>
			</div>		
		</div>
	</div>
</div>
<div class="menu">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle menu-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<?=$base->base_crea_menu_secciones( $url_seccion ) ?>
					</div>
				</nav>
			</div>
			<div class="col-md-4 redes_hd">
				<p style="text-align:center; margin:20px 0;">
					<span>Ll&aacute;manos:</span> (55) 91301375 / (55) 67324800
						</p>
			</div>
		</div>
	</div>
</div>

<br/>

<?
	if( $url_seccion != "inicio")
	{
		include_once(URL_SERVIDOR_FRONT."/template/secciones/titulo_interna.php");
	}
	else
	{
		include_once(URL_SERVIDOR_FRONT."/template/secciones/inicio.php");
	}

	if( $url_seccion != "inicio")
		{
			echo'<div class="contenido">
					<div class="container">
						<div class="col-md-12">
							<div id="no-more-tables">
							<br/>';
		}
?>
