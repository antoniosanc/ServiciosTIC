<?
	if( $_GET["i"] == md5(5) )
	{
		include_once( URL_SERVIDOR."/class/configuracion.class.php");
		$configuracion = new configuracion ();
		
		$arr_usuario_permiso = $configuracion->configuracion_obten_informacion_usuario_id( $_SESSION["uid"] );
	
		if( intval( $arr_usuario_permiso[0]["usuarios_es_admin"] ) == 1  )
		{
			
			if( $_GET["g"] == "g" && !empty($_POST) )
			{
				
				switch( $_GET["f"] )
				{
					case "hd":
						$url_archivo_leer = URL_SERVIDOR_FRONT.'/template/header.php';
						$nombre_archivo = "header.php";
						
					break;
					case "ft":
						$url_archivo_leer = URL_SERVIDOR_FRONT.'/template/footer.php';
						$nombre_archivo = "footer.php";
					break;
					case "ucss":
						$url_archivo_leer = URL_SERVIDOR_FRONT.'/css/usr.css';
						$nombre_archivo = "usr.css";
					break;
					case "ujs":
						$url_archivo_leer = URL_SERVIDOR_FRONT.'/js/usr.js';
						$nombre_archivo = "usr.js";
					break;
					case "rtxt":
						$url_archivo_leer = URL_SERVIDOR_FRONT.'/robots.txt';
						$nombre_archivo = "robots.txt";
					break;
					case "sxml":
						$url_archivo_leer = URL_SERVIDOR_FRONT.'/sitemap.xml';
						$nombre_archivo = "sitemap.xml";
					break;
				}
				
				$handle = fopen($url_archivo_leer, 'r');
				$data = fread($handle,filesize($url_archivo_leer) );
				
				$nombre_file_sin_ext = explode(".",$nombre_archivo);
				$nombre_archivo_backup = fopen( URL_SERVIDOR."/userfiles/bk/".date('Y-m-j-G-i-s')."-".$nombre_file_sin_ext[0].".txt","a");
				fputs( $nombre_archivo_backup, $data );
				fclose( $nombre_archivo_backup );
				
				$fp = fopen($url_archivo_leer, 'w');
				fwrite($fp, $_POST["fg"]);
		
				fclose($fp);
				echo correcto("Archivo ".$nombre_archivo." editado correctamente. <a href='index.php?q=configuracion'>SALIR</a>");
				
				echo '<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="glyphicon glyphicon-refresh"></i> Recuperar contenido anterior</button>
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-body">
							<textarea class="form-control" id="fg" name="fg" cols="48" rows="15">'.$data .'</textarea>
						  </div>
						</div>
					  </div>
					</div>';
				
			}
			
			
			
			switch( $_GET["f"] )
			{
				case "hd":
					if ( file_exists(URL_SERVIDOR_FRONT.'/template/header.php' ) )
					{
						$contenido_archivo = file_get_contents( URL_SERVIDOR_FRONT.'/template/header.php' );
						echo '<p>&nbsp;</p> <h1>Editar archivo header.php</h1>';
					}
				break;
				case "ft":
					if ( file_exists(URL_SERVIDOR_FRONT.'/template/footer.php' ) )
					{
						$contenido_archivo = file_get_contents( URL_SERVIDOR_FRONT.'/template/footer.php' );
						echo '<p>&nbsp;</p> <h1>Editar archivo footer.php</h1>';
					}
				break;
				case "ucss":
					if ( file_exists(URL_SERVIDOR_FRONT.'/css/usr.css' ) )
					{
						$contenido_archivo = file_get_contents( URL_SERVIDOR_FRONT.'/css/usr.css' );
						echo '<p>&nbsp;</p> <h1>Editar archivo usr.css</h1>';
					}
				break;
				case "ujs":
					if ( file_exists(URL_SERVIDOR_FRONT.'/js/usr.js' ) )
					{
						$contenido_archivo = file_get_contents( URL_SERVIDOR_FRONT.'/js/usr.js' );
						echo '<p>&nbsp;</p> <h1>Editar archivo usr.js</h1>';
						
					}
				break;
				case "rtxt":
					if ( file_exists(URL_SERVIDOR_FRONT.'/robots.txt' ) )
					{
						$contenido_archivo = file_get_contents( URL_SERVIDOR_FRONT.'/robots.txt' );
						echo '<p>&nbsp;</p> <h1>Editar archivo robots.txt</h1>';
					}
				break;
				case "sxml":
					if ( file_exists(URL_SERVIDOR_FRONT.'/sitemap.xml' ) )
					{
						$contenido_archivo = file_get_contents( URL_SERVIDOR_FRONT.'/sitemap.xml' );
						echo '<p>&nbsp;</p> <h1>Editar archivo sitemap.xml</h1>';
					}
				break;
			}
			
			echo '<form action="index.php?q=file&i='.md5(5).'&g=g&f='.$_GET["f"].'" method="POST" id="frm_file" id="frm_file">
					<div class="form-group">
						<textarea class="form-control" cols="48" rows="30" id="fg" name="fg">'.$contenido_archivo .'</textarea>
					</div>
					<br/>
					<p align="right"> <button class="btn btn-warning" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar cambios</button></p>
				</form>';
		}
		else
		{
			echo '<p align="center"><img src="img/404.gif" alt="P&aacute;gina no encontrada" border="0"/></p>';
		}
	}
	else
	{
		echo '<p align="center"><img src="img/404.gif" alt="P&aacute;gina no encontrada" border="0"/></p>';
	}
?>