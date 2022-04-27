<?
	session_start();
	include_once( "../configuration.php");

	$mensaje_error = 0;
	if( !empty($_POST) && strlen($_POST["user"]) > 4 && strlen($_POST["password"]) > 5)
	{

		include_once( URL_SERVIDOR."/class/generales.class.php");
		$generales = new generales ();
		
		include_once( URL_SERVIDOR."/class/usuario.class.php");
		$usuario = new usuario ();
		
		$datos = array();
		$datos["u"] = $generales->limpia_cadena($_POST["user"]);
		$datos["p"] = $generales->limpia_cadena($_POST["password"]);
		
		if( $resultado = $usuario->usuario_inicia_sesion( $datos ) )
		{
			
			$_SESSION["unombre"] = $resultado[0]["usuarios_nombre"];
			$_SESSION["uid"] = intval($resultado[0]["usuarios_id"]);
			$_SESSION["uemail"] =$resultado[0]["usuarios_email"];
			$_SESSION["reauth"] = 1;
			$_SESSION["ssid"] = $generales->genera_cadena_aleatoria(8);
			$_SESSION["permiso_secciones"] = intval($resultado[1]["usuarios_permisos_secciones"]);
			$_SESSION["permiso_contenido"] = intval($resultado[1]["usuarios_permisos_contenido"]);
			$_SESSION["permiso_estadisticas"] = intval($resultado[1]["usuarios_permisos_estadisticas"]);
			$_SESSION["permiso_centro_negocios"] = intval($resultado[1]["usuarios_permisos_centro_negocios"]);
			$_SESSION["permiso_configuracion"] = intval($resultado[1]["usuarios_permisos_configuracion"]);

			header('Location: index.php');
			exit;
		}
		else
		{
			$mensaje_error = 1;
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Inicia sesi&oacute;n</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		
		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
		<link href="./css/login.css" rel="stylesheet">
		<link href="./libs/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="./libs/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="./libs/bootstrap/js/html5shiv.js"></script>
		<![endif]-->

		<style type="text/css">
			.form-signin label.error 
			{
			margin-left: 10px;
			width: auto;
			}
		</style>
	</head>

	<body style="background: url('https://www.solucionesim.net/bgcms/1.jpg') no-repeat top center  #647687; no-repeat top center fixed;
-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-attachment: fixed;">

		<div class="container">
		  <form class="form-signin" method="POST" action="admin-login.php" id="commentForm">
			<h2 class="form-signin-heading">Inicia Sesi&oacute;n</h2>
			<input type="text" class="form-control col-md-12" placeholder="Usuario" id="user" name="user"/>
			<input type="password"class="form-control col-md-12" placeholder="Contrase&ntilde;a" id="password" name="password"/>
			
			<p align="center"><button class="btn btn-lg btn-warning" type="submit"> Entrar <span class="glyphicon glyphicon-log-in"></span></button></p>
			<?
				if(intval($mensaje_error) == 1)
				{
					echo '<div id="login_error">	<strong>ERROR</strong>: El usuario es incorrecto.</div>';
				}
			?>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p align="right"> <a href="../index.php" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-home"></span> Regresar al sitio</a></p>
		  </form>
		</div> 

		<script src="./libs/bootstrap/js/jquery.js"></script>
		<script src="./libs/validate/jqvalidate.js"></script>
		<script src="./js/login.js"></script>
		<!--La Plataforma CMSAdmin ha sido desarrollada y es propiedad de Soluciones IM.NET SA de CV. Todos los derechos de uso son reservados <?=date("Y")?>-->
	</body>
</html>
