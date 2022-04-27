<? $arr_permisos_usuarios = $configuracion->configuracion_obten_permisos_usuario($usuario_id) ?>
<form action="index.php?q=usuarios_edita&i=<?=$_GET["i"]?>&g=p" method="POST" id="frm_edita_permisos" name="frm_edita_permisos">
	<input type="hidden" name="uid" id="uid" value="<?=$usuario_id?>" />
	<table class="table table-hover ">
		<tr>
			<th>Secciones</th>
			<td>
				<select class="form-control"  id="input_secciones" name="input_secciones">
					<?
						if ($arr_permisos_usuarios[0]["usuarios_permisos_secciones"] > 0 && $arr_permisos_usuarios[0]["usuarios_permisos_secciones"] < 4)
						{
							switch( $arr_permisos_usuarios[0]["usuarios_permisos_secciones"] )
							{
								case "1":
									echo '<option value="1"> Leer y modificar  (Acceso Total) </option>';
								break;
								case "2":
									echo '<option value="2"> Solo lectura </option>';
								break;
								case "3":
									echo '<option value="3"> No permitido </option>';
								break;
							}
						}
					?>
					<option value="" > -- Selecciona una opci&oacute;n </option>
					<option value="3" > No permitido </option>
					<option value="2" > Solo lectura </option>
					<option value="1" > Leer y modificar (Acceso Total) </option>
				</select>
			</td>
		</tr>
		<tr>
			<th>Contenidos</th>
			<td>
				<select class="form-control" id="input_contenidos" name="input_contenidos">
				<?
					if ($arr_permisos_usuarios[0]["usuarios_permisos_contenido"] > 0 && $arr_permisos_usuarios[0]["usuarios_permisos_contenido"] < 4)
					{
						switch( $arr_permisos_usuarios[0]["usuarios_permisos_contenido"] )
						{
							case "1":
								echo '<option value="1"> Leer y modificar (Acceso Total) </option>';
							break;
							case "2":
								echo '<option value="2"> Solo lectura </option>';
							break;
							case "3":
								echo '<option value="3"> No permitido </option>';
							break;
						}
					}
				?>
					<option value="" > -- Selecciona una opci&oacute;n </option>
					<option value="3" > No permitido </option>
					<option value="2" > Solo lectura </option>
					<option value="1" > Leer y modificar (Acceso Total) </option>
				</select>
			</td>
		</tr>
		<tr>
			<th>Estad&iacute;sticas</th>
			<td>
				<select class="form-control"  id="input_estadisticas" name="input_estadisticas">
				<?
					if ($arr_permisos_usuarios[0]["usuarios_permisos_estadisticas"] > 0 && $arr_permisos_usuarios[0]["usuarios_permisos_estadisticas"] < 4)
					{
						switch( $arr_permisos_usuarios[0]["usuarios_permisos_estadisticas"] )
						{
							case "2":
								echo '<option value="2"> Solo lectura </option>';
							break;
							case "3":
								echo '<option value="3"> No permitido </option>';
							break;
						}
					}
				?>
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
				<?
					if ($arr_permisos_usuarios[0]["usuarios_permisos_centro_negocios"] > 0 && $arr_permisos_usuarios[0]["usuarios_permisos_centro_negocios"] < 4)
					{
						switch( $arr_permisos_usuarios[0]["usuarios_permisos_centro_negocios"] )
						{
							case "2":
								echo '<option value="1">  Solo lectura </option>';
							break;
							case "3":
								echo '<option value="3"> No permitido </option>';
							break;
						}
					}
				?>
					<option value="" > -- Selecciona una opci&oacute;n </option>
					<option value="3" > No permitido </option>
					<option value="2" >  Solo lectura </option>
				</select>
			</td>
		</tr>
		<tr>
			<th>Configuraci&oacute;n</th>
			<td>
				<select class="form-control"  id="input_configuracion" name="input_configuracion">
				<?
					if ($arr_permisos_usuarios[0]["usuarios_permisos_configuracion"] > 0 && $arr_permisos_usuarios[0]["usuarios_permisos_configuracion"] < 4)
					{
						switch( $arr_permisos_usuarios[0]["usuarios_permisos_configuracion"] )
						{
							case "1":
								echo '<option value="1"> Leer y modificar (Acceso Total) </option>';
							break;
							case "3":
								echo '<option value="3"> No permitido </option>';
							break;
						}
					}
				?>
					<option value="" > -- Selecciona una opci&oacute;n </option>
					<option value="3" > No permitido </option>
					<option value="1" > Leer y modificar (Acceso Total) </option>
				</select>
			</td>
		</tr>
	</table>
	<p align="right"> <button class="btn btn-warning" type="submit"><i class="glyphicon glyphicon-pencil"></i> Actualizar permisos</button></p>
</form>