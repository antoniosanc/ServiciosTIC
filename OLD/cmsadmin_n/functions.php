<?
	/* Para evitar SQL Injection */
	$_POST = evita_sqlinjection($_POST);
	$_GET = evita_sqlinjection($_GET);
	$_REQUEST = evita_sqlinjection($_REQUEST);
	$_SERVER = evita_sqlinjection($_SERVER);
	$_COOKIE = evita_sqlinjection($_COOKIE);

	function evita_sqlinjection($var)
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

	/* FIN Para evitar SQL Injection */


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