<?php

	include_once( URL_SERVIDOR_FRONT."/class/db.class.php");

	include_once( URL_SERVIDOR_FRONT."/class/generales.class.php");

	include_once( URL_SERVIDOR_FRONT."/libs/phpmailer/class.phpmailer.php");



class mail

{

	function __construct( ) 

	{

		$this->db = new db();

		$this->generales = new generales();

		$this->mail = new PHPMailer();

	}

	



	function enviar_mail ( $datos = "" )

	{



		if( !is_array($datos) )

			return false;

			

		$this->mail->charSet = "UTF-8";

		$this->mail->IsSMTP();

		$this->mail->Host = HOST_MAIL;

		$this->mail->SMTPAuth = true;

		

		if( strtolower(SEGURIDAD_MAIL) != "none")

			$this->mail->SMTPSecure = SEGURIDAD_MAIL;

		

		$this->mail->Port = PUERTO_MAIL; 

		$this->mail->Username = EMAIL_MAIL;

		$this->mail->Password = PASSWORD_MAIL;

		

		$this->mail->From = $datos["correo_remitente"];

		$this->mail->FromName = $datos["nombre_remitente"];

		

		if( $datos["contacto_correo2"] == "soporte@serviciostic.com.mx" )

		{

			$this->mail->AddAddress( "soporte@serviciostic.com.mx" );

		}

		else

		{

			$this->mail->AddAddress( $datos["correo_receptor"], $datos["nombre_receptor"] );

		}

		//$this->mail->AddAddress( "desarrollo1@solucionesim.net", "Marcos" );

		

		if(  CORREO_CCO_MAIL != "" )

			$this->mail->AddBCC( CORREO_CCO_MAIL );

		

		$this->mail->WordWrap = 50;



		$this->mail->IsHTML(true);



		$this->mail->Subject = utf8_decode($datos["asunto"]);

		$this->mail->Body    = $datos["cuerpo_correo"];

	

		if(!$this->mail->Send())

		{

			//echo "Error:".$this->mail->ErrorInfo;

			return false;

		}



		return true;

	}

	

	function mail_guarda_datos_contacto( $datos = "" )

	{

		if( !is_array($datos) )

			return false;

		

		if( !$this->generales->valida_email( $datos["contacto_email"] ))

			return false;

		

		$sql = sprintf("INSERT INTO contacto(contacto_nombre, contacto_correo_electronico, contacto_telefono, contacto_direccion, contacto_asunto, contacto_comentarios, contacto_fecha_contacto, contacto_status) VALUES ('%s','%s','%s','%s','%s','%s','%s',1)",

					$this->db->db_evita_sql_injection( $datos["contacto_nombre"] ),

					$this->db->db_evita_sql_injection( $datos["contacto_email"] ),

					$this->db->db_evita_sql_injection( $datos["contacto_telefono"] ),

					$this->db->db_evita_sql_injection( $datos["contacto_direccion"] ),

					$this->db->db_evita_sql_injection( $datos["contacto_asunto"] ),

					$this->db->db_evita_sql_injection( $datos["contacto_comentario"] ),

					$this->generales->hoy()

				);

		

		if( !$insert_id = $this->db->db_query( $sql, 2 ) )

				return false;

		

		

		

		$cuerpo = '

		<html>

			<head>

				<title></title>

			</head>

			<body>

				<table width="800" cellspacing="0" cellpadding="5" border="0" align="center">

					<tbody>

						<tr>

							<td width="100%" colspan="2" style="border-bottom:2px solid #333;">

								<h3 style="text-align:center;">'.NOMBRE_SITIO.'</h3>

							</td>

						</tr>

						<tr>

							<td width="800" colspan="2" style="padding-bottom:50px; padding-top:50px;">

								<p style="text-align:center;"><b>'.utf8_decode( ucwords(strtolower($datos["contacto_nombre"])) ).'</b></p>

								<p style="text-align:left;">Desea ponerse en contacto con usted, los datos de contacto que ha dejado son los siguientes:</p>

								<p>&nbsp;</p>

								<ul>

									<li> <b>E-mail: </b>'.$datos["contacto_email"].'</li>

									<li> <b>Direcci&oacute;n: </b>'.$datos["contacto_direccion"].'</li>

									<li> <b>Tel&eacute;fono: </b>'.$datos["contacto_telefono"].'</li>

									<li> <b>Asunto: </b>'.utf8_decode($datos["contacto_asunto"]).'</li>

									<li> Soporte ID: <b>'.($insert_id + 1000).'</li>

									<li> <b>Comentario: </b>'.utf8_decode($datos["contacto_comentario"]).'</li>

								</ul>

								<p>&nbsp;</p>

								<p style="text-align:left;"> Si quisiera consultar m&aacute;s detalles o desacargar un reporte m&aacute;s completo puede entrar a su Plataforma de <strong>CMSAdmin</strong>.</b></p>

							</td>

						</tr>

						<tr>

							<td width="800" colspan="2" style="border-top:2px solid #333;">

								<p style="text-align:right;">Si tiene algunda duda al respecto de este correo por favor comun&iacute;quese con nosotros:

								<p style="text-align:right;"><img alt="SIM" src="http://www.solucionesim.net/imgusr/icono-tel.png" class="img-responsive" width="20" border="0"> (55) 5970-6848 <br/>

								contacto@solucionesim.net<br/>

								<a style="color:#333;" href="http://www.solucionesim.net">www.solucionesim.net</a><p>

							</td>

						</tr>

					</tbody>

				</table>

			</body>

		</html>

		';



		$sql_remitente = sprintf("

					SELECT

						c.configuracion_nombre_empresa,

						c.configuracion_email_empresa,

						c.configuracion_correo_respuesta

					FROM

						configuracion AS c

					WHERE

						c.configuracion_id = 1");



		if( !$arr_configuracion = $this->db->db_query( $sql_remitente, 1 ) )

				return false;



		$nombre_remitente = NOMBRE_SITIO;

		if( $arr_configuracion[0]["configuracion_nombre_empresa"] != "" )

			$nombre_remitente = $arr_configuracion[0]["configuracion_nombre_empresa"];

		

		$correo_remitente = CORREO_CONTACTO;

		if( $arr_configuracion[0]["configuracion_email_empresa"] != "" )

			$correo_remitente = $arr_configuracion[0]["configuracion_email_empresa"];

		

		

		$arr_datos = array();

		$arr_datos["nombre_remitente"] = utf8_decode($datos["contacto_nombre"]);

		$arr_datos["correo_remitente"] = $datos["contacto_email"];

		$arr_datos["nombre_receptor"] = utf8_encode($nombre_remitente);

		$arr_datos["correo_receptor"] = $correo_remitente;

		$arr_datos["asunto"] = $datos["contacto_asunto"];

		$arr_datos["contacto_correo2"] = $datos["contacto_correo2"];

		$arr_datos["cuerpo_correo"] = $cuerpo;

		

		

		if( !$this->enviar_mail( $arr_datos ) ) // Enviamos el mail al dueño del sitio web

			return false;

			

		$cuerpo_usuario = '<html>

							<head>

							<title></title>

							</head>

							<body>

							<p align="center">

								Su correo fue enviado con &eacute;xito a la empresa '.NOMBRE_SITIO.'.  En breve le responderemos

							</p>

							</body>

						</html>';

		if(!empty($arr_configuracion[0]["configuracion_correo_respuesta"]) )

		{

			$cuerpo_usuario = '<html>

								<head>

								<title></title>

								</head>

								<body>

									'.$arr_configuracion[0]["configuracion_correo_respuesta"].'

								</body>

							</html>';

		}

		

		

		$arr_datos_usuario = array();

		$arr_datos_usuario["nombre_remitente"] = utf8_decode($nombre_remitente);

		$arr_datos_usuario["correo_remitente"] = $correo_remitente;

		$arr_datos_usuario["nombre_receptor"] = utf8_decode($datos["contacto_nombre"]);

		$arr_datos_usuario["correo_receptor"] = $datos["contacto_email"]; 

		$arr_datos_usuario["asunto"] = "Correo enviado a ".NOMBRE_SITIO." exitosamente";

		$arr_datos_usuario["cuerpo_correo"] = $cuerpo_usuario;

 

		if( !$this->enviar_mail( $arr_datos_usuario ) ) // Enviamos el mail al contactante con un agradecimiento.

			return false;

		

		return true;

	}

	

	function __destruct() 

	{

		unset($this->generales);

		unset($this->db);

		unset($this->mail);

	}

}



?>

