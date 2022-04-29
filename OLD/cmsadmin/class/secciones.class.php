<?
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
		
		
		function secciones_arregla_menu_forma ( $arr_secciones = 0 )		
		{
			if( !is_array($arr_secciones) )
				return false;

			$menu_forma = "";
			foreach( $arr_secciones[0] as $padres )
			{
				$valor_elemento_padre = $padres["id"];
				if( strtolower($padres["nombre"]) == "inicio" )
					$valor_elemento_padre = 0;
					
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
								$menu_forma .= "<option value='".$hijos2["id"]."' disabled> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;--- &nbsp;".ucfirst($hijos2["nombre"])."</option>";
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

			$menu_forma = '<ul class="nav nav-list">';
			
			foreach( $arr_secciones[0] as $padres )
			{
				$url_inicio = "#";
				if( strtolower($padres["nombre"]) != "inicio" && $_SESSION["permiso_secciones"] == 1)
					$url_inicio = 'index.php?q=secciones&d='.$this->generales->encriptar($padres["id"],"seccion");
			
				$menu_forma .= '<li class="active"><a href="'.$url_inicio.'">'.ucfirst($padres["nombre"])."</a></li>";

				if(is_array( $arr_secciones[$padres["id"]] ) )
				{
					foreach (  $arr_secciones[$padres["id"]] as $hijos )
					{
						$link_hijos = "#";
						if( $_SESSION["permiso_secciones"] == 1)
							$link_hijos = 'index.php?q=secciones&d='.$this->generales->encriptar($hijos["id"],"seccion");
							
						$menu_forma .= '<li><a href="'.$link_hijos.'"> &nbsp; &nbsp; &nbsp;-- &nbsp;'.ucfirst($hijos["nombre"])."</a></li>";;
						
						if(is_array( $arr_secciones[$hijos["id"]] ) )
						{
							foreach (  $arr_secciones[$hijos["id"]] as $hijos2 )
							{
								$link_hijos2 = "#";
								if( $_SESSION["permiso_secciones"] == 1)
									$link_hijos2 = 'index.php?q=secciones&d='.$this->generales->encriptar($hijos2["id"],"seccion");
							
								$menu_forma .= '<li><a href="'.$link_hijos2.'"> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;--- &nbsp;'.ucfirst($hijos2["nombre"])."</a></li>";
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
			
			$url_seccion = $this->generales->prepara_cadena_enlace( $datos["nombre_seccion"] );
			
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
			
			$nombre_seccion = $this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii(  $datos["nombre_seccion"]) )  ;
			$descripcion_seccion = $this->db->db_evita_sql_injection( $this->generales->limpia_caracteres_to_ascii(  $datos["descripcion_seccion"] ) ) ;
			
			
			$sql = sprintf("INSERT INTO secciones( secciones_nombre, secciones_url, secciones_superior_id, secciones_descripcion, 
								secciones_fecha, usuarios_id, secciones_status )
								VALUES ( '%s', '%s', '%s', '%s', '%s', '%s', 1)",
								ucfirst($nombre_seccion),
								$url_seccion,
								intval($datos["categoriasuperiorseccion"]),
								ucfirst($descripcion_seccion),
								$this->generales->hoy(),
								$_SESSION["uid"]
								);
				
			if(!$secciones_id = $this->db->db_query( $sql, 2 ) ) // Si no se agrega la sección impido crear su área de contenido
					return false;
		
			if(intval($secciones_id) <= 0)
				return false;
			
			$contenido_prueba = '<p>Y, vi&eacute;ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: S&aacute;bete, Sancho, que no es un hombre m&aacute;s que otro si no hace m&aacute;s que otro.</p>
			<p>Todas estas borrascas que nos suceden son se&ntilde;ales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aqu&iacute; se sigue que, habiendo durado mucho el mal, el bien est&aacute; ya cerca.</p>
			<h2>El gran quijote</h2>
			<p>As&iacute; que, no debes congojarte por las desgracias que a m&iacute; me suceden, pues a ti no te cabe parte dellas. Y, vi&eacute;ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: S&aacute;bete, Sancho, que no es un hombre m&aacute;s que otro si no hace m&aacute;s que otro.</p>
			<p align="right"><strong> Don Quijote </strong> </p>';
			
			$sql_contenido = sprintf("INSERT INTO contenido( contenido_titulo, contenido_descripcion, contenido_contenido, contenido_btn_compartir, contenido_palabras_clave, secciones_id,  contenido_fecha_modificacion, contenido_status) 
										VALUES ('%s','%s','%s',0, '%s', %d,'%s',1) ",
										ucfirst($nombre_seccion),
										ucfirst($nombre_seccion),
										$contenido_prueba,
										ucfirst($nombre_seccion),
										$secciones_id,
										$this->generales->hoy()
										);
			
			if($secciones_id = $this->db->db_query( $sql_contenido, 2 ) ) 
				if( $this->secciones_genera_sitemap() )
					return true;
					
			return false;
		}
		
		function secciones_edita_seccion ( $datos = "" )
		{
			if(!is_array($datos) )
				return false;

			if(	intval($_SESSION["uid"]) <= 0 )
					return false;
					
			$seccion_editar_id = $this->generales->desencriptar($_POST["seid"],"seccion");
			if( intval($seccion_editar_id) == 0)
				return false;
			
			$nombre_seccion = $this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii(  $datos["nombre_seccion"]) )  ;
			$descripcion_seccion = $this->db->db_evita_sql_injection( $this->generales->limpia_caracteres_to_ascii(  $datos["descripcion_seccion"] ) ) ;
			$url_seccion = $this->generales->prepara_cadena_enlace( $datos["nombre_seccion"] );
			
			$sql = sprintf("UPDATE secciones 
							SET secciones_nombre= '%s', secciones_url = '%s', secciones_superior_id= %d, secciones_descripcion = '%s', secciones_fecha = '%s', usuarios_id = %d, secciones_status = 1
							WHERE
								secciones_id = %d;",
								ucfirst($nombre_seccion),
								$url_seccion,
								intval($datos["categoriasuperiorseccion"]),
								ucfirst($descripcion_seccion),
								$this->generales->hoy(),
								$_SESSION["uid"],
								$seccion_editar_id
							);

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
							SET secciones_status= 0
							WHERE
								secciones_id = %d;",
								$seccion_eliminar_id
							);

			if(!$resultado = $this->db->db_query( $sql, 3 ) )
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
								s.secciones_descripcion
							FROM
								secciones as s
							WHERE
								s.secciones_id = %d
							AND
								s.secciones_status = 1",
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
							WHERE
								s.secciones_id = %d
							AND
								s.secciones_status = 1",
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
									s.secciones_fecha
								FROM 
									secciones as s
								WHERE
									s.secciones_status = 1");

			if(! $arr_secciones = $this->db->db_query( $sql_select, 1 ) )
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
								<loc>http://'.$_SERVER['HTTP_HOST'].'</loc>
								<changefreq>weekly</changefreq>
								<priority>1.00</priority>
							</url>
							<url>
								<loc>http://'.$_SERVER['HTTP_HOST'].'/index.php</loc>
								<changefreq>weekly</changefreq>
								<priority>1.00</priority>
							</url>';
			
			foreach( $arr_secciones as $secciones )
			{
				$prioridad = $this->secciones_calcula_prioridad_seccion( $secciones["secciones_url"] );
				$sitemap .=  '<url>
								<loc>http://'.$_SERVER['HTTP_HOST'].'/index.php?q='.$secciones["secciones_url"].'</loc>
								<changefreq>monthly</changefreq>
								<priority>'.$prioridad.'</priority>
							</url>';
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
					$prioridad = "0.80";
				break;
			}

				return $prioridad;
			
		}

	}

?>