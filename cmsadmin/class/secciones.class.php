<?php

	include_once( URL_SERVIDOR."/class/db.class.php");

	include_once( URL_SERVIDOR."/class/generales.class.php");

	

	class secciones

	{

		

		function __construct( ) 

		{

			$this->db = new db();

			$this->generales = new generales();

		}

		

		function secciones_lista_secciones(   )

		{



			$sql = sprintf(" SELECT 

								s.secciones_id,

								s.secciones_nombre,

								s.secciones_url,

								s.secciones_superior_id,

								s.secciones_descripcion

							FROM 

								secciones as s

							INNER JOIN contenido as c 

							USING (secciones_id)

							WHERE

								s.secciones_status = 1

							AND 

								c.contenido_status = 1"

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

		

		

		function secciones_arregla_menu_forma ( $arr_secciones = 0 )		

		{

			if( !is_array($arr_secciones) )

				return false;



			

			$seccion_para_editar_id = $this->generales->desencriptar($_GET["d"],"seccion");

			

			$menu_forma = "";

			foreach( $arr_secciones[0] as $padres )

			{

				$titulo_elemento = ucfirst($padres["nombre"]);

				

				$deshabilita_padre = "";

				if( $padres["id"] == $seccion_para_editar_id)

					$deshabilita_padre = ' disabled ';

				

				$padres_id = $padres["id"];

				if( strtolower($padres["nombre"]) == "inicio" )

				{

					$padres_id = 0;

					$titulo_elemento = "Inicio (Men&uacute; principal)";

					$deshabilita_padre = ' ';

				}

					

				$menu_forma .= "<option value='".$padres_id."' ".$deshabilita_padre.">&nbsp;".$titulo_elemento."</option>";

				

				if(is_array( $arr_secciones[$padres["id"]] ) )

				{

					foreach (  $arr_secciones[$padres["id"]] as $hijos )

					{

						$deshabilita_hijo = "";

						if( $hijos["id"] == $seccion_para_editar_id)

							$deshabilita_hijo = ' disabled ';

						

						$menu_forma .= "<option value='".$hijos["id"]."' ".$deshabilita_hijo.">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".ucfirst($hijos["nombre"])."</option>";

						

						if(is_array( $arr_secciones[$hijos["id"]] ) )

						{

							foreach (  $arr_secciones[$hijos["id"]] as $nietos )

							{

								$menu_forma .= "<option value='".$nietos["id"]."' disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".ucfirst($nietos["nombre"])."</option>";

							}

						}

						

					}

				}

			}

			

			return $menu_forma;

		}

		

		

		function secciones_arregla_menu_lista ( $arr_secciones = 0 )

		{

			if( !is_array($arr_secciones) )

				return false;



			$menu_forma = '<ul class="nav nav-pills nav-stacked ">';

			

			foreach( $arr_secciones[0] as $padres )

			{

				$url_inicio = "#";

				if( strtolower($padres["nombre"]) != "inicio" && strtolower($padres["nombre"]) != "contacto" && $_SESSION["permiso_secciones"] == 1)

					$url_inicio = 'index.php?q=secciones&d='.$this->generales->encriptar($padres["id"],"seccion");

			

				$menu_forma .= '<li class="bg-warning"><a href="'.$url_inicio.'"><small><i class="glyphicon glyphicon-pencil"></i></small> '.ucfirst($padres["nombre"])."</a></li>";



				if(is_array( $arr_secciones[$padres["id"]] ) )

				{

					foreach (  $arr_secciones[$padres["id"]] as $hijos )

					{

						$link_hijos = "#";

						if( $_SESSION["permiso_secciones"] == 1)

							$link_hijos = 'index.php?q=secciones&d='.$this->generales->encriptar($hijos["id"],"seccion");

							

						$menu_forma .= '<li><a href="'.$link_hijos.'">&nbsp;&nbsp;&nbsp;&nbsp; <small><i class="glyphicon glyphicon-pencil"></i></small> '.ucfirst($hijos["nombre"])."</a></li>";;

						

						if(is_array( $arr_secciones[$hijos["id"]] ) )

						{

							foreach (  $arr_secciones[$hijos["id"]] as $nietos )

							{

								$link_nietos = "#";

								if( $_SESSION["permiso_secciones"] == 1)

									$link_nietos = 'index.php?q=secciones&d='.$this->generales->encriptar($nietos["id"],"seccion");

							

								$menu_forma .= '<li><a href="'.$link_nietos.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><i class="glyphicon glyphicon-pencil"></i></small> &nbsp;'.ucfirst($nietos["nombre"])."</a></li>";

							}

						}

						

					}

				}

			}

			$menu_forma .= '</ul>';

			return $menu_forma;

		}

		

		

		function secciones_agrega_seccion ( $datos = "" )

		{

			

			if(!is_array($datos) )

				return false;

			

			if(	intval($_SESSION["uid"]) <= 0 ) //Verifico que este logueado el usuario

					return false;



			if( empty( $datos["nombre_seccion"] )  && strlen(  $datos["nombre_seccion"] ) < 3  )

				return false;

					

			if( empty( $datos["nombre_url"] ) )

				$url_seccion = $this->generales->prepara_cadena_enlace( trim( $datos["nombre_seccion"] ) );

			else

				$url_seccion = $this->generales->prepara_cadena_enlace( trim( str_replace("_"," ", str_replace("-"," ",$datos["nombre_url"]) ) ) );

			

			$sql_select = sprintf(" SELECT 

											s.secciones_url

										FROM 

											secciones as s

										WHERE

											s.secciones_status = 1

										AND

											LOWER(s.secciones_url) = '%s'",

										$this->db->db_evita_sql_injection( strtolower( $url_seccion ) )

									);



			if( $arr_secciones = $this->db->db_query( $sql_select, 1 ) ) // Si ya existe la sección impido su creación

				return false;

			

			$es_estatica = 0;

			if( strtolower($datos["seccion_estatica"]) == "on" || intval($datos["seccion_estatica"]) == 1)

				$es_estatica = 1;

			

			if( $url_seccion == "contacto")

				$es_estatica = 1;

			

			$muestra_header = 0;

			if( strtolower($datos["seccion_muestra_header"]) == "on" || intval($datos["seccion_muestra_header"]) == 1)

				$muestra_header = 1;

			

			$muestra_footer = 0;

			if( strtolower($datos["seccion_muestra_footer"]) == "on" || intval($datos["seccion_muestra_footer"]) == 1)

				$muestra_footer = 1;

			

			$nombre_seccion = $this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii(  trim( $datos["nombre_seccion"] ) ) )  ;

			//$descripcion_seccion = $this->db->db_evita_sql_injection( $this->generales->limpia_caracteres_to_ascii(  $datos["descripcion_seccion"] ) ) ;

			

			$sql = sprintf("INSERT INTO secciones( secciones_nombre, secciones_url, secciones_superior_id, secciones_descripcion, 

								secciones_fecha, usuarios_id, secciones_muestra_header, secciones_muestra_footer, secciones_seccion_estatica, secciones_status )

								VALUES ( '%s', '%s', %d, '%s', '%s', %d, %d, %d, %d, 1)",

								ucfirst($nombre_seccion),

								$url_seccion,

								intval($datos["categoriasuperiorseccion"]),

								ucfirst($nombre_seccion),

								$this->generales->hoy(),

								$_SESSION["uid"],

								$muestra_header,

								$muestra_footer,

								intval( $es_estatica )

							);



			if(!$secciones_id = $this->db->db_query( $sql, 2 ) ) // Si no se agrega la sección impido crear su área de contenido

					return false;

				

			if(intval($secciones_id) <= 0)

				return false;

			

			

			$palabras_clave_prueba = ucfirst($nombre_seccion).", ".NOMBRE_SITIO;

			$contenido_prueba = '<h2>Secci&oacute;n en construcci&oacute;n</h2>

			<p>Esta secci&oacute;n se encuentra en construcci&oacute;n.</p>';

			

			$sql_contenido = sprintf("INSERT INTO contenido( contenido_titulo, contenido_descripcion, contenido_contenido, contenido_btn_compartir, contenido_palabras_clave, secciones_id,  contenido_fecha_modificacion, contenido_status) 

										VALUES ('%s','%s','%s',0, '%s', %d,'%s',1) ",

										ucfirst($nombre_seccion),

										ucfirst($nombre_seccion),

										$contenido_prueba,

										$palabras_clave_prueba,

										$secciones_id,

										$this->generales->hoy()

										);

			if($secciones_id = $this->db->db_query( $sql_contenido, 2 ) ) 

				if( $this->secciones_genera_sitemap() )

					return $secciones_id;

					

			return false;

		}

		

		function secciones_edita_seccion ( $datos = "" )

		{

			if(!is_array($datos) )

				return false;



			if(	intval($_SESSION["uid"]) <= 0 )

					return false;

					

			$seccion_editar_id = $this->generales->desencriptar($datos["seid"],"seccion");

			if( intval($seccion_editar_id) == 0)

				return false;

			

			$nombre_seccion = $this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii(  $datos["nombre_seccion"]) )  ;

			//$descripcion_seccion = $this->db->db_evita_sql_injection( $this->generales->limpia_caracteres_to_ascii(  $datos["descripcion_seccion"] ) ) ;

			

			if( empty( $datos["nombre_url"] ) )

				$url_seccion = $this->generales->prepara_cadena_enlace( trim( $datos["nombre_seccion"] ) );

			else

				$url_seccion = $this->generales->prepara_cadena_enlace( trim( str_replace("_"," ", str_replace("-"," ",$datos["nombre_url"]) ) ) );

			

			$es_estatica = 0;

			if( strtolower($datos["seccion_estatica"]) == "on" || intval($datos["seccion_estatica"]) == 1)

				$es_estatica = 1;

			

			$muestra_header = 0;

			if( strtolower($datos["seccion_muestra_header"]) == "on" || intval($datos["seccion_muestra_header"]) == 1)

				$muestra_header = 1;

			

			$muestra_footer = 0;

			if( strtolower($datos["seccion_muestra_footer"]) == "on" || intval($datos["seccion_muestra_footer"]) == 1)

				$muestra_footer = 1;

			

			$sql = sprintf("UPDATE secciones 

							SET secciones_nombre= '%s', secciones_url = '%s', secciones_superior_id= %d, secciones_descripcion = '%s', secciones_fecha = '%s', usuarios_id = %d, secciones_muestra_header = %d, secciones_muestra_footer = %d, secciones_seccion_estatica = %d, secciones_status = 1

							WHERE

								secciones_id = %d;",

								ucfirst($nombre_seccion),

								$url_seccion,

								intval($datos["categoriasuperiorseccion"]),

								ucfirst($nombre_seccion),

								$this->generales->hoy(),

								$_SESSION["uid"],

								$muestra_header,

								$muestra_footer,

								$es_estatica,

								$seccion_editar_id

							);



			/*if( intval($es_estatica) == 1) //Para escribir el archivo en caso de seleccionar seccion estatica

			{

				$nombre_archivo_seccion = URL_SECCION_ESTATICA."template/secciones/".$url_seccion.".php";

				chmod( URL_SECCION_ESTATICA."template/secciones", 0777);  

				if($archivo_seccion = fopen($nombre_archivo_seccion, "a"))

				{

					fputs($archivo_seccion,'<?=$contenido->contenido_obten_contenido_full_nombre("'.$url_seccion.'") ?>');

					fputs($archivo_seccion,"\n");

					fclose($archivo_seccion);

				}

			}*/

			

			

			if( $resultado = $this->db->db_query( $sql, 3 ) )

				if( $this->secciones_genera_sitemap() )

					return true;



				

			

			return false;

		}

		

		function secciones_elimina_seccion ( $id = 0 )

		{

			$seccion_eliminar_id = $this->generales->desencriptar($id,"seccion");

			

			if(intval($seccion_eliminar_id) <= 1 )

				return false;



			if(	intval($_SESSION["uid"]) <= 0 )

					return false;

			

			$sql = sprintf("UPDATE secciones 

							SET secciones_status = 0, secciones_fecha = '%s'

							WHERE

								secciones_id = %d;",

								$this->generales->hoy(),

								$seccion_eliminar_id

							);



			if(!$resultado = $this->db->db_query( $sql, 3 ) )

				return false;

				

			$sql_hijos = sprintf("UPDATE secciones 

							SET secciones_superior_id = 0

							WHERE

								secciones_superior_id = %d;",

								$seccion_eliminar_id

							);



			if(!$resultado = $this->db->db_query( $sql_hijos, 3 ) )

				return false;

				

			$sql_contenido = sprintf("UPDATE contenido 

							SET contenido_status= 0

							WHERE

								secciones_id = %d;",

								$seccion_eliminar_id

							);



			if($resultado = $this->db->db_query( $sql_contenido, 3 ) )

				if( $this->secciones_genera_sitemap() )

					return true;



			return false;

		}

		

		function secciones_busca_seccion_id ( $seccion_id = 0 )

		{

			if( intval($seccion_id) <= 1 ) //Para que no editen la sección de Inicio

				return false;

				

			$sql = sprintf("SELECT 

								s.secciones_id,

								s.secciones_nombre,

								s.secciones_url,

								s.secciones_superior_id,

								s.secciones_descripcion,

								s.secciones_seccion_estatica,

								s.secciones_muestra_header,

								s.secciones_muestra_footer

							FROM

								secciones as s

							INNER JOIN contenido as c 

							USING (secciones_id)

							WHERE

								s.secciones_id = %d

							AND

								s.secciones_status = 1

							AND 

								c.contenido_status = 1",

							intval($seccion_id) 

						);

			

			if( !$arr_seccion = $this->db->db_query( $sql, 1 ) )

				return false;



			return $arr_seccion;

		}

		

		function secciones_busca_seccion_superior_id ( $seccion_superior_id = 0 )

		{



			if( intval($seccion_superior_id) <= 1 ) //Para que no editen la sección de Inicio

				return false;

				

			$sql = sprintf("SELECT 

								s.secciones_id,

								s.secciones_nombre

							FROM

								secciones as s

							INNER JOIN contenido as c 

							USING (secciones_id)

							WHERE

								s.secciones_id = %d

							AND

								s.secciones_status = 1

							AND 

								c.contenido_status = 1",

							intval($seccion_superior_id) 

						);



			if( !$arr_seccion_superior = $this->db->db_query( $sql, 1 ) )

				return false;



			return $arr_seccion_superior;

		}	

	

		

		function secciones_genera_sitemap()

		{



			$sql_select = sprintf("SELECT

									s.secciones_url,

									s.secciones_superior_id,

									s.secciones_fecha

								FROM 

									secciones as s

								INNER JOIN contenido as c 

									USING (secciones_id)

								WHERE

									s.secciones_status = 1

								AND 

									c.contenido_status = 1");



			if(!$arr_secciones = $this->db->db_query( $sql_select, 1 ) )

				return false;



			

			$sql_configuracion = sprintf("SELECT 

											c.configuracion_url_empresa

										FROM

											configuracion as c

										WHERE 

											c.configuracion_id = 1");

			

			if(!$arr_url_dominio = $this->db->db_query( $sql_configuracion, 1 ) )

				return false;



			$sitemap = '';

			$sitemap .= '<?xml version="1.0" encoding="UTF-8"?>

						<urlset

							xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"

							xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"

							xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9

							http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

							<!-- Sitemap creado por Soluciones IM www.solucionesim.net-->

							<url>

								<loc>'.$arr_url_dominio[0]['configuracion_url_empresa'].'</loc>

								<changefreq>weekly</changefreq>

								<priority>1.00</priority>

							</url>

							<url>

								<loc>'.$arr_url_dominio[0]['configuracion_url_empresa'].'/index.php</loc>

								<changefreq>weekly</changefreq>

								<priority>1.00</priority>

							</url>';

			

			foreach( $arr_secciones as $secciones )

			{

				$prioridad = $this->secciones_calcula_prioridad_seccion( $secciones["secciones_url"] );

				

				$url_padre = "";

				if( intval($secciones["secciones_superior_id"]) != 0 )

				{

					

					$sql_select_padre = sprintf("SELECT

									s.secciones_url,

									s.secciones_superior_id,

									s.secciones_fecha

								FROM 

									secciones as s

								INNER JOIN contenido as c 

									USING (secciones_id)

								WHERE

									s.secciones_status = 1

								AND 

									c.contenido_status = 1

								AND 

									s.secciones_id = %d",

								intval($secciones["secciones_superior_id"])

							);



					$arr_secciones_padre = $this->db->db_query( $sql_select_padre, 1 );

					

					

					$url_padre = '&amp;n='.$arr_secciones_padre[0]["secciones_url"];

				}

				

				if( $secciones["secciones_url"] == "blog")

				{

					$sitemap .=  '<url>

								<loc>'.$arr_url_dominio[0]['configuracion_url_empresa'].'/blog/index.php</loc>

								<changefreq>monthly</changefreq>

								<priority>'.$prioridad.'</priority>

							</url>';

				}

				else

				{

					$sitemap .=  '<url>

								<loc>'.$arr_url_dominio[0]['configuracion_url_empresa'].'/index.php?q='.$secciones["secciones_url"].$url_padre.'</loc>

								<changefreq>monthly</changefreq>

								<priority>'.$prioridad.'</priority>

							</url>';

				}

			}

			

			$sitemap.= '</urlset> ';

			

			if ($fp=fopen(URL_SITEMAP."/sitemap.xml","w+"))

			{

					fwrite ($fp,$sitemap);

					return true;

			}

			else

			{

				return false;

			}

			

			return false;

		}

		

		function secciones_calcula_prioridad_seccion ( $seccion = "" )

		{

			if($seccion == "")

				return false;

			



			switch( strtolower($seccion) )

			{

				case "inicio":

					$prioridad = "1.00";

				break;

				case "quienes_somos":

				case "acerca_de":

				case "mision":

				case "about_us":

				case "nosotros":

				case "conocenos":

					$prioridad = "0.60";

				break;

				case "servicios":

				case "productos":

				case "servicio":

				case "producto":

				case "cotiza":

				case "cotizador":

					$prioridad = "0.90";

				break;

				case "galeria":

				case "galerias":

				case "galerias":

				case "portafolio":

				case "cliente":

				case "clientes":

					$prioridad = "0.70";

				break;

				case "contacto":

				case "directorio":

				case "mapa_ubicacion":

				case "directorio_contacto":

					$prioridad = "0.60";

				break;

				default:

					$prioridad = "0.85";

				break;

			}



				return $prioridad;

			

		}

		

		function secciones_muestra_secciones_desactivadas()

		{



			$sql = sprintf(" SELECT 

								s.secciones_id,

								s.secciones_nombre,

								s.secciones_url,

								s.secciones_fecha,

								c.contenido_descripcion

							FROM 

								secciones as s

							INNER JOIN contenido as c 

							USING (secciones_id)

							WHERE

								s.secciones_status = 0

							AND 

								c.contenido_status = 0"

						);



			if( !$arr_secciones_desactivadas = $this->db->db_query( $sql, 1 ) )

				return false;

			

			return $arr_secciones_desactivadas;

		}

		

		function secciones_restaura_seccion( $seccion_id = "" )

		{

			

			if( empty($seccion_id) || $seccion_id == "" )

				return false;

			

			$seccion_restaurar_id = $this->generales->desencriptar($seccion_id,"restaurar");

			if( intval($seccion_restaurar_id) == 0 )

				return false;



			//Verifico que la sección esté inactiva

			$sql_verifica = sprintf(" SELECT 

										s.secciones_url,

										s.secciones_nombre,

										c.contenido_titulo

									FROM 

										secciones as s

									INNER JOIN contenido as c 

									USING (secciones_id)

									WHERE

										s.secciones_status = 0

									AND 

										c.contenido_status = 0

									AND 

										s.secciones_id = %d",

									$seccion_restaurar_id

								);



			if( !$arr_secciones_desactivadas = $this->db->db_query( $sql_verifica, 1 ) )

				return false;

			

			

			//Busco que no exista otra seccion con la misma URL 

			$sql_busca_seccion = sprintf(" SELECT 

												s.secciones_id

											FROM 

												secciones as s

											INNER JOIN contenido as c 

											USING (secciones_id)

											WHERE

												s.secciones_status = 1

											AND 

												c.contenido_status = 1

											AND 

												s.secciones_url = '%s'",

											$arr_secciones_desactivadas[0]["secciones_url"]

										);

			

			$arr_secciones_encontradas = $this->db->db_query( $sql_busca_seccion, 1 );

			

			if( $arr_secciones_encontradas[0]["secciones_id"] > 1 ) //Si existe una sección con la misma URL

			{

				$secciones_url = $arr_secciones_desactivadas[0]["secciones_url"]."_recuperado";

				$secciones_nombre = $arr_secciones_desactivadas[0]["secciones_nombre"]." (recuperado)";

				$contenido_titulo = $arr_secciones_desactivadas[0]["contenido_titulo"]." (recuperado)";

			}

			else

			{

				$secciones_url = $arr_secciones_desactivadas[0]["secciones_url"];

				$secciones_nombre = $arr_secciones_desactivadas[0]["secciones_nombre"];

				$contenido_titulo = $arr_secciones_desactivadas[0]["contenido_titulo"];

			}

			



			$sql = sprintf("UPDATE secciones 

							SET secciones_status = 1, secciones_fecha = '%s', secciones_url = '%s', secciones_nombre = '%s'

							WHERE

							secciones_id = %d",

							$this->generales->hoy(),

							$secciones_url,

							$secciones_nombre,

							$seccion_restaurar_id

						);

			

			if(!$resultado = $this->db->db_query( $sql, 3 ) )

				return false;

			

			$sql_contenidos = sprintf("UPDATE contenido 

							SET contenido_status= 1, contenido_titulo = '%s'

							WHERE

								secciones_id = %d",

							$contenido_titulo,

							$seccion_restaurar_id

						);

			

			if(!$resultado_c = $this->db->db_query( $sql_contenidos, 3 ) )

				return false;

			

			return $secciones_url;

		}

		



	}



?>