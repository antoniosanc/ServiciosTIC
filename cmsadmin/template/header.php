<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CMS Admin - Soluciones IM </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
		<link href="./css/admin.css" rel="stylesheet">
		<link href="./libs/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="./libs/dataTables/css/dataTables.bootstrap.css" rel="stylesheet">
		<link href="./libs/dataTables/css/font-awesome.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="./libs/bootstrap/js/html5shiv.js"></script>
		<![endif]-->
	</head>

	<body>

	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="https://www.solucionesim.net" target="_blank">CMSAdmin</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<?
						switch( strtolower($_GET["q"]) )
						{
							case "inicio":
								$inicio = ' class="active" ';
							break;
							case "secciones":
							case "secciones_restaurar":
								$secciones = ' active ';
							break;
							case "contenidos":
							case "contenidos_edita":
							case "contenidos_edita_historia":
							case "contenidos_restaura":
								$contenidos = ' class="active" ';
							break;
							case "galeria":
							case "galerias_edita":
							case "galerias_nueva":
							case "galerias_edita_imagenes":
								$galeria = ' active ';
							break;
							case "negocios":
							case "negocios_responder":
								$negocios = ' class="active" ';
							break;
							case "configuracion":
							case "usuarios_edita":
							case "usuarios_agrega":
							case "file":
								$configuracion = ' active ';
							break;
							default:
								$inicio = ' class="active" ';
							break;
						}
					?>
						<li <?=$inicio?>><a href="index.php">Inicio</a></li>
					<?
						if ( $_SESSION["permiso_secciones"] == 1 || $_SESSION["permiso_secciones"] == 2 )
						{
							echo '<li '.$secciones.'></li>';
							echo '<li class="'.$secciones.' dropdown">
									  <a href="index.php?q=secciones"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Secciones <span class="caret"></span> </a>
									<ul class="dropdown-menu">
										<li><a href="index.php?q=secciones">Agregar o editar nombre de secci&oacute;n</a></li>
										<li><a href="index.php?q=secciones_restaurar">Recuperar secci&oacute;n eliminada</a></li>
									  </ul>
								</li>';
						}
						
						if ( $_SESSION["permiso_contenido"] == 1 || $_SESSION["permiso_contenido"] == 2 )
							echo '<li '.$contenidos.'><a href="index.php?q=contenidos"  data-toggle="tooltip" data-placement="bottom" title="Cambia la informaci&oacute;n de tu sitio web">Contenidos</a></li>';

						if ( $_SESSION["permiso_contenido"] == 1 || $_SESSION["permiso_contenido"] == 2 )
						{
							echo '<li class="'.$galeria.' dropdown">
									  <a href="index.php?q=galeria" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  >Galer&iacute;as  <span class="caret"></span></a>
									  <ul class="dropdown-menu">
										<li><a href="index.php?q=galerias_edita&s=kg==">Agregar imagenes a slide principal</a></li>
										<li><a href="index.php?q=galerias_nueva">Crear nueva galer&iacute;a</a></li>
										<li><a href="index.php?q=galeria">Editar una galer&iacute;a</a></li>
									  </ul>
									</li>';
						}

						if ( $_SESSION["permiso_centro_negocios"] == 1 || $_SESSION["permiso_centro_negocios"] == 2 )
							echo '<li '.$negocios.'><a href="index.php?q=negocios"  data-toggle="tooltip" data-placement="bottom" title="Seguimiento a prospectos y contactos">Centro de negocios</a></li>';

						
						if ( $_SESSION["permiso_configuracion"] == 1 )
						{

							echo '<li class="'.$configuracion.' dropdown">
									  <a href="index.php?q=configuracion" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ajustes  <span class="caret"></span></a>
									  <ul class="dropdown-menu">
										<li><a href="index.php?q=usuarios_agrega">Agregar nuevo usuario</a></li>';
							echo ' 		</ul>
									</li>';
						}
					
						if ( $_SESSION["permiso_estadisticas"] == 2)
							echo '<li><a href="http://www.google.com/analytics/" target="_blank">Estad&iacute;sticas</a></li>';
					?>
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ayuda  <span class="caret"></span></a>
						  <ul class="dropdown-menu">
							<li><a href="https://www.solucionesim.net/blog/" target="_blank" >Consejos de Marketing</a></li>
							<li><a href="https://www.solucionesim.net/index.php?q=contacto&g=cmsadmin" target="_blank">Solicitar soporte t&eacute;cnico</a></li>
						  </ul>
						</li>';
					
					  <li><a href="../index.php" target="_blank">Mi Sitio Web</a></li>
					  <li><a href="logout.php">Salir</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	
	<!-- Begin page content -->
	<div class="container">
