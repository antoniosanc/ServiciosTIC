<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	include_once( URL_SERVIDOR."/class/galeria.class.php");
	$galeria = new galeria ();
	
	$galeria_id = $generales->desencriptar($_GET["e"], "galeria");
	
	if( intval( $galeria_id ) > 0 )
	{
		if( $galeria->galeria_elimina_galeria(  $galeria_id ) )
		{
			echo correcto("Tu galer&iacute;a ha sido eliminada con &eacute;xito");
		}
		else
		{
			echo alerta("Ocurrio un error al eliminar tu galer&iacute;a, por favor intenta nuevamente");
		}
	}
	
	if( $_GET["e"] == md5(1) )
	{
		
		$imagen_id = $generales->desencriptar($_GET["i"], "galeria");
		
		if( $galeria->galeria_elimina_imagen_seleccionada( $imagen_id  ) )
		{
			echo correcto("Tu imagen ha sido eliminada con &eacute;xito");
		}
		else
		{
			echo alerta("Ocurrio un error al eliminada tu imagen, por favor intenta nuevamente");
		}
	}
?>
						
<link href="./css/galeria.css" rel="stylesheet">

<div class="page-header">
	  <h1>Galer&iacute;as de imagenes</h1>
</div>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="panel-body">
		<p align="center"> <a href="index.php?q=galerias_nueva" class="btn btn-primary"> Agregar nueva galer&iacute;a</a> </p>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr >
							<th >ID</th>
							<th > Galer&iacute;a</th>
							<th >Secci&oacute;n relacionada</th>
							<th >Fecha de &uacute;ltima modificaci&oacute;n</th>
							<th ></th>
						</tr>
					</thead>
					<tbody>
						<?

							if( $contenido_galeria = $galeria->galeria_lista_galerias( ) )
							{
								echo $contenido_galeria;
							}
							else
							{
								echo '<tr class="error">
											<td colspan="5" ><p align="center" >No se encontr&oacute; ninguna galer&iacute;a para editar. Para comenzar <a href="index.php?q=galerias_crea">agrega una galer&iacute;a</a></p></td>
										</tr>';

							}
						?>
					<tbody>
				</table>
			</div>
		</div>
	</div>
</div>