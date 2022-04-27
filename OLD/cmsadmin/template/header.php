<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CMS Admin - Soluciones IM </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
		<link href="./css/admin.css" rel="stylesheet">
		<link href="./libs/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="./libs/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="./libs/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="./libs/dataTables/css/dataTables.bootstrap.css" rel="stylesheet">
		<link href="./libs/dataTables/css/font-awesome.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="./libs/bootstrap/js/html5shiv.js"></script>
		<![endif]-->
	</head>

	<body>
	<div id="wrap">

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="brand" href="index.php">CMS Admin</a>
				<div class="nav-collapse collapse">
				<ul class="nav">
				<?
					switch( strtolower($_GET["q"]) )
					{
						case "inicio":
							$inicio = ' class="active" ';
						break;
						case "secciones":
							$secciones = ' class="active" ';
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
							$galeria = ' class="active" ';
						break;
						case "negocios":
						case "negocios_responder":
							$negocios = ' class="active" ';
						break;
						case "configuracion":
						case "usuarios_edita":
						case "usuarios_agrega":
							$configuracion = ' class="active" ';
						break;
						default:
							$inicio = ' class="active" ';
						break;
					}
				?>
					<li <?=$inicio?>><a href="index.php">Home</a></li>
				<?
					if ( $_SESSION["permiso_secciones"] == 1 || $_SESSION["permiso_secciones"] == 2 )
						echo '<li '.$secciones.'><a href="index.php?q=secciones" >Secciones</a></li>';
					
					if ( $_SESSION["permiso_contenido"] == 1 || $_SESSION["permiso_contenido"] == 2 )
						echo '<li '.$contenidos.'><a href="index.php?q=contenidos" >Contenidos</a></li>';

					if ( $_SESSION["permiso_contenido"] == 1 || $_SESSION["permiso_contenido"] == 2 )
						echo '<li '.$galeria.'><a href="index.php?q=galeria" >Galer&iacute;as</a></li>';

					if ( $_SESSION["permiso_centro_negocios"] == 1 || $_SESSION["permiso_centro_negocios"] == 2 )
						echo '<li '.$negocios.'><a href="index.php?q=negocios">Centro de negocios</a></li>';

					if ( $_SESSION["permiso_estadisticas"] == 2)
						echo '<li><a href="http://www.google.com/analytics/" target="_blank">Estad&iacute;sticas</a></li>';
				?>
					<li><a href="http://www.solucionesim.net/blog/" target="_blank">Noticias</a></li>
				<?
					if ( $_SESSION["permiso_configuracion"] == 1 )
						echo '<li '.$configuracion.'><a href="index.php?q=configuracion">Configuraci&oacute;n</a></li>';
				?>
				  <li><a href="../index.php" target="_blank">Vista Previa</a></li>
				  <li><a href="logout.php">Salir</a></li>
				</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<!-- Begin page content -->
	<div class="container">
