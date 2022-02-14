-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2021 a las 01:15:50
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `base_iess`
--
CREATE DATABASE IF NOT EXISTS `base_iess` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `base_iess`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antibiotico`
--

DROP TABLE IF EXISTS `antibiotico`;
CREATE TABLE `antibiotico` (
  `ID_ANTIBIOTICO` int(11) NOT NULL,
  `NOMBRE_ANTIBIOTICO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antibiograma`
--

DROP TABLE IF EXISTS `antibiograma`;
CREATE TABLE `antibiograma` (
  `ID_ANTIBIOGRAMA` int(11) NOT NULL,
  `ID_ESTADO_ATB_AL_MOMENTO` int(11) DEFAULT NULL,
  `ID_TINCION_TECNICA` int(11) DEFAULT NULL,
  `FECHA_ANTIBIOGRMA` datetime NOT NULL,
  `REPORTE_ACRODE_A_GUIA` varchar(30) NOT NULL,
  `ANTIBIOTICO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antibiotico__basado_en_antibiograma_manua`
--

DROP TABLE IF EXISTS `antibiotico__basado_en_antibiograma_manua`;
CREATE TABLE `antibiotico__basado_en_antibiograma_manua` (
  `ID_ANTIBIOTICO__BASADO_EN_ANTIBIOGRAMA_MANUAL__` int(11) NOT NULL,
  `ID_DIAGNOSTICO` int(11) DEFAULT NULL,
  `ID_ESTADO_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA` int(11) DEFAULT NULL,
  `ID_ANTIBIOTICO` int(11) DEFAULT NULL,
  `ATB_24_H` varchar(30) NOT NULL,
  `INICIO` datetime NOT NULL,
  `MEDICO_RESPONSABLE` varchar(30) NOT NULL,
  `DOSIS` varchar(20) NOT NULL,
  `TIEMPO` int(11) NOT NULL,
  `ESCALA` varchar(30) NOT NULL,
  `MANTIENE` varchar(30) NOT NULL,
  `DESCALA` varchar(30) NOT NULL,
  `AJUSTE_DOSIS` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biologia_molecular_eplex`
--

DROP TABLE IF EXISTS `biologia_molecular_eplex`;
CREATE TABLE `biologia_molecular_eplex` (
  `ID_EPLEX` int(11) NOT NULL,
  `ID_ESTADO_BMO_EPLEX` int(11) DEFAULT NULL,
  `ID_TINCION_TECNICA` int(11) DEFAULT NULL,
  `ID_PEDIDO` int(11) NOT NULL,
  `TIPO_ID_BMO_EPLEX` varchar(10) NOT NULL,
  `MEC_RESISTENCI` varchar(12) NOT NULL,
  `FECHA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biologia_molecular_film_array`
--

DROP TABLE IF EXISTS `biologia_molecular_film_array`;
CREATE TABLE `biologia_molecular_film_array` (
  `ID_FILM_ARRAY` int(11) NOT NULL,
  `ID_ESTADO_BMO_FILM_ARRAY` int(11) DEFAULT NULL,
  `ID_TINCION_TECNICA` int(11) DEFAULT NULL,
  `ID_EMOCULTIVO` int(11) NOT NULL,
  `TIPO_ID_BMO_FILM_ARRAY` varchar(40) NOT NULL,
  `GEN_RESISTENCIA` varchar(11) NOT NULL,
  `FECH_FILM_ARRAY` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

DROP TABLE IF EXISTS `diagnostico`;
CREATE TABLE `diagnostico` (
  `ID_DIAGNOSTICO` int(11) NOT NULL,
  `ID_PACIENTE` int(11) DEFAULT NULL,
  `ID_PERSONALMEDICO` int(11) DEFAULT NULL,
  `ID_ENFERMEDAD` int(11) DEFAULT NULL,
  `DIAGNOSTICO` varchar(100) NOT NULL,
  `FECHA_DIAGNOSTICO` datetime NOT NULL,
  `NOTIFICACION` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

DROP TABLE IF EXISTS `enfermedad`;
CREATE TABLE `enfermedad` (
  `ID_ENFERMEDAD` int(11) NOT NULL,
  `COD_ENFERMEDAD` varchar(20) NOT NULL,
  `NOM_ENFERMEDAD` varchar(25) NOT NULL,
  `NIV_ENFERMEDAD` varchar(10) NOT NULL,
  `CLA_ENFERMEDAD` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_antibiotico_basado_en_antibiograma`
--

DROP TABLE IF EXISTS `estado_antibiotico_basado_en_antibiograma`;
CREATE TABLE `estado_antibiotico_basado_en_antibiograma` (
  `ID_ESTADO_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA` int(11) NOT NULL,
  `ESTADO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_atb_reporte`
--

DROP TABLE IF EXISTS `estado_atb_reporte`;
CREATE TABLE `estado_atb_reporte` (
  `ID_ESTADO_ATB_AL_MOMENTO` int(11) NOT NULL,
  `ESTADO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_bmo_eplex`
--

DROP TABLE IF EXISTS `estado_bmo_eplex`;
CREATE TABLE `estado_bmo_eplex` (
  `ID_ESTADO_BMO_EPLEX` int(11) NOT NULL,
  `ESTADO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_bmo_film_array`
--

DROP TABLE IF EXISTS `estado_bmo_film_array`;
CREATE TABLE `estado_bmo_film_array` (
  `ID_ESTADO_BMO_FILM_ARRAY` int(11) NOT NULL,
  `ESTADO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_emocultivo`
--

DROP TABLE IF EXISTS `estado_emocultivo`;
CREATE TABLE `estado_emocultivo` (
  `ID_ESTADO_EMOCULTIVO` int(11) NOT NULL,
  `ESTADO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_tipo_de_reporte`
--

DROP TABLE IF EXISTS `estado_tipo_de_reporte`;
CREATE TABLE `estado_tipo_de_reporte` (
  `ID_ESTADO_TIPO_DE_REPORTE` int(11) NOT NULL,
  `ESTADO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE `pacientes` (
  `ID_PACIENTE` int(11) NOT NULL,
  `HIST_CLINICA` int(11) NOT NULL,
  `NOM_PACIENTE` varchar(30) NOT NULL,
  `APELLIDO_PACIENTE` varchar(30) NOT NULL,
  `EDAD` int(11) DEFAULT NULL,
  `GENERO` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_examen`
--

DROP TABLE IF EXISTS `pedido_examen`;
CREATE TABLE `pedido_examen` (
  `ID_DIAGNOSTICO` int(11) DEFAULT NULL,
  `ID_PEDIDO` int(11) NOT NULL,
  `ID_TIPO_EXAMEN` int(11) DEFAULT NULL,
  `FECHA_PEDIDO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_tipo_examen`
--

DROP TABLE IF EXISTS `pedido_tipo_examen`;
CREATE TABLE `pedido_tipo_examen` (
  `ID_TIPO_EXAMEN` int(11) NOT NULL,
  `TIPO_DE_EXAMEN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_medico`
--

DROP TABLE IF EXISTS `personal_medico`;
CREATE TABLE `personal_medico` (
  `ID_PERSONALMEDICO` int(11) NOT NULL,
  `CED_PERSONAL` int(11) NOT NULL,
  `CODIGO_AS400` varchar(30) NOT NULL,
  `NOM_PERSONAL` varchar(30) NOT NULL,
  `APE_PERSONAL` varchar(30) NOT NULL,
  `CARGO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcion_muestra_emocultivo`
--

DROP TABLE IF EXISTS `recepcion_muestra_emocultivo`;
CREATE TABLE `recepcion_muestra_emocultivo` (
  `ID_RECEPCION_EMOCULTIVO` int(11) NOT NULL,
  `ID_PEDIDO` int(11) DEFAULT NULL,
  `ID_ESTADO_EMOCULTIVO` int(11) DEFAULT NULL,
  `NOMBRE_RESPONSABLE` varchar(50) NOT NULL,
  `FECH_MUEST_HEMO` datetime NOT NULL,
  `FECHA_ALAR_HEMO` datetime NOT NULL,
  `NUME_FRASCOS` int(11) NOT NULL,
  `RESULTADO` varchar(50) NOT NULL,
  `FECHA_RECEPCION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tincion_gram`
--

DROP TABLE IF EXISTS `tincion_gram`;
CREATE TABLE `tincion_gram` (
  `ID_GRAM` int(11) NOT NULL,
  `ID_RECEPCION_EMOCULTIVO` int(11) DEFAULT NULL,
  `FECH_GRAM` datetime NOT NULL,
  `TREST_GRAM` varchar(30) NOT NULL,
  `ALARMA` tinyint(1) DEFAULT NULL,
  `NUM_TECNICAS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tincion_tecnica`
--

DROP TABLE IF EXISTS `tincion_tecnica`;
CREATE TABLE `tincion_tecnica` (
  `ID_TINCION_TECNICA` int(11) NOT NULL,
  `ID_GRAM` int(11) NOT NULL,
  `ID_TIPO_TECNICA` int(11) NOT NULL,
  `OBSERVACION` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_resultado`
--

DROP TABLE IF EXISTS `tipo_de_resultado`;
CREATE TABLE `tipo_de_resultado` (
  `ID_GRAM` int(11) NOT NULL,
  `ID_ESTADO_TIPO_DE_RESULTADO` int(11) NOT NULL,
  `ID_TIPO_RESULTADO` int(11) NOT NULL,
  `NOM_RESULTADO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_tecnica`
--

DROP TABLE IF EXISTS `tipo_de_tecnica`;
CREATE TABLE `tipo_de_tecnica` (
  `ID_TIPO_TECNICA` int(11) NOT NULL,
  `DESCRIPCION` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `ID_USUARIO` int(11) NOT NULL,
  `ID_PERSONALMEDICO` int(11) DEFAULT NULL,
  `USUARIO` varchar(30) NOT NULL,
  `PASSWORD` varchar(15) NOT NULL,
  `FEC_CREACION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antibiotico`
--
ALTER TABLE `antibiotico`
  ADD PRIMARY KEY (`ID_ANTIBIOTICO`);

--
-- Indices de la tabla `antibiograma`
--
ALTER TABLE `antibiograma`
  ADD PRIMARY KEY (`ID_ANTIBIOGRAMA`),
  ADD KEY `FK_ESTADO_ANTIBIOGRAMA` (`ID_ESTADO_ATB_AL_MOMENTO`),
  ADD KEY `FK_TECNICA_ANTIBIOGRAMA` (`ID_TINCION_TECNICA`);

--
-- Indices de la tabla `antibiotico__basado_en_antibiograma_manua`
--
ALTER TABLE `antibiotico__basado_en_antibiograma_manua`
  ADD PRIMARY KEY (`ID_ANTIBIOTICO__BASADO_EN_ANTIBIOGRAMA_MANUAL__`),
  ADD KEY `FK_DIAGNOSTICO_ANTIBIOTICO` (`ID_DIAGNOSTICO`),
  ADD KEY `FK_ESTADOANTIBIOTICO_ANTIBIOTICO` (`ID_ESTADO_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA`),
  ADD KEY `FK_TIPOANTIBIOTICO_ANTIBIOTICO` (`ID_ANTIBIOTICO`);

--
-- Indices de la tabla `biologia_molecular_eplex`
--
ALTER TABLE `biologia_molecular_eplex`
  ADD PRIMARY KEY (`ID_EPLEX`),
  ADD KEY `FK_ESTADO_BME` (`ID_ESTADO_BMO_EPLEX`),
  ADD KEY `FK_TECNICA_BME` (`ID_TINCION_TECNICA`);

--
-- Indices de la tabla `biologia_molecular_film_array`
--
ALTER TABLE `biologia_molecular_film_array`
  ADD PRIMARY KEY (`ID_FILM_ARRAY`),
  ADD KEY `FK_ESTADO_BMF` (`ID_ESTADO_BMO_FILM_ARRAY`),
  ADD KEY `FK_TECNICA_BMF` (`ID_TINCION_TECNICA`);

--
-- Indices de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`ID_DIAGNOSTICO`),
  ADD KEY `FK_ENFERMEDAD_DIAGNOSTICO` (`ID_ENFERMEDAD`),
  ADD KEY `FK_PACIENTES_DIAGNOSTICO` (`ID_PACIENTE`),
  ADD KEY `FK_PERSONALMEDICO_DIAGNOSTICO` (`ID_PERSONALMEDICO`);

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`ID_ENFERMEDAD`);

--
-- Indices de la tabla `estado_antibiotico_basado_en_antibiograma`
--
ALTER TABLE `estado_antibiotico_basado_en_antibiograma`
  ADD PRIMARY KEY (`ID_ESTADO_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA`);

--
-- Indices de la tabla `estado_atb_reporte`
--
ALTER TABLE `estado_atb_reporte`
  ADD PRIMARY KEY (`ID_ESTADO_ATB_AL_MOMENTO`);

--
-- Indices de la tabla `estado_bmo_eplex`
--
ALTER TABLE `estado_bmo_eplex`
  ADD PRIMARY KEY (`ID_ESTADO_BMO_EPLEX`);

--
-- Indices de la tabla `estado_bmo_film_array`
--
ALTER TABLE `estado_bmo_film_array`
  ADD PRIMARY KEY (`ID_ESTADO_BMO_FILM_ARRAY`);

--
-- Indices de la tabla `estado_emocultivo`
--
ALTER TABLE `estado_emocultivo`
  ADD PRIMARY KEY (`ID_ESTADO_EMOCULTIVO`);

--
-- Indices de la tabla `estado_tipo_de_reporte`
--
ALTER TABLE `estado_tipo_de_reporte`
  ADD PRIMARY KEY (`ID_ESTADO_TIPO_DE_REPORTE`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`ID_PACIENTE`);

--
-- Indices de la tabla `pedido_examen`
--
ALTER TABLE `pedido_examen`
  ADD PRIMARY KEY (`ID_PEDIDO`),
  ADD KEY `FK_DIAGNOSTICO_PEDIDOEXAMEN` (`ID_DIAGNOSTICO`),
  ADD KEY `FK_ESTADO_PEDIDO_EXAMEN` (`ID_TIPO_EXAMEN`);

--
-- Indices de la tabla `pedido_tipo_examen`
--
ALTER TABLE `pedido_tipo_examen`
  ADD PRIMARY KEY (`ID_TIPO_EXAMEN`);

--
-- Indices de la tabla `personal_medico`
--
ALTER TABLE `personal_medico`
  ADD PRIMARY KEY (`ID_PERSONALMEDICO`);

--
-- Indices de la tabla `recepcion_muestra_emocultivo`
--
ALTER TABLE `recepcion_muestra_emocultivo`
  ADD PRIMARY KEY (`ID_RECEPCION_EMOCULTIVO`),
  ADD KEY `FK_PEDIDOEXAMEN_RECEPCION` (`ID_PEDIDO`),
  ADD KEY `FK_RECEPCION_ESTADO` (`ID_ESTADO_EMOCULTIVO`);

--
-- Indices de la tabla `tincion_gram`
--
ALTER TABLE `tincion_gram`
  ADD PRIMARY KEY (`ID_GRAM`),
  ADD KEY `FK_RECEPCION_TINCION` (`ID_RECEPCION_EMOCULTIVO`);

--
-- Indices de la tabla `tincion_tecnica`
--
ALTER TABLE `tincion_tecnica`
  ADD PRIMARY KEY (`ID_TINCION_TECNICA`),
  ADD KEY `FK_ESTADO_TECNICA` (`ID_TIPO_TECNICA`),
  ADD KEY `FK_TINCIOGRAM_TECNICA` (`ID_GRAM`);

--
-- Indices de la tabla `tipo_de_resultado`
--
ALTER TABLE `tipo_de_resultado`
  ADD PRIMARY KEY (`ID_TIPO_RESULTADO`),
  ADD KEY `FK_TIPOGRAM_ESTADO` (`ID_ESTADO_TIPO_DE_RESULTADO`),
  ADD KEY `FK_TIPOGRAM_TINCIONGRAM` (`ID_GRAM`);

--
-- Indices de la tabla `tipo_de_tecnica`
--
ALTER TABLE `tipo_de_tecnica`
  ADD PRIMARY KEY (`ID_TIPO_TECNICA`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD KEY `FK_USUARIO_PERSONAL` (`ID_PERSONALMEDICO`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antibiograma`
--
ALTER TABLE `antibiograma`
  ADD CONSTRAINT `FK_ESTADO_ANTIBIOGRAMA` FOREIGN KEY (`ID_ESTADO_ATB_AL_MOMENTO`) REFERENCES `estado_atb_reporte` (`ID_ESTADO_ATB_AL_MOMENTO`),
  ADD CONSTRAINT `FK_TECNICA_ANTIBIOGRAMA` FOREIGN KEY (`ID_TINCION_TECNICA`) REFERENCES `tincion_tecnica` (`ID_TINCION_TECNICA`);

--
-- Filtros para la tabla `antibiotico__basado_en_antibiograma_manua`
--
ALTER TABLE `antibiotico__basado_en_antibiograma_manua`
  ADD CONSTRAINT `FK_DIAGNOSTICO_ANTIBIOTICO` FOREIGN KEY (`ID_DIAGNOSTICO`) REFERENCES `diagnostico` (`ID_DIAGNOSTICO`),
  ADD CONSTRAINT `FK_ESTADOANTIBIOTICO_ANTIBIOTICO` FOREIGN KEY (`ID_ESTADO_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA`) REFERENCES `estado_antibiotico_basado_en_antibiograma` (`ID_ESTADO_ANTIBIOTICO_BASADO_EN_ANTIBIOGRAMA`),
  ADD CONSTRAINT `FK_TIPOANTIBIOTICO_ANTIBIOTICO` FOREIGN KEY (`ID_ANTIBIOTICO`) REFERENCES `antibiotico` (`ID_ANTIBIOTICO`);

--
-- Filtros para la tabla `biologia_molecular_eplex`
--
ALTER TABLE `biologia_molecular_eplex`
  ADD CONSTRAINT `FK_ESTADO_BME` FOREIGN KEY (`ID_ESTADO_BMO_EPLEX`) REFERENCES `estado_bmo_eplex` (`ID_ESTADO_BMO_EPLEX`),
  ADD CONSTRAINT `FK_TECNICA_BME` FOREIGN KEY (`ID_TINCION_TECNICA`) REFERENCES `tincion_tecnica` (`ID_TINCION_TECNICA`);

--
-- Filtros para la tabla `biologia_molecular_film_array`
--
ALTER TABLE `biologia_molecular_film_array`
  ADD CONSTRAINT `FK_ESTADO_BMF` FOREIGN KEY (`ID_ESTADO_BMO_FILM_ARRAY`) REFERENCES `estado_bmo_film_array` (`ID_ESTADO_BMO_FILM_ARRAY`),
  ADD CONSTRAINT `FK_TECNICA_BMF` FOREIGN KEY (`ID_TINCION_TECNICA`) REFERENCES `tincion_tecnica` (`ID_TINCION_TECNICA`);

--
-- Filtros para la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD CONSTRAINT `FK_ENFERMEDAD_DIAGNOSTICO` FOREIGN KEY (`ID_ENFERMEDAD`) REFERENCES `enfermedad` (`ID_ENFERMEDAD`),
  ADD CONSTRAINT `FK_PACIENTES_DIAGNOSTICO` FOREIGN KEY (`ID_PACIENTE`) REFERENCES `pacientes` (`ID_PACIENTE`),
  ADD CONSTRAINT `FK_PERSONALMEDICO_DIAGNOSTICO` FOREIGN KEY (`ID_PERSONALMEDICO`) REFERENCES `personal_medico` (`ID_PERSONALMEDICO`);

--
-- Filtros para la tabla `pedido_examen`
--
ALTER TABLE `pedido_examen`
  ADD CONSTRAINT `FK_DIAGNOSTICO_PEDIDOEXAMEN` FOREIGN KEY (`ID_DIAGNOSTICO`) REFERENCES `diagnostico` (`ID_DIAGNOSTICO`),
  ADD CONSTRAINT `FK_ESTADO_PEDIDO_EXAMEN` FOREIGN KEY (`ID_TIPO_EXAMEN`) REFERENCES `pedido_tipo_examen` (`ID_TIPO_EXAMEN`);

--
-- Filtros para la tabla `recepcion_muestra_emocultivo`
--
ALTER TABLE `recepcion_muestra_emocultivo`
  ADD CONSTRAINT `FK_PEDIDOEXAMEN_RECEPCION` FOREIGN KEY (`ID_PEDIDO`) REFERENCES `pedido_examen` (`ID_PEDIDO`),
  ADD CONSTRAINT `FK_RECEPCION_ESTADO` FOREIGN KEY (`ID_ESTADO_EMOCULTIVO`) REFERENCES `estado_emocultivo` (`ID_ESTADO_EMOCULTIVO`);

--
-- Filtros para la tabla `tincion_gram`
--
ALTER TABLE `tincion_gram`
  ADD CONSTRAINT `FK_RECEPCION_TINCION` FOREIGN KEY (`ID_RECEPCION_EMOCULTIVO`) REFERENCES `recepcion_muestra_emocultivo` (`ID_RECEPCION_EMOCULTIVO`);

--
-- Filtros para la tabla `tincion_tecnica`
--
ALTER TABLE `tincion_tecnica`
  ADD CONSTRAINT `FK_ESTADO_TECNICA` FOREIGN KEY (`ID_TIPO_TECNICA`) REFERENCES `tipo_de_tecnica` (`ID_TIPO_TECNICA`),
  ADD CONSTRAINT `FK_TINCIOGRAM_TECNICA` FOREIGN KEY (`ID_GRAM`) REFERENCES `tincion_gram` (`ID_GRAM`);

--
-- Filtros para la tabla `tipo_de_resultado`
--
ALTER TABLE `tipo_de_resultado`
  ADD CONSTRAINT `FK_TIPOGRAM_ESTADO` FOREIGN KEY (`ID_ESTADO_TIPO_DE_RESULTADO`) REFERENCES `estado_tipo_de_reporte` (`ID_ESTADO_TIPO_DE_REPORTE`),
  ADD CONSTRAINT `FK_TIPOGRAM_TINCIONGRAM` FOREIGN KEY (`ID_GRAM`) REFERENCES `tincion_gram` (`ID_GRAM`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_USUARIO_PERSONAL` FOREIGN KEY (`ID_PERSONALMEDICO`) REFERENCES `personal_medico` (`ID_PERSONALMEDICO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
