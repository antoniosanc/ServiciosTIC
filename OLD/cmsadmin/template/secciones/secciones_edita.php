<?

	if( !$arr_seccion_editar = $secciones->secciones_busca_seccion_id( $seccion_editar ) )
	{
		echo alerta('Ocurri&oacute; un error al obtener los datos <a href="index.php?q=secciones">Intenta nuevamente</a>.');
		exit;
	}
	
	$arr_seccions = array();
	if( intval($arr_seccion_editar[0]["secciones_superior_id"]) != 0)
	{
		if( !$arr_seccion_superior = $secciones->secciones_busca_seccion_superior_id( $arr_seccion_editar[0]["secciones_superior_id"]) )
		{
			echo alerta('Ocurri&oacute; un error al obtener los datos (1)<a href="index.php?q=secciones">Intenta nuevamente</a>.');
			exit;
		}
		
		$arr_seccions["id"] =$arr_seccion_superior[0]["secciones_id"];
		$arr_seccions["nombre"] =$arr_seccion_superior[0]["secciones_nombre"];
	}
	else
	{
		$arr_seccions["id"] = 0;
		$arr_seccions["nombre"] = "- Inicio";
	}

?>

<form action="index.php?q=secciones&e=<?=md5(1)?>" method="POST" id="frmsecciones" >
	<div class="input-prepend">
		<select id="categoriasuperiorseccion" name="categoriasuperiorseccion" class="span12">
			<option value="<?=intval($arr_seccions["id"])?>" > <?=ucfirst($arr_seccions["nombre"])?> </option>
			<option value="" disabled>-- Elige otra categoria  --</option>
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
		<input class="input-xlarge"  value="<?=ucfirst($arr_seccion_editar[0]["secciones_nombre"])?>" name="nombre_seccion"  id="nombre_seccion" type="text"  placeholder="T&iacute;tulo"/>
		<input  name="sid"  id="sid" type="hidden" value="<?=md5(2)?>"/>
		<input  name="seid"  id="seid" type="hidden" value="<?=$generales->encriptar($arr_seccion_editar[0]["secciones_id"],"seccion") ?>"/>
		<br/>
		<textarea rows="4" class="span12" name="descripcion_seccion"  id="descripcion_seccion" placeholder="Breve descripci&oacute;n"><?=ucfirst($arr_seccion_editar[0]["secciones_descripcion"])?></textarea>
		
		<p align="center"> <button class="btn btn-primary" type="submit">Editar</button></p>
	</div>
</form>


<p align="right">
	<a class="btn btn-small btn btn-danger delsec" href="#" data-url="index.php?q=secciones&e=<?=md5(2)?>&i=<?=$generales->encriptar($arr_seccion_editar[0]["secciones_id"],"seccion") ?>"><i class="icon-remove icon-white"></i> Eliminar <?=ucfirst($arr_seccion_editar[0]["secciones_nombre"])?></a> 
</p>