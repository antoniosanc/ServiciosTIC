<?php
class generales 
{
	
	public function elimina_duplicados_array ( $array  )
	{
         $new = array(); 
        $exclude = array(""); 
        for ($i = 0; $i<=count($array)-1; $i++) { 
            if (!in_array(trim($array[$i][$campo]) ,$exclude)) { $new[] = $array[$i]; $exclude[] = trim($array[$i][$campo]); } 
        }
        
        return $new; 
    }  
	// solo funciona para las cadenas DD/MM/AAAA (de un datepicker o form)
	public function cadena_fecha_datepicker( $str_fecha = "")
	{
		if (empty($str_fecha))
			return false;
			
		$arr_fecha = explode("/",$str_fecha);
		
		if (empty($arr_fecha[1]))
			return false;
		date_default_timezone_set('America/Mexico_City');
		$fecha = date("Y-m-d", mktime(0,0,0,$arr_fecha[1],$arr_fecha[0],$arr_fecha[2]));

		return $fecha;
	}
	
	
	// solo funciona para las cadenas con estructura de JQuery forma: MM/DD/AAAA
	public function cadena_fecha( $str_fecha = "")
	{
		if (empty($str_fecha))
			return false;
			
		$arr_fecha = explode("/",$str_fecha);
		
		if (empty($arr_fecha[1]))
			return false;
		
		date_default_timezone_set('America/Mexico_City');
		$fecha = date("Y-m-d", mktime(0,0,0,$arr_fecha[0],$arr_fecha[1],$arr_fecha[2]));

		return $fecha;
	}
	
	//da la fecha y hora actual
	public function hoy()
	{
		date_default_timezone_set('America/Mexico_City');
		return date( 'Y-m-d H:i:s',time() );
	}
	
	public function prepara_cadena_busquedas($url = "")
	{
		$url = strtolower($url);
		
		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
		$repl = array('a', 'e', 'i', 'o', 'u', 'n');
		$url = str_replace ($find, $repl, $url);
		
		$find = array( '&', '\r\n', '\n', '+');
		$url = str_replace ($find, '-', $url);
		
		return $url;
	} 
	
	public function prepara_cadena_enlace($url = "")
	{
		$url = strtolower($url);
		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
		$repl = array('a', 'e', 'i', 'o', 'u', 'n');
		$url = str_replace ($find, $repl, $url);
		$find = array(' ', '&', '\r\n', '\n', '+');
		$url = str_replace ($find, '-', $url);
		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('', '_', '');
		$url = preg_replace ($find, $repl, $url);
		
		return $url;
	} 
	
	function limpia_caracteres_to_ascii( $cadena = "" )
	{
		if( empty($cadena) )
			return false;

		$mensaje = str_replace("=","",$cadena);
		$mensaje = str_replace("\"","",$mensaje); 
		$mensaje = str_replace("'","&#39;",$mensaje); 

		return $mensaje;
	}
	
	//Limpia una cadena
	public function limpia_cadena($cadena = "")
	{
		if ( $cadena == "" )
			return false;
		
		return mb_eregi_replace("[^ A-Za-z0-9_\.]", "", $cadena);
	}
	
	
	public function lista_directorio ($dir = "")
	{
		if ( strlen($dir) == 0 )
			return false;
			
		$a_archivos = array();
		
		if( !$dr = opendir( $dir ) )
			return false;

		$contador = 0;
		while (($archivo = readdir($dr)) !== false) 
		{
			if(filetype($dir . $archivo)!="dir")
			{
				$tam=round(filesize($dir . $archivo)/1024,0);
				$a_archivos[$contador]= $dir.$archivo ;
			}
			$contador++;
		}
		closedir($dr);
		
		sort( $a_archivos );
		
		return $a_archivos;
	}
	
	
	//Genera una cadena de numeros y caracteres aleatorios 
	public function genera_cadena_aleatoria( $tamanio = 0 )
	{
		$code = md5(uniqid(rand(), true));
		if ($tamanio != 0)
			return substr($code, 0, $tamanio);
		else 
			return $code;
	}
	
	//obtiene la IP del usuario
	public function obten_ip()
	{
		$realip = 0;
		if ($_SERVER)
		{
			if ( $_SERVER["HTTP_X_FORWARDED_FOR"] ) 
			{  
				$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];  
			} 
			elseif ( $_SERVER["HTTP_CLIENT_IP"] ) 
			{  
				$realip = $_SERVER["HTTP_CLIENT_IP"];  
			} 
			else 
			{  
				$realip = $_SERVER["REMOTE_ADDR"];  
			} 
		} 
		else 
		{  
			if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) 
			{
				$realip = getenv( 'HTTP_X_FORWARDED_FOR' );  
			} 
			elseif ( getenv( 'HTTP_CLIENT_IP' ) ) 
			{  
				$realip = getenv( 'HTTP_CLIENT_IP' );  
			} else 
			{  
				$realip = getenv( 'REMOTE_ADDR' );  
			}
		}
		return $realip;
	}
	
	//Genera un password
	public function construye_password( $longitud  = 0 )
	{
		if ( intval($longitud) == 0)
			$tamanio = 5;
		else
			$tamanio = $longitud; 
			
		$nuevo_pass = $this->genera_cadena_aleatoria( $tamanio );
		
		return md5( $nuevo_pass );
	}
	
	//Encripta una cadena
	public function encriptar( $cadena = "", $semilla = "" )
	{
		if($cadena == "")
			return false;
			
		if($semilla == "")
			return false;
		
		$resultado = '';
		for($i=0; $i<strlen($cadena); $i++) 
		{
			$txt = substr($cadena, $i, 1);
			$keytxt = substr($semilla, ($i % strlen($semilla))-1, 1);
			$txt = chr(ord($txt)+ord($keytxt));
			$resultado .= $txt;
		}
		return base64_encode($resultado);
	}

	//Desencripta la cadena
	public function desencriptar($cadena="", $semilla = "")
	{
		if($semilla == "")
			return false;
		
		if($cadena == "")
			return false;
		
		$resultado = '';
		$cadena = base64_decode($cadena);
		for($i=0; $i<strlen($cadena); $i++) 
		{
			$txt = substr($cadena, $i, 1);
			$keytxt = substr($semilla, ($i % strlen($semilla))-1, 1);
			$txt = chr(ord($txt)-ord($keytxt));
			$resultado.= $txt;
		}
		return $resultado;
	}
        
	//Corta una cadena sin cortar palabras
     public function corta_cadena( $txt = "" , $long = 0, $break = " ", $pad="...")
	{
		if(strlen($txt) <= $long)
		return $txt;
		// is $break present between $long and the end of the txt?
		if(false !== ($breakpoint = strpos($txt, $break, $long))) {
		if($breakpoint < (strlen($txt) - 1) ) {
		$txt = substr($txt, 0, $breakpoint) . $pad;
		}
		}
		return $txt;
	}

	//Valida que un correo sea válido
	function valida_email($email )
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			return false;
		else
			return true;
	}
	
	
//Convierte un array a json
	public function array_a_json( $array )
	{
		if( !is_array( $array ) )
			return false;

		$associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
		if( $associative )
		{
			$construct = array();
			foreach( $array as $key => $value )
			{
				// We first copy each key/value pair into a staging array, formatting each key and value properly as we go. Format the key:
				if( is_numeric($key) )
				{
					$key = "key_$key";
				}
				$key = "\"".addslashes($key)."\"";

				// Format the value:
				if( is_array( $value ))
				{
					$value = $this->array_a_json( $value );
				} 
				else if( !is_numeric( $value ) || is_string( $value ) )
				{
					$value = "\"".addslashes($value)."\"";
				}
				// Add to staging array:
				$construct[] = "$key: $value";
			}

			// Then we collapse the staging array into the JSON form:
			$result = "{ " . implode( ", ", $construct ) . " }";
		} 
		else 
		{
			$construct = array();
			foreach( $array as $value )
			{
				// Format the value:
				if( is_array( $value ))
				{
					$value = $this->array_a_json( $value );
				} 
				else if( !is_numeric( $value ) || is_string( $value ) )
				{
					$value = "'".addslashes($value)."'";
				}
				// Add to staging array:
				$construct[] = $value;
			}
			// Then we collapse the staging array into the JSON form:
			$result = "[ " . implode( ", ", $construct ) . " ]";
		}
		return $result;
	}

	function fecha_formato_humano ( $fecha = "" )
	{
		if($fecha == "" )
			return false;
	
		$arr_fechafull = explode(" ",$fecha);
	
		$arr_fecha = explode("-",$arr_fechafull[0]);
		
		$arr_dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$arr_meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		 
		return $arr_dias[$arr_fecha[2]]." ".$arr_fecha[2]." de ".$arr_meses[$arr_fecha[1]-1]. " del ".$arr_fecha[0] ;
	}
	
	function obtener_dominio ()
	{

		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol = $this->strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
		 
		return $protocol . "://" . $_SERVER['SERVER_NAME'];
	}
	
	function strleft($s1, $s2)
    {
		return substr($s1, 0, strpos($s1, $s2));
    }
	
	function obten_articulos_blog( $url = "" ) //RSS Image Feed -> Click, to include the "enclosure" tag in the feed / Click, to include the "media:content" tag in the feed.
	{
		if( empty($url) )
		{
			echo 'ERROR! ';
		}
		
		$arr_feed = array();
				
		$feeds = file_get_contents($url);
		$rss = simplexml_load_string($feeds);
		
		$contador_feed = 0;
		foreach($rss->channel->item as $entry) 
		{
			$arr_feed[$contador_feed]["title"] = $entry->xpath('title');
			$arr_feed[$contador_feed]["link"] = $entry->xpath('link'); 
					
			if($entry->children('media', true)->content->attributes()) 
			{
				$md = $entry->children('media', true)->content->attributes();
				$arr_feed[$contador_feed]["image"] = $md->url;
			}
			$contador_feed++;
		}

		return $arr_feed;
	}
	
}
?>
