<?php

	include_once( URL_SERVIDOR."/class/db.class.php");

	include_once( URL_SERVIDOR."/class/generales.class.php");

	include_once( URL_SERVIDOR."/class/mail.class.php");

	

	class negocios extends mail

	{

		

		function __construct( ) 

		{

			$this->db = new db();

			$this->generales = new generales();

			$this->mail = new mail();

		}

		

		function negocios_lista_contactos (  )

		{



			$sql = sprintf("SELECT 

								c.contacto_id,

								c.contacto_nombre,

								c.contacto_correo_electronico,

								c.contacto_telefono,

								c.contacto_direccion,

								c.contacto_asunto,

								c.contacto_comentarios,

								c.contacto_fecha_contacto

							FROM

								contacto AS c

							WHERE

								c.contacto_status = 1

							ORDER BY 

								c.contacto_fecha_contacto DESC

						"

					);

			

			if( !$arr_contacto = $this->db->db_query( $sql, 1 ) )

				return false;

			

			$salida = "";

			if(is_array($arr_contacto) )

			{

				foreach( $arr_contacto as $contacto)

				{

					$arr_fecha_contacto = explode(" ",$contacto["contacto_fecha_contacto"]);

					$fecha_contacto = $arr_fecha_contacto[0];



					$salida .= "<tr>

									<td>".$contacto["contacto_id"]."</td>

									<td>".$fecha_contacto." ".$arr_fecha_contacto[1]."</td>

									<td class='tablecenter'>

										".$contacto["contacto_nombre"]." <br/> (".$contacto["contacto_correo_electronico"].")";

									if( $contacto["contacto_telefono"] )

										$salida .= "<br/> <strong>Tel&eacute;fono</strong>: ".$contacto["contacto_telefono"]."";

									if( $contacto["contacto_direccion"] )

										$salida .= "<br/><strong>Direcci&oacute;n</strong>: ".$contacto["contacto_direccion"];

										

						$salida .= "</td>

									<td>";

									if( $contacto["contacto_asunto"] )

										$salida .= "<p><strong>".$contacto["contacto_asunto"]."</strong></p>";

										

										$salida .= "<p>".$contacto["contacto_comentarios"]."</p>";

								$salida .= "</td>

								</tr>";

				}

			}

			return $salida;

		}

		

		function negocios_lista_contactos_exportar (  )

		{



			$sql = sprintf("SELECT 

								c.contacto_id,

								c.contacto_nombre,

								c.contacto_correo_electronico,

								c.contacto_telefono,

								c.contacto_direccion,

								c.contacto_fecha_contacto,

								c.contacto_asunto, 

								c.contacto_comentarios

							FROM

								contacto AS c

							WHERE

								c.contacto_status = 1

							ORDER BY 

								c.contacto_fecha_contacto DESC

						"

					);

			

			if( !$arr_contacto = $this->db->db_query( $sql, 1 ) )

				return false;

			

			

			return $arr_contacto;

		}

		

		function negocios_busca_contacto_id ( $contacto_id = 0 )

		{

			if(intval($contacto_id)  == 0)

				return false;

		

			$sql = sprintf("SELECT 

								c.contacto_id,

								c.contacto_nombre,

								c.contacto_correo_electronico,

								c.contacto_telefono,

								c.contacto_direccion,

								c.contacto_asunto,

								c.contacto_comentarios,

								c.contacto_fecha_contacto

							FROM

								contacto AS c

							WHERE

								c.contacto_status = 1

							AND

								c.contacto_id = %d

						",

						$this->db->db_evita_sql_injection( $contacto_id )

					);



			if( !$arr_contacto = $this->db->db_query( $sql, 1 ) )

				return false;

			

			return $arr_contacto;

		}

		

		function negocios_envia_correo_contacto ( $datos = 0)

		{

			if( !is_array($datos) )

				return false;

			

			if( intval( $_SESSION["uid"]) == 0 )

				return false;

			

			$contacto_id = $this->generales->desencriptar($datos["idc"],"contacto");

			

			if(intval($contacto_id ) == 0)

				return false;

			

			if( !$this->generales->valida_email($datos["correo_empresa"] ) )

				return false;

			

			$sql = sprintf("INSERT INTO contacto_respuestas(contacto_id, contacto_respuestas_correo, contacto_respuestas_asunto, contacto_respuestas_contenido, contacto_respuestas_fecha ) VALUES (%d, '%s', '%s', '%s', '%s' )",

				$this->db->db_evita_sql_injection( $contacto_id ),

				$this->db->db_evita_sql_injection( $datos["correo_empresa"] ),

				$this->db->db_evita_sql_injection( $this->generales->limpia_caracteres_to_ascii( htmlentities($datos["asunto_correo"]) )),

				$this->db->db_evita_sql_injection( $datos["contacto_editor"] ),

				$this->generales->hoy()

			);

			

			if( !$this->db->db_query( $sql, 2 ) )

				return false;

			

			$sql_receptor = sprintf("SELECT

										c.contacto_correo_electronico

									FROM

										contacto AS c

									WHERE

										c.contacto_id = %d",

								$this->db->db_evita_sql_injection( $contacto_id )

								);

			

			if( !$arr_contacto = $this->db->db_query( $sql_receptor, 1 ) )

				return false;

			

			

			$arr_datos = array();

			$arr_datos["correo_remitente"] = $datos["correo_empresa"];

			$arr_datos["correo_receptor"] = $arr_contacto[0]["contacto_correo_electronico"];

			$arr_datos["asunto"] = $datos["asunto_correo"];

			$arr_datos["cuerpo_correo"] = $datos["contacto_editor"];

			



			if( $this->mail->enviar_mail( $arr_datos ) )

				return true;

				

			return false;

		}

	}

?>