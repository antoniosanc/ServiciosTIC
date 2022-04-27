<?php

	session_start();

	error_reporting(0);

	

	include_once("../configuration.php");

  

	include_once(URL_SERVIDOR."/class/generales.class.php");

	$generales = new generales();

	

	include_once(URL_SERVIDOR."/class/negocios.class.php");

	$negocios = new negocios();



	switch( strtolower($_GET["q"]) )

	{  

		case "base": 

			$var_formato = "exportar-contactos";

			$var_formato_url = URL_SERVIDOR."/".$var_formato.".csv";

			$arr_negocios = $negocios->negocios_lista_contactos_exportar( );

			 

			$csv_end = "\n";

			$csv_sep = ",";

			$archivo_csv="";

			

			$archivo_csv .= ucfirst(utf8_decode("Clave, Nombre, Teléfono, Correo electrónico, Ciudad, Motivo de contacto, Comentario, Fecha de registro,\n"));

			foreach( $arr_negocios as $negocios )

			{ 

			

				$comentarios = str_replace("<ul>", "", strtolower($negocios['contacto_comentarios']) );

				$comentarios = str_replace("</ul>", "", strtolower($comentarios) );

				$comentarios = str_replace("</li>", "", strtolower($comentarios) );

				$comentarios = str_replace("<strong>", "", strtolower($comentarios) );

				$comentarios = str_replace("</strong>", "", strtolower($comentarios) );

				$comentarios = str_replace(",", "", strtolower($comentarios) );

				$comentarios = str_replace(";", "", strtolower($comentarios) );

				$comentarios = str_replace("<br/>", "", strtolower($comentarios) );

				$comentarios = str_replace("<br>", "", strtolower($comentarios) );

				$comentarios = str_replace("<br />", "", strtolower($comentarios) );

				$comentarios = str_replace("\r\n", "", strtolower($comentarios) );

				$comentarios = str_replace("\n", "", strtolower($comentarios) );

				$comentarios = str_replace("<li>", "|||", strtolower($comentarios) );

			 

				$archivo_csv.= 

					ucfirst(utf8_decode($negocios['contacto_id'])).$csv_sep.

					ucfirst(utf8_decode($negocios['contacto_nombre'])).$csv_sep.

					ucfirst(utf8_decode($negocios['contacto_telefono'])).$csv_sep.

					ucfirst(utf8_decode($negocios['contacto_correo_electronico'])).$csv_sep.

					ucfirst(utf8_decode(str_replace(",",";",$negocios['contacto_direccion']))).$csv_sep.

					ucfirst(utf8_decode(str_replace(",",";",$negocios['contacto_asunto']))).$csv_sep.

					ucfirst(utf8_decode(str_replace(",",";",$comentarios))).$csv_sep.

					ucfirst(utf8_decode($negocios['contacto_fecha_contacto'])).$csv_end;  

			}

			

			

			$fp = fopen($var_formato_url,'w');

			fwrite($fp,$archivo_csv);

			fclose($fp);

			

			header("Content-type:text/csv");

			header("Content-Disposition:attachment;filename=".$var_formato.".csv");

			readfile(URL_SERVIDOR."/".$var_formato.".csv");

			header("Pragma: no-cache");

			header("Expires: 0");

			die();

			 

		break;

		default:

			echo '<html>

					<head>

						<link href="./libs/bootstrap/css/bootstrap.css" rel="stylesheet"> 

					</head>

					<body>

						<div class="alert alert-danger">

							Error al consultar el formato. Haz <a class="alert-link" href="index.php">clic aqu&iacute;</a> para intentar nuevamente.

						</div>

					</body>

				</html>';

			exit;

		break;

	}

?>