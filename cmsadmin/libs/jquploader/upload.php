<?php
session_start();
include_once("../../../configuration.php");

$output_dir = $_SERVER["DOCUMENT_ROOT"].URL_USERFILES."/image/";
if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
 	 	$fileName = $_FILES["myfile"]["name"];
		
		if( file_exists($output_dir.$fileName) )
		{
			$arr_file_name = explode(".",$fileName);
			
			include_once(URL_SERVIDOR."/class/generales.class.php");
			$generales = new generales();
			$cadena = $generales->genera_cadena_aleatoria(3);
			$fileName = $generales->limpia_cadena($arr_file_name[0])."-".$cadena.".".$arr_file_name[1];
		}
 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
    	$ret[]= $fileName;
		
		include_once(URL_SERVIDOR."/class/contenidos.class.php");
		$contenidos = new contenidos();
		
		$arr_datos = array();
		$arr_datos["archivo"] = $fileName;
		$arr_datos["seccion"] = $_SESSION["sid"] ;
		
		if( $contenidos->contenidos_guarda_imagen_destacada ( $arr_datos ) )
		{
			  echo json_encode($ret);
		}
		
		
	}
 }
 ?>