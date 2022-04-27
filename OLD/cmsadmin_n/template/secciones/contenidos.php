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

<div class="container">
	<div class="row">
		<h2>Secciones</h2>
		<div class="col-md-12">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr >
						<th width="10%" >ID</th>
						<th width="15%" ></th>
						<th width="45%">Secci&oacute;n</th>
						<th width="20%">Fecha de &uacute;ltima modificaci&oacute;n</th>
						<th width="10%"></th>
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