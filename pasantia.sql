-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-06-2015 a las 15:48:28
-- Versión del servidor: 5.5.38-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pasantia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `cedula_alumno` bigint(20) NOT NULL,
  `id_estatus` int(20) unsigned NOT NULL,
  `id_usuario` int(20) unsigned NOT NULL,
  `id_carrera` int(20) unsigned NOT NULL,
  `id_mencion` int(20) unsigned NOT NULL,
  `id_alumnos` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `carnet` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` int(10) DEFAULT NULL,
  `direccion_habitacion` varchar(130) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_habitacion` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_celular` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empleo` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_empleo` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo_empleo` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_empleo` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_empleo` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `creditos_aprobados` int(20) DEFAULT NULL,
  `semestre` int(20) DEFAULT NULL,
  `turno` int(20) DEFAULT NULL,
  `indice_academico` int(11) DEFAULT NULL,
  PRIMARY KEY (`cedula_alumno`),
  UNIQUE KEY `id_alumnos` (`id_alumnos`),
  UNIQUE KEY `cedula_alumno` (`cedula_alumno`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`cedula_alumno`, `id_estatus`, `id_usuario`, `id_carrera`, `id_mencion`, `id_alumnos`, `nombre`, `apellido`, `carnet`, `fecha_nacimiento`, `sexo`, `direccion_habitacion`, `telefono_habitacion`, `telefono_celular`, `email`, `empleo`, `nombre_empleo`, `cargo_empleo`, `telefono_empleo`, `email_empleo`, `creditos_aprobados`, `semestre`, `turno`, `indice_academico`) VALUES
(15862302, 1, 48, 2, 3, 28, 'JAVIER', 'RAMOS', '6700327', '1979-11-02', 1, 'mijares', '02124565445', '04242823894', 'javier_1842@hotmail.com', 'no', '', '', '', '', 102, 5, 1, 15),
(987654, 1, 24, 3, 7, 17, 'LUISA', 'MENDEZ', '32563293', '1984-10-10', 2, 'mmmmmmmmm', '02124565445', '04125635656', 'luisam1234@gmail.com', 'no', '', '', '', '', 99, 6, 2, 15),
(4444, 1, 29, 3, 7, 22, 'ANDRES', 'IZARRA', '6555', '1984-10-10', 1, 'knjhjhjhjhjhjh', '02124565445', '04125635656', 'ai@hotmail.com', 'no', '', '', '', '', 100, 5, 3, 16),
(3636, 1, 31, 3, 7, 24, 'FELIZ', 'UZCATEGUI', '32563293', '2006-06-09', 1, 'mijares', '02124565445', '04125635656', 'felix@hotmail.com', 'no', '', '', '', '', 101, 5, 3, 10),
(19200360, 2, 47, 1, 5, 27, 'CARLOS', 'ANGULO', '69300123', '1990-06-09', 1, 'QUINTA ANAUCO AV BOLIVAR', '02124565445', '04125635656', 'carlos_an98789@gmail.com', 'si', 'PDVSA', 'ANALISTA DE PRESUPUESTO II', '2128563254', 'cangulo@pdvsa.gob.ve', 102, 6, 1, 15),
(15325899, 2, 32, 3, 7, 25, 'DARIANA', 'GONZALEZ', '1028330', '1962-11-08', 1, 'AV. SANTA CECELIA', '02124565445', '04242823894', 'dari@hotmail.com', 'no', '', '', '', '', 102, 6, 2, 19),
(9696963, 0, 50, 0, 0, 30, 'JENIFER', 'VEGA', NULL, NULL, NULL, NULL, NULL, NULL, 'jeniferv_344@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15843331, 4, 40, 3, 7, 26, 'DORIAN', 'GONZALEZ', '6700327', '1984-06-06', 1, 'mijares', '02128601103', '04242823894', 'doriandarren1@hotmail.com', 'no', '', '', '', '', 101, 5, 3, 19),
(15999666, 1, 49, 1, 5, 29, 'JULIAN ', 'ARIAS', '1111111', '1984-06-06', 1, 'SAN JUAQUIN LAS PIEDRAS', '02124565445', '04242823894', 'jarias@gmail.com', 'si', 'FUNDAPATRIMONIO', 'ANALISTA DE PRESUPUESTO II', '02125859789', 'presupuesto@fundapatrimonio.gob.ve', 101, 6, 1, 16),
(23563230, 0, 51, 0, 0, 31, 'FRANYER', 'VALERO', NULL, NULL, NULL, NULL, NULL, NULL, 'FRANYER_VALERO1987@HOTMAIL.COM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12363666, 5, 54, 3, 7, 32, 'LILIAN', 'PEREZ', '4568566', '1974-05-08', 2, 'altagracia', '02125632632', '04142225566', 'LILIANP15263@HOTMAIL.COM', 'no', '', '', '', '', 92, 6, 1, 18),
(0, 0, 56, 0, 0, 34, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(233, 0, 57, 0, 0, 35, 'EEEEEEWWEW', 'WWEWE', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13698596, 0, 58, 0, 0, 36, 'JHONY ALFREDO', 'ZAPATA BRITO', NULL, NULL, NULL, NULL, NULL, NULL, 'JHONYAL_234_1@GMAIL.COM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6259828, 0, 60, 0, 0, 37, 'PEDRO', 'PEREZ', NULL, NULL, NULL, NULL, NULL, NULL, 'PEDROPER@HOTMAIL.COM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9876549, 0, 61, 0, 0, 38, 'JUAN', 'PEREZ', NULL, NULL, NULL, NULL, NULL, NULL, 'JPEREZ@HOTMAIL.COM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE IF NOT EXISTS `auditoria` (
  `evento_id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tabla` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `accion` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `user_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`evento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`evento_id`, `modulo`, `tabla`, `accion`, `fecha`, `hora`, `user_id`) VALUES
(1, 'CENTROS DE PASANTIA', 'vacante_departamento', 'CREAR', '0000-00-00', '16:01:26', '4'),
(2, 'CENTROS DE PASANTIA', 'vacante_departamento', 'CREAR', '2015-06-12', '16:06:40', '4'),
(3, 'REGISTRO ESTUDIANTE', 'usuario', 'CREAR', '2015-06-16', '15:33:12', ''),
(4, 'REGISTRO ESTUDIANTE', 'alumno', 'CREAR', '2015-06-16', '15:33:13', ''),
(5, 'ALUMNOS', 'usuario', 'CREAR', '2015-06-16', '15:43:19', '4'),
(6, 'ALUMNOS', 'alumno', 'CREAR', '2015-06-16', '15:43:19', '4'),
(7, 'REGISTRO USUARIO', 'alumno', 'ACTUALIZAR CLAV', '2015-06-17', '14:47:34', ''),
(8, 'REGISTRO USUARIO', 'alumno', 'ACTUALIZAR CLAV', '2015-06-17', '14:48:30', '61'),
(9, 'REGISTRO USUARIO', 'alumno', 'ACTUALIZAR CLAV', '2015-06-17', '14:49:40', '61'),
(10, 'REGISTRO USUARIO', 'alumno', 'ACTUALIZAR CLAV', '2015-06-17', '15:36:43', '61'),
(11, 'REGISTRO USUARIO', 'alumno', 'ACTUALIZAR CLAV', '2015-06-17', '15:37:55', '61'),
(12, 'REGISTRO USUARIO', 'alumno', 'ACTUALIZAR CLAV', '2015-06-17', '15:41:16', '61'),
(13, 'REGISTRO USUARIO', 'usuario', 'ACTUALIZAR CLAV', '2015-06-17', '15:45:18', '61');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
  `id_carrera` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_carrera` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_carrera`),
  UNIQUE KEY `id_carrera` (`id_carrera`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `nombre_carrera`) VALUES
(1, 'ADMINISTRACION'),
(2, 'CONTADURIA'),
(3, 'INFORMATICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros_temporales`
--

CREATE TABLE IF NOT EXISTS `centros_temporales` (
  `id_centros_temporales` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_preinscripcion` bigint(20) unsigned NOT NULL,
  `id_vacante_departamento` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id_centros_temporales`),
  UNIQUE KEY `id_centros_temporales` (`id_centros_temporales`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `centros_temporales`
--

INSERT INTO `centros_temporales` (`id_centros_temporales`, `id_preinscripcion`, `id_vacante_departamento`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 5, 4),
(4, 37, 5),
(5, 56, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_informes`
--

CREATE TABLE IF NOT EXISTS `control_informes` (
  `id_control_informes` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_inscrito` bigint(20) unsigned NOT NULL,
  `id_informes` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id_control_informes`),
  UNIQUE KEY `id_control_informes` (`id_control_informes`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `control_informes`
--

INSERT INTO `control_informes` (`id_control_informes`, `id_inscrito`, `id_informes`) VALUES
(16, 19, 16),
(15, 19, 15),
(14, 19, 14),
(17, 18, 17),
(18, 19, 18),
(19, 18, 19),
(20, 18, 20),
(21, 20, 21),
(22, 21, 22),
(23, 21, 23),
(24, 21, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `cedula_departamento` bigint(20) NOT NULL,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `id_departamento` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cedula_departamento`),
  UNIQUE KEY `id_departamento` (`id_departamento`),
  UNIQUE KEY `cedula_departamento` (`cedula_departamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`cedula_departamento`, `id_usuario`, `id_departamento`, `nombre`, `apellido`, `cargo`, `email`) VALUES
(2031002, 39, 3, 'NELSON', 'MURILLO', 'JEFE DEL DEPARTAMENTO', 'nmurillo@cufm.gob.ve'),
(1522245, 34, 2, 'ssssss', 'dwdwdwdwdw', 'no sss', 'alb@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
  `id_documento` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tipo_documento` bigint(20) unsigned NOT NULL,
  `id_preinscripcion` bigint(20) unsigned NOT NULL,
  `nombre_centro` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `carta_dirigida` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo_asignado` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_actual` date DEFAULT NULL,
  `documento_estatus` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_lapso` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_documento`),
  UNIQUE KEY `id_documento` (`id_documento`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id_documento`, `id_tipo_documento`, `id_preinscripcion`, `nombre_centro`, `carta_dirigida`, `cargo_asignado`, `fecha_actual`, `documento_estatus`, `telefono_lapso`) VALUES
(68, 2, 56, 'FEDE', 'RAYNA CHACON', 'GERENTE DE RRHH', '2014-11-27', 'leido', '2'),
(69, 3, 56, 'FEDE', 'RAYNA CHACON', 'GERENTE DE RRHH', '2014-11-27', 'leido', '2'),
(70, 3, 56, 'FEDE', 'RAYNA CHACON', 'GERENTE DE RRHH', '2014-11-27', 'noleido', '2'),
(66, 1, 51, 'INTT', 'DIDIER PLAZA', 'JEFE DE RRHH', '2014-11-24', 'leido', '02125203696'),
(67, 1, 56, 'cantv', 'LUIS PINO', 'DIRECTOR GENERAL', '2014-11-27', 'leido', '522222'),
(63, 3, 52, 'FONTUR', 'RAYNA CHACON', 'GERENTE DE RRHH', '2014-11-24', 'noleido', '2'),
(62, 2, 47, 'FONTUR', 'JUAN PETRO', 'GERENTE DE RRHH', '2014-11-24', 'noleido', '3'),
(61, 1, 50, 'CTV', 'PEDRO PEREZ', 'DIRECTOR GENERAL', '2014-11-25', 'leido', '02125640502');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `rif` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `id_empresa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion_empresa` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_empresa` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_empresa` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`rif`),
  UNIQUE KEY `id_empresa` (`id_empresa`),
  UNIQUE KEY `rif` (`rif`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`rif`, `id_usuario`, `id_empresa`, `nombre_empresa`, `direccion_empresa`, `telefono_empresa`, `email_empresa`) VALUES
('18364925-2', 6, 1, 'cupcakes', 'la vega', '4720681', 'cup@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadistica`
--

CREATE TABLE IF NOT EXISTS `estadistica` (
  `id_estadistica` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `alumnos_aprobados` bigint(20) DEFAULT NULL,
  `alumnos_reprobados` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_estadistica`),
  UNIQUE KEY `id_estadistica` (`id_estadistica`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `estadistica`
--

INSERT INTO `estadistica` (`id_estadistica`, `alumnos_aprobados`, `alumnos_reprobados`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE IF NOT EXISTS `estatus` (
  `id_estatus` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_estatus` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_estatus`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id_estatus`, `nombre_estatus`) VALUES
(1, 'PREINSCRITO'),
(2, 'INSCRITO'),
(3, 'INFORMES'),
(4, 'APROBADO'),
(5, 'REPROBADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha_actividades`
--

CREATE TABLE IF NOT EXISTS `fecha_actividades` (
  `id_fecha` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo_lapso` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_culminacion` date DEFAULT NULL,
  `fecha_infinal` date DEFAULT NULL,
  `fecha_habilitado` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_pasantias` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_periodo` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_fecha`),
  UNIQUE KEY `id_fecha` (`id_fecha`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `fecha_actividades`
--

INSERT INTO `fecha_actividades` (`id_fecha`, `codigo_lapso`, `fecha_inicio`, `fecha_culminacion`, `fecha_infinal`, `fecha_habilitado`, `tipo_pasantias`, `tipo_periodo`) VALUES
(1, 'A200', '2014-08-07', '2014-08-07', '2014-08-07', 'si', 'tiempo completo', 'tc1'),
(2, 'A200', '2014-08-09', '2014-08-09', '2014-08-09', 'si', 'tiempo completo', 'tc2'),
(3, 'A200', '2014-08-10', '2014-08-10', '2014-08-10', 'si', 'tiempo completo', 'tc3'),
(4, 'A200', '2014-08-11', '2014-08-11', '2014-08-11', 'si', 'tiempo completo', 'tc4'),
(5, 'A200', '2014-08-12', '2014-08-12', '2014-08-12', 'si', 'medio tiempo', 'mt1'),
(6, 'A200', '2014-08-15', '2014-08-15', '2014-08-15', 'si', 'pasantia larga', 'pl1'),
(7, 'A200', '2014-08-16', '2014-08-16', '2014-08-16', 'si', 'pasantia larga', 'pl2'),
(8, 'A200', '2014-08-17', '2014-08-17', '2014-08-17', 'si', 'pasantia larga', 'pl3'),
(9, 'B201', '2014-11-19', '2014-12-19', '2015-01-19', 'si', 'tiempo completo', 'tc1'),
(10, 'B201', '2014-11-19', '2014-12-19', '2015-01-29', 'si', 'tiempo completo', 'tc2'),
(11, 'B201', '2014-11-19', '2014-12-19', '2015-01-24', 'si', 'tiempo completo', 'tc3'),
(12, 'B201', '2014-11-19', '2014-12-19', '2015-01-31', 'si', 'tiempo completo', 'tc4'),
(13, 'B201', '2014-11-19', '2015-01-10', '2015-02-11', 'si', 'medio tiempo', 'mt1'),
(14, 'B201', '2014-11-19', '2014-12-23', '2015-02-28', 'si', 'pasantia larga', 'pl1'),
(15, 'B201', '2014-11-19', '2014-12-23', '2015-02-27', 'si', 'pasantia larga', 'pl2'),
(16, 'B201', '2014-11-19', '2014-05-20', '2015-02-26', 'si', 'pasantia larga', 'pl3'),
(17, 'B501', '2014-11-03', '2014-11-06', '2014-11-12', 'si', 'tiempo completo', 'tc1'),
(18, 'B501', '2014-12-04', '2014-12-11', '2014-12-10', 'si', 'tiempo completo', 'tc2'),
(19, 'B501', '2015-01-06', '2015-01-01', '2015-01-01', 'si', 'tiempo completo', 'tc3'),
(20, 'B501', '2015-02-03', '2016-06-06', '2015-02-04', 'si', 'tiempo completo', 'tc4'),
(21, 'B501', '2015-04-07', '2015-03-13', '2015-03-11', 'si', 'medio tiempo', 'mt1'),
(22, 'B501', '2015-05-21', '2015-05-14', '2015-04-08', 'si', 'pasantia larga', 'pl1'),
(23, 'B501', '2015-06-16', '2015-06-03', '2015-05-06', 'si', 'pasantia larga', 'pl2'),
(24, 'B501', '2017-05-19', '2015-07-08', '2015-06-10', 'si', 'pasantia larga', 'pl3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha_eventos`
--

CREATE TABLE IF NOT EXISTS `fecha_eventos` (
  `id_fecha_evento` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_diurna` date DEFAULT NULL,
  `fecha_vespertino` date DEFAULT NULL,
  `fecha_nocturno` date DEFAULT NULL,
  `fecha_preins` date DEFAULT NULL,
  PRIMARY KEY (`id_fecha_evento`),
  UNIQUE KEY `id_fecha_evento` (`id_fecha_evento`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `fecha_eventos`
--

INSERT INTO `fecha_eventos` (`id_fecha_evento`, `fecha_diurna`, `fecha_vespertino`, `fecha_nocturno`, `fecha_preins`) VALUES
(1, '2014-08-05', '2014-08-06', '2014-08-07', '2014-08-08'),
(2, '2014-11-03', '2014-11-03', '2014-11-03', '2014-11-03'),
(3, '2014-11-30', '2014-11-29', '2014-11-28', '2014-11-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `id_grupo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_grupo` char(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_grupo`),
  UNIQUE KEY `id_grupo` (`id_grupo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nombre_grupo`) VALUES
(1, 'estudiante'),
(2, 'departamento'),
(3, 'empresa'),
(4, 'administrador'),
(5, 'tutor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes`
--

CREATE TABLE IF NOT EXISTS `informes` (
  `id_informes` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unidad_pasantias` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `informe_actividades` varchar(800) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `limitaciones_pasantia` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `entrevista_academico` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `entrevista_empresarial` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `entrevista_tutor_academico` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `entrevista_tutor_empresarial` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_informe` date DEFAULT NULL,
  `estado_informe` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `calificacion_informe` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_informes`),
  UNIQUE KEY `id_informes` (`id_informes`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `informes`
--

INSERT INTO `informes` (`id_informes`, `unidad_pasantias`, `informe_actividades`, `limitaciones_pasantia`, `entrevista_academico`, `entrevista_empresarial`, `entrevista_tutor_academico`, `entrevista_tutor_empresarial`, `fecha_informe`, `estado_informe`, `calificacion_informe`) VALUES
(8, 'UNIDAD DE INFORMATICA', 'LIMPIEZA DE IMPRESORAS, ACTUALIZACIONES DEL SISTEMA OPERATIVO CANAIMA DE LA VERSION 4.0 A LA VERSION 4.1, RECOLECCION DE INFORMACION PARA EL SISTEMA CITGO DE PRESUPUESTO.', 'SE PRESENTO PROBLEMAS POR RESTRASO DE ENTREGA DE INFORMACION SOLICITADA AL DEPARTAMENTO DE PLANIFICACION Y PRESUPUESTO', 'NINGUNA', 'NINGUNA', 'si', 'si', '2014-11-24', 'noleido', 'en espera'),
(7, 'UNIDAD DE INFORMATICA', 'MANTENIMIENTO CORRECTIVO Y PREVENTIVO DE ESTACIONES DE TRABAJOS DE LOS USUARIOS DE LA INSTITUCION', 'NUNGUNA', 'NINGUNA', 'NINGUNA', 'si', 'si', '2014-11-24', 'noleido', 'en espera'),
(10, 'UNIDAD DE INFORMATICA', 'JDJDJDJDJDJDJ', 'JJDJDJDJJDJ', 'WWWWWW', 'RRRRRR', 'si', 'si', '2014-11-24', 'noleido', 'en espera'),
(17, 'UNIDAD DE PROGRAMACION', 'CAMBIO DE INTERFAZ EN JOOMLA, CREAR ACCESOS A USUARIOS', 'NINGUNA', 'NINGUNA', 'NINGUNA', 'si', 'si', '2014-11-24', 'leido', 'aprobado'),
(21, 'aaaaaaaaaaaaaa', 'dwdwwdwd', 'dwdwdw', 'dwdwd', 'dwdwdwd', 'si', 'si', '2014-11-27', 'noleido', 'en espera'),
(14, 'UNIDADA DE INFORMATICA', 'REPARACION Y MANTENIMIENTO DE ESTACIONES DE TRABAJOS', 'SOLO ESTA EL PERSONAL DE PASANTIA LABORANDO', 'NINGUNA', 'NINGUNA', 'si', 'si', '2014-11-24', 'noleido', 'en espera'),
(20, 'UNIDAD DE SOPORTE TECNICO', 'MANTEMINETO DE ESTACIONES DE TRABAJO EN LA INSTUCION', 'NINGUNA', 'NINGUNA', 'NINGUNA', 'si', 'si', '2014-11-24', 'leido', 'aprobado'),
(18, 'UNIDAD DE PROGRAMACION', 'ACCESOS A USUARIOS EN LA INTRANET, CAMBIO DE PLANTILLAS JOOMLA 1.5 EN LA PAGINA WEB DE LA INSTITUCION', 'POCA DOCUMENTACION DE LOS PROCESOS DE BASE DATOS Y CODIGO FUENTE EN LA UNIDAD DE INFORMATICA', 'NINGUNA', 'NINGUNA', 'si', 'si', '2014-11-24', 'noleido', 'en espera'),
(19, 'UNIDAD DE REDES', 'CAMBIO DE PACTH CORD EN LA DIFERENTES AREAS DE LA INSTITUCION, SOBRE TODO EN LAS ESTACIONES DE TRABAJO DE PRESIDENCIA DONDE PRESENTABAN MAYOR FALLAS', 'NO HAY DOCUMENTACION FISICA EN LA INSTITUCION', 'NINGUNA', 'NINGUNA', 'si', 'si', '2014-11-25', 'leido', 'aprobado'),
(22, 'unidad de soporte a usuarios', 'limpieza de equipos, mantenimiento preventivo de hardware y software, actualizaciones de programas ofimaticos entre otros. ', 'ninguna', '', '', 'si', 'si', '2015-05-31', 'leido', 'aprobado'),
(23, 'unidad de programacion', 'desarrollo de pagina web para algunas aplicaciones en la intranet, utilizando el manejador de contenido JOOMLA version 1.5 para el servicio que se maneja en la unidad que tiene por nombre HELPDESK', 'ninguna', '', '', 'si', 'si', '2015-05-31', 'leido', 'aprobado'),
(24, 'unidad de redes', 'se logro montar servidor web para el area de administracion del Ministerio', 'ninguna', '', '', 'si', 'si', '2015-05-31', 'leido', 'aprobado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE IF NOT EXISTS `inscripcion` (
  `id_inscrito` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_fecha` bigint(20) unsigned NOT NULL,
  `id_preinscripcion` bigint(20) unsigned NOT NULL,
  `id_vacante_dep` int(11) NOT NULL,
  `nombre_empresa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_empresa` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion_empresa` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jefe_responsable` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo_jefe` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_jefe` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_jefe` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_pasantia` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horario` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tutor_empresarial` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo_tutor` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_tutor` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `obtencion_centro` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad_informes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_inscrito`),
  UNIQUE KEY `id_inscrito` (`id_inscrito`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id_inscrito`, `id_fecha`, `id_preinscripcion`, `id_vacante_dep`, `nombre_empresa`, `telefono_empresa`, `direccion_empresa`, `jefe_responsable`, `cargo_jefe`, `telefono_jefe`, `email_jefe`, `area_pasantia`, `horario`, `tutor_empresarial`, `cargo_tutor`, `email`, `telefono_tutor`, `obtencion_centro`, `cantidad_informes`) VALUES
(20, 2, 56, 0, 'FEDE', '02125640502', 'mijares aaaaa', 'RAYNA CHACON', 'GERENTE DE RRHH', '04245205255', 'raulg@fede.gob.ve', 'UNIDAD DE INFORMATICA', '8AM - 4PM', 'PAULO ALVAREZ', 'JEFE INFORMATICA', 'pauloaaa12@corpozulia.gob.ve', '02263063030', 'trabaja alli', 1),
(19, 2, 52, 0, 'FONTUR', '02120000000', 'AV. SANTA CECELIA', 'RAYNA CHACON', 'GERENTE DE RRHH', '02123000000', 'grrhhchacono@fontur.gob.ve', 'UNIDAD DE INFORMATICA', '8AM - 4PM', 'LANDER CACERES', 'JEFE INFORMATICA', 'lanca@hotmail.com', '02556306321', 'gestion propia', 2),
(18, 3, 47, 0, 'FONTUR', '04241710110', 'AV. SANTA CECELIA', 'JUAN PETRO', 'GERENTE DE RRHH', '04245205255', 'jpetro@fontur.gob.ve', 'UNIDAD DE INFORMATICA', '8AM - 4PM', 'FRANK QUINTANA', 'JEFE INFORMATICA', 'fquintana@hotmail.com', '02263063030', 'gestion propia', 3),
(21, 2, 57, 0, 'MINISTERIO DEL PODER POPULAR PAra la educacion', '02125636666', 'altagracia', 'juan franco', 'jefe de tecnologia', '02123652635', 'franco.juan@mppe.gob.ve', 'unidad de informatica', '8', 'gabriel marquez', 'jefe de programacion', 'gabriel.marquez@mppe.gob.ve', '02123652635', 'otro', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lapso`
--

CREATE TABLE IF NOT EXISTS `lapso` (
  `codigo_lapso` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_fecha_evento` bigint(20) unsigned NOT NULL,
  `id_estadistica` bigint(20) unsigned NOT NULL,
  `id_lapso` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lapso_habilitado` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`codigo_lapso`),
  UNIQUE KEY `id_lapso` (`id_lapso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `lapso`
--

INSERT INTO `lapso` (`codigo_lapso`, `id_fecha_evento`, `id_estadistica`, `id_lapso`, `lapso_habilitado`, `fecha_registro`) VALUES
('A200', 1, 1, 1, 'si', '2014-07-07'),
('B201', 2, 0, 2, 'no', '2014-11-19'),
('B501', 3, 0, 3, 'no', '2014-11-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menciones`
--

CREATE TABLE IF NOT EXISTS `menciones` (
  `id_mencion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_mencion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_carrera` int(11) NOT NULL,
  PRIMARY KEY (`id_mencion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `menciones`
--

INSERT INTO `menciones` (`id_mencion`, `nombre_mencion`, `id_carrera`) VALUES
(1, 'RECURSOS HUMANOS', 1),
(2, 'TRANSPORTE Y DIST. DE BIENES', 1),
(3, 'CONTADURIA', 2),
(5, 'BANCA Y FINANZAS', 1),
(7, 'INFORMATICA', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_secretas`
--

CREATE TABLE IF NOT EXISTS `preguntas_secretas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `preguntas_secretas`
--

INSERT INTO `preguntas_secretas` (`id`, `descripcion`) VALUES
(1, 'NOMBRE DE SU MASCOTA FAVORITA'),
(2, 'MARCA DE CARRO FAVORITA'),
(3, 'CIUDAD NATAL DE SU PADRE'),
(4, 'NOMBRE DEL PRIMER JEFE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preinscripcion`
--

CREATE TABLE IF NOT EXISTS `preinscripcion` (
  `id_preinscripcion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_alumno` int(11) NOT NULL,
  `cedula_alumno` bigint(20) NOT NULL,
  `id_tutor` bigint(20) unsigned NOT NULL,
  `codigo_lapso` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cant_centros_temporales` bigint(20) DEFAULT NULL,
  `cantidad_documentos_postulacion` bigint(20) DEFAULT NULL,
  `cantidad_documentos_permiso` bigint(20) DEFAULT NULL,
  `cantidad_documentos_constancia` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_preinscripcion`),
  UNIQUE KEY `id_preinscripcion` (`id_preinscripcion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Volcado de datos para la tabla `preinscripcion`
--

INSERT INTO `preinscripcion` (`id_preinscripcion`, `id_alumno`, `cedula_alumno`, `id_tutor`, `codigo_lapso`, `cant_centros_temporales`, `cantidad_documentos_postulacion`, `cantidad_documentos_permiso`, `cantidad_documentos_constancia`) VALUES
(47, 26, 15843331, 13, '1', 0, 0, 2, 3),
(56, 25, 15325899, 8, '1', 1, 1, 1, 2),
(50, 24, 3636, 13, '1', 0, 4, 0, 0),
(51, 22, 4444, 8, '1', 0, 5, 0, 0),
(52, 27, 19200360, 9, '1', 0, 0, 0, 1),
(54, 28, 15862302, 10, '1', 0, 0, 0, 0),
(55, 29, 15999666, 9, '1', 0, 0, 0, 0),
(57, 32, 12363666, 13, '1', 0, 0, 0, 0),
(58, 17, 987654, 8, '1', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE IF NOT EXISTS `sexo` (
  `id_sexo` int(11) NOT NULL,
  `descripcion_sexo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_sexo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`id_sexo`, `descripcion_sexo`) VALUES
(1, 'MASCULINO'),
(2, 'FEMENINO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id_tipo_documento` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_documento`, `nombre`, `descripcion`) VALUES
(1, 'Carta de Postulación', NULL),
(2, 'Solicitud de Permiso', NULL),
(3, 'Costancia de Pasantías', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE IF NOT EXISTS `turnos` (
  `id_turno` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_turno` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_turno`),
  UNIQUE KEY `id_turno` (`id_turno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id_turno`, `nombre_turno`) VALUES
(1, 'DIURNO'),
(2, 'VESPERTINO'),
(3, 'NOCTURNO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor_academico`
--

CREATE TABLE IF NOT EXISTS `tutor_academico` (
  `id_tutor` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `id_carrera` bigint(20) unsigned NOT NULL,
  `id_mencion` bigint(20) unsigned NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cedula` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_trabajo` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad_asignacion_alum` bigint(20) DEFAULT NULL,
  `habilitado` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_tutor`),
  UNIQUE KEY `id_tutor` (`id_tutor`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `tutor_academico`
--

INSERT INTO `tutor_academico` (`id_tutor`, `id_usuario`, `id_carrera`, `id_mencion`, `nombre`, `apellido`, `cedula`, `email`, `area_trabajo`, `telefono`, `cantidad_asignacion_alum`, `habilitado`) VALUES
(13, 46, 3, 7, 'PABLO', 'BARRANCO', '4052630', 'pbarranco1982@hotmail.com', 'PROGRAMADOR ', '04241710110', 3, 'si'),
(11, 44, 1, 1, 'JAIME', 'PEREZ', '8900200', 'jperez@gmail.com', 'RRHH MPPP', '04241710110', 0, 'si'),
(12, 45, 1, 2, 'MAURICIO', 'MARQUEZ', '11205630', 'mmarquez@inttt.gob.ve', 'JEFE DE BIENES NACIONALES INTT', '04165008888', 0, 'si'),
(14, 52, 1, 5, 'ISAIAS', 'MEDINA', '1025000', 'ISAIAS_M@HOTMAIL.COM', '', '56236252', 0, 'si'),
(10, 43, 1, 3, 'DOUGLAS', 'JIMENEZ', '10200300', 'djimenez@gmail.com', 'CONTADOR PUBLICO', '04125003050', 1, 'si'),
(8, 41, 3, 7, 'LUIS', 'AGUILAR', '6052302', 'laguilar@intt.gob.ve', 'REDES III', '02120000000', 3, 'si'),
(9, 42, 1, 5, 'NESTOR', 'BELTRAN', '7008900', 'nbeltran@cufm.gob.ve', 'BANCA Y FINANZAS', '04245006030', 2, 'si'),
(15, 53, 1, 5, 'ISAIAS', 'MEDINA', '15200750', 'ISAIAS_M@HOTMAIL.COM', 'BANCA Y FINANZAS', '02125640502', 0, 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_grupo` bigint(20) unsigned NOT NULL,
  `login` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_registro` datetime DEFAULT '0000-00-00 00:00:00',
  `ultima_visita` datetime DEFAULT '0000-00-00 00:00:00',
  `id_pregunta_secreta` int(11) NOT NULL,
  `respuesta` varchar(350) NOT NULL,
  `ip_session` varchar(15) DEFAULT NULL,
  `origen` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  UNIQUE KEY `id_usuario_2` (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_grupo`, `login`, `password`, `fecha_registro`, `ultima_visita`, `id_pregunta_secreta`, `respuesta`, `ip_session`, `origen`) VALUES
(2, 4, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '2014-06-04 00:00:00', '2015-06-10 02:06:47', 0, '', NULL, NULL),
(49, 1, 'julian', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-27 00:37:59', '0000-00-00 00:00:00', 0, '', NULL, NULL),
(48, 1, 'javier', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-24 20:55:14', '2015-06-04 02:25:04', 0, '', NULL, NULL),
(47, 1, 'carlos', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-22 00:46:15', '2014-11-22 22:20:45', 0, '', NULL, NULL),
(24, 1, 'luisa', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-05 20:27:13', '2014-11-20 03:19:02', 0, '', NULL, NULL),
(45, 5, 'mauricio', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-20 16:00:01', '0000-00-00 00:00:00', 0, '', NULL, NULL),
(46, 5, 'pablo', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-20 16:01:47', '2015-06-04 18:54:05', 0, '', NULL, NULL),
(43, 5, 'douglas', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-20 15:55:22', '0000-00-00 00:00:00', 0, '', NULL, NULL),
(44, 5, 'jaime', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-20 15:56:37', '2015-05-30 20:55:45', 0, '', NULL, NULL),
(29, 1, 'andres', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-13 23:31:37', '0000-00-00 00:00:00', 0, '', NULL, NULL),
(31, 1, 'felix', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-15 17:27:01', '2014-11-20 14:17:06', 0, '', NULL, NULL),
(32, 1, 'dari', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-16 17:29:37', '2014-11-28 12:43:49', 0, '', NULL, NULL),
(42, 5, 'nestor', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-20 15:53:48', '0000-00-00 00:00:00', 0, '', NULL, NULL),
(41, 5, 'luis', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-20 15:51:40', '2014-12-01 11:56:00', 0, '', NULL, NULL),
(35, 5, 'cperez', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-18 01:49:19', '0000-00-00 00:00:00', 0, '', NULL, NULL),
(39, 2, 'nelson', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-20 03:24:50', '2015-06-10 02:16:27', 0, '', NULL, NULL),
(40, 1, 'dorian', 'e10adc3949ba59abbe56e057f20f883e', '2014-11-20 11:55:00', '2015-06-10 01:56:47', 0, '', NULL, NULL),
(50, 1, 'jeni', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-28 12:50:16', '2014-11-28 12:50:56', 0, '', NULL, NULL),
(51, 1, 'franyer', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-28 23:03:04', '0000-00-00 00:00:00', 0, '', NULL, NULL),
(53, 5, 'isaias', '81dc9bdb52d04dc20036dbd8313ed055', '2014-11-29 00:45:44', '2014-11-29 00:45:57', 0, '', NULL, NULL),
(54, 1, 'lilian', '81dc9bdb52d04dc20036dbd8313ed055', '2015-05-31 15:00:58', '2015-06-04 03:59:57', 0, '', NULL, NULL),
(58, 1, 'jhony', 'e10adc3949ba59abbe56e057f20f883e', '2015-06-10 01:33:53', '2015-06-10 11:54:16', 1, 'pepe', '', NULL),
(59, 4, 'lalmaro', 'e10adc3949ba59abbe56e057f20f883e', '2015-06-10 10:00:00', '2015-06-17 13:22:38', 1, 'nacho', NULL, NULL),
(60, 1, 'pedroper', 'e10adc3949ba59abbe56e057f20f883e', '2015-06-16 15:33:12', '2015-06-16 16:23:11', 1, 'pepe', NULL, 0),
(61, 1, 'jperez', 'd44b121fc3524fe5cdc4f3feb31ceb78', '2015-06-16 15:43:19', '2015-06-17 15:47:09', 1, 'pepe', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacante_departamento`
--

CREATE TABLE IF NOT EXISTS `vacante_departamento` (
  `id_vacante_departamento` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cedula_departamento` bigint(20) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubicacion` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_pasantes` bigint(20) DEFAULT NULL,
  `vacante_carrera` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vacante_mencion` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_vacante_departamento`),
  UNIQUE KEY `id_vacante_departamento` (`id_vacante_departamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `vacante_departamento`
--

INSERT INTO `vacante_departamento` (`id_vacante_departamento`, `cedula_departamento`, `nombre`, `ubicacion`, `numero_pasantes`, `vacante_carrera`, `vacante_mencion`) VALUES
(1, 0, 'metro de caracas', 'hoyada', 10, '1', '5'),
(2, 0, 'cantv', 'san martin', 19, '3', '7'),
(6, 0, 'monaca', 'la carlota', 15, '3', '7'),
(4, 0, 'indu', 'catia', 10, '3', '7'),
(5, 0, 'la flor', 'la candelaria', 4, '3', '7'),
(9, 0, 'zzzz', 'zzzz', 1, '1', '5'),
(10, 0, 'MPPS', 'Centro Simon Bolivar', 12, '3', '7'),
(11, 0, 'fddfd', 'dfgdfg', 23, '1', '5'),
(12, 0, 'MPPTT', 'Centro Simon Bolivar', 10, '1', '5'),
(13, 0, 'MPPTT', 'Centro Simon Bolivar', 10, '1', '5'),
(14, 0, 'MPPTT', 'Centro Simon Bolivar', 10, '1', '5'),
(15, 0, 'Alla', 'Mas alla', 5, '2', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacante_empresa`
--

CREATE TABLE IF NOT EXISTS `vacante_empresa` (
  `id_vacante_empresa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rif` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vacante_carrera` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vacante_mencion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_pasantes` int(11) DEFAULT NULL,
  `turno` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_vacante_empresa`),
  UNIQUE KEY `id_vacante_empresa` (`id_vacante_empresa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
