-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-12-2015 a las 22:09:21
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pronosticos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `melate`
--

CREATE TABLE `melate` (
  `id_resultado` bigint(20) UNSIGNED NOT NULL,
  `concurso` smallint(5) UNSIGNED NOT NULL,
  `r1` tinyint(3) UNSIGNED NOT NULL,
  `r2` tinyint(3) UNSIGNED NOT NULL,
  `r3` tinyint(3) UNSIGNED NOT NULL,
  `r4` tinyint(3) UNSIGNED NOT NULL,
  `r5` int(10) UNSIGNED NOT NULL,
  `r6` tinyint(3) UNSIGNED NOT NULL,
  `r7` tinyint(3) UNSIGNED NOT NULL,
  `bolsa` float UNSIGNED NOT NULL,
  `fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `melate`
--
ALTER TABLE `melate`
  ADD PRIMARY KEY (`id_resultado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `melate`
--
ALTER TABLE `melate`
  MODIFY `id_resultado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
