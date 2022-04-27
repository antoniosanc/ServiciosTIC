<?php
session_start();
include_once("../../../configuration.php");

$output_dir =  $_SERVER["DOCUMENT_ROOT"].URL_USERFILES;
if(isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name']))
{
	$fileName =$_POST['name'];
	$filePath = $output_dir. $fileName;
	if (file_exists($filePath)) 
	{
		include_once(URL_SERVIDOR."/class/contenidos.class.php");
		$contenidos = new contenidos();
		
		$arr_datos = array();
		$arr_datos["seccion"] = $_SESSION["sid"] ;
		
		if( $contenidos->contenidos_elimina_imagen_destacada ( $arr_datos ) )
		{
			unlink($filePath);
		}
    }
	echo "Se ha eliminado: ".$fileName."<br>";
}

?>