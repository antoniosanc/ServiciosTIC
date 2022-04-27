<?
	include_once( URL_SERVIDOR."/class/db.class.php");
	include_once( URL_SERVIDOR."/class/generales.class.php");
	
	class galeria
	{
		
		function __construct( ) 
		{
			$this->db = new db();
			$this->generales = new generales();
		}
		
		function galeria_lista_imagen (  $galeria_id = 0)
		{
			if( intval($galeria_id) == 0)
				return false;
			
			
			$sql = sprintf("SELECT 
								gi.galerias_imagenes_id,
								gi.galerias_imagenes_url_imagen,
								gi.galerias_imagenes_url,
								gi.galerias_imagenes_titulo,
								gi.galerias_imagenes_descripcion
							FROM 
								galerias_imagenes as gi
							WHERE
								gi.galerias_imagenes_status = 1
							AND 
								gi.galerias_imagenes_id = %d",
							 intval($galeria_id)
								);

			if( !$arr_galerias = $this->db->db_query( $sql, 1 ) )
				return false;
			
			return $arr_galerias;
		}
		
		function galeria_lista_imagenes_galeria (  $galeria_id = 0)
		{
			if( intval($galeria_id) == 0)
				return false;
			
			
			$sql = sprintf("SELECT 
								g.galerias_titulo,
								gi.galerias_imagenes_id,
								gi.galerias_imagenes_url_imagen,
								gi.galerias_imagenes_url,
								gi.galerias_imagenes_titulo,
								gi.galerias_imagenes_descripcion
							FROM 
								galerias_imagenes as gi
							INNER JOIN galerias as g
							USING ( galerias_id )
							WHERE
								g.galerias_status = 1
							AND
								gi.galerias_imagenes_status = 1
							AND 
								g.galerias_id = %d
							ORDER BY 
								gi.galerias_imagenes_id DESC",
							 intval($galeria_id)
								);

			if( !$arr_galerias = $this->db->db_query( $sql, 1 ) )
				return false;
			
			return $arr_galerias;
		}
		
		function galeria_lista_galerias ( )
		{

			$sql = sprintf("SELECT 
								g.galerias_id,
								g.galerias_titulo,
								g.galerias_keywords,
								c.contenido_titulo,
								g.galerias_fecha_creacion,
								g.galerias_status
							FROM 
								galerias as g
							INNER JOIN contenido as c
							USING ( secciones_id )
							WHERE
								g.galerias_status = 1
							AND
								c.contenido_status = 1
							ORDER BY 
								g.galerias_id DESC" );

			if( !$arr_galerias = $this->db->db_query( $sql, 1 ) )
				return false;
			
			$salida = "";
			if(is_array($arr_galerias) )
			{
				foreach( $arr_galerias as $galerias)
				{
					$fecha_galeria = $this->generales->fecha_formato_humano( $galerias["galerias_fecha_creacion"] );

					$salida .= "<tr>
									<td>".$galerias["galerias_id"]."</td>
									<td>".$galerias["galerias_titulo"]." </td>
									<td>".$galerias["contenido_titulo"]." </td>
									<td>".$fecha_galeria."</td>
									<td>  
										<p><a href='index.php?q=galerias_edita&s=".$this->generales->encriptar($galerias["galerias_id"],"galeria")."' class='btn btn-warning btn-mini'>".(($_SESSION["permiso_contenido"] == 1)? "<i class='glyphicon glyphicon-picture'></i> Editar im&aacute;genes": "<i class='glyphicon glyphicon-zoom-in'></i>Ver" )."</a> ";
										if( intval($galerias["galerias_id"]) > 1 && $_SESSION["permiso_contenido"] == 1)
											$salida .= "<a href='#' data-url='index.php?q=galeria&e=".$this->generales->encriptar($galerias["galerias_id"],"galeria")."' class='btn btn-xs btn-danger delgal' ><i class='glyphicon glyphicon-remove'></i> Eliminar</a></p>";
					$salida .= "	</td>
								</tr>";
				}
			}
			return $salida;
		}
		
		function galeria_lista_galerias_id ( $galeria_id = 0)
		{

			if( intval($galeria_id) == 0 )
				return false;
			
			$sql = sprintf("SELECT 
								g.galerias_id,
								g.galerias_titulo
							FROM 
								galerias as g
							WHERE
								g.galerias_status = 1
							AND
								g.galerias_id = %d",
							intval( $galeria_id) 
							);

			if( !$arr_galerias = $this->db->db_query( $sql, 1 ) )
				return false;
			
			
			return $arr_galerias;
		}
		
		
		function galeria_guarda_nueva_galeria ( $datos = 0 )
		{
			if( !is_array($datos ) )
				return false;
		
			$sql = sprintf("INSERT INTO galerias(galerias_titulo, galerias_keywords, secciones_id, galerias_fecha_creacion, galerias_status ) VALUES ('%s','%s', %d, '%s', 1) ",
						$this->db->db_evita_sql_injection( $datos["galeria_titulo"] ),
						$this->db->db_evita_sql_injection( $datos["galeria_keywords"] ),
						$this->db->db_evita_sql_injection( $datos["galeria_seccion"] ),
						$this->generales->hoy()
			);
			
			if( !$this->db->db_query( $sql, 2 ) )
				return false;
			
			return true;
			
		}
		
		function galeria_guarda_nueva_imagen ( $datos = 0, $file = 0 )
		{
			if( !is_array($datos) || !is_array($file) )
				return false;
			
			if( !$file["imagen_subir"]['type'] == 'image/png' || !$file["imagen_subir"]['type'] == 'image/jpeg' || !$file["imagen_subir"]['type'] == 'image/gif' )
				return false;
				
			if( $file["imagen_subir"]['size'] > 786432 ) //Verificamos que no pese más de 700Kb
				return false;
				
			$galeria_id = $this->generales->desencriptar($datos["s"], "galeria");
			
			if ( intval($galeria_id) == 0 )
				return false;
				
			$sql_seccion = sprintf("SELECT 
								s.secciones_url
							FROM 
								galerias as g
							INNER JOIN 
								secciones as s USING ( secciones_id )
							WHERE 
								g.galerias_status = 1
							AND 
								s.secciones_status = 1
							AND 
								g.galerias_id = %d",
							intval($galeria_id)
						);
			
			if( !$arr_titulo_galeria = $this->db->db_query( $sql_seccion, 1 ) )
				return false;
			
			$directorio = $_SERVER["DOCUMENT_ROOT"].URL_USERFILES."image/".$arr_titulo_galeria[0]["secciones_url"]."/";
		
			if(!is_dir( $directorio  ) )
				mkdir( $directorio , 0777, true);

			$nombre_imagen = $file["imagen_subir"]['name'];
			$cadena_unica = $this->generales->genera_cadena_aleatoria(4);

			switch( $file["imagen_subir"]['type'] )
			{
				case "image/png":
					$type_imagen = ".png";
				break;
				case "image/jpeg":
					$type_imagen = ".jpg";
				break;
				case "image/gif":
					$type_imagen = ".gif";
				break;
				
			}
					
			$nombre_archivo = $directorio."sl_".$this->generales->prepara_cadena_enlace($nombre_imagen)."-".$cadena_unica.$type_imagen;
			$nombre_imagen = str_replace($_SERVER["DOCUMENT_ROOT"], "", $nombre_archivo );

			if (! move_uploaded_file($file['imagen_subir']['tmp_name'], $nombre_archivo))
				return false;
			
			$sql = sprintf("INSERT INTO 
									galerias_imagenes (galerias_id, galerias_imagenes_url_imagen, galerias_imagenes_url, galerias_imagenes_titulo, galerias_imagenes_descripcion, galerias_imagenes_fecha, galerias_imagenes_status) 
							VALUES (%d, '%s','%s','%s','%s','%s', 1) ",
						intval($galeria_id),
						$this->db->db_evita_sql_injection( $nombre_imagen ),
						$this->db->db_evita_sql_injection( $datos["imagen_url"] ),
						$this->db->db_evita_sql_injection( $datos["imagen_titulo"] ),
						$this->db->db_evita_sql_injection( $datos["imagen_descripcion"] ),
						$this->generales->hoy()
			);
	
			if( !$this->db->db_query( $sql, 2 ) )
				return false;
			
			return true;
		}
		
		
		function galeria_edita_imagen_seleccionada ( $datos = 0, $file = 0 )
		{
			if( !is_array($datos)  )
				return false;
			
			$galeria_id = $this->generales->desencriptar($datos["s"], "galeria");
		
			if ( intval($galeria_id) == 0 )
				return false;

			$sql_imagen = "";
			if( !empty( $file["imagen_subir"]['name'] ) )
			{
				if( !$file["imagen_subir"]['type'] == 'image/png' || !$file["imagen_subir"]['type'] == 'image/jpeg' || !$file["imagen_subir"]['type'] == 'image/gif' )
					return false;
					
				if( $file["imagen_subir"]['size'] > 786432 ) //Verificamos que no pese más de 700Kb
					return false;
				
				$nombre_imagen = $file["imagen_subir"]['name'];
				$cadena_unica = $this->generales->genera_cadena_aleatoria(4);

				switch( $file["imagen_subir"]['type'] )
				{
					case "image/png":
						$type_imagen = ".png";
					break;
					case "image/jpeg":
						$type_imagen = ".jpg";
					break;
					case "image/gif":
						$type_imagen = ".gif";
					break;
					
				}
				
				$directorio = $_SERVER["DOCUMENT_ROOT"].URL_USERFILES."image/".$arr_titulo_galeria[0]["secciones_url"]."/";
				
				if(!is_dir( $directorio  ) )
					mkdir( $directorio , 0777, true);
					
				$nombre_archivo = $directorio.$cadena_unica."-".$this->generales->prepara_cadena_enlace($nombre_imagen).$type_imagen;
				$nombre_imagen = str_replace($_SERVER["DOCUMENT_ROOT"], "", $nombre_archivo );

				if (! move_uploaded_file($file['imagen_subir']['tmp_name'], $nombre_archivo))
					return false;
				
				$sql_imagen = sprintf(", galerias_imagenes_url_imagen ='%s' ", $nombre_imagen);
			}
	
			$sql = sprintf("UPDATE galerias_imagenes SET galerias_imagenes_url ='%s', galerias_imagenes_titulo ='%s', galerias_imagenes_descripcion ='%s', galerias_imagenes_fecha ='%s', galerias_imagenes_status = 1 %s WHERE galerias_imagenes_id = %d ",
						$this->db->db_evita_sql_injection( $datos["imagen_url"] ),
						$this->db->db_evita_sql_injection( $datos["imagen_titulo"] ),
						$this->db->db_evita_sql_injection( $datos["imagen_descripcion"] ),
						$this->generales->hoy(),
						$sql_imagen ,
						intval($galeria_id)
			);

			if( !$this->db->db_query( $sql, 3 ) )
				return false;
			
			return true;
		}
		
		function galeria_elimina_galeria ( $galeria_id = 0 )
		{
			if( intval($galeria_id) == 0 )
				return false;
			
			$sql = sprintf("UPDATE galerias SET galerias_status = 0 WHERE galerias_id = %d ",
					 intval($galeria_id)
			);
			
			if( !$this->db->db_query( $sql, 3 ) )
				return false;
			
			$sql_imagenes = sprintf("UPDATE galerias_imagenes SET galerias_imagenes_status = 0 WHERE galerias_id = %d ",
					 intval($galeria_id)
			);
			
			if( !$this->db->db_query( $sql_imagenes, 3 ) )
				return false;
			
			return true;
		}
		
		function galeria_elimina_imagen_seleccionada ( $galeria_id = 0 )
		{
			if( intval($galeria_id) == 0 )
				return false;
			
			$sql_imagenes = sprintf("UPDATE galerias_imagenes SET galerias_imagenes_status = 0 WHERE galerias_imagenes_id = %d ",
					 intval($galeria_id)
			);
			
			if( !$this->db->db_query( $sql_imagenes, 3 ) )
				return false;
			
			return true;
		}
		
		function galeria_lista_secciones(   )
		{

			$sql = sprintf(" SELECT 
								s.secciones_id,
								s.secciones_nombre,
								s.secciones_url,
								s.secciones_superior_id,
								s.secciones_descripcion
							FROM 
								secciones as s
							WHERE
								secciones_status = 1"
						);

			if( !$arr_secciones = $this->db->db_query( $sql, 1 ) )
				return false;

			$arr_menu_secciones = array();
			foreach( $arr_secciones as $secciones) 
			{
				$arr_menu_secciones[$secciones['secciones_superior_id']][$secciones['secciones_id']]['id'] = $secciones['secciones_id'];
				$arr_menu_secciones[$secciones['secciones_superior_id']][$secciones['secciones_id']]['nombre'] = $secciones['secciones_nombre'];
				$arr_menu_secciones[$secciones['secciones_superior_id']][$secciones['secciones_id']]['url'] = $secciones['secciones_url'];
				$arr_menu_secciones[$secciones['secciones_superior_id']][$secciones['secciones_id']]['descripcion'] = $secciones['secciones_descripcion'];
			} 
			
			return $arr_menu_secciones;
		}
		
		
		function galeria_arregla_secciones ( $arr_secciones = 0 )		
		{
			if( !is_array($arr_secciones) )
				return false;

			$menu_forma = "";
			foreach( $arr_secciones[0] as $padres )
			{
				$valor_elemento_padre = $padres["id"];
				if( strtolower($padres["nombre"]) == "inicio" )
					$valor_elemento_padre = 1;
					
				$menu_forma .= "<option value='".$valor_elemento_padre."'>&nbsp;- &nbsp;".ucfirst($padres["nombre"])."</option>";
				
				if(is_array( $arr_secciones[$padres["id"]] ) )
				{
					foreach (  $arr_secciones[$padres["id"]] as $hijos )
					{
						$menu_forma .= "<option value='".$hijos["id"]."'> &nbsp; &nbsp; &nbsp;-- &nbsp;".ucfirst($hijos["nombre"])."</option>";
						
						if(is_array( $arr_secciones[$hijos["id"]] ) )
						{
							foreach (  $arr_secciones[$hijos["id"]] as $hijos2 )
							{
								$menu_forma .= "<option value='".$hijos2["id"]."'> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;--- &nbsp;".ucfirst($hijos2["nombre"])."</option>";
							}
						}
						
					}
				}
			}
			
			return $menu_forma;
		}
		
	}
?>