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
<div class="container">
	<div class="row">
	<form action="index.php?q=usuarios_agrega&g=g" method="POST" name="frm_agregadatos" id="frm_agregadatos">
		<div class="col-md-7">
			<h3>Datos generales</h3>
			<div class="form-group">
				<label>Nombre:</label>
				<input type="text" name="nombre_usuario" id="nombre_usuario" value="" class="form-control" placeholder="Escribe el nombre del usuario"/>
			</div>
			<div class="form-group">
				<label>Usuario:</label>
				<input type="text" name="usuario_usuario" id="usuario_usuario" value="" class="form-control" placeholder="Escribe el usuario para iniciar sesi&oacute;n"/>
			</div>
			<div class="form-group">
				<label>Correo electr&oacute;nico:</label>
				<input type="text" name="correo_empresa" id="correo_empresa" value="" class="form-control" placeholder="Escribe el correo electr&oacute;nico"/>
			</div>
			<div class="form-group">
				<label>Nueva Contrase&ntilde;a:</label>
				<input type="password" name="password_nuevo" id="password_nuevo" value="" class="form-control" placeholder="Escribe la nueva contrase&ntilde;a"/>
			</div>
			<div class="form-group">
				<label>Confirma Contrase&ntilde;a:</label>
				<input type="password" name="password_nuevo_confirma" id="password_nuevo_confirma" value="" class="form-control" placeholder="Escribe la contrase&ntilde;a anterior"/>
			</div>
		</div>
		<div class="col-md-5">
			<h3>Permisos por secci&oacute;n</h3>
			<table class="table table-hover ">
			<tr>
				<th>Secciones</th>
				<td>
					<select class="form-control" id="input_secciones" name="input_secciones">
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
					<select class="form-control"  id="input_contenidos" name="input_contenidos">
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
					<select class="form-control"  id="input_estadisticas" name="input_estadisticas">
						<option value="" > -- Selecciona una opci&oacute;n </option>
						<option value="3" > No permitido </option>
						<option value="2" > Solo lectura </option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Centro de negocios</th>
				<td>
					<select class="form-control"  id="input_centro_negocios" name="input_centro_negocios">
						<option value="" > -- Selecciona una opci&oacute;n </option>
						<option value="3" > No permitido </option>
						<option value="2" > Solo lectura </option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Configuraci&oacute;n</th>
				<td>
					<select class="form-control"  id="input_configuracion" name="input_configuracion">
						<option value="" > -- Selecciona una opci&oacute;n </option>
						<option value="3" > No permitido </option>
						<option value="1" > Lectura y escritura (Acceso Total) </option>
					</select>
				</td>
			</tr>
			<tr>
			<th>Brokers (Login brokers)</th>
			<td>
				<select class="form-control"  id="input_login_brokers" name="input_login_brokers">
				
					<option value="" > -- Selecciona una opci&oacute;n </option>
					<option value="3" > No permitido </option>
					<option value="1" > Inicio de sesi&oacute;n y consulta </option>
				</select>
			</td>
			</tr>			
			</table>
		</div>
	<p>&nbsp;</p>
	<p align="right"> <button class="btn btn-warning" type="submit">Agregar usuario</button></p>
	</form>
	</div>

</div>
