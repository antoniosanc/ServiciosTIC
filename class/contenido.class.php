<?php

	include_once( URL_SERVIDOR_FRONT."/class/db.class.php");

	include_once( URL_SERVIDOR_FRONT."/class/generales.class.php");

	

	class contenido

	{

		

		function __construct( ) 

		{

			$this->db = new db();

			$this->generales = new generales();

		}

		

		function contenido_obten_array_contenido ( $seccion = "" )

		{

			if( empty($seccion) )

				return false;



			$sql = sprintf("SELECT 

								c.contenido_titulo AS titulo,

								c.contenido_descripcion AS descripcion,

								c.contenido_imagen AS imagen_destacada,

								c.contenido_contenido AS contenido,

								s.secciones_url AS url

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



			if( !$arr_seccion_interna = $this->db->db_query( $sql, 1 ) )

				return false;

			

			return $arr_seccion_interna;

		}

		

		function contenido_obten_contenido_url ( $seccion = "" )

		{

			if( empty($seccion) )

				return false;



			$sql = sprintf("SELECT 

								c.contenido_contenido as contenido

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



			if( !$arr_seccion_interna = $this->db->db_query( $sql, 1 ) )

				return false;

			

			return $arr_seccion_interna[0]["contenido"];

		}

		

		function contenido_obten_contenido_id ( $seccion_id = 0 )

		{

			if( intval($seccion_id) == 0 )

				return false;



			$sql = sprintf("SELECT 

								c.contenido_contenido as contenido

							FROM

								contenido AS c

							INNER JOIN

								secciones AS s

							USING (secciones_id)

							WHERE

								s.secciones_id = %d

							AND

								s.secciones_status = 1

							AND 

								c.contenido_status = 1",

							$this->db->db_evita_sql_injection( intval($seccion_id) )

							);



			if( !$arr_seccion_interna = $this->db->db_query( $sql, 1 ) )

				return false;

			

			return $arr_seccion_interna[0]["contenido"];

		}

		

		function contenido_buscar_contenido ( $qs = "" ) 

		{

			if (strlen($qs) == 0)

				return false;



			$cadena_busca = str_replace(" ","%",$this->generales->limpia_cadena( $qs )); 

			$arr_cadena = explode(" ",$this->generales->limpia_cadena( $qs )); 

			

			

			$sql_comp = "";

			if( count( $arr_cadena ) > 1 )

			{	

				foreach($arr_cadena as $cadena)

				{

					$sql_comp .= " OR c.contenido_contenido LIKE '%".$cadena."%'

									OR c.contenido_titulo  LIKE '%".$cadena."%' 

									OR s.secciones_url  LIKE '%".$cadena."%' ";

				}

			}

			

			

			$sql = sprintf("SELECT 

							c.contenido_titulo,

							c.contenido_imagen,

							c.contenido_descripcion,

							c.contenido_contenido,

							s.secciones_url

						FROM contenido as c

						INNER JOIN secciones as s  USING  ( secciones_id ) 

						WHERE 

							c.contenido_contenido LIKE '%%%s%%'

							OR c.contenido_titulo LIKE '%%%s%%'

							OR s.secciones_nombre LIKE '%%%s%%'

							%s

						AND 

							s.secciones_status = 1

						AND 

							c.contenido_status = 1

						ORDER BY s.secciones_id DESC",

							$cadena_busca,

							$cadena_busca,

							$cadena_busca,

							$sql_comp

						);



			if (!$arr_datos = $this->db->db_query($sql, 1) )

					return false;

					

			return $arr_datos;

		}

		

		

		function contenido_crea_paginado_seccion ( $url_seccion = "", $pagina_actual = 1, $elementos_por_pagina = 1)

		{

			if( empty($url_seccion) )

				return false;

			

			$sql_seccion_id = sprintf("SELECT 

											s.secciones_id

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

									$this->db->db_evita_sql_injection( $url_seccion )

									);

			

			if( !$arr_secciones_id = $this->db->db_query( $sql_seccion_id, 1 ) )

				return false;



			

			$sql_padre = sprintf("SELECT 

								c.contenido_id

								FROM

									contenido AS c

								INNER JOIN

									secciones AS s

								USING (secciones_id)

								WHERE

									s.secciones_superior_id = %d

								AND

									s.secciones_status = 1

								AND 

									c.contenido_status = 1

									ORDER BY s.secciones_id DESC ",

							$this->db->db_evita_sql_injection( $arr_secciones_id[0]["secciones_id"] )

							);



						 		

			if( !$arr_padre = $this->db->db_query( $sql_padre, 1 ) )

				return false;

			

			$contador_paginas = 1;





			$ultima_pagina = ceil( count( $arr_padre ) / $elementos_por_pagina ) ;



			

			$html_paginado = '<nav aria-label="Page navigation">

								<ul class="pagination">'; 

			

			if( intval($pagina_actual) == 1)

				$html_paginado .= '<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';

			else

				$html_paginado .= '<li><a href="index.php?q='.$url_seccion.'&p='.( ( $pagina_actual == 1)? "1" : ($pagina_actual - 1 ) ) .'" aria-label="Ant"><span aria-hidden="true">&laquo;</span></a></li>';

		

			for ( $i = 1; $i <= $ultima_pagina; $i++)

			{

				$class_active = "";

				if( $pagina_actual == $contador_paginas )

						$class_active = ' class="active" ';

			

				$html_paginado .= '<li '.$class_active.'><a href="index.php?q='.$url_seccion.'&p='.$i.'">'.$i.'</a></li>';

								

				$contador_paginas++;

			}

			



			

			if( $ultima_pagina == $pagina_actual )

				$html_paginado .= '<li class="disabled"><a href="#" aria-label="Sig"><span aria-hidden="true">&raquo;</span></a></li>';

			else

				$html_paginado .= '<li><a href="index.php?q='.$url_seccion.'&p='.$ultima_pagina.'" aria-label="Sig"><span aria-hidden="true">&raquo;</span></a></li>';

			

			$html_paginado .= '	</ul>

							</nav>';

							

			return $html_paginado;

			

		}

		

		function contenido_muestra_secciones_url_padre ( $url_seccion = 0, $numero_pagina = 0, $elementos_por_pagina = 0 )

		{

			

			if( empty($url_seccion) )

				return false;

			

			$sql_seccion_id = sprintf("SELECT 

											s.secciones_id

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

									$this->db->db_evita_sql_injection( $url_seccion )

									);

			

			if( !$arr_secciones_id = $this->db->db_query( $sql_seccion_id, 1 ) )

				return false;



			if( intval($numero_pagina) == 1)

			{

				$sql_limit = "LIMIT 0,".$elementos_por_pagina;

			}

			else

			{

				$limite_superior = ($numero_pagina * $elementos_por_pagina) ;

				$limite_inferior = $limite_superior - $elementos_por_pagina ;

				$sql_limit = "LIMIT ".$limite_inferior.",".$elementos_por_pagina; 

			}



			

			$sql = sprintf("SELECT 

								c.contenido_titulo AS titulo,

								c.contenido_descripcion AS descripcion,

								c.contenido_imagen as imagen_destacada,

								c.contenido_contenido as contenido,

								s.secciones_url as url

								FROM

									contenido AS c

								INNER JOIN

									secciones AS s

								USING (secciones_id)

								WHERE

									s.secciones_superior_id = %d

								AND

									s.secciones_status = 1

								AND 

									c.contenido_status = 1

									ORDER BY s.secciones_id ASC

								%s",

							$this->db->db_evita_sql_injection( $arr_secciones_id[0]["secciones_id"] ),

							$sql_limit

							);



			if( !$arr_secciones = $this->db->db_query( $sql, 1 ) )

				return false;



			

			$html_salida = "";

			if(is_array($arr_secciones) )

			{	

				$html_salida .= '<div class="row" >';

				foreach( $arr_secciones as $secciones )

				{

					$html_salida .=  '

						<div class="col-sm-4 col-md-4 cards br_col'.$brn.'" >

							<p style="text-align:center;">

								<a href="index.php?q='.$secciones["url"].'&n='.$url_seccion.'">

									<img class="img-responsive" src="'.URL_USERFILES."image/".$secciones["imagen_destacada"].'" border="0" alt="'.$secciones["titulo"].'"/>

								</a>

							</p>

							<h3 style="text-align:center;">'.$secciones["titulo"].'</h3>

							<p style="text-align:justify;">'.$this->generales->corta_cadena($secciones["descripcion"],80).'</p>

							<p style="text-align:center;">

								<a href="index.php?q='.$secciones["url"].'&n='.$url_seccion.'" class="btn btn-conoce">CONOCE M&Aacute;S </a>

							</p>

						</div>';



					if( $contador == 2 )

					{

						$html_salida .=  '</div>

							<div class="row " >';

						$contador = 0;

						$brn = 0;

					}

					else

					{

						$contador++;

						$brn++;

					}

				}

				$html_salida .=  '</div>';

			}

			

			return $html_salida;

		}

function contenido_muestra_secciones_url_padre_servicios ( $url_seccion = 0, $numero_pagina = 0, $elementos_por_pagina = 0 )

		{

			

			if( empty($url_seccion) )

				return false;

			

			$sql_seccion_id = sprintf("SELECT 

											s.secciones_id

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

									$this->db->db_evita_sql_injection( $url_seccion )

									);

			

			if( !$arr_secciones_id = $this->db->db_query( $sql_seccion_id, 1 ) )

				return false;



			if( intval($numero_pagina) == 1)

			{

				$sql_limit = "LIMIT 0,".$elementos_por_pagina;

			}

			else

			{

				$limite_superior = ($numero_pagina * $elementos_por_pagina) ;

				$limite_inferior = $limite_superior - $elementos_por_pagina ;

				$sql_limit = "LIMIT ".$limite_inferior.",".$elementos_por_pagina; 

			}



			

			$sql = sprintf("SELECT 

								c.contenido_titulo AS titulo,

								c.contenido_descripcion AS descripcion,

								c.contenido_imagen as imagen_destacada,

								c.contenido_contenido as contenido,

								s.secciones_url as url

								FROM

									contenido AS c

								INNER JOIN

									secciones AS s

								USING (secciones_id)

								WHERE

									s.secciones_superior_id = %d

								AND

									s.secciones_status = 1

								AND 

									c.contenido_status = 1

									ORDER BY s.secciones_id ASC

								%s",

							$this->db->db_evita_sql_injection( $arr_secciones_id[0]["secciones_id"] ),

							$sql_limit

							);



			if( !$arr_secciones = $this->db->db_query( $sql, 1 ) )

				return false;



			

			$html_salida = "";

			if(is_array($arr_secciones) )

			{	

				$html_salida .= '<div class="row" >';

				foreach( $arr_secciones as $secciones )

				{

					$html_salida .=  '

						<div class="col-sm-6 col-md-6 serv-interno text-center" style="background : url(/userfiles/servicios_tic20/image/servicios/bg-'.$this->generales->prepara_cadena_enlace($secciones["titulo"]).'.jpg) no-repeat center; background-size: cover;">						

							<h3 style="text-align:center;">'.$secciones["titulo"].'</h3>

							

							<p style="text-align:center;">

								<a href="index.php?q='.$secciones["url"].'&n='.$url_seccion.'" class="btn btn-mas-servicios">M&Aacute;S INFORMACI&Oacute;N</a>

							</p>

						</div>';



					if( $contador == 1 )

					{

						$html_salida .=  '</div>

							<div class="row " >';

						$contador = 0;

						$brn = 0;

					}

					else

					{

						$contador++;

						$brn++;

					}

				}

				$html_salida .=  '</div>';

			}

			

			return $html_salida;

		}

		

		function contenido_obten_seccion_padre ( $seccion = "" )

		{

			if( empty($seccion) )

				return false;



			$sql = sprintf("SELECT 

								c.contenido_titulo,

								s.secciones_url

								FROM

									contenido AS c

								INNER JOIN

									secciones AS s

								USING (secciones_id)

								WHERE

									s.secciones_id = %d

								AND

									s.secciones_status = 1

								AND 

									c.contenido_status = 1",

							$this->db->db_evita_sql_injection( $seccion )

							);



			if( !$arr_seccion_interna = $this->db->db_query( $sql, 1 ) )

				return false;

			return $arr_seccion_interna;

		}

		

		function contenido_obten_contenido_titulo ( $seccion = "" )

		{

			if( empty($seccion) )

				return false;



			$sql = sprintf("SELECT 

								c.contenido_titulo,

								s.secciones_superior_id,

								s.secciones_url

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



			if( !$arr_seccion_interna = $this->db->db_query( $sql, 1 ) )

				return false;

			return $arr_seccion_interna;

		}

		

		function __destruct() 

		{

			unset($this->generales);

			unset($this->db);

		}

		

	}



?>

