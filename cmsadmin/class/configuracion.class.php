<?php

	include_once( URL_SERVIDOR."/class/db.class.php");

	include_once( URL_SERVIDOR."/class/generales.class.php");

	

	class configuracion

	{

		

		function __construct( ) 

		{

			$this->db = new db();

			$this->generales = new generales();

			$this->key = "6435743";

		}

		

		function configuracion_obten_configuracion ()

		{

			$sql = sprintf("SELECT 

								c.configuracion_nombre_empresa,

								c.configuracion_email_empresa,

								c.configuracion_url_empresa,

								c.configuracion_correo_respuesta

							FROM

								configuracion as c

							WHERE

								c.configuracion_status = 1

							AND

								c.configuracion_id = 1");

								

			if( !$arr_seccion = $this->db->db_query( $sql, 1 ) )

				return false;

			

			return $arr_seccion;

		}

		

		function configuracion_obten_configuracion_miscelaneo ()

		{

			$sql = sprintf("SELECT 

								c.configuracion_codigo_analytics,

								c.configuracion_keyword_seo,

								c.configuracion_keywords_base,

								c.configuracion_descripcion_base,

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

			

			return $arr_seccion;

		}

		

		function configuracion_guarda_configuracion ( $datos = "")

		{

			if( !is_array($datos) )

				return false;

			

			if( intval( $_SESSION["uid"]) == 0 )

				return false;

				

			if( !$this->generales->valida_email($datos["correo_empresa"]) )

				return false;

			

			if( empty( $datos["nombre_empresa"] ) && strlen(  $datos["nombre_empresa"] ) < 3 )

				return false; 

			

			$correo_empresa =  str_replace('src="/','src="'.$this->generales->obtener_dominio().'/',$datos["txt_email_empresa"]);

			

			$sql = sprintf("UPDATE configuracion SET configuracion_nombre_empresa = '%s', configuracion_email_empresa = '%s', configuracion_url_empresa = '%s', configuracion_correo_respuesta = '%s', configuracion_ultima_modificacion  = '%s', usuarios_id = %d WHERE configuracion_id = 1 AND configuracion_status = 1",

				$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii( $datos["nombre_empresa"]) ),

				$this->db->db_evita_sql_injection(  $datos["correo_empresa"] ),

				$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii( $datos["pagina_empresa"]) ),

				$this->db->db_evita_sql_injection( $correo_empresa ),

				$this->generales->hoy(),

				$_SESSION["uid"]

			);

			

			if( $resultado = $this->db->db_query( $sql, 3 ) )

					return true;



			return false;

		}

		

		function configuracion_guarda_configuracion_miscelaneo ( $datos = "")

		{

			if( !is_array($datos) )

				return false;

		

			if( intval( $_SESSION["uid"]) == 0 )

				return false;

			

			if( empty( $datos["analytics"] ) && strlen(  $datos["analytics"] ) < 5 )

				return false; 

			

			$translate = 0;

			if( $datos["translate"] == "on" )

				$translate = 1;

			

			$sql = sprintf("UPDATE configuracion SET configuracion_translate = %d, configuracion_codigo_chat = '%s', configuracion_codigo_analytics = '%s', configuracion_keyword_seo = '%s', configuracion_keywords_base = '%s', configuracion_descripcion_base = '%s', configuracion_codigo_messenger = '%s', configuracion_recaptcha_publico = '%s', configuracion_recaptcha_privado = '%s', configuracion_ultima_modificacion  = '%s', usuarios_id = %d WHERE configuracion_id = 1 AND configuracion_status = 1",

				$this->db->db_evita_sql_injection(  $translate ),

				$this->db->db_evita_sql_injection(  $datos["chat"] ),

				$this->db->db_evita_sql_injection(  $datos["analytics"] ),

				$this->db->db_evita_sql_injection(  $datos["keyword_seo_base"] ),

				$this->db->db_evita_sql_injection(  $datos["keywords_base"] ),

				$this->db->db_evita_sql_injection(  $datos["descripcion_base"] ),

				$this->db->db_evita_sql_injection(  $datos["chat_facebook"] ),

				$this->db->db_evita_sql_injection(  $datos["recaptcha_publico"] ),

				$this->db->db_evita_sql_injection(  $datos["recaptcha_privado"] ),

				$this->generales->hoy(),

				$_SESSION["uid"]

			);



			if( $resultado = $this->db->db_query( $sql, 3 ) )

					return true;



			return false;

		}

		

		function configuracion_obten_usuarios_permiso ()

		{

			$sql = sprintf("SELECT 

								u.usuarios_id,

								u.usuarios_nombre,

								u.usuarios_usuario,

								u.usuarios_es_admin,

								up.usuarios_permisos_secciones

							FROM 

								usuarios AS u

							INNER JOIN usuarios_permisos AS up 

							USING (usuarios_id)

							WHERE

								u.usuarios_status = 1

							AND

								up.usuarios_permisos_status = 1

							AND

								u.usuarios_id != 1");

		

			if( !$arr_usuarios = $this->db->db_query( $sql, 1 ) )

				return false;

			

			$html_salida = "";

			

			if(is_array($arr_usuarios))

			{

				foreach( $arr_usuarios as $lista_usuarios => $usuarios)

				{

					$html_salida .=  '<tr>

										<td> '.$usuarios["usuarios_nombre"].' ('.$usuarios["usuarios_usuario"].') </td>';

					

					if( intval( $usuarios["usuarios_es_admin"]) == 0)

					{

						$html_salida .=  '<td align="center">  

												<a href="index.php?q=usuarios_edita&i='.$this->generales->encriptar($usuarios["usuarios_id"],"usuario").'" class="btn btn-success">Editar <i class="glyphicon glyphicon-edit"></i></a> &nbsp;

												<a href="index.php?q=configuracion&eu='.md5(1).'&i='.$this->generales->encriptar($usuarios["usuarios_id"],"usuario").'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> Eliminar</a> 

										</td>';

					}

					else

					{

						$html_salida .=  '<td align="center"> &nbsp; Administrador </td>';

					}

					$html_salida .=  '</tr>';

				}

			}

			

			return $html_salida;

		}

		

		function configuracion_obten_informacion_usuario_id ( $usuario_id = 0)

		{

			if( intval($usuario_id) == 0)

				return false;

			

			$sql = sprintf("SELECT 

								u.usuarios_id,

								u.usuarios_nombre,

								u.usuarios_usuario,

								u.usuarios_email,

								u.usuarios_es_admin,

								up.usuarios_permisos_secciones

							FROM 

								usuarios AS u

							INNER JOIN usuarios_permisos AS up 

							USING (usuarios_id)

							WHERE

								u.usuarios_status = 1

							AND

								up.usuarios_permisos_status = 1

							AND 

								u.usuarios_id = %d",

							$this->db->db_evita_sql_injection(  $usuario_id )

						);

		

			if( !$arr_usuarios = $this->db->db_query( $sql, 1 ) )

				return false;

			

			return $arr_usuarios;

		}

		

		function configuracion_guarda_usuario_datos_generales ( $datos = 0, $usuario_id )

		{

			if( !is_array($datos) )

				return false;

		

			if( intval( $_SESSION["uid"]) == 0 )

				return false;

			

			if( empty( $datos["nombre_usuario"] ) && strlen(  $datos["nombre_usuario"] ) < 3 )

				return false; 

		

			if( !$this->generales->valida_email($datos["correo_empresa"]) )

				return false;

			

			$sql = sprintf("UPDATE usuarios SET usuarios_nombre  = '%s', usuarios_email = '%s', usuario_inserta_id = '%s', usuarios_fecha_creacion  = '%s' WHERE usuarios_id = %d AND usuarios_status = 1",

				$this->db->db_evita_sql_injection(  $datos["nombre_usuario"] ),

				$this->db->db_evita_sql_injection(  $datos["correo_empresa"]) ,

				$_SESSION["uid"],

				$this->generales->hoy(),

				$usuario_id

			);

			

			if( $resultado = $this->db->db_query( $sql, 3 ) )

					return true;



			return false;

		}

		

		function configuracion_valida_password_actual ( $password = 0, $usuario_id = 0)

		{

			if( strlen($password) < 5 || intval($usuario_id) == 0 )

				return false;

		

			if( intval( $_SESSION["uid"]) == 0 )

				return false;

			

			$sql = sprintf("SELECT 

								u.usuarios_password

							FROM

								usuarios AS u

							WHERE

								usuarios_id = %d

							AND 

								usuarios_password = '%s'",

				$this->db->db_evita_sql_injection($usuario_id ),

				$this->db->db_evita_sql_injection( $this->key . md5($password ) )

			);

			

			if( $resultado = $this->db->db_query( $sql, 1 ) )

					return true;



			return false;

		}

		

		function configuracion_actualiza_usuario_password ( $datos = 0 , $usuario_id = 0 )

		{

			if( !is_array($datos) || intval($usuario_id) == 0 )

				return false;

		

			if( intval( $_SESSION["uid"]) == 0 )

				return false;

			

			if( $datos["password_nuevo"] != $datos["password_nuevo_confirma"] )

				return false;

			

			$sql = sprintf("UPDATE usuarios SET usuarios_password = '%s' WHERE usuarios_id = %d AND usuarios_status = 1",

				$this->db->db_evita_sql_injection( $this->key . md5($datos["password_nuevo"] ) ),

				$this->db->db_evita_sql_injection( $usuario_id )

				);



			if( $resultado = $this->db->db_query( $sql, 3 ) )

				return true;



			return false;

		}

		

		function configuracion_guarda_permisos_usuarios ( $datos = 0 )

		{

			if( !is_array($datos) )

				return false;

		

			if( intval( $_SESSION["uid"]) == 0 )

				return false;

			

			if( empty( $datos["input_secciones"] ) || empty( $datos["input_contenidos"] ) )

				return false; 

			

			$sql = sprintf("INSERT INTO usuarios_permisos(

											usuarios_id, 

											usuarios_permisos_secciones, 

											usuarios_permisos_contenido, 

											usuarios_permisos_estadisticas, 

											usuarios_permisos_centro_negocios, 

											usuarios_permisos_configuracion,

											usuarios_permisos_fecha_modificacion,

											usuarios_id_modifico, 

											usuarios_permisos_status

										) 

									VALUES (%d, %d, %d, %d, %d, %d, '%s', %d, 1)

								ON DUPLICATE KEY UPDATE

									usuarios_id = %d, 

									usuarios_permisos_secciones = %d, 

									usuarios_permisos_contenido = %d, 

									usuarios_permisos_estadisticas = %d, 

									usuarios_permisos_centro_negocios = %d, 

									usuarios_permisos_configuracion = %d,

									usuarios_permisos_fecha_modificacion = '%s',

									usuarios_id_modifico = %d",

				$this->db->db_evita_sql_injection( $datos["uid"]),

				intval ( $this->db->db_evita_sql_injection( $datos["input_secciones"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_contenidos"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_estadisticas"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_centro_negocios"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_configuracion"] ) ),

				$this->generales->hoy(),

				$_SESSION["uid"],

				$this->db->db_evita_sql_injection( $datos["uid"]),

				intval ( $this->db->db_evita_sql_injection( $datos["input_secciones"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_contenidos"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_estadisticas"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_centro_negocios"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_configuracion"] ) ),

				$this->generales->hoy(),

				$_SESSION["uid"]

				);



			if( $resultado = $this->db->db_query( $sql, 2 ) )

				return true;



			return false;

		}

		

		function configuracion_obten_permisos_usuario ( $usuario_id = 0 )

		{

			if( intval($usuario_id) == 0)

				return false;

		

			$sql = sprintf("SELECT 

								up.usuarios_permisos_secciones,

								up.usuarios_permisos_contenido,

								up.usuarios_permisos_estadisticas,

								up.usuarios_permisos_centro_negocios,

								up.usuarios_permisos_configuracion

							FROM

								usuarios_permisos AS up

							WHERE

								usuarios_permisos_status = 1

							AND

								usuarios_id = %d;",

						intval($usuario_id) );

			

			if( !$arr_permisos_usuarios = $this->db->db_query( $sql, 1 ) )

				return false;

			

			return $arr_permisos_usuarios;

		}

		

		function configuracion_guarda_nuevo_usuario ( $datos = 0)

		{

			if( !is_array($datos) )

				return false;

			

			if(	intval($_SESSION["uid"]) <= 0 )

				return false;

			

			if( empty( $datos["usuario_usuario"] ) || strlen( $datos["usuario_usuario"] ) < 3 )

				return false; 

			

			if( empty( $datos["nombre_usuario"] ) || strlen( $datos["nombre_usuario"] ) < 3 )

				return false; 

			

			

			$sql = sprintf("SELECT 

								u.usuarios_usuario

							FROM

								usuarios AS u

							WHERE

								usuarios_usuario = '%s'

							AND 

								usuarios_status = 1",

							 $this->db->db_evita_sql_injection( $datos["usuario_usuario"] ) 

							);



			if( $arr_permisos_usuarios = $this->db->db_query( $sql, 1 ) ) //Si hay resultados regresa error de usuario

				return false;

			

			if( $datos["password_nuevo"] != $datos["password_nuevo_confirma"] )

				return false;

			

			$sql_insert_usuario = sprintf("INSERT INTO usuarios(usuarios_nombre, usuarios_usuario, usuarios_password, usuarios_email, usuarios_fecha_creacion, usuario_inserta_id, usuarios_es_admin, usuarios_status) VALUES ('%s','%s','%s','%s','%s','%s', 0, 1) ",

				$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii( $datos["nombre_usuario"] )),

				$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii( str_replace(" ", "", $datos["usuario_usuario"]) )),

				$this->db->db_evita_sql_injection( $this->key . md5($datos["password_nuevo"] ) ),

				$this->db->db_evita_sql_injection(  $this->generales->limpia_caracteres_to_ascii( $datos["correo_empresa"] )),

				$this->generales->hoy(),

				$_SESSION["uid"]

			);

	

			if( !$insert_id = $this->db->db_query( $sql_insert_usuario, 2 ) )

				return false;



			if( intval($insert_id) == 0 )

				return false;

			

			$sql = sprintf("INSERT INTO usuarios_permisos(

											usuarios_id, 

											usuarios_permisos_secciones, 

											usuarios_permisos_contenido, 

											usuarios_permisos_estadisticas, 

											usuarios_permisos_centro_negocios, 

											usuarios_permisos_configuracion,

											usuarios_permisos_fecha_modificacion,

											usuarios_id_modifico, 

											usuarios_permisos_status

										) 

									VALUES (%d, %d, %d, %d, %d, %d, '%s', %d, 1)

								ON DUPLICATE KEY UPDATE

									usuarios_id = %d, 

									usuarios_permisos_secciones = %d,

									usuarios_permisos_contenido = %d,

									usuarios_permisos_estadisticas = %d,

									usuarios_permisos_centro_negocios = %d, 

									usuarios_permisos_configuracion = %d,

									usuarios_permisos_fecha_modificacion = '%s',

									usuarios_id_modifico = %d",

				$this->db->db_evita_sql_injection( $insert_id ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_secciones"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_contenidos"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_estadisticas"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_centro_negocios"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_configuracion"] ) ),

				$this->generales->hoy(),

				$_SESSION["uid"],

				$this->db->db_evita_sql_injection( $insert_id ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_secciones"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_contenidos"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_estadisticas"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_centro_negocios"] ) ),

				intval ( $this->db->db_evita_sql_injection( $datos["input_configuracion"] ) ),

				$this->generales->hoy(),

				$_SESSION["uid"]

				);



			if( $resultado = $this->db->db_query( $sql,2 ) )

				return true;



			return false;

			

		}

		

		

		function configuracion_elimina_usuario ( $usuario_id = 0)

		{

			if(intval($usuario_id) == 0)

				return false;

			

			if(	intval($_SESSION["uid"]) <= 0 )

				return false;

				

			

			$sql = sprintf("UPDATE usuarios SET usuarios_status  = 0, usuarios_fecha_creacion = '%s' WHERE usuarios_id = %d ",

				$this->generales->hoy(),

				$this->db->db_evita_sql_injection(  $usuario_id )

			);

			

			if( !$resultado = $this->db->db_query( $sql, 3 ) )

					return false;



			$sql_permisos = sprintf("UPDATE usuarios_permisos SET usuarios_permisos_status  = 0, usuarios_permisos_fecha_modificacion = '%s' WHERE usuarios_id = %d ",

				$this->generales->hoy(),

				$this->db->db_evita_sql_injection(  $usuario_id )

			);

			

			if( !$resultado = $this->db->db_query( $sql_permisos, 3 ) )

					return false;



			return true;

		}

		

		function configuracion_obten_respaldo_archivos ()

		{

			



			if( !$usuario_id = $this->configuracion_obten_informacion_usuario_id( $_SESSION["uid"] ) )

				return false;

				

			if(	intval( $usuario_id ) == 1 )

			{

			

				$salida = '<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="glyphicon glyphicon-refresh"></i> Contenido anterior</button>

									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

									  <div class="modal-dialog" role="document">

										<div class="modal-content">

										  <div class="modal-body">';

											

											if( $arr_archivos_editados = $this->generales->lista_directorio( URL_SERVIDOR."/userfiles/bk/" ) )

											{

												

												$salida .=  '<ul>';

												foreach( $arr_archivos_editados as $files_editados )

												{

													$url_archivo_final = str_replace( "/public_html","",$files_editados );

													$url_archivo_final = str_replace( "/var/www","",$url_archivo_final );

													//$url_archivo_final = str_replace( "/var/www","",$url_archivo_final );

													$salida .=  '<li><a href="'.$url_archivo_final.'" target="_blank">'.$url_archivo_final.'</a></li>';

												}

												$salida .=  '</ul>';

											}

											else

											{

												$salida .=  alerta("No hay ediciones de archivos.");

											}

											

									$salida .=   '</div>

										</div>

									  </div>

									</div> ';

				

				return $salida;

			}

			else

			{

				return alerta("ERROR. No tienes permisos para ver estos archivos");

			}

		}

	}



?>

