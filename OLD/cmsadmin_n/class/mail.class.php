<?
	include_once( URL_SERVIDOR."/class/db.class.php");
	include_once( URL_SERVIDOR."/class/generales.class.php");
	include_once( URL_SERVIDOR."/libs/phpmailer/class.phpmailer.php");

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

		$this->mail->IsSMTP();
		$this->mail->Host = HOST_MAIL;
		$this->mail->SMTPAuth = true;
		
		if( strtolower(SEGURIDAD_MAIL) != "none")
			$this->mail->SMTPSecure = "";
		else
			$this->mail->SMTPSecure = SEGURIDAD_MAIL;
		
		$this->mail->Port = PUERTO_MAIL; 
		$this->mail->Username = EMAIL_MAIL;
		$this->mail->Password = PASSWORD_MAIL;
		
		$this->mail->From = $datos["correo_remitente"];
		$this->mail->FromName = $datos["nombre"];
		$this->mail->AddAddress( $datos["correo_receptor"] );
		$this->mail->AddBCC( "contacto_clientes@solucionesim.net" );
		
		$this->mail->WordWrap = 50;

		$this->mail->IsHTML(true);

		$this->mail->Subject = $datos["asunto"];
		$this->mail->Body    = $datos["cuerpo_correo"];
	
		if(!$this->mail->Send())
		   return false;

		return true;
	}
}

?>
