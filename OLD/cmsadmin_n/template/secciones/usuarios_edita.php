<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	include_once( URL_SERVIDOR."/class/configuracion.class.php");
	$configuracion = new configuracion ();
	
	$usuario_id = intval ($generales->desencriptar($_GET["i"],"usuario") );

	if( intval($usuario_id) == 0 )
	{
		echo alerta('Ocurrio un error al obtener la informaci&oacute;n del usuario. Regresa a la <a href="index.php?q=configuracion">p&aacute;gina anterior</a> he intenta nuevamente');
		exit;
	}
	
	$resultado_datos_generales = "";
	if(!empty($_POST) && strtolower($_GET["g"]) == "d" && intval($_SESSION["permiso_configuracion"]) == 1 )
	{
		if( $configuracion->configuracion_guarda_usuario_datos_generales( $_POST, $usuario_id ) )
			$resultado_datos_generales = correcto("Datos Actualizados");
		else
			$resultado_datos_generales = alerta("Ocurrio un error al actualizar los datos del usuario");
	}
	
	$resultado_password = "";
	if(!empty($_POST) && strtolower($_GET["g"]) == "c" && intval($_SESSION["permiso_configuracion"]) == 1 )
	{
		if( $configuracion->configuracion_valida_password_actual ( $_POST["password_actual"], $usuario_id ) ) 
		{
			if( $configuracion->configuracion_actualiza_usuario_password( $_POST, $usuario_id ) )
				$resultado_password = correcto("Datos Actualizados");
			else
				$resultado_password = alerta("Ocurrio un error al actualizar los datos del usuario");
		}
		else
		{
			$resultado_password = alerta("La contrase&ntilde;a actual no coincide, favor de intentar nuevamente");
		}
	}
	
	$resultado_permisos = "";
	if(!empty($_POST) && strtolower($_GET["g"]) == "p" && intval($_SESSION["permiso_configuracion"]) == 1 )
	{
		if( $configuracion->configuracion_guarda_permisos_usuarios( $_POST ) )
			$resultado_permisos = correcto("Permisos actualizados correctamente");
		else
			$resultado_permisos = alerta("Ocurrio un error al actualizar los permisos");
	}
	
	$arr_usuario = $configuracion->configuracion_obten_informacion_usuario_id ( $usuario_id );
?>

<link href="./css/configuracion.css" rel="stylesheet">

<div class="page-header">
	  <h1>Editar usuario</h1>
</div>

<div class="container">
	<h2><?=$arr_usuario[0]["usuarios_nombre"]?> (<?= strtolower($arr_usuario[0]["usuarios_usuario"])?>) </h2>
	<div class="row">
		<div class="col-md-7">
			<h3>Datos generales</h3>
			<?=$resultado_datos_generales?>
			<form action="index.php?q=usuarios_edita&i=<?=$_GET["i"]?>&g=d" method="POST" name="frm_datosgral" id="frm_datosgral">
				<div class="form-group">
					<label>Nombre:</label>
					 <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?=$arr_usuario[0]["usuarios_nombre"]?>" class="form-control" placeholder="Escribe el nombre del usuario"/>
				</div>
				<div class="form-group">
					<label>Correo electr&oacute;nico:</label>
					<input type="text" name="correo_empresa" id="correo_empresa" value="<?=$arr_usuario[0]["usuarios_email"]?>" class="form-control" placeholder="Escribe el correo electr&oacute;nico"/>
				</div>
				<br/>
				<p align="left"> <button class="btn btn-warning" type="submit">Actualizar datos</button></p>
				<br/>
				<br/>
			</form>
			
			<h3>Cambiar contrase&ntilde;a</h3>
			<?=$resultado_password?>
			<form action="index.php?q=usuarios_edita&i=<?=$_GET["i"]?>&g=c" method="POST" name="frm_cpass" id="frm_cpass">
				<div class="form-group">
					<label>Contrase&ntilde;a actual:</label>
					<input type="password" name="password_actual" id="password_actual" value="" class="form-control" placeholder="Escribe la contrase&ntilde;a actual"/>
				</div>
				<div class="form-group">
					<label>Nueva Contrase&ntilde;a:</label>
					<input type="password" name="password_nuevo" id="password_nuevo" value="" class="form-control" placeholder="Escribe la nueva contrase&ntilde;a"/>
				</div>
				<div class="form-group">
					<label>Confirma Contrase&ntilde;a:</label>
					<input type="password" name="password_nuevo_confirma" id="password_nuevo_confirma" value="" class="form-control" placeholder="Escribe la contrase&ntilde;a anterior"/>
				</div>
				<br/>
				<p align="left"> <button class="btn btn-warning" type="submit">Cambiar contrase&ntilde;a</button></p>
				
				<p><small>Si has olvidado tu contrase&ntilde;a haz <a href="logout.php">clic aqu&iacute;</a> para cambiarla <i>(Saldr&aacute;s del CMSAdmin para poder cambiarla)</i></small></p>
			</form>
		</div>
		<div class="col-md-5">
			<h3>Permisos por secci&oacute;n</h3>
			<?=$resultado_permisos?>
			<?
			if( intval($arr_usuario[0]["usuarios_es_admin"]) == 1 )
				include_once( URL_SERVIDOR."/template/secciones/usuarios_edita_vista.php");
			else
				include_once( URL_SERVIDOR."/template/secciones/usuarios_edita_form.php"); 
			?>
		</div>
	</div>
</div>