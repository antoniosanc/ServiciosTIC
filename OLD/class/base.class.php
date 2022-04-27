<?
	include_once( URL_SERVIDOR_FRONT."/class/db.class.php");
	include_once( URL_SERVIDOR_FRONT."/class/generales.class.php");
	
	class base
	{
		
		function __construct( ) 
		{
			$this->db = new db();
			$this->generales = new generales();
		}
		
		function base_obten_datos_seo ( $seccion = "" )
		{
			if( empty($seccion) )
				return false;
			
			$sql = sprintf("SELECT 
								c.configuracion_nombre_empresa,
								c.configuracion_email_empresa,
								c.configuracion_url_empresa,
								c.configuracion_keywords_base,
								c.configuracion_descripcion_base,
								c.configuracion_codigo_analytics 	
							FROM
								configuracion as c
							WHERE
								c.configuracion_status = 1
							AND
								c.configuracion_id = 1");
			
			if( !$arr_seccion = $this->db->db_query( $sql, 1 ) )
					return false;
			
			if( strtolower($seccion) != "inicio" )
			{
				$sql_interna = sprintf("SELECT 
								c.contenido_palabras_clave,
								c.contenido_titulo,
								c.contenido_descripcion,
								c.contenido_imagen,
								c.contenido_btn_compartir
								FROM
									contenido AS c
								INNER JOIN
									secciones AS s
								USING (secciones_id)
								WHERE
									s.secciones_url = '%s'
								AND
									s.secciones_status = 1
								AND 
									c.contenido_status = 1",
							$this->db->db_evita_sql_injection( $seccion )
							);

				$arr_seccion_interna = $this->db->db_query( $sql_interna, 1 );
			}

			$arr_head_seo = array();
			
			$arr_head_seo["author"] = NOMBRE_SITIO;
			if( !empty($arr_seccion[0]["configuracion_nombre_empresa"]) )
				$arr_head_seo["author"] = $arr_seccion[0]["configuracion_nombre_empresa"];
			
			$arr_head_seo["title"] = "Bienvenido";
			if( !empty($arr_seccion_interna[0]["contenido_titulo"]) )
				$arr_head_seo["title"] = $arr_seccion_interna[0]["contenido_titulo"];
			
			$arr_head_seo["description"] =  $arr_seccion[0]["configuracion_descripcion_base"];
			if( !empty($arr_seccion_interna[0]["contenido_descripcion"]) )
				$arr_head_seo["description"] = $arr_seccion_interna[0]["contenido_descripcion"];
			
			$arr_head_seo["keywords"] =  $arr_seccion[0]["configuracion_keywords_base"];
			if( !empty($arr_seccion_interna[0]["contenido_palabras_clave"]) )
				$arr_head_seo["keywords"] = $arr_seccion_interna[0]["contenido_palabras_clave"];
			
			if( !empty($arr_seccion[0]["configuracion_codigo_analytics"]) )
				$arr_head_seo["analytics"] = $arr_seccion[0]["configuracion_codigo_analytics"];
			
			$url_sitio = $this->generales->obtener_dominio();
			if( !empty($arr_seccion[0]["configuracion_url_empresa"]) )
				$arr_head_seo["url_sitio"] = $arr_seccion[0]["configuracion_url_empresa"];
			
			$arr_head_seo["url_sitio"] = str_replace("https://www.", "", $arr_head_seo["url_sitio"]);
			$arr_head_seo["url_sitio"] = str_replace("http://www.", "", $arr_head_seo["url_sitio"]);
			$arr_head_seo["url_sitio"] = str_replace("https://", "", $arr_head_seo["url_sitio"]);
			$arr_head_seo["url_sitio"] = str_replace("http://", "", $arr_head_seo["url_sitio"]);
			$arr_head_seo["url_sitio"] = str_replace("www.", "", $arr_head_seo["url_sitio"]);
			
			$arr_head_seo["btn_compartir"] = intval($arr_seccion_interna[0]["contenido_btn_compartir"]);
			
			$arr_head_seo["imagen_destacada"] = $arr_seccion_interna[0]["contenido_imagen"];
			
			return $arr_head_seo;
		}
		
		
		function base_crea_menu_secciones( $url_seccion = "" )
		{

			if( empty($url_seccion) )
				$url_seccion = "inicio";
			
			$sql = sprintf(" SELECT 
								s.secciones_id,
								s.secciones_nombre,
								s.secciones_url,
								s.secciones_superior_id,
								s.secciones_descripcion
							FROM 
								secciones as s
							WHERE
								secciones_status = 1
							AND 
								s.secciones_url != 'aviso_privacidad'
							AND
								s.secciones_url != 'terminos_uso'
							AND 
								s.secciones_url != 'mapa_sitio' 
							AND 
								s.secciones_url != 'mapa' 
							AND 
								s.secciones_url != 'ventajas_competitivas'
							AND 
								s.secciones_url != 'logros'
							AND 
								s.secciones_url != 'solicita_soporte_tecnico'
							AND 
								s.secciones_url NOT LIKE '%%columna%%'
							AND
								s.secciones_url NOT LIKE '%%acordeon%%'"
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
			
			if( $html_menu = $this->base_formatea_menu ( $arr_menu_secciones, $url_seccion ) )  
			return $html_menu;
		}
		
		function base_crea_menu_footer( )
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
								secciones_status = 1
							AND 
								s.secciones_url != 'aviso_privacidad'
							AND
								s.secciones_url != 'terminos_uso'
							AND 
								s.secciones_url != 'mapa_sitio' 
							AND 
								s.secciones_url != 'mapa' 
							AND 
								s.secciones_url != 'ventajas_competitivas'
							AND 
								s.secciones_url != 'logros'
							AND 
								s.secciones_url NOT LIKE '%%columna%%'
							AND
								s.secciones_url NOT LIKE '%%acordeon%%'"
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
			
			if( $html_menu = $this->base_formatea_menu_footer ( $arr_menu_secciones) )  
			return $html_menu;
		}
		
		function base_formatea_menu ( $arr_secciones = 0,  $url_seccion = "inicio" )
		{
			if( !is_array($arr_secciones) )
				return false;

			$menu_forma = '<ul class="nav navbar-nav">';
			//echo detalle($arr_secciones);
			foreach( $arr_secciones[0] as $padres )
			{
				$url_padre = "inicio";
				if( strtolower($padres["nombre"]) != "inicio" )
					$url_padre = $padres["url"];
			
				$mnu_hover = '';
				if( $url_seccion == $url_padre )
					$mnu_hover = ' mnuhover ';
			
				if( !is_array( $arr_secciones[ $padres["id"] ]) ) // Si no tiene hijos
				{
					$menu_forma .= '<li><a href="index.php?q='.$url_padre.'" class="'.$mnu_hover.'"> '.ucfirst($padres["nombre"]).'</a></li>';
				}
				else
				{

					$menu_forma_hijo = ""; 
					$menu_forma_hijo .= '<li class="dropdown">
									  <a href="index.php?q='.$url_padre.'"  class="dropdown-toggle';

					$menu_forma_hijo_comp = '">'.ucfirst($padres["nombre"]).' <b class="caret"></b></a> 
									  <ul class="dropdown-menu">';
									  
					$mnu_hover = '';
					
					if( $url_seccion == $url_padre )
						$mnu_hover = ' mnuhover ';
						
					foreach (  $arr_secciones[$padres["id"]] as $hijos )
					{
						$url_hijos = $hijos["url"];
						$menu_forma_hijo_comp .= '<li><a href="index.php?q='.$url_hijos.'&n='.$url_padre.'">'.ucfirst($hijos["nombre"])."</a></li> <li class='divider'></li>";

						if( $url_seccion == $url_hijos  || strtolower($_GET["n"]) == $url_hijos  )
							$mnu_hover = ' mnuhover ';
			
					}
					
					
					$menu_forma .= $menu_forma_hijo. $mnu_hover . $menu_forma_hijo_comp;
					$menu_forma .= '
					</ul>
					</li>';

				}
			}
			$menu_forma .= '</ul>';
			return $menu_forma;
		}
		
		function base_formatea_menu_footer ( $arr_secciones = 0 )
		{
			if( !is_array($arr_secciones) )
				return false;

			$menu_forma = '<ul class="nav navbar-nav">';
			//echo detalle($arr_secciones);
			foreach( $arr_secciones[0] as $padres )
			{
				$url_inicio = "inicio";
				if( strtolower($padres["nombre"]) != "inicio" )
					$url_inicio = $padres["url"];
			
				$menu_forma .= '<li><a href="index.php?q='.$url_inicio.'">'.ucfirst($padres["nombre"]).'</a></li>';
				
			}
			$menu_forma .= '</ul>';
			return $menu_forma;
		}
		
		
		function base_crea_slide_home()
		{
			$sql = sprintf("SELECT 
								gi.galerias_imagenes_id,
								gi.galerias_imagenes_url_imagen,
								gi.galerias_imagenes_url,
								gi.galerias_imagenes_titulo,
								gi.galerias_imagenes_descripcion
							FROM 
								galerias_imagenes as gi
							WHERE 
								gi.galerias_id = 1
							AND 
								gi.galerias_imagenes_status = 1 ");
			
			if( !$arr_slide = $this->db->db_query( $sql, 1 ) )
				return false;
			
			$salida = '';
			
			if( is_array( $arr_slide) )
			{
				$salida .= '
										<div class="carousel slide" id="carousel-440287"  data-ride="carousel">
											<ol class="carousel-indicators">';
											
											for( $i = 0; $i< count( $arr_slide ); $i++ )
											{
												$active = "";
												if($i == 0 )
													$active = 'class="active"';
													
												$salida .= '<li '.$active.' data-slide-to="'.$i.'" data-target="#carousel-440287"> </li>';
											}
											
									$salida .= '</ol>
											<div class="carousel-inner">';
											
											$cont = 0;
											foreach( $arr_slide as $slide )
											{
												$active = "";
												if($cont == 0 )
													$active = 'active ';
												
												$salida .= '<div class="item '.$active.'">
																<p style="text-align:center; margin:0;"> 
																	<a  href="'.$slide["galerias_imagenes_url"].'"><img alt="'.$slide["galerias_imagenes_titulo"].'" src="'.$slide["galerias_imagenes_url_imagen"].'" class="img-responsiva"/></a>
																</p>';
																
																if( !empty($slide["galerias_imagenes_titulo"]) || !empty($slide["galerias_imagenes_descripcion"]) )
																	$salida .= '<div class="carousel-caption">';
																
																if( !empty($slide["galerias_imagenes_titulo"]) )
																	$salida .= '<h4>'.$slide["galerias_imagenes_titulo"].'</h4>';
																
																if( !empty($slide["galerias_imagenes_descripcion"]) )
																			$salida .= '<p>'.$slide["galerias_imagenes_descripcion"].'</p>';
																		
																if( !empty($slide["galerias_imagenes_titulo"]) || !empty($slide["galerias_imagenes_descripcion"]) )
																	$salida .= '</div>';
																
												$salida .= '</div>';
												$cont++;
											}
												

									$salida .= '</div> <a class="left carousel-control" href="#carousel-440287" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-440287" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
										</div>';
			}
			
			return $salida;
		}
		
		function base_lista_imagenes_galeria( $url_seccion = "" )
		{
			
			if( empty( $url_seccion) )
				return false;
			
			$sql = sprintf("SELECT 
								g.galerias_id
							FROM 
								galerias as g
							INNER JOIN 
								secciones as s USING ( secciones_id )
							WHERE 
								g.galerias_status = 1
							AND 
								s.secciones_status = 1
							AND 
								s.secciones_url = '%s'",
					$this->db->db_evita_sql_injection( $url_seccion )
					);
				
			if( !$arr_galeria = $this->db->db_query( $sql, 1 ) )
				return false;
			
			$sql_galeria = sprintf("SELECT 
										gi.galerias_imagenes_id,
										gi.galerias_imagenes_url_imagen,
										gi.galerias_imagenes_url,
										gi.galerias_imagenes_titulo,
										gi.galerias_imagenes_descripcion
									FROM 
										galerias_imagenes as gi
									WHERE 
										gi.galerias_id = %d
									AND 
										gi.galerias_imagenes_status = 1 ",
					$this->db->db_evita_sql_injection( $arr_galeria[0]["galerias_id"] )
					);

			if( !$arr_archivos = $this->db->db_query( $sql_galeria, 1 ) )
				return false;
			
			return $arr_archivos;
		}
	}
?>

