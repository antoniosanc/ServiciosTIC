<?php



/**

 * ¿Qué hace la clase completa?

 *

 * @author Soluciones IM

 * @copyright junio 2016

*/ 

	include_once( URL_SERVIDOR_FRONT."/class/db.class.php");

	include_once( URL_SERVIDOR_FRONT."/class/generales.class.php");

	

	class base

	{

		

		function __construct( ) 

		{

			$this->db = new db();

			$this->generales = new generales();

		}

		

		

		/**

		 * ¿Qué hace la función?

		 * @return i¿Qué valor? ¿A dónde o donde se usa?

		*/

		function base_obten_datos_seo ( $seccion = "" )

		{

			if( empty($seccion) )

				return false;

			

			$sql = sprintf("SELECT 

								c.configuracion_nombre_empresa,

								c.configuracion_email_empresa,

								c.configuracion_url_empresa,

								c.configuracion_keyword_seo,

								c.configuracion_keywords_base,

								c.configuracion_descripcion_base,

								c.configuracion_codigo_analytics,

								c.configuracion_codigo_chat,

								c.configuracion_codigo_messenger,

								c.configuracion_recaptcha_publico,

								c.configuracion_recaptcha_privado,

								c.configuracion_translate

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

								c.contenido_btn_compartir,

								s.secciones_seccion_estatica,

								s.secciones_superior_id

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

			if( isset($arr_seccion[0]["configuracion_nombre_empresa"]) )

				$arr_head_seo["author"] = $arr_seccion[0]["configuracion_nombre_empresa"];

			



				$arr_head_seo["title"] = $arr_seccion[0]["configuracion_nombre_empresa"]. " | ".$arr_seccion[0]["configuracion_keyword_seo"] ;

			if( $seccion != "inicio"  )

				$arr_head_seo["title"] = $arr_seccion_interna[0]["contenido_titulo"];

			

			

			$arr_head_seo["description"] =  $arr_seccion[0]["configuracion_descripcion_base"];

			if( $seccion != "inicio"  )

				$arr_head_seo["description"] = $arr_seccion_interna[0]["contenido_descripcion"];

			

			

			$arr_keywords = explode(",", $this->generales->limpia_caracteres_to_ascii(  strtolower( $arr_seccion_interna[0]["contenido_palabras_clave"] )  ) );

			

			$arr_keywords_limpio = array();

			foreach( $arr_keywords as $keyword )

			{

				if( $keyword != "")

					$arr_keywords_limpio[] = ltrim( rtrim( $keyword) );

			}



			$arr_keywords_generales = explode(",",  strtolower( $arr_seccion[0]["configuracion_keywords_base"] ) );

			$arr_keywords_generales_limpio = array();

			foreach( $arr_keywords_generales as $keyword )

			{

				if( $keyword != "")

					$arr_keywords_generales_limpio[] = ltrim( rtrim( $keyword) );

			}



			$arr_combinado = array_unique ( array_merge( $arr_keywords_limpio, $arr_keywords_generales_limpio ) ) ;



			$numero_keywords = count($arr_combinado);

			$contador_keywords = 0;

			

			foreach ($arr_combinado as $keywords_para_cms)

			{

				if( !empty($keywords_para_cms) && strtolower($keywords_para_cms) != " ")

					$arr_head_seo["keywords"] .= $keywords_para_cms;

				

				if( $contador_keywords < ($numero_keywords-1) )

					$arr_head_seo["keywords"] .=  ", ";

				

				$contador_keywords++;

			}

			

			if( !empty($arr_seccion[0]["configuracion_codigo_analytics"]) )

				$arr_head_seo["analytics"] = $arr_seccion[0]["configuracion_codigo_analytics"];

			

			if( !empty($arr_seccion[0]["configuracion_keyword_seo"]) )

				$arr_head_seo["keyword_seo"] = $arr_seccion[0]["configuracion_keyword_seo"];

			

			if( !empty($arr_seccion[0]["configuracion_codigo_chat"]) )

				$arr_head_seo["chat"] = $arr_seccion[0]["configuracion_codigo_chat"];

			

			if( !empty($arr_seccion[0]["configuracion_recaptcha_publico"]) )

				$arr_head_seo["captcha_publico"] = $arr_seccion[0]["configuracion_recaptcha_publico"];

			

			if( !empty($arr_seccion[0]["configuracion_recaptcha_privado"]) )

				$arr_head_seo["captcha_privado"] = $arr_seccion[0]["configuracion_recaptcha_privado"];



			if( !empty($arr_seccion[0]["configuracion_codigo_messenger"]) )

				$arr_head_seo["fb_messenger"] = $arr_seccion[0]["configuracion_codigo_messenger"];

			

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

			$arr_head_seo["translate"] = $arr_seccion[0]["configuracion_translate"];

			$arr_head_seo["secciones_superior_id"] = $arr_seccion_interna[0]["secciones_superior_id"];

			

			if( isset($arr_seccion_interna[0]["secciones_seccion_estatica"]) )

				$arr_head_seo["es_seccion_estatica"] = intval($arr_seccion_interna[0]["secciones_seccion_estatica"]);

			else

				$arr_head_seo["es_seccion_estatica"] = 1;

			

			return $arr_head_seo;

		}

		

		function base_crea_menu_principal( $url_seccion = "" )

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

								s.secciones_muestra_header = 1

							AND 

								s.secciones_url != 'aviso_privacidad'

							AND

								s.secciones_url != 'terminos_uso'

							AND 

								s.secciones_url != 'mapa_sitio' 

							AND 

								s.secciones_url != 'mapa'

							AND 

								s.secciones_url NOT LIKE '%%columna%%'

							AND

								s.secciones_url NOT LIKE '%%acordeon%%' "

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

								s.secciones_muestra_footer = 1

							AND 

								s.secciones_url != 'aviso_privacidad'

							AND

								s.secciones_url != 'terminos_uso'

							AND 

								s.secciones_url != 'mapa_sitio' 

							AND 

								s.secciones_url != 'mapa'

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



			$menu_forma = '

			<nav class="navbar navbar-default hd-navbar" role="navigation">

				<div class="navbar-header">

					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> 

				</div>

				<div class="collapse navbar-collapse" id="navbar-collapse-1">

						<ul class="nav navbar-nav hd-nav">';

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

					if( $url_padre != "blog" )

						$menu_forma .= '<li><a href="index.php?q='.$url_padre.'" class="'.$mnu_hover.'"> '.ucfirst($padres["nombre"]).'</a></li>';

					else

						$menu_forma .= '<li><a href="blog/index.php" class="'.$mnu_hover.'"> '.ucfirst($padres["nombre"]).'</a></li>';

				}

				else

				{



					$menu_forma_hijo = ""; 

					

					

					if( $url_padre != "blog" )

						$menu_forma_hijo .= '<li class="dropdown"><a href="index.php?q='.$url_padre.'"  class="dropdown-toggle';

					else

						$menu_forma_hijo .= '<li class="dropdown"><a href="blog/index.php"  class="dropdown-toggle';



					$menu_forma_hijo_comp = '" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.ucfirst($padres["nombre"]).' <b class="caret"></b></a> 

									  <ul class="dropdown-menu">';

									  

					$mnu_hover = '';

					

					if( $url_seccion == $url_padre )

						$mnu_hover = ' mnuhover ';

						

					foreach (  $arr_secciones[$padres["id"]] as $hijos )

					{

						$url_hijos = $hijos["url"];

						$menu_forma_hijo_comp .= '<li><a href="index.php?q='.$url_hijos.'&n='.$url_padre.'">'.ucfirst($hijos["nombre"])."</a></li> 

													<li class='divider'></li>";



						if( $url_seccion == $url_hijos  || strtolower($_GET["n"]) == $url_hijos  )

							$mnu_hover = ' mnuhover ';

			

					}

					

					

					$menu_forma .= $menu_forma_hijo. $mnu_hover . $menu_forma_hijo_comp;

					$menu_forma .= '

					</ul>

					</li>';



				}

			}

			$menu_forma .= '</ul>

					</div>

				</nav>	';



			return $menu_forma;

		}

		

		function base_formatea_menu_footer ( $arr_secciones = 0 )

		{

			if( !is_array($arr_secciones) )

				return false;



			$menu_forma = '<ul class="nav navbar-nav ft-navbar">';

			//echo detalle($arr_secciones);

			foreach( $arr_secciones[0] as $padres )

			{

				$url_inicio = "inicio";

				if( strtolower($padres["nombre"]) != "inicio" )

					$url_inicio = $padres["url"];

			

				if( $url_inicio != "blog")

					$menu_forma .= '<li><a href="index.php?q='.$url_inicio.'">'.ucfirst($padres["nombre"]).'</a></li>';

				else

					$menu_forma .= '<li><a href="blog/index.php">'.ucfirst($padres["nombre"]).'</a></li>';

				

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

								gi.galerias_imagenes_descripcion,

								gi.galerias_imagenes_vigencia

							FROM 

								galerias_imagenes as gi

							WHERE 

								gi.galerias_id = 1

							AND 

								gi.galerias_imagenes_status = 1 

							AND 

								(

								gi.galerias_imagenes_vigencia > now() OR

								gi.galerias_imagenes_vigencia = '0000-00-00'

								)

							ORDER BY galerias_imagenes_id DESC ");

			

			if( !$arr_slide = $this->db->db_query( $sql, 1 ) )

				return false;

			

			$salida = '';

			

			if( is_array( $arr_slide) )

			{

				$salida .= '

							<div class="row">

									<div class="col-md-12" style="padding:0px;">

										<div class="carousel slide" id="carousel-440287"  data-ride="carousel">

											<!--ol class="carousel-indicators">';

											

											for( $i = 0; $i< count( $arr_slide ); $i++ )

											{

												$active = "";

												if($i == 0 )

													$active = 'class="active"';

													

												$salida .= '<li '.$active.' data-slide-to="'.$i.'" data-target="#carousel-440287"> </li>';

											}

											

									$salida .= '</ol-->

											<div class="carousel-inner">';

											

											$cont = 0;

											foreach( $arr_slide as $slide )

											{

												$active = "";

												if($cont == 0 )

													$active = 'active ';

												

												$salida .= '<div class="item '.$active.'" style="background:url('.$slide["galerias_imagenes_url_imagen"].') no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; min-height:700px;">';

																

																if( !empty($slide["galerias_imagenes_titulo"]) || !empty($slide["galerias_imagenes_descripcion"]) )

																	$salida .= '<div class="carousel-caption">';

																

																if( !empty($slide["galerias_imagenes_titulo"]) )

																	$salida .= '<h4>'.$slide["galerias_imagenes_titulo"].'</h4>';

																

																if( !empty($slide["galerias_imagenes_descripcion"]) )

																			$salida .= '<p>'.$slide["galerias_imagenes_descripcion"].'</p>

																						<p><a href="'.$slide["galerias_imagenes_url"].'" class="btn btn-massl">M&aacute;s Informaci&oacute;n</a> <a href="index.php?q=contacto" class="btn btn-massl">Cont&aacute;ctanos</a></p>

																		';

																		

																if( !empty($slide["galerias_imagenes_titulo"]) || !empty($slide["galerias_imagenes_descripcion"]) )

																	$salida .= '</div>';

																

												$salida .= '</div>';

												$cont++;

											}

												



								$salida .= '</div> 

											<a class="left carousel-control" href="#carousel-440287" data-slide="prev"><img src="./imgusr/sl-izq.png" class="img-responsive" border="0" alt="Izquierda"></a> 

											<a class="right carousel-control" href="#carousel-440287" data-slide="next"><img src="./imgusr/sl-der.png" class="img-responsive" border="0" alt="Izquierda"></span></a>

										</div>

									</div>

								</div>';

			}



			return $salida;

		}

		

		function base_lista_imagenes_galeria( $galeria_id = "" )

		{

			

			if( intval( $galeria_id) == 0 )

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

										gi.galerias_imagenes_status = 1 

									ORDER BY  

										gi.galerias_imagenes_id ASC",

					$this->db->db_evita_sql_injection( $galeria_id )

					);



			if( !$arr_archivos = $this->db->db_query( $sql_galeria, 1 ) )

				return false;

			

			return $arr_archivos;

		}

		

		function base_genera_mapa_sitio (  )

		{

		

			if( !$arr_secciones = $this->lista_arbol_secciones() )

				return false;

			



			$menu_forma = '<ul class="list-group">';

			

			foreach( $arr_secciones[0] as $padres )

			{

				$menu_forma .= '<li class="list-group-item"><a href="index.php?q='.$padres["url"].'" style="color:#B20A0A;"> &raquo; '.ucfirst($padres["titulo"])."</a></li>";



				if(is_array( $arr_secciones[$padres["id"]] ) )

				{

					foreach (  $arr_secciones[$padres["id"]] as $hijos )

					{



						$menu_forma .= '<li class="list-group-item"><a href="index.php?q='.$hijos["url"].'&n='.$padres["url"].'"  style="color:#273961;"> &nbsp; &nbsp; &nbsp;    &raquo;     &raquo;  &nbsp;'.ucfirst($hijos["titulo"])."</a></li>";

						

						if(is_array( $arr_secciones[$hijos["id"]] ) )

						{

							foreach (  $arr_secciones[$hijos["id"]] as $hijos2 )

							{

							

								$menu_forma .= '<li class="list-group-item"><a href="index.php?q='.$hijos2["url"].'&n='.$hijos["url"].'" style="color: #6AB5C5;"> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;    &raquo;     &raquo;     &raquo;  &nbsp;'.ucfirst($hijos2["titulo"])."</a></li>";

							}

						}

						

					}

				}

			}

			$menu_forma .= '</ul>';

			return $menu_forma;

		}

		

		function lista_arbol_secciones(   )

		{



			$sql = sprintf(" SELECT 

								s.secciones_id,

								s.secciones_nombre,

								s.secciones_url,

								s.secciones_superior_id,

								c.contenido_titulo

							FROM 

								secciones as s

							INNER JOIN

								contenido AS c USING (secciones_id)

							WHERE

								secciones_status = 1

							AND 

								s.secciones_muestra_header = 1

							AND 

								s.secciones_url != 'aviso_privacidad'

							AND

								s.secciones_url != 'terminos_uso'

							AND 

								s.secciones_url != 'mapa_sitio' 

							AND 

								s.secciones_url != 'mapa'

							AND 

								s.secciones_url NOT LIKE '%%columna%%'

							AND

								s.secciones_url NOT LIKE '%%acordeon%%' "

						);



			if( !$arr_secciones = $this->db->db_query( $sql, 1 ) )

				return false;



			$arr_menu_secciones = array();

			foreach( $arr_secciones as $secciones) 

			{

				$arr_menu_secciones[$secciones['secciones_superior_id']][$secciones['secciones_id']]['id'] = $secciones['secciones_id'];

				$arr_menu_secciones[$secciones['secciones_superior_id']][$secciones['secciones_id']]['titulo'] = $secciones['contenido_titulo'];

				$arr_menu_secciones[$secciones['secciones_superior_id']][$secciones['secciones_id']]['url'] = $secciones['secciones_url'];

			} 

			

			return $arr_menu_secciones;

		}

		

		

		function __destruct() 

		{

			unset($this->generales);

			unset($this->db);

		}

	

	}

?>



