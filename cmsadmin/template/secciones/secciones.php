<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	include_once( URL_SERVIDOR."/class/secciones.class.php");
	$secciones = new secciones ();
?>
						
<link href="./css/secciones.css" rel="stylesheet">

<div class="page-header">
	  <h1>Secciones</h1>
</div>
<?
if( $_SESSION["permiso_secciones"] == 1 )
{
	switch( $_GET["e"] )
	{
		case md5(1): //Para editar
			$seccion_editar_id = $generales->desencriptar($_POST["seid"],"seccion");

			if( intval($seccion_editar_id) > 1 )
			{
				if( $secciones->secciones_edita_seccion( $_POST ) )
					echo correcto('<strong>Secci&oacute;n editada correctamente</strong>. Para comenzar a a&ntilde;adir informaci&oacute;n <a href="index.php?q=contenidos_edita&s='.$generales->encriptar( $seccion_editar_id, "contenidos" ).'" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-pencil"></i> Haz clic aqu&iacute;</a>');
				else
					echo alerta('Ocurrio un error al editar la secci&oacute;n');
			}
			else
			{
				echo alerta('Ocurrio un error al editar la secci&oacute;n');
			}
		break;
		case md5(2): //Para eliminar
			$seccion_eliminar_id = $generales->desencriptar($_GET["i"],"seccion");
			if(intval($seccion_eliminar_id) > 1)
			{
				if( $secciones->secciones_elimina_seccion( $_GET["i"] ) )
					echo correcto('Secci&oacute;n eliminada correctamente');
				else
					echo alerta('Ocurrio un error al eliminar la secci&oacute;n');
			}
		break;
		case md5(3): //Para restaurar
			$seccion_restaurar_id = $generales->desencriptar($_GET["i"],"restaurar");

			if(intval($seccion_restaurar_id) > 1)
			{
				if( $secciones_url_recuperada = $secciones->secciones_restaura_seccion( $_GET["i"] ) )
					echo correcto('Secci&oacute;n restaurada  correctamente Para ver el contenido <a href="../index.php?q='.$secciones_url_recuperada.'" target="_blank" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-link"></i> haz clic aqu&iacute;</a>' );
				else
					echo alerta('Ocurrio un error al restaurar la secci&oacute;n. <a href="index.php?q=secciones_restaurar">Intenta nuevamente</a>');
			}
		break;
		default: //Para Agregar
			if( !empty($_POST) && $_POST["sid"] == md5(1) )
			{
				if( $seccion_id = $secciones->secciones_agrega_seccion( $_POST ) )
				{
					echo correcto('<strong>Secci&oacute;n agregada correctamente</strong>. Para iniciar la edici&oacute;n de tu contenido <a href="index.php?q=contenidos_edita&s='.$generales->encriptar( $seccion_id, "contenidos" ).'" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-pencil"></i> Haz clic aqu&iacute;</a>');
					
				}
				else
				{
					echo alerta('Ocurrio un error al agregar la secci&oacute;n');
				}
			}
		break;
	}
}


?>
<div class="container">

	<div class="row">
	<div class="col-md-7">
		<h2>Men&uacute;</h2>
		<?
			if( $_SESSION["permiso_secciones"] == 1)
				echo '<p>Haz clic en una secci&oacute;n para editar:</p>';
			else 
				echo '<p>Las siguientes secciones componen tu sitio web:</p>';
		?>
		
		<div class="sidebar-nav">
		 <?
			$arr_secciones = $secciones->secciones_lista_secciones();
			
			if( is_array($arr_secciones) && count($arr_secciones) > 0)
			{
				if ($menu_lista = $secciones->secciones_arregla_menu_lista( $arr_secciones ))
				{
					if( $_SESSION["permiso_secciones"] == 1 )
					{
						echo '<p><a href="index.php?q=secciones" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i> Agrega una nueva secci&oacute;n</a></p>';
					}
					echo $menu_lista;
				}
				else
					echo '<p  align="center" class="text-error">Favor de crear la primer secci&oacute;n en el formulario de la derecha</p>';
			}
			else
			{
				echo '<p align="center" class="text-error">Favor de crear la primer secci&oacute;n en el formulario de la derecha</p>';
			}
		?>
		</div>
		<br/>
		<br/>
		<br/>
		<br/>
		<p><a href="index.php?q=secciones_restaurar" class="btn btn-info btn-xs"> <i class="glyphicon glyphicon-share-alt"></i> Recupera una secci&oacute;n eliminada</a></p>
	</div><!--/span-->

	<div class="col-md-5 border">
		<?
			if( $_SESSION["permiso_secciones"] == 1 )
			{
					$seccion_editar = $generales->desencriptar($_GET["d"],"seccion");

					if(!empty($_GET["d"]) && intval($seccion_editar) > 1 )
						include_once(URL_SERVIDOR."/template/secciones/secciones_edita.php");
					else
						include_once(URL_SERVIDOR."/template/secciones/secciones_nueva.php");
					
			}
		?>
	
	</div><!--/span-->
	</div><!--/row-->
</div>
</p>&nbsp;</p>