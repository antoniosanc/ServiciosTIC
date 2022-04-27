<?
	include_once( URL_SERVIDOR_FRONT."/class/db.class.php");
	include_once( URL_SERVIDOR_FRONT."/class/generales.class.php");
	
	class contenido
	{
		
		function __construct( ) 
		{
			$this->db = new db();
			$this->generales = new generales();
		}
		
		function contenido_obten_contenido_nombre ( $seccion = "" )
		{
			if( empty($seccion) )
				return false;

			$sql = sprintf("SELECT 
								c.contenido_titulo AS titulo,
								c.contenido_descripcion AS descripcion,
								c.contenido_imagen as imagen_destacada,
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
			
			return $arr_seccion_interna;
		}
		
		function contenido_obten_contenido_full_nombre ( $seccion = "" )
		{
			if( empty($seccion) )
				return false;

			$sql = sprintf("SELECT 
								c.contenido_titulo AS titulo,
								c.contenido_descripcion AS descripcion,
								c.contenido_imagen as imagen_destacada,
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
	}

?>
