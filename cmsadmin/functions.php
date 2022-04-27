<?php



	/* Para evitar Injection de código y XSS*/

	$_POST = evita_injection($_POST);

	$_GET = evita_injection_get($_GET);

	$_COOKIE = evita_injection($_COOKIE);

	$_REQUEST = evita_injection($_REQUEST);

	$_SESSION = evita_injection($_SESSION);



	function evita_injection_get($var)

	{

		

		if (!is_array($var))

			return addslashes($var);

 

		$new_var = array();

		foreach ($var as $k => $v)

		{

			$v = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $v);

			$v = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', "", $v);

			$v = preg_replace('/<\\?.*(\\?>|$)/Us', '',$v);

			$v = htmlentities($v);

			$new_var[addslashes($k)] = strip_tags($v);

		}



		return $new_var;

	}

	

	

	function evita_injection($var)

	{

		

		if (!function_exists('get_magic_quotes_gpc'))

			return $var;



		if (get_magic_quotes_gpc ())

		{

			if (is_array($var))

			{

				foreach ($var as $variable => $valor)

				{

					$temp[$variable] = evita_sqlinjection($valor);

				}

				return $temp;

			}

			else

			{

				return stripslashes($var);

			}

		}

		else

		{

			return $var;

		}



		if (!is_array($var))

			return addslashes($var);



		$new_var = array();

		foreach ($var as $k => $v)

			$new_var[addslashes($k)] = evita_sqlinjection($v);



		return $new_var;

	}

	/* FIN Para evitar Injection */

	

	

	function alerta( $texto = "")

	{

		if($texto != "")

			return  '<div class="alert alert-danger">'.$texto.'</div>';



		return $texto;

	}

	

	function correcto( $texto = "")

	{

		if($texto != "")

			return  '<div class="alert alert-success">'.$texto.'</div>';



		return $texto;

	}

	

	function detalle( $cadena = "" )

	{

		return "<pre>".print_r($cadena,true)."</pre>";

	}

?>