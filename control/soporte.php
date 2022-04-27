<?php
require_once "conexion.php";
 

    if(isset($_POST['solicita_soporte_nombre'])){
        $solicita_soporte_nombre=$_POST['solicita_soporte_nombre'];
        $solicita_soporte_email=$_POST['solicita_soporte_email'];
        $solicita_soporte_telefono=$_POST['solicita_soporte_telefono'];
        $contacto_direccion='N/A';
        $contacto_asunto='Solicitud de Soporte Técnico';
        $solicita_soporte_comentario=$_POST['solicita_soporte_comentario'];
        $hoy = date("Y-m-d H:i:s");

       $query = "INSERT INTO `contacto`(`contacto_nombre`, `contacto_correo_electronico`, `contacto_telefono`, `contacto_direccion`, `contacto_asunto`, `contacto_comentarios`, `contacto_fecha_contacto`, `contacto_status`) VALUES ('$solicita_soporte_nombre', '$solicita_soporte_email', '$solicita_soporte_telefono', '$contacto_direccion',' $contacto_asunto','$solicita_soporte_comentario','$hoy','1')";
        $query_run = mysqli_query($conexion, $query); 


        if($query_run){
            
            header("Location:".$_SERVER["HTTP_REFERER"]);
        }
        else
        {
            echo "fallo";
           header("Location:../index.php");
        }

    }


        
?>