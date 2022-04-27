<?php

	include_once( URL_SERVIDOR."/class/db.class.php");

	include_once( URL_SERVIDOR."/class/generales.class.php");

	

	class usuario

	{

		var $user = "";

		var $password = "";

		var $key = "";

		

		function __construct( ) 

		{

			$this->key = "6435743";

			$this->db = new db();

			$this->generales = new generales();

		}

		

		function usuario_inicia_sesion( $datos = ""  )

		{

			if( !is_array($datos) || empty($datos["u"]) ||  empty($datos["p"])  )

				return false;

			

			$sql = sprintf(" SELECT 

								u.usuarios_id,

								u.usuarios_nombre,

								u.usuarios_usuario,

								u.usuarios_email

							FROM 

								usuarios as u

							WHERE

								u.usuarios_status = 1

							AND

								u.usuarios_usuario = '%s'

							AND 

								u.usuarios_password = '%s'",

							$this->db->db_evita_sql_injection( $datos["u"] ),

							$this->key . md5( $this->db->db_evita_sql_injection( $datos["p"]) )

						);



			if( !$resultado = $this->db->db_query( $sql, 1 ) )

				return false;

			

			$sql_permisos = sprintf(" SELECT 

											up.usuarios_permisos_secciones,

											up.usuarios_permisos_contenido, 

											up.usuarios_permisos_estadisticas, 

											up.usuarios_permisos_centro_negocios, 

											up.usuarios_permisos_configuracion

										FROM 

											usuarios_permisos as up

										WHERE

											up.usuarios_permisos_status = 1

										AND

											up.usuarios_id = %d",

										intval($resultado[0]["usuarios_id"])

									);



			if( !$resultado_permisos = $this->db->db_query( $sql_permisos, 1 ) )

				return false;

			

			$arr_salida = array_merge($resultado, $resultado_permisos);

			

			if ($id_insertado = $this->usuario_registra_nueva_sesion( $resultado ) )

				return $arr_salida;

			

			return false;



		}

		

		

		function usuario_registra_nueva_sesion( $datos = ""  )

		{

			if( !is_array( $datos ))

				return false;

			

			if( !$mi_ip = $this->generales->obten_ip() )

				return false;

				

			if( !$hoy = $this->generales->hoy() )

				return false;

			

			$sql = sprintf(" INSERT INTO 

								registro_login (registro_login_usuario, registro_login_ip, registro_login_fecha, usuarios_id  )

							VALUES

								('%s', '%s', '%s', %d )",

							$this->db->db_evita_sql_injection( $datos[0]["usuarios_usuario"] ),

							$mi_ip ,

							$hoy,

							intval( $datos[0]["usuarios_id"] )

						);



			if( $resultado = $this->db->db_query( $sql, 2 ) )

				return $resultado;

			

			return false;

		}

		

		function __destruct() 

		{

			unset($this->user);

			unset($this->db);

			unset($this->password);

			unset($this->key);

		}

	

	}



?>