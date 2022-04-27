<link href="./libs/editable_select/editable_select.css" rel="stylesheet">

<h2>A&ntilde;adir nueva secci&oacute;n</h2>
<div class="hero-unit">

	<p> Agrega una nueva secci&oacute;n a tu sitio web:</p>

	<form action="index.php?q=secciones" method="post" id="frmsecciones" >
		<div class="input-prepend">
			<select id="categoriasuperior" name="categoriasuperior" class="form-control" placeholder="-- Elige la ubicaci&oacute;n de tu secci&oacute;n --">

				<?
					if( is_array($arr_secciones) && count($arr_secciones) > 0)
					{
						if ($menu_select = $secciones->secciones_arregla_menu_forma( $arr_secciones ))
							echo $menu_select;
						else
							echo '<option value="0"> Men&uacute; principal (Inicio)</option>';
					}
					else
					{
						echo '<option value="0">  Men&uacute; principal (Inicio)</option>';
					}
				?>
			</select>
			<br/>
			<input class="form-control"  name="categoriasuperiorseccion"  id="categoriasuperiorseccion" type="hidden" />
			<input class="form-control"  name="nombre_seccion"  id="nombre_seccion" type="text"  placeholder="Nombre de la nueva secci&oacute;n"/>
			<br/>
			<p><small><a href="#" id="muestra_opc">+ Opciones Avanzadas</a></small></p>
			<div class="elementos_secciones">
				<input class="form-control"  name="nombre_url"  id="nombre_url" type="text"  placeholder="Escribe la URL personalizada (Espacios son representados por guiones bajos)"/>
				
				<input  name="sid"  id="sid" type="hidden" value="<?=md5(1)?>"/>
				<br/>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="seccion_estatica" id="seccion_estatica" /> Tendr&aacute; contenido HTML o PHP fuera del CMSAdmin
					</label>
					<hr class="separador"/>
					<label>
						<input type="checkbox" name="seccion_muestra_header" id="seccion_muestra_header" checked="checked" /> Mostrar en el men&uacute; principal (Header) 
					</label>
					<hr class="separador"/>
					<label>
						<input type="checkbox" name="seccion_muestra_footer" id="seccion_muestra_footer" checked="checked" /> Mostrar en el men&uacute; del pie de p&aacute;gina (Footer) 
					</label>
				</div>
			</div>
			<p>&nbsp;</p>
			<p align="center"> <button class="btn btn-warning" type="submit"> Crear <i class="glyphicon glyphicon-edit"></i> </button></p>
		</div>
	</form>
</div>