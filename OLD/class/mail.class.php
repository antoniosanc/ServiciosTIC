<?
	include_once( URL_SERVIDOR_FRONT."/class/db.class.php");
	include_once( URL_SERVIDOR_FRONT."/class/generales.class.php");
	include_once( URL_SERVIDOR_FRONT."/libs/phpmailer/class.phpmailer.php");

class mail
{
	function __construct( ) 
	{
		$this->db = new db();
		$this->generales = new generales();
		$this->mail = new phpmailer();
	}
	

	function enviar_mail ( $datos = "" )
	{

		if( !is_array($datos) )
			return false;
			
		$this->mail = new PHPMailer();

		//$this->mail->IsSMTP();
		//$this->mail->Host = "smtp.gmail.com";
		//$this->mail->SMTPAuth = true;
		//$this->mail->SMTPSecure = "ssl";  //google apps
		//$this->mail->Port       = 465;    //google apps
		//$this->mail->Username = $mail_envio_admin;
		//$this->mail->Password = "redessociales123";
		
		$this->mail->From = $datos["correo_remitente"];
		$this->mail->FromName = $datos["nombre_remitente"];
		$this->mail->AddAddress( $datos["correo_receptor"], $datos["nombre_receptor"] );
		$this->mail->AddCC( $datos["contacto_correo2"]);
		
		$this->mail->WordWrap = 50;

		$this->mail->IsHTML(true);

		$this->mail->Subject = $datos["asunto"];
		$this->mail->Body    = $datos["cuerpo_correo"];
	
		if(!$this->mail->Send())
		   return false;

		return true;
	}
	
	function mail_guarda_datos_contacto( $datos = "", $soporte_tecnico = 0 )
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
				Desde el sitio Web de '.NOMBRE_SITIO.' <br/>
				<b>'.$datos["contacto_nombre"].'</b>, Desea ponerse en contacto contigo, sus datos son:
				<br/>Tel&eacute;fono: <b>'.$datos["contacto_telefono"].'</b>
				<br/>E-mail: <b>'.$datos["contacto_email"].'</b>
				<br/>Direccion: <b>'.$datos["contacto_direccion"].'</b>
				<br/>Comentario: <b>'.$datos["contacto_comentario"].'</b>
				<br/>Soporte ID: <b>'.($insert_id + 1000).'</b>
				<br/> Ademas la cuenta de correo '.$datos["contacto_email"].' ha sido agregada correctamente a la base de datos con toda la informacion necesaria para su posterior consulta en el CMSAdmin.
				<br/><br/>
				
				<b>Atte.</b><br/>
				<b>Sitio Web de Contacto Web '.NOMBRE_SITIO.'.</b><br/><br/>
				<small><i>Si tuvieras alguna duda con este correo favor de contactar a <a href="http://www.solucionesim.net" target="_blank">Soluciones IM</a>.</i></small>
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
		if(!empty($arr_configuracion[0]["configuracion_nombre_empresa"]) )
			$nombre_remitente = $arr_configuracion[0]["configuracion_nombre_empresa"];
		
		$correo_remitente = CORREO_CONTACTO;
		if(!empty($arr_configuracion[0]["configuracion_email_empresa"]) )
			$correo_remitente = $arr_configuracion[0]["configuracion_email_empresa"];
		
		
		$arr_datos = array();
		$arr_datos["nombre_remitente"] = $datos["contacto_nombre"];
		$arr_datos["correo_remitente"] = $datos["contacto_email"];
		$arr_datos["nombre_receptor"] = $nombre_remitente;
		$arr_datos["correo_receptor"] = $correo_remitente;
		$arr_datos["asunto"] = utf8_decode($datos["contacto_asunto"]);
		$arr_datos["cuerpo_correo"] = $cuerpo;
		$arr_datos["contacto_correo2"] = $datos["contacto_correo2"];

		if( !$this->enviar_mail( $arr_datos ) ) // Enviamos el mail al dueño del sitio web
			return false;
			
		$cuerpo_usuario = '<html>
							<head>
							<title></title>
							</head>
							<body>
								<p>Estimado '.ucwords(strtolower($datos["contacto_nombre"])).'<p>
								<p align="center">Su solicitud ha sido recibida con &eacute;xito, en breve uno de nuestros Ingenieros se comunicar&aacute; con usted. Su n&uacute;mero de soporte t&eacute;cnico es '.($insert_id + 1000).'.</p>
								<p>Atte.</p>
								<p> Equipo de '.NOMBRE_SITIO.'</p>
							</body>
						</html>';
						
						
		if(!empty($arr_configuracion[0]["configuracion_correo_respuesta"]) && $soporte_tecnico == 0 )
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
		
		
		$arr_datos = array();
		$arr_datos["nombre_remitente"] = $nombre_remitente;
		$arr_datos["correo_remitente"] = $correo_remitente;
		$arr_datos["nombre_receptor"] = $datos["contacto_nombre"];
		$arr_datos["correo_receptor"] = $datos["contacto_email"];
		$arr_datos["asunto"] = "Correo enviado a ".NOMBRE_SITIO." exitosamente" ;
		$arr_datos["cuerpo_correo"] = $cuerpo_usuario;

		if( !$this->enviar_mail( $arr_datos ) ) // Enviamos el mail al contactante con un agradecimiento.
			return false;
		
		return $insert_id;
	}
}

?>
