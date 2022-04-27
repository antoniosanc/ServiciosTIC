<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	include_once( URL_SERVIDOR."/class/contenidos.class.php");
	$contenidos = new contenidos ();
?>
						
<link href="./css/contenidos.css" rel="stylesheet">

<div class="page-header">
	  <h1>Contenidos</h1>
</div>

<div class="container-fluid">
	<div class="row-fluid">
		<h2>Secciones</h2>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr >
							<th >ID</th>
							<th ></th>
							<th >Secci&oacute;n</th>
							<th >Fecha de &uacute;ltima modificaci&oacute;n</th>
							<th ></th>
						</tr>
					</thead>
					<tbody>
						<?

							if( $contenido_secciones = $contenidos->contenidos_busca_secciones( ) )
							{
								echo $contenido_secciones;
							}
							else
							{
								echo '<tr class="error">
											<td colspan="5" ><p align="center" >No se encontr&oacute; ninguna secci&oacute;n para editar. Para comenzar <a href="index.php?q=secciones">agrega una secci&oacute;n</a></p></td>
										</tr>';

							}
						?>
					<tbody>
				</table>
			</div>
		</div>
	</div>
</div>