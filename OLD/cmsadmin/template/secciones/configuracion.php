<?
	if( intval($_SESSION["permiso_configuracion"]) != 1)
		return false;
	
	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	include_once( URL_SERVIDOR."/class/configuracion.class.php");
	$configuracion = new configuracion ();

	include_once(URL_SERVIDOR."/libs/FCKeditor/fckeditor.php") ;
	$oFCKeditor = new FCKeditor('txt_email_empresa');
	$oFCKeditor->Width = '800' ;
	$oFCKeditor->Height = '250';
	$oFCKeditor->BasePath = 'libs/FCKeditor/';
	$oFCKeditor->ToolbarSet = 'Basic';
?>

<link href="./css/configuracion.css" rel="stylesheet">

<div class="page-header">
	  <h1>Configuraci&oacute;n</h1>
</div>

<div class="container-fluid">
	<?
	if($_GET["eu"] == md5("1") && !empty($_GET["i"]) )
	{
		$usuario_id = $generales->desencriptar( $_GET["i"], "usuario");
		if(intval($usuario_id) == 0 )
			echo alerta('Ocurrio un error al intentar eliminar el usuario seleccionado');
		else
		{
			if ($configuracion->configuracion_elimina_usuario( $usuario_id ) )
				echo correcto('Usuario eliminado con &eacute;xito');
			else
				echo alerta('Ocurrio un error al intentar eliminar el usuario seleccionado (1)');
		}
	}
	?>
	<div>
		<h2>Informaci&oacute;n General</h2>
		<?

			if(!empty($_POST) && strtolower($_GET["g"]) == "g" && intval($_SESSION["permiso_configuracion"]) == 1 )
			{
				if( $configuracion->configuracion_guarda_configuracion( $_POST ) )
					echo correcto("Datos Actualizados");
				else
					echo alerta("Ocurrio un error al guardar la secci&oacute;n de datos generales");
			}
			
			
			$arr_configuracion = $configuracion->configuracion_obten_configuracion();

			$dominio_principal = $generales->obtener_dominio();
			$nombre_empresa = str_replace("http://","", strtolower( $dominio_principal) );
			$correo_principal = "contacto@".str_replace("www.","", strtolower( $nombre_empresa) );
			
			$configuracion_nombre_empresa = $nombre_empresa;
			if ($arr_configuracion[0]["configuracion_nombre_empresa"])
				$configuracion_nombre_empresa = $arr_configuracion[0]["configuracion_nombre_empresa"];
			
			$configuracion_email_empresa = $correo_principal;
			if ($arr_configuracion[0]["configuracion_email_empresa"])
				$configuracion_email_empresa = $arr_configuracion[0]["configuracion_email_empresa"];
			
			$configuracion_url_empresa = $dominio_principal;
			if ($arr_configuracion[0]["configuracion_url_empresa"])
				$configuracion_url_empresa = $arr_configuracion[0]["configuracion_url_empresa"];
			
			$configuracion_correo_respuesta = "Su correo fue enviado con &eacute;xito. <br/> En breve le responderemos. \n\n ";
			if ($arr_configuracion[0]["configuracion_correo_respuesta"])
				$configuracion_correo_respuesta = $arr_configuracion[0]["configuracion_correo_respuesta"];
			
			
		?>
		<div class="row-fluid">
			<form action="index.php?q=configuracion&g=g" method="POST" id="frm_infogral" id="frm_infogral">
				<label><span class="span3">Nombre de la empresa:</span> <input type="text" name="nombre_empresa" id="nombre_empresa" value="<?=$configuracion_nombre_empresa?>" class="input-xxlarge" placeholder="Escribe el nombre de tu empresa"/></label>
				<label><span class="span3">Correo electr&oacute;nico: </span><input type="text" name="correo_empresa" id="correo_empresa" value="<?=$configuracion_email_empresa?>" class="input-xxlarge" placeholder="Escribe el nombre de tu empresa"/></label>
				<label><span class="span3">Dominio principal: </span><input type="text" name="pagina_empresa" id="pagina_empresa" value="<?=$configuracion_url_empresa?>" class="input-xxlarge" placeholder="Escribe el nombre de tu empresa"/></label>
				<label><span class="span3">Texto de respuesta autom&aacute;tico</span> </label>
				<br/>
				<?
					$oFCKeditor->Value = $configuracion_correo_respuesta;
					$oFCKeditor->Create();
				?>
				<br/>
				<p align="left"> <button class="btn btn-primary" type="submit">Guardar</button></p>
			</form>
		</div>
		<p>&nbsp;</p>
		<h2>Permisos y usuarios</h2>
		
		<table class="table table-hover ">
		<tr>
			<th>Usuario</th>
			<th>Acciones</th>
		</tr>
		<?
			echo $configuracion->configuracion_obten_usuarios_permiso();
		?>
		</table>
	
		<a href="index.php?q=usuarios_agrega" class='btn btn-primary'>Agregar usuario</a>
		<p>&nbsp;</p>
		<h2>Miscel&aacute;neos</h2>
		<div class="row-fluid">
		
		<?
			if(!empty($_POST) && strtolower($_GET["g"]) == "m" && intval($_SESSION["permiso_configuracion"]) == 1)
			{
				if( $configuracion->configuracion_guarda_configuracion_miscelaneo( $_POST ) )
					echo correcto("Datos Actualizados");
				else
					echo alerta("Ocurrio un error al guardar la secci&oacute;n de datos generales");
			}
			
			$arr_configuracion = $configuracion->configuracion_obten_configuracion_miscelaneo();

		
			$configuracion_codigo_analytics = "";
			if ($arr_configuracion[0]["configuracion_codigo_analytics"])
				$configuracion_codigo_analytics = $arr_configuracion[0]["configuracion_codigo_analytics"];
			
			$configuracion_estilo_personalizado = "";
			if ($arr_configuracion[0]["configuracion_estilo_personalizado"])
				$configuracion_estilo_personalizado = $arr_configuracion[0]["configuracion_estilo_personalizado"];

			$configuracion_keywords_base = $configuracion_nombre_empresa;
			if ($arr_configuracion[0]["configuracion_keywords_base"])
				$configuracion_keywords_base = $arr_configuracion[0]["configuracion_keywords_base"];

			$configuracion_descripcion_base = "Bienvenido al sitio web de ".$configuracion_nombre_empresa;
			if ($arr_configuracion[0]["configuracion_descripcion_base"])
				$configuracion_descripcion_base = $arr_configuracion[0]["configuracion_descripcion_base"];

		?>
		
			<form action="index.php?q=configuracion&g=m" method="POST" id="frm_misc" id="frm_misc">
				<label><span class="span3">Palabras clave para buscadores:</span> 
					<input type="text" name="keyworkds_base" id="keyworkds_base" value="<?=$configuracion_keywords_base?>" class="input-xxlarge" placeholder="Escribe las palabras clave de tu sitio para mejorar el posicionamiento en buscadores"/>
				</label>
				<label><span class="span3">Descripci&oacute;n del sitio:</span> 
					<input type="text" name="descripcion_base" id="descripcion_base" value="<?=$configuracion_descripcion_base?>" class="input-xxlarge" placeholder="La descripci&oacute;n de tu sitio web"/>
				</label>
				<label><span class="span3">C&oacute;digo de seguimiento (Analytics):</span> 
					<input type="text" name="analytics" id="analytics" value="<?=$configuracion_codigo_analytics?>" class="input-xxlarge" placeholder="Pega el ID de Google Analytics, ejemplo: UA-0123456-78"/>
				</label>
				<label><span class="span3">Hojas de estilo personalizadas</span> 
					<textarea placeholder="Pega tus hojas de estilo (CSS) Personalizadas" id="css_custom" name="css_custom" class="span7" rows="4"><?=$configuracion_estilo_personalizado?></textarea>
				</label>
				<p align="left"> <button class="btn btn-primary" type="submit">Guardar</button></p>
			</form>
		</div>
	</div>
</div>