-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-07-2015 a las 14:25:20
-- Versión del servidor: 5.5.43-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.9

SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cms2015`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE IF NOT EXISTS `configuracion` (
  `configuracion_id` int(11) NOT NULL,
  `configuracion_nombre_empresa` varchar(255) NOT NULL,
  `configuracion_email_empresa` varchar(150) NOT NULL,
  `configuracion_url_empresa` varchar(150) NOT NULL,
  `configuracion_correo_respuesta` text NOT NULL,
  `configuracion_keywords_base` varchar(255) DEFAULT NULL,
  `configuracion_descripcion_base` varchar(255) DEFAULT NULL,
  `configuracion_codigo_analytics` text NOT NULL,
  `configuracion_estilo_personalizado` text NOT NULL,
  `configuracion_ultima_modificacion` datetime NOT NULL, 
  `usuarios_id` int(20) NOT NULL,
  `configuracion_status` int(3) NOT NULL
) ;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`configuracion_id`, `configuracion_nombre_empresa`, `configuracion_email_empresa`, `configuracion_url_empresa`, `configuracion_correo_respuesta`, `configuracion_keywords_base`, `configuracion_descripcion_base`, `configuracion_codigo_analytics`, `configuracion_estilo_personalizado`, `configuracion_ultima_modificacion`, `usuarios_id`, `configuracion_status`) VALUES
(1, 'Soluciones IM SA de CV', 'cnavarro@solucionesim.net', 'http://www.solucionesim.net', '<p style="text-align:center">Su correo fue enviado con &eacute;xito.</p>\r\n\r\n			<p style="text-align:center">En breve le responderemos.</p>', 'Soluciones IM SA de CV, Productos, Sitio Web', 'Bienvenido al sitio web de Soluciones IM SA de CV WebHosting', '', '', '2002-09-26 19:54:57', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

DROP TABLE IF EXISTS `contacto`;
CREATE TABLE IF NOT EXISTS `contacto` (
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
) AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_respuestas`
--

DROP TABLE IF EXISTS `contacto_respuestas`;
CREATE TABLE IF NOT EXISTS `contacto_respuestas` (
  `contacto_respuestas_id` int(50) NOT NULL AUTO_INCREMENT,
  `contacto_id` int(10) NOT NULL,
  `contacto_respuestas_correo` varchar(100) NOT NULL,
  `contacto_respuestas_asunto` varchar(200) NOT NULL,
  `contacto_respuestas_contenido` text NOT NULL,
  `contacto_respuestas_fecha` datetime NOT NULL,
  PRIMARY KEY (`contacto_respuestas_id`)
) AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

DROP TABLE IF EXISTS `contenido`;
CREATE TABLE IF NOT EXISTS `contenido` (
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
)  AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`contenido_id`, `contenido_titulo`, `contenido_descripcion`, `contenido_imagen`, `contenido_contenido`, `contenido_btn_compartir`, `contenido_palabras_clave`, `secciones_id`, `contenido_fecha_modificacion`, `contenido_status`) VALUES
(1, 'Bienvenido', 'Bienvenido A Mi Sitio Web', '', '<p><strong>Don Quijote</strong></p>\r\n\r\n<p>Don Quijote De Aquella Manera, Con Muestras De Tanta Tristeza, Le Dijo: S&aacute;bete, Sancho, Que No Es Un Hombre M&aacute;s Que Otro Si No Hace M&aacute;s Que Otro.</p>\r\n\r\n<p>Todas Estas Borrascas Que Nos Suceden Son Se&ntilde;ales De Que Presto Ha De Serenar El Tiempo Y Han De Sucedernos Bien Las Cosas; Porque No Es Posible Que El Mal Ni El Bien Sean Durables, Y De Aqu&iacute; Se Sigue Que, Habiendo Durado Mucho El Mal, El Bien Est&aacute; Ya Cerca.</p>\r\n\r\n<p>As&iacute; Que, No Debes Congojarte Por Las Desgracias Que A M&iacute; Me Suceden, Pues A Ti No Te Cabe Parte Dellas. Y, Vi&eacute;ndole Don Quijote De Aquella Manera, Con Muestras De Tanta Tristeza, Le Dijo: S&aacute;bete, Sancho, Que No Es Un Hombre M&aacute;s Que Otro Si No Hace M&aacute;s Que Otro.</p>\r\n', 1, '', 1, '2002-09-26 19:39:44', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido_historia`
--

DROP TABLE IF EXISTS `contenido_historia`;
CREATE TABLE IF NOT EXISTS `contenido_historia` (
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
) AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galerias`
--

DROP TABLE IF EXISTS `galerias`;
CREATE TABLE IF NOT EXISTS `galerias` (
  `galerias_id` int(100) NOT NULL AUTO_INCREMENT,
  `galerias_titulo` varchar(250) NOT NULL,
  `galerias_keywords` varchar(255) NOT NULL,
  `secciones_id` int(100) NOT NULL,
  `galerias_fecha_creacion` datetime NOT NULL,
  `galerias_status` int(2) NOT NULL,
  PRIMARY KEY (`galerias_id`)
)  AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `galerias`
--

INSERT INTO `galerias` (`galerias_id`, `galerias_titulo`, `galerias_keywords`, `secciones_id`, `galerias_fecha_creacion`, `galerias_status`) VALUES
(1, 'Slide p&aacutegina inicio', 'inicio, galeria, sitio web', 1, '2015-07-17 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galerias_imagenes`
--

DROP TABLE IF EXISTS `galerias_imagenes`;
CREATE TABLE IF NOT EXISTS `galerias_imagenes` (
  `galerias_imagenes_id` int(200) NOT NULL AUTO_INCREMENT,
  `galerias_id` int(100) NOT NULL,
  `galerias_imagenes_url_imagen` varchar(255) NOT NULL,
  `galerias_imagenes_url` varchar(255) NOT NULL,
  `galerias_imagenes_titulo` varchar(255) NOT NULL,
  `galerias_imagenes_descripcion` varchar(255) NOT NULL,
  `galerias_imagenes_fecha` datetime NOT NULL,
  `galerias_imagenes_status` int(2) NOT NULL,
  PRIMARY KEY (`galerias_imagenes_id`)
) AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_login`
--

DROP TABLE IF EXISTS `registro_login`;
CREATE TABLE IF NOT EXISTS `registro_login` (
  `registro_login_id` int(100) NOT NULL AUTO_INCREMENT,
  `registro_login_usuario` varchar(20) NOT NULL,
  `registro_login_ip` varchar(30) NOT NULL,
  `registro_login_fecha` datetime NOT NULL,
  `usuarios_id` int(10) NOT NULL,
  PRIMARY KEY (`registro_login_id`)
)  AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `registro_login`
--

INSERT INTO `registro_login` (`registro_login_id`, `registro_login_usuario`, `registro_login_ip`, `registro_login_fecha`, `usuarios_id`) VALUES
(1, 'solucionesim', '192.168.0.6', '2015-07-17 12:44:50', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

DROP TABLE IF EXISTS `secciones`;
CREATE TABLE IF NOT EXISTS `secciones` (
  `secciones_id` int(30) NOT NULL AUTO_INCREMENT,
  `secciones_nombre` varchar(100) NOT NULL,
  `secciones_url` varchar(100) NOT NULL,
  `secciones_superior_id` int(30) NOT NULL,
  `secciones_descripcion` varchar(255) NOT NULL,
  `secciones_fecha` datetime NOT NULL,
  `usuarios_id` int(10) NOT NULL,
  `secciones_status` int(2) NOT NULL,
  PRIMARY KEY (`secciones_id`)
)  AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`secciones_id`, `secciones_nombre`, `secciones_url`, `secciones_superior_id`, `secciones_descripcion`, `secciones_fecha`, `usuarios_id`, `secciones_status`) VALUES
(1, 'Inicio', 'inicio', 0, 'Bienvenido a Inicio', '2013-11-28 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
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
)  AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `usuarios_nombre`, `usuarios_usuario`, `usuarios_password`, `usuarios_email`, `usuarios_es_admin`, `usuarios_fecha_creacion`, `usuario_inserta_id`, `usuarios_status`) VALUES
(1, 'Soluciones IM .NET SA de CV', 'solucionesim', '6435743b4a488ce81fa6441f8cb338804ae199c', 'cnavarro@solucionesim.net', 1, '2002-09-24 02:47:48', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_permisos`
--

DROP TABLE IF EXISTS `usuarios_permisos`;
CREATE TABLE IF NOT EXISTS `usuarios_permisos` (
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
)  AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios_permisos`
--

INSERT INTO `usuarios_permisos` (`usuarios_permisos_id`, `usuarios_id`, `usuarios_permisos_secciones`, `usuarios_permisos_contenido`, `usuarios_permisos_estadisticas`, `usuarios_permisos_centro_negocios`, `usuarios_permisos_configuracion`, `usuarios_permisos_fecha_modificacion`, `usuarios_id_modifico`, `usuarios_permisos_status`) VALUES
(1, 1, 1, 1, 2, 1, 1, '2002-09-24 03:38:50', 5, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
