-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2018 a las 19:26:56
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `genesis`
--
CREATE DATABASE IF NOT EXISTS `genesis` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `genesis`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directions`
--

CREATE TABLE `directions` (
  `id` int(11) NOT NULL,
  `direction` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `directions`
--

INSERT INTO `directions` (`id`, `direction`, `created`, `modified`) VALUES
(1, 'CENTRO', '2018-01-04 00:00:00', '2018-01-04 00:00:00'),
(2, 'NORTE', '2018-01-04 00:00:00', '2018-01-04 00:00:00'),
(3, 'METRO', '2018-01-04 00:00:00', '2018-01-04 00:00:00'),
(4, 'NORTE PACIFICO', '2018-01-04 00:00:00', '2018-01-04 00:00:00'),
(5, 'SUR', '2018-01-04 00:00:00', '2018-01-04 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `implement_activities`
--

CREATE TABLE `implement_activities` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `activity` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `implement_activities`
--

INSERT INTO `implement_activities` (`id`, `id_user`, `activity`, `description`, `created`, `modified`) VALUES
(1, 1, 'Visita a campo', 'Se realizo visita a campo a la oficina de toluca oriente, con acompañamiento del gerente.', '2018-01-03 00:00:00', '2018-01-03 00:00:00'),
(2, 1, 'Junta RAE', 'Se realiza seguimiento en junta RAE', '2018-01-04 00:00:00', '2018-01-04 00:00:00'),
(3, 2, 'Visita a campo', 'Se realiza visita a campo en la region metro occidente.\r\nIdentificando los principales problemas.', '2018-01-04 05:00:00', '2018-01-04 05:00:00'),
(4, 2, 'adsad', 'asdasdsad', '2018-01-05 17:50:51', '2018-01-05 17:50:51'),
(5, 2, 'wwerwer', 'werwerwer', '2018-01-05 17:52:38', '2018-01-05 17:52:38'),
(6, 1, 'wwerwer', 'werwerwer', '2018-01-05 17:53:25', '2018-01-05 17:53:25'),
(7, 1, 'Actividad', 'nueva actividad definida', '2018-01-05 17:54:29', '2018-01-05 17:54:29'),
(8, 1, 'Actividad', 'nueva actividad definida', '2018-01-05 17:54:52', '2018-01-05 17:54:52'),
(9, 1, 'nueva activity', 'asdasdasdasdasdasdasdasda', '2018-01-05 18:30:04', '2018-01-05 18:30:04'),
(10, 1, 'wqeqweqwe', 'asdasdasdasdasdasdasdasda', '2018-01-05 18:30:20', '2018-01-05 18:30:20'),
(11, 1, 'probando el grid', 'sÃ±ldkasÃ±daslcaÃ±sldÃ±{saldÃ±{asldÃ±{asdlÃ±{asd', '2018-01-05 18:40:31', '2018-01-05 18:40:31'),
(12, 1, 'asdsad3123123', 'asdasdasdsadasdasd', '2018-01-05 18:42:05', '2018-01-05 18:42:05'),
(13, 1, 'probando actualizador', 'aasdasdasdasdasdasdasd', '2018-01-05 18:45:27', '2018-01-05 18:45:27'),
(14, 1, 'test test', 'asdasdasdasdsaasdasd', '2018-01-05 18:45:54', '2018-01-05 18:45:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `region` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `subdirection_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subdirections`
--

CREATE TABLE `subdirections` (
  `id` int(11) NOT NULL,
  `subdirection` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direction_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subdirections`
--

INSERT INTO `subdirections` (`id`, `subdirection`, `direction_id`, `created`, `modified`) VALUES
(1, 'METRO', 3, '2018-01-04 00:00:00', '2018-01-04 00:00:00'),
(2, 'METRO ORIENTE', 3, '2018-01-04 00:00:00', '2018-01-04 00:00:00'),
(3, 'ESTADO DE MÉXICO', 3, '2018-01-04 00:00:00', '2018-01-04 00:00:00'),
(4, 'BAJIO', 3, '2018-01-04 00:00:00', '2018-01-04 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `first_lastname` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `second_lastname` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `names` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `position_id` int(11) NOT NULL,
  `boss_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `number`, `first_lastname`, `second_lastname`, `names`, `position_id`, `boss_id`) VALUES
(1, 1234, 'JUAREZ', 'PADILLA', 'HILDA', 2, 0),
(2, 37768, 'RIZO', 'FLORES', 'JUAN CARLOS', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `directions`
--
ALTER TABLE `directions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `implement_activities`
--
ALTER TABLE `implement_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subdirections`
--
ALTER TABLE `subdirections`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `directions`
--
ALTER TABLE `directions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `implement_activities`
--
ALTER TABLE `implement_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subdirections`
--
ALTER TABLE `subdirections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
