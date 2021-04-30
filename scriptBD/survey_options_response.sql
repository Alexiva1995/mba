-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2020 a las 05:37:09
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `survey_options_response`
--

CREATE TABLE `survey_options_response` (
  `id` int(11) NOT NULL,
  `response` text NOT NULL,
  `survey_options_id` int(11) NOT NULL,
  `selected` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `survey_options_response`
--

INSERT INTO `survey_options_response` (`id`, `response`, `survey_options_id`, `selected`, `user_id`, `created_at`, `updated_at`) VALUES
(14, 'Probando encuesta guardada y habilitada', 33, 0, 3, NULL, NULL),
(15, ' respuesta 1', 33, 0, 3, NULL, NULL),
(16, 'Probando encuesta guardada y habilitada', 33, 0, 3, NULL, NULL),
(17, ' respuesta 2', 33, 0, 3, NULL, NULL),
(18, 'aesryeturyi78iy', 34, 0, 3, NULL, NULL),
(19, 'Mal', 35, 0, 3, NULL, NULL),
(20, 'Bien', 35, 0, 3, NULL, NULL),
(21, 'Neutral', 35, 0, 3, NULL, NULL),
(22, 'Excelente', 35, 0, 3, NULL, NULL),
(27, 'Bien', 35, 1, 10, '2020-10-12 17:49:12', '2020-10-12 17:49:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `survey_options_response`
--
ALTER TABLE `survey_options_response`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `survey_options_response`
--
ALTER TABLE `survey_options_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
