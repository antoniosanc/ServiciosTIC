<link href="./css/contenidos_edita_historia.css" rel="stylesheet">

<?
	include_once(URL_SERVIDOR."/class/contenidos.class.php");
	$contenidos = new contenidos();
	
	include_once(URL_SERVIDOR."/class/generales.class.php");
	$generales = new generales();
	
	$seccion_id = $generales->desencriptar( $_GET["s"] ,"contenidos");

	if(intval($seccion_id) <= 0)
	{
		echo alerta('Ocurrio un error al cargar la secci&oacute;n (1). Favor de intentar nuevamente haciendo <a href="index.php?q=contenidos">clic aqu&iacute;</a>');
		return false;
	}
	
	
	if( !$arr_contenido = $contenidos->contenidos_busca_contenido_id( $seccion_id ) )
	{
		echo alerta('Ocurrio un error al cargar la secci&oacute;n. Favor de intentar nuevamente haciendo <a href="index.php?q=contenidos">clic aqu&iacute;</a> (1)');
		return false;
	}
	
	
?>

<div class="page-header">
	  <h1>Historia secci&oacute;n: <?=ucwords($arr_contenido[0]["contenido_titulo"])?></h1>
</div>
<div class="container-fluid">

	<div class="row-fluid">
		
		<?
			$seccion_id = $generales->desencriptar( $_GET["s"] ,"contenidos");
			
			
			
			if( $historia_contenidos = $contenidos->contenidos_busca_historia( $seccion_id ) )
			{
		?>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th >Fecha</th>
									<th ></th>
									<th >Informaci&oacute;n</th>
									<th ></th>
								</tr>
							</thead>
							<tbody>
								<?= $historia_contenidos?>
							</tbody>
						</table>
					</div>
				</div>
		<?
			}
			else
			{
				echo alerta('No hemos encontrado una versi&oacute;n anterior de la secci&oacute;n que deseas restaurar');
			}
		?>
	</div>
</div>
<p>&nbsp;</p>