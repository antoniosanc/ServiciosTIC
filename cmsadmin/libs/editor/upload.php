<?
include_once("../../../configuration.php");

if ($_FILES['image']['name']) 
{
	if (!$_FILES['image']['error']) 
	{
		include_once(URL_SERVIDOR."/class/generales.class.php");
		$generales = new generales();
		
		$cadena = $generales->genera_cadena_aleatoria(3);
		
		$ext = explode('.', $_FILES['image']['name']);
		$filename = $ext[0] . $cadena . '.' . $ext[1];
		$destination = $_SERVER["DOCUMENT_ROOT"].URL_USERFILES.'image/' . $filename; //change this directory
		
		move_uploaded_file( $_FILES["image"]["tmp_name"], $destination);
		echo str_replace($_SERVER["DOCUMENT_ROOT"],"",$destination);
	}
	else
	{
	  return false;
	}
}
?>