<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	include_once( URL_SERVIDOR."/class/configuracion.class.php");
	$configuracion = new configuracion ();
	
	
	if(!empty($_POST) && strtolower($_GET["g"]) == "g" && intval($_SESSION["permiso_configuracion"]) == 1 )
	{
		if( $configuracion->configuracion_guarda_nuevo_usuario( $_POST ) )
			$resultado_datos_generales = correcto("Usuario Agregado con &eacute;xito");
		else
			$resultado_datos_generales = alerta("Ocurrio un error al agregar el usuario. Es muy posible que el usuario ya exista");
	}

?>

<link href="./css/configuracion.css" rel="stylesheet">

<div class="page-header">
	  <h1>Agrega usuario</h1>
</div>
<?=$resultado_datos_generales?>
<div class="container-fluid">
	<div class="row-fluid">
	<form action="index.php?q=usuarios_agrega&g=g" method="POST" name="frm_agregadatos" id="frm_agregadatos">
		<div class="span7">
			<h3>Datos generales</h3>
			
				<label><span class="span3">Nombre:</span> <input type="text" name="nombre_usuario" id="nombre_usuario" value="" class="input-large" placeholder="Escribe el nombre del usuario"/></label>
				<label><span class="span3">Usuario:</span> <input type="text" name="usuario_usuario" id="usuario_usuario" value="" class="input-large" placeholder="Escribe el usuario para iniciar sesi&oacute;n"/></label>
				<label><span class="span3">Correo electr&oacute;nico: </span><input type="text" name="correo_empresa" id="correo_empresa" value="" class="input-large" placeholder="Escribe el correo electr&oacute;nico"/></label>

				<label><span class="span3">Nueva Contrase&ntilde;a: </span><input type="password" name="password_nuevo" id="password_nuevo" value="" class="input-large" placeholder="Escribe la nueva contrase&ntilde;a"/></label>
				<label><span class="span3">Confirma Contrase&ntilde;a: </span><input type="password" name="password_nuevo_confirma" id="password_nuevo_confirma" value="" class="input-large" placeholder="Escribe la contrase&ntilde;a anterior"/></label>
				<br/>
		</div>
		<div class="span5">
			<h3>Permisos por secci&oacute;n</h3>
			<table class="table table-hover ">
			<tr>
				<th>Secciones</th>
				<td>
					<select id="input_secciones" name="input_secciones">
						<option value="" > -- Selecciona una opci&oacute;n </option>
						<option value="3" > No permitido </option>
						<option value="2" > Solo lectura </option>
						<option value="1" > Lectura y escritura (Acceso Total) </option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Contenidos</th>
				<td>
					<select id="input_contenidos" name="input_contenidos">
						<option value="" > -- Selecciona una opci&oacute;n </option>
						<option value="3" > No permitido </option>
						<option value="2" > Solo lectura </option>
						<option value="1" > Lectura y escritura (Acceso Total) </option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Estad&iacute;sticas</th>
				<td>
					<select id="input_estadisticas" name="input_estadisticas">
						<option value="" > -- Selecciona una opci&oacute;n </option>
						<option value="3" > No permitido </option>
						<option value="2" > Solo lectura </option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Centro de negocios</th>
				<td>
					<select id="input_centro_negocios" name="input_centro_negocios">
						<option value="" > -- Selecciona una opci&oacute;n </option>
						<option value="3" > No permitido </option>
						<option value="2" > Solo lectura </option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Configuraci&oacute;n</th>
				<td>
					<select id="input_configuracion" name="input_configuracion">
						<option value="" > -- Selecciona una opci&oacute;n </option>
						<option value="3" > No permitido </option>
						<option value="1" > Lectura y escritura (Acceso Total) </option>
					</select>
				</td>
			</tr>
			</table>
		</div>
	<p align="left"> <button class="btn btn-primary" type="submit">Guardar</button></p>
	</form>
	</div>

</div>
