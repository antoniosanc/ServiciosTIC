<form action="index.php?q=secciones" method="post" id="frmsecciones" >
	<div class="input-prepend">
		<select id="categoriasuperiorseccion" name="categoriasuperiorseccion" class="span12">
			<option value="" >-- Categoria Superior --</option>
			<?
				if( is_array($arr_secciones) && count($arr_secciones) > 0)
				{
					if ($menu_select = $secciones->secciones_arregla_menu_forma( $arr_secciones ))
						echo $menu_select;
					else
						echo '<option value="1"> Inicio</option>';
				}
				else
				{
					echo '<option value="1"> Inicio</option>';
				}
			?>
		</select>
		<br/>
		<input class="input-xlarge"  name="nombre_seccion"  id="nombre_seccion" type="text"  placeholder="T&iacute;tulo"/>
		<input  name="sid"  id="sid" type="hidden" value="<?=md5(1)?>"/>
		<br/>
		<textarea rows="4" class="span12" name="descripcion_seccion"  id="descripcion_seccion" placeholder="Breve descripci&oacute;n"></textarea>
		
		
		<p align="center"> <button class="btn btn-primary" type="submit">Crear</button></p>
	</div>
</form>