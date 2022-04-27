<?

	include_once( URL_SERVIDOR."/class/generales.class.php");
	$generales= new generales ();
	
	include_once( URL_SERVIDOR."/class/negocios.class.php");
	$negocios = new negocios ();
	
	if( strtolower($_GET["g"]) == "c" && $_SESSION["permiso_centro_negocios"] == "1" && !empty($_POST) )
	{
		if( $negocios->negocios_envia_correo_contacto( $_POST ) )
			echo correcto('El Correo electr&oacute;nico fue env&iacute;ado con &eacute;xito.');
		else
			echo error('Ocurrio un error al enviar el correo electr&oacute;nico. Intenta nuevamente');
	}
?>
						
<link href="./css/negocios.css" rel="stylesheet">

<div class="page-header">
	  <h1>Centro de negocios</h1>
</div>
	<p align="right"><a href="./exportar.php?q=base" class="btn btn-success btn-sm target="_blank"><span class="glyphicon glyphicon-download-alt"></span> Exportar datos</a></p>
	<br/>	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		
			<?

				if( $contenido_contacto = $negocios->negocios_lista_contactos(  ) )
				{
					echo '<thead>
							<tr >
								<th >ID</th>
								<th >Fecha</th>
								<th > Nombre </th>
								<th>Pregunta</th>
								<th ></th>
							</tr>
						</thead>
						<tbody>';
					echo $contenido_contacto;
					echo '</tbody>';
				}
				else
				{
					echo '<thead>
							<tr >
								<th > ERROR </th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td ><p align="center" >No se encontr&oacute; ninguna interacci&oacute;n.</p></td>
							</tr>
							</tbody>';

				}
			?>
		</tbody>
	</table>
