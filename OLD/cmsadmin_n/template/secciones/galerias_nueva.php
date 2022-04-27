<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	include_once( URL_SERVIDOR."/class/galeria.class.php");
	$galeria = new galeria ();
	
	$arr_secciones = $galeria->galeria_lista_secciones();
	
	if( !empty($_POST) )
	{
		if( $galeria->galeria_guarda_nueva_galeria( $_POST ) )
		{
			echo correcto("Tu galer&iacute;a ha sido creada con &eacute;xito");
		}
		else
		{
			echo alerta("Ocurrio un error al crear tu galer&iacute;a, por favor intenta nuevamente");
		}
	}
?>
						
<link href="./css/galeria.css" rel="stylesheet">

<div class="page-header">
	  <h1>Agrega una nueva galer&iacute;a</h1>
</div>


<div class="container">
	<div class="row">
			<div class="bs-docs-galeria">
				<form method="POST" action="index.php?q=galerias_nueva" id="frm_nueva_galeria" name="frm_nueva_galeria" >
						<input type="text" name="galeria_titulo" id="galeria_titulo" class="form-control" placeholder="Título de tu galer&iacute;a" value=""/><br/>
						<input type="text" name="galeria_keywords" id="galeria_keywords" class="form-control" placeholder="Palabras clave relacionadas a la galer&iacute;a (Separadas por coma)" value=""/><br/>
						<select id="galeria_seccion" name="galeria_seccion" class="form-control">
						<option value="" >-- Secci&oacute;n asociada a la galer&iacute;a --</option>
						<?
							if( is_array($arr_secciones) && count($arr_secciones) > 0)
							{
								if ($menu_select = $galeria->galeria_arregla_secciones( $arr_secciones ))
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
					<br/><br/>
					<p align="center"><button class="btn btn-warning" > <i class="glyphicon glyphicon-floppy-disk"></i> Guardar galer&iacute;a </button></p>
				</form>
			</div>
	</div>
</div>
