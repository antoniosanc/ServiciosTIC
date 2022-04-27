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

		//$this->mail->IsSMTP();
		//$this->mail->Host = "smtp.gmail.com";
		//$this->mail->SMTPAuth = true;
		//$this->mail->SMTPSecure = "ssl";  //google apps
		//$this->mail->Port       = 465;    //google apps
		//$this->mail->Username = $mail_envio_admin;
		//$this->mail->Password = "redessociales123";
		
		$this->mail->From = $datos["correo_remitente"];
		$this->mail->FromName = $datos["nombre"];
		$this->mail->AddAddress( $datos["correo_receptor"] );
		
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
