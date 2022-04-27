<?

	if( !$arr_seccion_editar = $secciones->secciones_busca_seccion_id( $seccion_editar ) )
	{
		echo alerta('Ocurri&oacute; un error al obtener los datos <a href="index.php?q=secciones">Intenta nuevamente</a>.');
		exit;
	}
	
	//$arr_secciones = array();
	if( intval($arr_seccion_editar[0]["secciones_superior_id"]) != 0)
	{
		if( !$arr_seccion_superior = $secciones->secciones_busca_seccion_superior_id( $arr_seccion_editar[0]["secciones_superior_id"]) )
		{
			echo alerta('Ocurri&oacute; un error al obtener los datos (1)<a href="index.php?q=secciones">Intenta nuevamente</a>.');
			exit;
		}
		
		$arr_secciones["id"] =$arr_seccion_superior[0]["secciones_id"];
		$arr_secciones["nombre"] =$arr_seccion_superior[0]["secciones_nombre"];
	}
	else
	{
		$arr_secciones["id"] = 0;
		$arr_secciones["nombre"] = "- Inicio";
	}

?>
<h2>Editar secci&oacute;n </h2>
<div class="hero-unit">
	<p> Estas editando la secci&oacute;n: <strong><?=ucfirst($arr_seccion_editar[0]["secciones_nombre"])?></strong></p>
	<form action="index.php?q=secciones&e=<?=md5(1)?>" method="POST" id="frmsecciones" >
		<div class="input-prepend">
			<select id="categoriasuperiorseccion" name="categoriasuperiorseccion" class="form-control">
				<option value="<?=intval($arr_secciones["id"])?>" > <?=ucfirst($arr_secciones["nombre"])?> </option>
				<option value="" disabled>-- Cambia de ubicaci&oacute;n tu secci&oacute;n  --</option>
				<?
					if( is_array($arr_secciones) && count($arr_secciones) > 0)
					{
						if ($menu_select = $secciones->secciones_arregla_menu_forma( $arr_secciones ))
							echo $menu_select;
						else
							echo '<option value="1">  Men&uacute; principal (Inicio)</option>';
					}
					else
					{
						echo '<option value="1"> Men&uacute; principal (Inicio) </option>';
					}
				?>
			</select>
			<br/>
			<input class="form-control"  value="<?=ucfirst($arr_seccion_editar[0]["secciones_nombre"])?>" name="nombre_seccion"  id="nombre_seccion" type="text"  placeholder="Nombre de la nueva secci&oacute;n"  data-toggle="tooltip" data-placement="bottom" title="Recuerda: Si cambias el nombre de una secci&oacute;n, no cambiar&aacute; su URL a menos que lo tu hagas"/>
			<input  name="sid"  id="sid" type="hidden" value="<?=md5(2)?>"/>
			<input  name="seid"  id="seid" type="hidden" value="<?=$generales->encriptar($arr_seccion_editar[0]["secciones_id"],"seccion") ?>"/>
			<br/>
			<p><small><a href="#" id="muestra_opc">+ Opciones Avanzadas</a></small></p>
			<div class="elementos_secciones">
				<input class="form-control"  name="nombre_url"  id="nombre_url" type="text" value="<?=$arr_seccion_editar[0]["secciones_url"]?>" placeholder="Escribe la URL personalizada (Espacios son representados por guiones bajos)"/>
				<br/>
				<div class="checkbox">
					<label>
					<?
						$es_checked_estatico = "";
						if( intval($arr_seccion_editar[0]["secciones_seccion_estatica"]) == 1 )
							$es_checked_estatico = " checked='checked' ";
					?>
					
						<input type="checkbox" name="seccion_estatica" id="seccion_estatica" <?=$es_checked_estatico?>/> Tendr&aacute; contenido HTML o PHP fuera del CMSAdmin
					</label>
					<hr class="separador"/>
					<label>
					<?
						$es_checked_header = "";
						if( intval($arr_seccion_editar[0]["secciones_muestra_header"]) == 1 )
							$es_checked_header = " checked='checked' ";
					?>
						<input type="checkbox" name="seccion_muestra_header" id="seccion_muestra_header" <?=$es_checked_header?> /> Mostrar en el men&uacute; principal (Header) 
					</label>
					<hr class="separador"/>
					<label>
					<?
						$es_checked_footer = "";
						if( intval($arr_seccion_editar[0]["secciones_muestra_footer"]) == 1 )
							$es_checked_footer = " checked='checked' ";
					?>
						<input type="checkbox" name="seccion_muestra_footer" id="seccion_muestra_footer" <?=$es_checked_footer?>  /> Mostrar en el men&uacute; del pie de p&aacute;gina (Footer) 
					</label>
				</div>
			</div>
			<p>&nbsp;</p>
			<p align="center"> <button class="btn btn-warning" type="submit"> Editar <i class="glyphicon glyphicon-edit"></i></button></p>
		</div>
	</form>


	<p align="right">
		<a class="btn btn-xs btn-danger delsec" href="#" data-url="index.php?q=secciones&e=<?=md5(2)?>&i=<?=$generales->encriptar($arr_seccion_editar[0]["secciones_id"],"seccion") ?>"><i class="glyphicon glyphicon-remove"></i> Eliminar <?=ucfirst($arr_seccion_editar[0]["secciones_nombre"])?></a> 
	</p>
</div>