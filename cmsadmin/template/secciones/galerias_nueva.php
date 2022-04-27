						
<link href="./css/galeria.css" rel="stylesheet">
<link href="./libs/editable_select/editable_select.css" rel="stylesheet">

<div class="page-header">
	  <h1>Agrega una nueva galer&iacute;a</h1>
</div>
<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	include_once( URL_SERVIDOR."/class/galeria.class.php");
	$galeria = new galeria ();
	
	$arr_secciones = $galeria->galeria_lista_secciones();
	
	if( !empty($_POST) && $_GET["e"] == md5(2))
	{

		if( $galeria_id = $galeria->galeria_guarda_nueva_galeria( $_POST ) )
		{
			echo correcto('La galer&iacute;a ha sido creada con &eacute;xito. Para comenzar a a&ntilde;adir im&aacute;genes <a href="index.php?q=galerias_edita&s='.$generales->encriptar($galeria_id,"galeria").'" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-pencil"></i> Haz clic aqu&iacute;</a>');
		}
		else
		{
			echo alerta("Ocurrio un error al crear tu galer&iacute;a, por favor intenta nuevamente");
		}
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-2">&nbsp;</div>
		<div class="col-md-8">
			<div class="bs-docs-galeria">
				<form method="POST" action="index.php?q=galerias_nueva&g=g&e=<?=md5("2")?>" id="frm_nueva_galeria" name="frm_nueva_galeria" >
						<input type="text" name="galeria_titulo" id="galeria_titulo" class="form-control" placeholder="Título de tu galer&iacute;a" value=""/><br/>
						<input type="text" name="galeria_keywords" id="galeria_keywords" class="form-control" placeholder="Palabras clave relacionadas a la galer&iacute;a (Separadas por coma)" value=""/><br/>
						<select id="galeria_elije_seccion" name="galeria_elije_seccion" class="form-control" placeholder="Selecciona">
						<option value="" selected >-- Secci&oacute;n vinculada --</option>
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
					<input type="hidden" name="galeria_seccion" id="galeria_seccion"  value=""/>
					<br/><br/>
					<p align="center"><button class="btn btn-warning" > <i class="glyphicon glyphicon-floppy-disk"></i> Crear galer&iacute;a </button></p>
				</form>
			</div>
		</div>
		<div class="col-md-2">&nbsp;</div>
	</div>
</div>
