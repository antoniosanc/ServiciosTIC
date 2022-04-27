-- Database: `cms2017` --
-- Table `configuracion` --
CREATE TABLE `configuracion` (
  `configuracion_id` int(11) NOT NULL,
  `configuracion_nombre_empresa` varchar(255) NOT NULL,
  `configuracion_email_empresa` varchar(150) NOT NULL,
  `configuracion_url_empresa` varchar(150) NOT NULL,
  `configuracion_correo_respuesta` text NOT NULL,
  `configuracion_keywords_base` varchar(255) DEFAULT NULL,
  `configuracion_keyword_seo` varchar(100) DEFAULT NULL,
  `configuracion_descripcion_base` varchar(255) DEFAULT NULL,
  `configuracion_codigo_analytics` text NOT NULL,
  `configuracion_codigo_chat` text NOT NULL,
  `configuracion_codigo_messenger` varchar(20) DEFAULT NULL,
  `configuracion_recaptcha_publico` varchar(255) DEFAULT NULL,
  `configuracion_recaptcha_privado` varchar(255) DEFAULT NULL,
  `configuracion_translate` int(3) NOT NULL,
  `configuracion_estilo_personalizado` text NOT NULL,
  `configuracion_ultima_modificacion` datetime NOT NULL,
  `usuarios_id` int(20) NOT NULL,
  `configuracion_status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `configuracion` (`configuracion_id`, `configuracion_nombre_empresa`, `configuracion_email_empresa`, `configuracion_url_empresa`, `configuracion_correo_respuesta`, `configuracion_keywords_base`, `configuracion_keyword_seo`, `configuracion_descripcion_base`, `configuracion_codigo_analytics`, `configuracion_codigo_chat`, `configuracion_codigo_messenger`, `configuracion_recaptcha_publico`, `configuracion_recaptcha_privado`, `configuracion_translate`, `configuracion_estilo_personalizado`, `configuracion_ultima_modificacion`, `usuarios_id`, `configuracion_status`) VALUES
(1, 'Soluciones IM SA de CV', 'cnavarro@solucionesim.net', 'http://www.solucionesim.net', '<table width=\"800\" cellspacing=\"0\" cellpadding=\"5\" border=\"0\" align=\"center\"><tbody><tr><td width=\"400\" style=\"border-bottom:2px solid #ccc;\"><h2 style=\"text-align:left;\"><a href=\"#\">Logo de su empresa</a></h2></td><td width=\"400\" style=\"border-bottom:2px solid #ccc;\"><p style=\"text-align:right;\"><a href=\"#\"><img src=\"http://www.solucionesim.net/imgusr/icono-face.png\" alt=\"Facebook\"></a><a href=\"#\"><img src=\"http://www.solucionesim.net/imgusr/icono-twitter.png\" alt=\"Twitter\"></a><a href=\"#\"><img src=\"http://www.solucionesim.net/imgusr/icono-youtube.png\" alt=\"YouTube\"></a></p></td></tr><tr><td width=\"800\" colspan=\"2\" style=\"padding-bottom:50px; padding-top:50px;\"><p style=\"text-align:center;\">Estimado usuario</p><p style=\"text-align:center;\">Su correo fue enviado con &eacute;xito.</b></p><p style=\"text-align:center;\">En breve le responderemos.</p></td></tr><tr><td width=\"800\" colspan=\"2\" style=\"border-top:2px solid #ccc;\"><p style=\"text-align:right;\"><img alt=\"SIM\" src=\"http://www.solucionesim.net/imgusr/icono-tel.png\" class=\"img-responsive\" width=\"20\" border=\"0\"> (55) 5970-6848 <br/>contacto@solucionesim.net<br/><a style=\"color:#00aeef;\" href=\"http://www.solucionesim.net\">www.solucionesim.net</a><p></td></tr></tbody></table>', 'Soluciones IM SA de CV, Productos, Sitio Web, servicios', 'Sitios Web', 'Bienvenido al sitio web de Soluciones IM SA de CV WebHosting para sitios web profesionales prueba tu página ahora', 'UA-126975523-2', '', '588228301294343', '', '', 0, '', '2018-12-26 14:25:18', 1, 1);

-- Table `contacto` --
CREATE TABLE `contacto` (
  `contacto_id` int(10) NOT NULL AUTO_INCREMENT,
  `contacto_nombre` varchar(100) NOT NULL,
  `contacto_correo_electronico` varchar(100) NOT NULL,
  `contacto_telefono` varchar(255) DEFAULT NULL,
  `contacto_direccion` varchar(255) DEFAULT NULL,
  `contacto_asunto` varchar(255) DEFAULT NULL,
  `contacto_comentarios` text NOT NULL,
  `contacto_fecha_contacto` datetime NOT NULL,
  `contacto_status` int(1) NOT NULL,
  PRIMARY KEY (`contacto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `contacto` (`contacto_id`, `contacto_nombre`, `contacto_correo_electronico`, `contacto_telefono`, `contacto_direccion`, `contacto_asunto`, `contacto_comentarios`, `contacto_fecha_contacto`, `contacto_status`) VALUES
(1, 'Carlos Navarro', 'carlos@solucionesim.net', '59706848', 'MÃ©xico', 'Prueba de pÃ¡gina CMS', 'prueba de CMS para validar funcionamiento', '2016-02-15 12:06:48', 1);

-- Table `contacto_respuestas` --
CREATE TABLE `contacto_respuestas` (
  `contacto_respuestas_id` int(50) NOT NULL AUTO_INCREMENT,
  `contacto_id` int(10) NOT NULL,
  `contacto_respuestas_correo` varchar(100) NOT NULL,
  `contacto_respuestas_asunto` varchar(200) NOT NULL,
  `contacto_respuestas_contenido` text NOT NULL,
  `contacto_respuestas_fecha` datetime NOT NULL,
  PRIMARY KEY (`contacto_respuestas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table `contenido` --
CREATE TABLE `contenido` (
  `contenido_id` int(10) NOT NULL AUTO_INCREMENT,
  `contenido_titulo` varchar(100) NOT NULL,
  `contenido_descripcion` varchar(255) DEFAULT NULL,
  `contenido_imagen` varchar(100) DEFAULT NULL,
  `contenido_contenido` text NOT NULL,
  `contenido_btn_compartir` int(2) NOT NULL,
  `contenido_palabras_clave` varchar(255) NOT NULL,
  `secciones_id` int(50) NOT NULL,
  `contenido_fecha_modificacion` datetime NOT NULL,
  `contenido_status` int(2) NOT NULL,
  PRIMARY KEY (`contenido_id`),
  KEY `contenido` (`contenido_titulo`,`contenido_descripcion`,`contenido_contenido`(255))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `contenido` (`contenido_id`, `contenido_titulo`, `contenido_descripcion`, `contenido_imagen`, `contenido_contenido`, `contenido_btn_compartir`, `contenido_palabras_clave`, `secciones_id`, `contenido_fecha_modificacion`, `contenido_status`) VALUES
(1, 'Bienvenido', 'Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables', 'VITACENTRAL.png', '<p>Y, vi&eacute;ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: S&aacute;bete, Sancho, que no es un hombre m&aacute;s que otro si no hace m&aacute;s que otro.fffff</p>\r\n<p>Todas estas borrascas que nos suceden<span style=\"background-color: rgb(0, 0, 255);\"> son se&ntilde;ales de q</span>ue presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y <b>de aqu&iacute; se sigue que, habiendo durad</b>o mucho el mal, el bien est&aacute;<span style=\"color: rgb(0, 0, 255);\"> ya cerca</span>.</p>\r\n<h2>El gran quijote</h2>\r\n<p>As&iacute; que, no debes congojarte por las desgracias que a m&iacute; me suceden, pues a ti no te cabe parte dellas. Y, vi&eacute;ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: S&aacute;bete, Sancho, que no es un hombre m&aacute;s que otro si no hace m&aacute;s que otro.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/fQqGKuB6d3g\" allowfullscreen=\"allowfullscreen\" width=\"560\" height=\"315\" frameborder=\"0\"></iframe></p>\r\n<p style=\"text-align: right;\">kk<img src=\"/userfiles/cuetzalan/image/82de-268x0wjpg.jpg\" alt=\"\" width=\"268\" height=\"268\" /></p>\r\n<table style=\"width: 200px; border-spacing: 1px;\" cellpadding=\"1\" border=\"1\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <p>&nbsp;</p>\r\n            <p>kkk</p>\r\n            </td>\r\n            <td>&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td>&nbsp;</td>\r\n            <td>&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td>&nbsp;</td>\r\n            <td>&nbsp;</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p style=\"text-align: right;\"><a href=\"index.php?q=contacto\" class=\"btn btn-info\"><strong> Don Quijote </strong></a></p>', 1, 'palabras, clave, de prueba', 1, '2019-02-15 19:25:41', 1);

-- Table `contenido_historia` --
CREATE TABLE `contenido_historia` (
  `contenido_historia_id` int(10) NOT NULL AUTO_INCREMENT,
  `contenido_id` int(50) NOT NULL,
  `contenido_historia_titulo` varchar(100) NOT NULL,
  `contenido_historia_descripcion` varchar(255) DEFAULT NULL,
  `contenido_historia_imagen` varchar(100) DEFAULT NULL,
  `contenido_historia_contenido` text NOT NULL,
  `secciones_id` int(50) NOT NULL,
  `contenido_historia_fecha_modificacion` datetime NOT NULL,
  `contenido_historia_status` int(2) NOT NULL,
  PRIMARY KEY (`contenido_historia_id`),
  KEY `contenido` (`contenido_historia_titulo`,`contenido_historia_descripcion`,`contenido_historia_contenido`(255))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `contenido_historia` (`contenido_historia_id`, `contenido_id`, `contenido_historia_titulo`, `contenido_historia_descripcion`, `contenido_historia_imagen`, `contenido_historia_contenido`, `secciones_id`, `contenido_historia_fecha_modificacion`, `contenido_historia_status`) VALUES
(1, 1, 'Bienvenido', 'Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables', 'VITACENTRAL.png', '<p>Y, viéndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: Sábete, Sancho, que no es un hombre más que otro si no hace más que otro.fffff</p>\r\n<p>Todas estas borrascas que nos suceden<span style=\"background-color: rgb(0, 0, 255);\"> son señales de q</span>ue presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y <b>de aquí se sigue que, habiendo durad</b>o mucho el mal, el bien está<span style=\"color: rgb(0, 0, 255);\"> ya cerca</span>.</p>\r\n<h2>El gran quijote</h2>\r\n<p>Así que, no debes congojarte por las desgracias que a mí me suceden, pues a ti no te cabe parte dellas. Y, viéndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: Sábete, Sancho, que no es un hombre más que otro si no hace más que otro.</p>\r\n<p align=\"right\"><a href=\"index.php?q=contacto\" class=\"btn btn-info\"><strong> Don Quijote </strong></a></p>', 1, '2019-02-15 19:25:02', 1),
(2, 1, 'Bienvenido', 'Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables', 'VITACENTRAL.png', '<p>Y, vi&eacute;ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: S&aacute;bete, Sancho, que no es un hombre m&aacute;s que otro si no hace m&aacute;s que otro.fffff</p>\r\n<p>Todas estas borrascas que nos suceden<span style=\"background-color: rgb(0, 0, 255);\"> son se&ntilde;ales de q</span>ue presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y <b>de aqu&iacute; se sigue que, habiendo durad</b>o mucho el mal, el bien est&aacute;<span style=\"color: rgb(0, 0, 255);\"> ya cerca</span>.</p>\r\n<h2>El gran quijote</h2>\r\n<p>As&iacute; que, no debes congojarte por las desgracias que a m&iacute; me suceden, pues a ti no te cabe parte dellas. Y, vi&eacute;ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: S&aacute;bete, Sancho, que no es un hombre m&aacute;s que otro si no hace m&aacute;s que otro.</p>\r\n<p style=\"text-align: right;\"><a href=\"index.php?q=contacto\" class=\"btn btn-info\"><strong> Don Quijote </strong></a></p>', 1, '2019-02-15 19:25:18', 1),
(3, 1, 'Bienvenido', 'Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables', 'VITACENTRAL.png', '<p>Y, vi&eacute;ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: S&aacute;bete, Sancho, que no es un hombre m&aacute;s que otro si no hace m&aacute;s que otro.fffff</p>\r\n<p>Todas estas borrascas que nos suceden<span style=\"background-color: rgb(0, 0, 255);\"> son se&ntilde;ales de q</span>ue presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y <b>de aqu&iacute; se sigue que, habiendo durad</b>o mucho el mal, el bien est&aacute;<span style=\"color: rgb(0, 0, 255);\"> ya cerca</span>.</p>\r\n<h2>El gran quijote</h2>\r\n<p>As&iacute; que, no debes congojarte por las desgracias que a m&iacute; me suceden, pues a ti no te cabe parte dellas. Y, vi&eacute;ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: S&aacute;bete, Sancho, que no es un hombre m&aacute;s que otro si no hace m&aacute;s que otro.</p>\r\n<p style=\"text-align: right;\">kk<img src=\"/userfiles/cuetzalan/image/82de-268x0wjpg.jpg\" width=\"268\" height=\"268\" alt=\"\" /></p>\r\n<table cellpadding=\"1\" border=\"1\" style=\"width: 200px; border-spacing: 1px;\">\r\n    <tbody>\r\n        <tr>\r\n            <td>\r\n            <p>&nbsp;</p>\r\n            <p>kkk</p>\r\n            </td>\r\n            <td>&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td>&nbsp;</td>\r\n            <td>&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td>&nbsp;</td>\r\n            <td>&nbsp;</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<p style=\"text-align: right;\"><a href=\"index.php?q=contacto\" class=\"btn btn-info\"><strong> Don Quijote </strong></a></p>', 1, '2019-02-15 19:25:41', 1);

-- Table `galerias` --
CREATE TABLE `galerias` (
  `galerias_id` int(100) NOT NULL AUTO_INCREMENT,
  `galerias_titulo` varchar(250) NOT NULL,
  `galerias_keywords` varchar(255) NOT NULL,
  `secciones_id` int(100) NOT NULL,
  `galerias_fecha_creacion` datetime NOT NULL,
  `galerias_status` int(2) NOT NULL,
  PRIMARY KEY (`galerias_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `galerias` (`galerias_id`, `galerias_titulo`, `galerias_keywords`, `secciones_id`, `galerias_fecha_creacion`, `galerias_status`) VALUES
(1, 'Slide p&aacutegina inicio', 'inicio, galeria, sitio web', 1, '2015-07-17 00:00:00', 1);

-- Table `galerias_imagenes` --
CREATE TABLE `galerias_imagenes` (
  `galerias_imagenes_id` int(200) NOT NULL AUTO_INCREMENT,
  `galerias_id` int(100) NOT NULL,
  `galerias_imagenes_url_imagen` varchar(255) NOT NULL,
  `galerias_imagenes_url` varchar(255) DEFAULT NULL,
  `galerias_imagenes_titulo` varchar(255) DEFAULT NULL,
  `galerias_imagenes_descripcion` varchar(255) DEFAULT NULL,
  `galerias_imagenes_vigencia` date DEFAULT NULL,
  `galerias_imagenes_fecha` datetime NOT NULL,
  `galerias_imagenes_status` int(2) NOT NULL,
  PRIMARY KEY (`galerias_imagenes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table `registro_login` --
CREATE TABLE `registro_login` (
  `registro_login_id` int(100) NOT NULL AUTO_INCREMENT,
  `registro_login_usuario` varchar(20) NOT NULL,
  `registro_login_ip` varchar(30) NOT NULL,
  `registro_login_fecha` datetime NOT NULL,
  `usuarios_id` int(10) NOT NULL,
  PRIMARY KEY (`registro_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `registro_login` (`registro_login_id`, `registro_login_usuario`, `registro_login_ip`, `registro_login_fecha`, `usuarios_id`) VALUES
(1, 'solucionesim', '192.168.0.6', '2015-07-17 12:44:50', 1),
(2, 'solucionesim', '192.168.0.30', '2019-02-15 19:23:42', 1),
(3, 'solucionesim', '192.168.0.30', '2019-02-15 19:24:01', 1),
(4, 'solucionesim', '192.168.0.30', '2019-02-15 19:24:40', 1),
(5, 'solucionesim', '192.168.0.30', '2019-02-15 19:24:54', 1),
(6, 'solucionesim', '192.168.0.14', '2019-02-21 18:08:52', 1);

-- Table `secciones` --
CREATE TABLE `secciones` (
  `secciones_id` int(30) NOT NULL AUTO_INCREMENT,
  `secciones_nombre` varchar(100) NOT NULL,
  `secciones_url` varchar(100) NOT NULL,
  `secciones_superior_id` int(30) NOT NULL,
  `secciones_descripcion` varchar(255) NOT NULL,
  `secciones_fecha` datetime NOT NULL,
  `secciones_seccion_estatica` int(3) NOT NULL DEFAULT '0',
  `secciones_muestra_header` int(1) NOT NULL DEFAULT '1',
  `secciones_muestra_footer` int(1) NOT NULL DEFAULT '1',
  `usuarios_id` int(10) NOT NULL,
  `secciones_status` int(2) NOT NULL,
  PRIMARY KEY (`secciones_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `secciones` (`secciones_id`, `secciones_nombre`, `secciones_url`, `secciones_superior_id`, `secciones_descripcion`, `secciones_fecha`, `secciones_seccion_estatica`, `secciones_muestra_header`, `secciones_muestra_footer`, `usuarios_id`, `secciones_status`) VALUES
(1, 'Inicio', 'inicio', 0, 'Bienvenido a Inicio', '2013-11-28 00:00:00', 1, 1, 1, 1, 1);

-- Table `usuarios` --
CREATE TABLE `usuarios` (
  `usuarios_id` int(4) NOT NULL AUTO_INCREMENT,
  `usuarios_nombre` varchar(150) NOT NULL,
  `usuarios_usuario` varchar(50) NOT NULL,
  `usuarios_password` varchar(100) NOT NULL,
  `usuarios_email` varchar(100) NOT NULL,
  `usuarios_es_admin` int(11) NOT NULL,
  `usuarios_fecha_creacion` datetime NOT NULL,
  `usuario_inserta_id` int(5) NOT NULL,
  `usuarios_status` int(2) NOT NULL,
  PRIMARY KEY (`usuarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `usuarios` (`usuarios_id`, `usuarios_nombre`, `usuarios_usuario`, `usuarios_password`, `usuarios_email`, `usuarios_es_admin`, `usuarios_fecha_creacion`, `usuario_inserta_id`, `usuarios_status`) VALUES
(1, 'Soluciones IM .NET SA de CV', 'solucionesim', '6435743b4a488ce81fa6441f8cb338804ae199c', 'cnavarro@solucionesim.net', 1, '2002-09-24 02:47:48', 1, 1);

-- Table `usuarios_permisos` --
CREATE TABLE `usuarios_permisos` (
  `usuarios_permisos_id` int(10) NOT NULL AUTO_INCREMENT,
  `usuarios_id` int(5) NOT NULL,
  `usuarios_permisos_secciones` int(1) NOT NULL COMMENT '3 no permitido, 2 solo lectura, 1 lectura y escritura',
  `usuarios_permisos_contenido` int(3) NOT NULL,
  `usuarios_permisos_estadisticas` int(3) NOT NULL,
  `usuarios_permisos_centro_negocios` int(3) NOT NULL,
  `usuarios_permisos_configuracion` int(3) NOT NULL,
  `usuarios_permisos_fecha_modificacion` datetime NOT NULL,
  `usuarios_id_modifico` int(5) NOT NULL,
  `usuarios_permisos_status` int(2) NOT NULL,
  PRIMARY KEY (`usuarios_permisos_id`),
  UNIQUE KEY `usuarios_id` (`usuarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `usuarios_permisos` (`usuarios_permisos_id`, `usuarios_id`, `usuarios_permisos_secciones`, `usuarios_permisos_contenido`, `usuarios_permisos_estadisticas`, `usuarios_permisos_centro_negocios`, `usuarios_permisos_configuracion`, `usuarios_permisos_fecha_modificacion`, `usuarios_id_modifico`, `usuarios_permisos_status`) VALUES
(1, 1, 1, 1, 2, 1, 1, '2002-09-24 03:38:50', 5, 1);

