<?
	if( intval($_SESSION["permiso_configuracion"]) != 1)
		return false;
	
	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	include_once( URL_SERVIDOR."/class/configuracion.class.php");
	$configuracion = new configuracion ();

	include_once(URL_SERVIDOR."/libs/FCKeditor/fckeditor.php") ;
	$oFCKeditor = new FCKeditor('txt_email_empresa');
	$oFCKeditor->Width = '100%' ;
	$oFCKeditor->Height = '450';
	$oFCKeditor->BasePath = 'libs/FCKeditor/';
	$oFCKeditor->ToolbarSet = 'Basic';
?>

<link href="./css/configuracion.css" rel="stylesheet">


<div class="page-header">
	  <h1>Configuraci&oacute;n</h1>
</div>

<div class="container">
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
		<div class="row">
			<form action="index.php?q=configuracion&g=g" method="POST" id="frm_infogral" id="frm_infogral">
				<div class="form-group">
					<label>Nombre de la empresa:</label>
					<input type="text" name="nombre_empresa" id="nombre_empresa" value="<?=$configuracion_nombre_empresa?>" class="form-control" placeholder="Escribe el nombre de tu empresa"/>
				</div>
				<div class="form-group">
					<label>Correo electr&oacute;nico:</label>
					<input type="text" name="correo_empresa" id="correo_empresa" value="<?=$configuracion_email_empresa?>" class="form-control" placeholder="Escribe el nombre de tu empresa"/>
				</div>
				<div class="form-group">
					<label>Dominio principal: </label>
					<input type="text" name="pagina_empresa" id="pagina_empresa" value="<?=$configuracion_url_empresa?>" class="form-control" placeholder="Escribe el nombre de tu empresa"/>
				</div>
				<div class="form-group">
					<label>Texto de respuesta autom&aacute;tico</label>
					<?
						$oFCKeditor->Value = $configuracion_correo_respuesta;
						$oFCKeditor->Create();
					?>
				</div>

				<br/>
				<p align="right"> <button class="btn btn-warning" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button></p>
			</form>
		</div>
		<p>&nbsp;</p>
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
	
		<a href="index.php?q=usuarios_agrega" class='btn btn-warning'> <span class="glyphicon glyphicon-user"></span> Agregar usuario</a>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<h2>Miscel&aacute;neos</h2>
		<div class="row">
		
			<?
				if(!empty($_POST) && strtolower($_GET["g"]) == "m" && intval($_SESSION["permiso_configuracion"]) == 1)
				{
					if( $configuracion->configuracion_guarda_configuracion_miscelaneo( $_POST ) )
						echo correcto("Datos Actualizados");
					else
						echo alerta("Ocurrio un error al guardar la secci&oacute;n de datos generales");
				}
				
				$arr_configuracion = $configuracion->configuracion_obten_configuracion_miscelaneo();

			
				$configuracion_translate = "";
				if ( intval($arr_configuracion[0]["configuracion_translate"]) == 1)
					$configuracion_translate = 'checked = "checked" ';
				
				$configuracion_codigo_chat = "";
				if ( !empty($arr_configuracion[0]["configuracion_codigo_chat"]) )
					$configuracion_codigo_chat = $arr_configuracion[0]["configuracion_codigo_chat"];
				
				$configuracion_codigo_messenger = "";
				if ( !empty($arr_configuracion[0]["configuracion_codigo_messenger"]) )
					$configuracion_codigo_messenger = $arr_configuracion[0]["configuracion_codigo_messenger"];
				
				$configuracion_codigo_analytics = "";
				if ( !empty($arr_configuracion[0]["configuracion_codigo_analytics"]) )
					$configuracion_codigo_analytics = $arr_configuracion[0]["configuracion_codigo_analytics"];
				
				$configuracion_codigo_recaptcha_publico = "";
				if ( !empty($arr_configuracion[0]["configuracion_recaptcha_publico"]) )
					$configuracion_codigo_recaptcha_publico = $arr_configuracion[0]["configuracion_recaptcha_publico"];
				
				$configuracion_codigo_recaptcha_privado = "";
				if ( !empty($arr_configuracion[0]["configuracion_recaptcha_privado"]) )
					$configuracion_codigo_recaptcha_privado = $arr_configuracion[0]["configuracion_recaptcha_privado"];
				
				$configuracion_estilo_personalizado = "";
				if ( !empty($arr_configuracion[0]["configuracion_estilo_personalizado"]) )
					$configuracion_estilo_personalizado = $arr_configuracion[0]["configuracion_estilo_personalizado"];

				if ( !empty($arr_configuracion[0]["configuracion_keyword_seo"]) )
					$configuracion_keywords_seo_base = $arr_configuracion[0]["configuracion_keyword_seo"];

				$configuracion_keywords_base = $configuracion_nombre_empresa;
				if ( !empty($arr_configuracion[0]["configuracion_keywords_base"]) )
					$configuracion_keywords_base = $arr_configuracion[0]["configuracion_keywords_base"];

				$configuracion_descripcion_base = "Bienvenido al sitio web de ".$configuracion_nombre_empresa;
				if ( !empty($arr_configuracion[0]["configuracion_descripcion_base"]) )
					$configuracion_descripcion_base = $arr_configuracion[0]["configuracion_descripcion_base"];

			?>
		
			<form action="index.php?q=configuracion&g=m" method="POST" id="frm_misc" id="frm_misc">
				<div class="form-group">
					<label>T&eacute;rmino de b&uacute;squeda SEO:</label>
					<input type="text" name="keyword_seo_base" id="keyword_seo_base" value="<?=$configuracion_keywords_seo_base?>" class="form-control" placeholder="Escribe la palabras clave que se utilizar&aacute; para SEO"/>
				</div>
				<div class="form-group">
					<label>Palabras clave para buscadores:</label>
					<input type="text" name="keywords_base" id="keywords_base" value="<?=$configuracion_keywords_base?>" class="form-control" placeholder="Escribe las palabras clave de tu sitio para mejorar el posicionamiento en buscadores"/>
				</div>
				<div class="form-group">
					<label>Descripci&oacute;n del sitio:</label>
					<input type="text" name="descripcion_base" id="descripcion_base" value="<?=$configuracion_descripcion_base?>" class="form-control" placeholder="La descripci&oacute;n de tu sitio web"/>
				</div>
				<div class="form-group">
					<label>C&oacute;digo de seguimiento (Google Analytics):</label>
					<input type="text" name="analytics" id="analytics" value="<?=$configuracion_codigo_analytics?>" class="form-control" placeholder="Pega el ID de Google Analytics, ejemplo: UA-0123456-78"/>
				</div>
				<div class="form-group">
					<label>Validaci&oacute;n de seguridad (Google reCaptcha):</label>
					<input type="text" name="recaptcha_publico" id="recaptcha_publico" value="<?=$configuracion_codigo_recaptcha_publico?>" class="form-control" placeholder="Pega el ID de c&oacute;digo publico para recaptcha"/><br/>
					<input type="text" name="recaptcha_privado" id="recaptcha_privado" value="<?=$configuracion_codigo_recaptcha_privado?>" class="form-control" placeholder="Pega el ID de c&oacute;digo privado para recaptcha"/>
				</div>
				<div class="form-group">
					<label>C&oacute;digo de Chat (Zopim / Zendesk):</label>
					<input type="text" name="chat" id="chat" value="<?=$configuracion_codigo_chat?>" class="form-control" placeholder="Pega el ID de Zendesk Chat, ejemplo: 31ab1ace5suLdgW2Mnq82DzJrr50FS9m"/>
				</div>
				<div class="form-group">
					<label>C&oacute;digo de Messenger (Facebook):</label>
					<input type="text" name="chat_facebook" id="chat_facebook" value="<?=$configuracion_codigo_messenger?>" class="form-control" placeholder="page_id= (Solo en sitios https://)"/>
				</div>
				 <div class="checkbox">
					<label>
						<input type="checkbox" id="translate" name="translate" <?=$configuracion_translate?>> Habilitar multi-idioma (Con Google Translate)
					</label>
				</div>

				<p align="right"> <button class="btn btn-warning" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button></p>
			</form>
			
		</div>
		
		<? 
			$arr_usuario_permiso = $configuracion->configuracion_obten_informacion_usuario_id( $_SESSION["uid"] );
		
			if( intval( $arr_usuario_permiso[0]["usuarios_es_admin"]) == 1 )
			{
				echo '<h2>Haz un Respaldo ahora</h2>
					<div class="row">
						<div class="col-md-12">
							<form action="backup.php?q=bk&g='.md5(5).'" method="POST" id="frm_bkup" id="frm_bkup" target="_blank">
								<div class="form-group">
									<label>Usuario DB:</label>
									<input type="password" name="usuariodb" id="usuariodb" value="'.USER_DB_CMS.'" class="form-control" placeholder="Escribe el nombre del usuario de la base de datos"/>
								</div>
								<div class="form-group">
									<label>Password DB:</label>
									<input type="password" name="passworddb" id="passworddb" value="'.PASSWORD_DB_CMS.'" class="form-control" placeholder="Escribe la contrase&ntilde;a de la base de datos"/>
								</div>
								<div class="form-group">
									<label>DB:</label>
									<input type="password" name="basedatos" id="basedatos" value="'.BASE_DB_CMS.'" class="form-control" placeholder="Escribe el nombre de la base de datos"/>
								</div>
								<div class="form-group">
									<label>Host:</label>
									<input type="password" name="hostdb" id="hostdb" value="'.HOST_DB_CMS.'" class="form-control" placeholder="Escribe el nombre del Host de la base de datos"/>
								</div>
								<div class="form-group">
									<label>Puerto DB:</label>
									<input type="password" name="puertodb" id="puertodb" value="'.PUERTO_DB_CMS.'" class="form-control" placeholder="Escribe el numero del puerto Host de la base de datos"/>
								</div>
								<p align="right"> <button class="btn btn-warning" type="submit"><i class=" glyphicon glyphicon-download-alt"></i> Respaldar</button></p>
							</form>
							
							<p>Modificar: <a href="index.php?q=file&f=hd&i='.md5(5).'">header.php</a> / <a href="index.php?q=file&f=ft&i='.md5(5).'">footer.php</a>  / <a href="index.php?q=file&f=ucss&i='.md5(5).'">usr.css</a> / <a href="index.php?q=file&f=ujs&i='.md5(5).'">usr.js</a> / <a href="index.php?q=file&f=rtxt&i='.md5(5).'">robots.txt</a> / <a href="index.php?q=file&f=sxml&i='.md5(5).'">sitemap.xml</a></p>';
							
							echo $configuracion->configuracion_obten_respaldo_archivos();
								
					echo '</div>
					</div>';
					
			}
		?>
		
	</div>
</div>