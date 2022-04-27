<?
session_start();

include_once(dirname(__FILE__) ."/configuration.php");
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<?
			include_once (URL_SERVIDOR_FRONT."/class/generales.class.php");
			$generales = new generales();
			
			include_once (URL_SERVIDOR_FRONT."/class/base.class.php");
			$base = new base();

			$url_seccion =  strtolower($_GET["q"]);
			if(empty( $_GET["q"]) )
				$url_seccion = "inicio";
			
			if($_GET["q"] == "galeria" )
			{
				$arr_sitio_base = $base->base_obten_datos_seo( $_GET["n"] );
				$url_seccion = strtolower($_GET["n"]);
			}
			else
			{
				$arr_sitio_base = $base->base_obten_datos_seo( $url_seccion );
			}
		?>
		<title> <?=$arr_sitio_base["title"]?> - <?=NOMBRE_SITIO?> - <?=$_SERVER["HTTP_HOST"]?> </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="<?=$arr_sitio_base["author"]?>">
		<meta name="title" content="<?=$arr_sitio_base["title"]?> <?=$arr_sitio_base["author"]?>">
		<meta name="DC.Title" content="<?=$arr_sitio_base["title"]?> <?=$arr_sitio_base["author"]?>">
		<meta http-equiv="title" content="<?=$arr_sitio_base["title"]?> <?=$arr_sitio_base["author"]?>">
		<meta name="rating" content="General"/>
		<meta name="abstract" content="<?=$arr_sitio_base["description"]?>"/>
		<meta name="description" content="<?=$arr_sitio_base["description"]?>">
		<meta http-equiv="description" content="<?=$arr_sitio_base["description"]?>">
		<meta http-equiv="DC.Description" content="<?=$arr_sitio_base["description"]?>">
		<meta name="keywords" content="<?=$arr_sitio_base["keywords"]?>">
		<meta http-equiv="keywords" content="<?=$arr_sitio_base["keywords"]?>">
		<meta name="Revisit" content="30">
		<meta name="REVISIT-AFTER" content="30">
		<meta http-equiv="Content-Language" content="es"/>
		<meta name="ROBOTS" content="INDEX,FOLLOW"/>
		<meta name="distribution" content="global">
		<meta name="resource-type" content="document">
		<meta http-equiv="Pragma" content="cache">
		
		<meta property="og:title" content="<?=$arr_sitio_base["title"]?>" />
		<meta property="og:type" content="article" />
		<meta property="og:site_name" content="<?=$arr_sitio_base["title"]?>" />
		<meta property="og:image" content="http://www.<?=$arr_sitio_base["url_sitio"]?><?=URL_USERFILES?>image/<?=$arr_sitio_base["imagen_destacada"]?>" />
		<meta property="og:url" content="http://www.<?=$arr_sitio_base["url_sitio"]?>/index.php?q=<?=$url_seccion?>" />
		
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:title" content="<?=$arr_sitio_base["title"]?>" />
		<meta name="twitter:description" content="<?=$arr_sitio_base["description"]?>" />
		<meta name="twitter:image" content="http://www.<?=$arr_sitio_base["url_sitio"]?><?=URL_USERFILES?>image/<?=$arr_sitio_base["imagen_destacada"]?>" />
		<!--// <?=$arr_sitio_base["description"]?> //-->  

		<link href="./libs/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="./libs/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="./css/usr.css" rel="stylesheet">
		<link href="./libs/tables/tables.css" rel="stylesheet">
		<link href="./libs/animate/css/animate.css" rel="stylesheet">
		<link rel="stylesheet" href="./libs/lightbox/css/lightbox.css">	
		<!-- Global site tag (gtag.js) - Google Ads: 716540927 -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=AW-716540927"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'AW-716540927');
		</script>

	
	</head>

	<body>
	<?
		
	include_once (URL_SERVIDOR_FRONT."/class/contenido.class.php");
	$contenido = new contenido();
	
	
		if (!include_once (URL_SERVIDOR_FRONT."/template/header.php"))
			echo alerta("<strong>Error:</strong> No se encontro el archivo de la cabecera");

		if (!include_once (URL_SERVIDOR_FRONT."/template/contenido.php"))
			echo alerta("<strong>Error:</strong> No se encontro el archivo con el contenido");

		if( intval($arr_sitio_base["btn_compartir"]) == 1 )
			include_once (URL_SERVIDOR_FRONT."/libs/codes/social.php");
			
		if (!include_once (URL_SERVIDOR_FRONT."/template/footer.php"))
			echo alerta("<strong>Error:</strong> No se encontro el archivo del footer");

		echo "<!--Este sitio Web ha sido desarrollado por: \n
		www.solucionesim.net - contacto [arroba] solucionesim [punto] net
		Carlos Navarro (Desarrollador  PHP) www.carlosnuel.com - carlosnuel [arroba] gmail [punto] com, \n \n\n
		Si te ha gustado nuestro trabajo, tienes comentarios y/o sugerencias que crees pudieran sernos de utilidad puedes contactarnos y con mucho gusto te responderemos a la brevedad posible.\n
		Todos los derechos reservados. ".date("Y")."
		-->";
	?>
	
	<script src="./libs/bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="./libs/bootstrap/js/bootstrap.js"></script>
	<script src="./libs/validate/jqvalidate.js"></script>
	<script src="./libs/bootstrap/js/bootstrap-dropdown.js"></script>
	<script src="./js/usr.js"></script>
	<script src="./js/jquery.particleground.js"></script>
	<script src="./libs/animate/js/animate.js"></script>
	<script src="./libs/lightbox/js/lightbox.js"></script>
	
	<?
	if ($url_seccion == 'inicio')
		{
	?>
	
		<noscript>
			<link rel="stylesheet" type="text/css" href="libs/parallax/css/nojs.css" />
		</noscript>
		<script src="libs/parallax/js/modernizr.custom.28468.js" type="text/javascript"></script>
		<script src="libs/parallax/js/jquery.cslider.js" type="text/javascript"></script>

		<link rel="stylesheet" type="text/css" href="libs/parallax/css/style.css" />
		<script type="text/javascript">
		$(function() {
			$('#da-slider').cslider({
				autoplay	: true,
				bgincrement	: 450
			});
		});
		</script>
	<?
		}
	?>
	
	<?
		if ($url_seccion == 'servicios' || $url_seccion == 'soporte_tecnico' || $url_seccion == 'consultoria_y_seguridad_informatica' || $url_seccion == 'hosting' || $url_seccion == 'consumibles')
		{
	?>
	<link rel="stylesheet" type="text/css" href="./libs/jcarousel/jcarousel.responsive.css">
	<script type="text/javascript" src="./libs/jcarousel/jquery.jcarousel.js"></script>
	<script type="text/javascript" src="./libs/jcarousel/jcarousel.responsive.js"></script>
	<script type="text/javascript" src="./libs/jcarousel/autoscroll.js"></script>
	<script type="text/javascript">
	$(function() {
		$('.jcarousel')
			.jcarousel({
				// Core configuration goes here
			})
			.jcarouselAutoscroll({
				interval: 3000,
				target: '+=1',
				autostart: true
			})
		;
	});
	</script>
	<?
		}
	?>
	
	<!--[if lt IE 9]>
			<script src="./libs/bootstrap/js/html5shiv.js"></script>
		<![endif]-->
		

	<?
		if( strlen($arr_sitio_base["analytics"]) > 5 )
			include_once (URL_SERVIDOR_FRONT."/libs/codes/analytics.php");
	?>
	
	<!-- WhatsHelp.io widget -->
	<script type="text/javascript">
		(function () { 
			var options = {
				whatsapp: "+525539201357", // WhatsApp number
				call_to_action: "¿Tienes dudas?", // Call to action
				position: "left", // Position may be 'right' or 'left'
			};
			var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
			var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
			s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
			var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
		})();
	</script>
	<!-- /WhatsHelp.io widget -->
		
	<!--Sitio desarrollado por Soluciones IM <?=date("Y")?>-->
	</body>
</html>
