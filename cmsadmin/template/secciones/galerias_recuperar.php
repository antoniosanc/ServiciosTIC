<link href="./css/galerias_restaurar.css" rel="stylesheet">
<?

	$galeria_id = $generales->desencriptar($_GET["s"], "galeria");
	if( intval($galeria_id) == 0 )
		return false;
	
	include_once(URL_SERVIDOR."/class/galeria.class.php");
	$galeria = new galeria();
?>

<div class="container">
	<h1>Recupera una imagen eliminada</h1>
	<p>&nbsp;</p>
	<div class="row">
		<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<thead>
				<tr >
					<th width="10%" >ID</th>
					<th width="20%">T&iacute;tulo</th>
					<th width="20%">V&iacute;nculo</th>
					<th width="35%">Imagen</th>
					<th width="15%"></th>
				</tr>
			</thead>
			<tbody>
			<?
				$arr_imagen_desactivada = $galeria->galerias_muestra_imagenes_desactivadas( $galeria_id );
				
				if( !empty($arr_imagen_desactivada) )
				{
					foreach( $arr_imagen_desactivada as $imagenes )
					{
						echo '
						<tr>
							<td>'.$imagenes["galerias_imagenes_id"].'</td>
							<td>
								<p>'.$imagenes["galerias_titulo"].'</p>
							<td>
								<p>'.$imagenes["galerias_imagenes_url"].'</p>
							</td>
							<td>
								<p align="center"><img src="'.$imagenes["galerias_imagenes_url_imagen"].'" alt="'.$imagenes["galerias_titulo"].'" style="max-height:130px;"/></p>
							</td>
							<td> 
								<p><a href="index.php?q=galerias_edita&s='.$_GET["s"].'&e='.md5(4).'&i='.$generales->encriptar($imagenes["galerias_imagenes_id"],"restaurar").'" class="btn btn-success btn-xs"> <i class="  glyphicon glyphicon-retweet"></i> Restaurar</a> </p></td>
						</tr>
						
						';
					}
				}
				else
				{
					echo '<tr class="error">
							<td>1</td>
							<td ><p align="center" >No se encontr&oacute; ninguna imagen eliminada para la galeria seleccionada. </p></td>
							<td> </td>
							<td> </td>
							<td> </td>
						</tr>';
				}
				?>
			<tbody>
		</table>
		
		<p align="center"><a href="index.php?q=galerias_edita&s=<?=$_GET["s"]?>" class="btn btn-xs btn-success"> <i class="glyphicon glyphicon-menu-left"></i> Regresar</a></p>
	</div>
</div>
