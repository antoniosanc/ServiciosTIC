<?
	include_once( URL_SERVIDOR."/class/db.class.php");
	include_once( URL_SERVIDOR."/class/generales.class.php");
	
	class contenidos
	{
		
		function __construct( ) 
		{
			$this->db = new db();
			$this->generales = new generales();
		}
		
		function contenidos_busca_secciones ( )
		{

			$sql = sprintf("SELECT 
								s.secciones_id,
								s.secciones_nombre,
								c.contenido_id,
								c.contenido_titulo,
								c.contenido_imagen,
								c.contenido_descripcion,
								c.contenido_fecha_modificacion,
								c.contenido_status
							FROM 
								secciones as s
							INNER JOIN contenido as c 
							USING ( secciones_id )
							WHERE
								s.secciones_status = 1
							AND
								c.contenido_status = 1
							ORDER BY 
								s.secciones_id DESC"

						);

			if( !$arr_seccion = $this->db->db_query( $sql, 1 ) )
				return false;
			
			$salida = "";
			if(is_array($arr_seccion) )
			{
				foreach( $arr_seccion as $seccion)
				{
					$fecha_evento = $this->generales->fecha_formato_humano( $seccion["contenido_fecha_modificacion"] );

					$salida .= "<tr>
									<td>".$seccion["secciones_id"]."</td>
									<td class='tablecenter'>";
									
									if(!empty( $seccion["contenido_imagen"] ))
									{
									$salida .= " <img src='".URL_USERFILES."/image/".$seccion["contenido_imagen"]."' border='0' alt='imagen destacada' class='imagenth'/>";
									}
					$salida .= "</td>
									<td>
										<p ><strong>".$seccion["contenido_titulo"]."</strong>. ".$this->generales->corta_cadena($seccion["contenido_descripcion"], 100)."</p>
									</td>
									<td>".$fecha_evento."</td>
									<td>  <a href='index.php?q=contenidos_edita&s=".$this->generales->encriptar($seccion["secciones_id"],"contenidos")."' class='btn btn-primary'>".(($_SESSION["permiso_contenido"] == 1)? "Editar": "Ver" )."</a></td>
								</tr>";
				}
			}
			return $salida;
		}
	
		function contenidos_busca_contenido_id ( $seccion_id = 0 )
		{
			if( intval($seccion_id) <= 0 )
				return false;
		
			$sql = sprintf("SELECT 
								c.contenido_titulo,
								c.contenido_descripcion,
								c.contenido_imagen,
								c.contenido_contenido,
								c.contenido_btn_compartir,
								c.contenido_palabras_clave,
								c.secciones_id
							FROM
								contenido c 
							INNER JOIN
								secciones s
							USING ( secciones_id )
							WHERE
								c.secciones_id = %d
							AND
								c.contenido_status = 1
							AND
								s.secciones_status = 1",
							 intval($seccion_id)
							);

			if( $arr_seccion = $this->db->db_query( $sql, 1 ) )
				return $arr_seccion;
			
			return false;
		}
		
		function contenidos_guarda_imagen_destacada( $datos = "")
		{
			if(!is_array($datos) )
				return false;
			
			if(	intval($_SESSION["uid"]) <= 0 )
					return false;
			
			$sql = sprintf("UPDATE contenido SET contenido_imagen = '%s'
								WHERE contenido_id =%d",
								$datos["archivo"],
								$datos["seccion"]
								);

			if($secciones_id = $this->db->db_query( $sql, 3 ) )
				return true;

			return false;
		}
		
		function contenidos_elimina_imagen_destacada( $datos = "")
		{
			if(!is_array($datos) )
				return false;
			
			if(	intval($_SESSION["uid"]) <= 0 )
					return false;
			
			$sql = sprintf("UPDATE contenido SET contenido_imagen = ''
								WHERE contenido_id =%d",
								$datos["seccion"]
								);

			if($secciones_id = $this->db->db_query( $sql, 3 ) )
				return true;

			return false;
		}
		
		function contenidos_guarda_contenido( $datos = "")
		{
			if(!is_array($datos) )
				return false;
			
			if(	intval($_SESSION["uid"]) <= 0 )
					return false;
			
			$seccion_id = $this->generales->desencriptar( $datos["sid"] ,"contenidos");
			if( intval($seccion_id) == 0 )
				return false;
			
			$compartir_rs = 0;
			if( $datos["contenido_social"] )
				$compartir_rs = 1;
				
			$sql_obten_historia = sprintf( "SELECT 
									c.contenido_titulo, 
									c.contenido_descripcion, 
									c.contenido_imagen, 
									c.contenido_contenido
								FROM
									contenido AS c
								WHERE
									c.contenido_id = %d",
								$seccion_id
								);
			
			if( !$arr_historia_seccion = $this->db->db_query( $sql_obten_historia, 1 ) )
				return false;
			
			$sql_historia = sprintf("INSERT INTO contenido_historia( contenido_id, secciones_id, contenido_historia_titulo, contenido_historia_descripcion, contenido_historia_imagen, contenido_historia_contenido, contenido_historia_fecha_modificacion, contenido_historia_status)  VALUES(%d, %d, '%s','%s','%s','%s','%s', 1)",
			$seccion_id,
			$seccion_id,
			$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii( $arr_historia_seccion[0]["contenido_titulo"] )),
			$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii( $arr_historia_seccion[0]["contenido_descripcion"] )), 
			$this->db->db_evita_sql_injection($arr_historia_seccion[0]["contenido_imagen"] ),
			$this->db->db_evita_sql_injection( $arr_historia_seccion[0]["contenido_contenido"] ),
			$this->generales->hoy()
			);

			if( !$this->db->db_query( $sql_historia, 2 ) )
				return false;
			
				
			$sql = sprintf("UPDATE contenido SET contenido_titulo = '%s', contenido_descripcion = '%s', contenido_contenido = '%s', contenido_fecha_modificacion  = '%s',  contenido_btn_compartir = '%s', contenido_palabras_clave  = '%s'
								WHERE contenido_id = %d",
								$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii( $datos["contenido_titulo"]) ),
								$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii( $datos["contenido_descripcion"]) ),
								$this->db->db_evita_sql_injection(    $datos["contenido_editor"] ),
								$this->generales->hoy(),
								$compartir_rs,
								$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii(  $datos["contenido_keywords"]) ),
								$seccion_id
						);
 
			if($contenido_id = $this->db->db_query( $sql, 3 ) )
			{
				$sql_busca_nombre_seccion = sprintf("SELECT 
														s.secciones_url
													FROM
														contenido c 
													INNER JOIN
														secciones s
													USING ( secciones_id )
													WHERE
														c.secciones_id = %d
													AND
														c.contenido_status = 1
													AND
														s.secciones_status = 1",
													 intval($seccion_id)
													);

				if( $arr_seccion = $this->db->db_query( $sql_busca_nombre_seccion, 1 ) )
					return $arr_seccion[0]["secciones_url"];
				
				return true;
			}

			return false;
		}
		
		function contenidos_busca_historia( $seccion_id = 0 )
		{
			if( intval($seccion_id)  == 0)
				return false;
				
			$sql = sprintf("SELECT
								ch.contenido_historia_id,
								ch.contenido_historia_titulo,
								ch.contenido_historia_descripcion,
								ch.contenido_historia_imagen,
								ch.contenido_historia_contenido,
								ch.contenido_historia_fecha_modificacion
							FROM
								contenido_historia AS ch
							WHERE
								ch.secciones_id = %d
							AND
								ch.contenido_historia_status = 1
							ORDER BY contenido_historia_fecha_modificacion DESC 
							LIMIT 5",
						intval($seccion_id) );

			if( !$arr_seccion = $this->db->db_query( $sql, 1 ) )
				return false;
			
			$salida = "";
			
			if(is_array($arr_seccion) )
			{
				$contador = 1;
				foreach( $arr_seccion as $seccion )
				{
					$fecha_evento = $this->generales->fecha_formato_humano( $seccion["contenido_historia_fecha_modificacion"] );

					$salida .= "<tr>
									<td>".$fecha_evento."</td>
									<td class='tablecenter'>";
									
									if(!empty( $seccion["contenido_historia_imagen"] ))
									{
									$salida .= " <img src='/userfiles/image/nuevo_cms/".$seccion["contenido_historia_imagen"]."' border='0' alt='imagen destacada' class='imagenth'/>";
									}

					$salida .= "	</td>
									<td>
										<p ><strong>".$seccion["contenido_historia_titulo"]."</strong></p>
										<p >".$seccion["contenido_historia_descripcion"]."</p>
									</td>
									<td>  
										<a href='#modal_contenidos_".$contador."' class='btn btn-primary' data-toggle='modal'>Leer m&aacute;s</a>
										<a href='index.php?q=contenidos_restaura&s=".$this->generales->encriptar($seccion["contenido_historia_id"],"contenidos")."' class='btn btn-primary'>Restaurar</a>
										
										
										<div id='modal_contenidos_".$contador."' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
											<div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
											<h3 id='myModalLabel'>".$seccion["contenido_historia_titulo"]."</h3>
											</div>
											<div class='modal-body'>
												".$seccion["contenido_historia_contenido"]."
											</div>
											<div class='modal-footer'>
											<button class='btn btn-primary' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
											</div>
										</div>

									</td>
								</tr>";
					$contador++;
				}
			}
			
			return $salida;
		}
		
		function contenidos_restaura_contenido ( $seccion_historia_id = 0)
		{
			if(intval($seccion_historia_id) == 0)
				return false;

			if(	intval($_SESSION["uid"]) <= 0 )
					return false;

			//Obtenemos la información a restaurar
			$sql = sprintf("SELECT
								ch.contenido_id,
								ch.contenido_historia_titulo,
								ch.contenido_historia_descripcion,
								ch.contenido_historia_imagen,
								ch.contenido_historia_contenido,
								ch.contenido_historia_fecha_modificacion
							FROM
								contenido_historia AS ch
							WHERE
								ch.contenido_historia_status = 1
							AND
								contenido_historia_id = %d",
						intval($seccion_historia_id) );

			if( !$arr_contenido = $this->db->db_query( $sql, 1 ) )
				return false;

			//tomamos la informacion actual y la guardamos en la historia
			$sql_seccion_reemplazar = sprintf("SELECT 
									c.contenido_titulo, 
									c.contenido_descripcion, 
									c.contenido_imagen, 
									c.contenido_contenido
								FROM
									contenido AS c
								WHERE
									c.contenido_id = %d",
								intval( $arr_contenido[0]["contenido_id"] )
								);
			
			if( !$arr_historia_seccion = $this->db->db_query( $sql_seccion_reemplazar, 1 ) )
				return false;
			
			//La guardamos en la historia
			$sql_historia = sprintf("INSERT INTO contenido_historia( contenido_id, secciones_id, contenido_historia_titulo, contenido_historia_descripcion, contenido_historia_imagen, contenido_historia_contenido, contenido_historia_fecha_modificacion, contenido_historia_status)  VALUES(%d, %d, '%s','%s','%s','%s','%s', 1)",
			intval( $arr_contenido[0]["contenido_id"] ),
			intval( $arr_contenido[0]["contenido_id"] ),
			$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii(   $arr_historia_seccion[0]["contenido_titulo"] )),
			$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii(   $arr_historia_seccion[0]["contenido_descripcion"] )),
			$this->db->db_evita_sql_injection($arr_historia_seccion[0]["contenido_imagen"] ),
			$this->db->db_evita_sql_injection( $arr_historia_seccion[0]["contenido_contenido"] ),
			$this->generales->hoy()
			);

			if( !$this->db->db_query( $sql_historia, 2 ) )
				return false;
				
			//Restauramos la información
			$sql_restaura = sprintf(" UPDATE contenido SET  contenido_titulo = '%s', contenido_descripcion = '%s', contenido_imagen = '%s', contenido_contenido = '%s', contenido_fecha_modificacion  = '%s'
								WHERE contenido_id = %d",
								$this->db->db_evita_sql_injection($arr_contenido[0]["contenido_historia_titulo"]),
								$this->db->db_evita_sql_injection($arr_contenido[0]["contenido_historia_descripcion"]),
								$this->db->db_evita_sql_injection($arr_contenido[0]["contenido_historia_imagen"]),
								$this->db->db_evita_sql_injection($arr_contenido[0]["contenido_historia_contenido"]),
								$this->generales->hoy(),
								intval( $arr_contenido[0]["contenido_id"] )
									);
			
			if( !$this->db->db_query( $sql_restaura, 3 ) )
				return false;
			
			return true;
		}
		
	}
?>