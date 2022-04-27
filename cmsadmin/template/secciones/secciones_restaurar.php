<link href="./css/secciones_restaurar.css" rel="stylesheet">

<?
	include_once(URL_SERVIDOR."/class/secciones.class.php");
	$secciones = new secciones();
?>

<div class="container">
	<h1>Recupera una secci&oacute;n eliminada</h1>
	<p>&nbsp;</p>
	<div class="row">
		<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<thead>
				<tr >
					<th width="10%" >ID</th>
					<th width="45%">Nombre</th>
					<th width="30%">Fecha de eliminaci&oacute;n</th>
					<th width="15%"></th>
				</tr>
			</thead>
			<tbody>
			<?
				$arr_secciones_desactivadas = $secciones->secciones_muestra_secciones_desactivadas();
				
				if( !empty($arr_secciones_desactivadas) )
				{
					foreach( $arr_secciones_desactivadas as $secciones )
					{
						echo '
						<tr>
							<td>'.$secciones["secciones_id"].'</td>
							<td>
								<p><strong>'.$secciones["secciones_nombre"].'</strong> - <i>index.php?q='.$secciones["secciones_url"].'</i></p>
								<p><small>'.$secciones["contenido_descripcion"].'</strong> </small></p>
							</td>
							<td>'.$generales->fecha_formato_humano( $secciones["secciones_fecha"] ).'</td>
							<td> <br/><p><a href="index.php?q=secciones&i='.$generales->encriptar($secciones["secciones_id"],"restaurar").'&e='.md5(3).'" class="btn btn-success btn-xs"> <i class="  glyphicon glyphicon-retweet"></i> Restaurar</a> </p></td>
						</tr>
						
						';
					}
				}
				else
				{
					echo '<tr class="error">
							<td>1</td>
							<td ><p align="center" >No se encontr&oacute; ninguna secci&oacute;n eliminada previamente. </p></td>
							<td> </td>
							<td> </td>
						</tr>';
				}
				?>
			<tbody>
		</table>
	</div>
</div>
