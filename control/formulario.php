<?php
//require_once "conexion.php";
 

    if(isset($_POST['contacto_nombre'])){
        $contacto_nombre=$_POST['contacto_nombre'];//nombre
        $contacto_email=$_POST['contacto_email'];// email
        $contacto_telefono=$_POST['contacto_telefono'];//telefono
        $contacto_direccion=$_POST['contacto_direccion'];//direccion 
        $contacto_asunto=$_POST['contacto_asunto'];//asunto
        $contacto_comentario=$_POST['contacto_comentario'];//comentario
        $hoy = date("Y-m-d H:i:s");

        $destinatario = 'asanchez@serviciostics.com.mx';
        $header = 'Solicitud enviado desde la pagina de SERVICIOS EN TICS';
        $mensajeCompleto = 'ASUNTO '.$contacto_asunto;

        mail($destinatario,$mensajeCompleto,$header);
        echo "<script>alert('correo enviado exitosamente')</script>";
        echo "<scrip>setTimeout(\"location.href = \",1000)</scrip>";

       /*$query = "INSERT INTO `contacto`(`contacto_nombre`, `contacto_correo_electronico`, `contacto_telefono`, `contacto_direccion`, `contacto_asunto`, `contacto_comentarios`, `contacto_fecha_contacto`, `contacto_status`) VALUES ('$contacto_nombre', '$contacto_email', '$contacto_telefono', '$contacto_direccion',' $contacto_asunto','$contacto_comentario','$hoy','1')";
        $query_run = mysqli_query($conexion, $query); 


        if($query_run){
            
            header("Location:".$_SERVER["HTTP_REFERER"]);
        }
        else
        {
            echo "fallo";
           header("Location:".$_SERVER["HTTP_REFERER"]);
        }*/

    }


        
?>