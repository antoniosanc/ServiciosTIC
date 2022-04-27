<?
	define("URL_SERVIDOR_FRONT", dirname(__FILE__) );
	
	$sim_mostrar_errores = 0; 
	
	/*Editar aquí*/
	
	/*Datos del proyecto*/
	$sim_nombre_proyecto = 'Servicios en TIC S.A. de C.V.'; //Nombre del proyecto
	$sim_correo_electronico_proyecto = 'soporte@serviciostic.com.mx'; //Correo del cliente 
	$sim_carpeta_userfiles = 'servicios_tic'; //directorio del proyecto
	
	/*Datos de conexión base de datos*/
	$sim_nombre_base_datos = 'ec2544servicio_stic19';  //Nombre de la base de datos
	$sim_usuario_base_datos = 'ec2544servicio_stic19';   // Usuario de la base de datos
	$sim_password_base_datos = 'SswdxIlD6'; //contraseña de la base de datos
	
	/*Datos de envio de correo (APLICAR EN PRODUCCIÓN EN DOMINIO)*/
	$sim_host_mail = 'mail.serviciostic.com.mx'; //Host de SIM: mail.dominio_cliente.com // Google Apps: smtp.gmail.com
	$sim_email_mail = 'web@serviciostic.com.mx'; //Ej. correo@dominio_cliente.com
	$sim_password_mail = 'WebTics4r'; //debe ser contraseña segura del correo anterior
	$sim_seguridad_mail = 'ssl'; //Host de SIM: none // Google Apps: ssl
	$sim_puerto_mail = '465'; //SMTP de SIM: 587 // SMTP Google Apps: 465
	
	$sim_copia_correo_mail = ''; //Dirección de correo secundaria para mandar copia (Puede usarse para pruebas)
	
	/*Fin Editar*/
	
	include_once(URL_SERVIDOR_FRONT."/cmsadmin/configuration.php");
	
?>