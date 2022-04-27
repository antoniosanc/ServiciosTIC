<?php

class db

{

	public $numfilas = 0;

	

	function __construct( )  

	{

		if( !$this->dbconexion = new mysqli(HOST_DB_CMS, USER_DB_CMS, PASSWORD_DB_CMS, BASE_DB_CMS, PUERTO_DB_CMS) )

		{

			echo alerta("<strong>Error:</strong> Ocurrio un error al intentar conectarse.");

		}

		

		if (!$this->dbconexion->set_charset("utf8") ) 

		{

			echo alerta("Error cargando el conjunto de caracteres utf8: %s\n", $this->dbconexion->error );

		}

	}



	function db_query( $sql = "", $tipo_query = 0 )

	{

		if($sql == "")

			return false;

		

		if(intval($tipo_query) == 0)

			return false;

		

		if( !$resultado = $this->dbconexion->query($sql) )

				return false;  

		

		switch( $tipo_query )

		{

			case 1: //Select

				if ( !$this->numfilas = $resultado->num_rows ) //SI NO HAY REGISTROS MUESTRO ERROR

					return false;



				$arr_datos_consulta = array();

				

				while ( $row = $resultado->fetch_array(MYSQLI_ASSOC) )

				{

					array_push($arr_datos_consulta, $row);

				}

				

				$resultado->close();



				return $arr_datos_consulta;   

			break;

			case 2://Insert

				if(!$insert_id = $this->dbconexion->insert_id )

					return false;

				

				if( intval($insert_id) > 0 )

					return  $insert_id;  

				else

					return false;

			break;

			case 3: //Delete / update

				return $resultado;

			break;

		}

		

		return false;

	}

	

	

	function db_evita_sql_injection($cadena = "")

	{

		

		if ( $cadena == "" && !empty($cadena) )

			return false;



		return $this->dbconexion->real_escape_string( $cadena );

	}



	



}



?>