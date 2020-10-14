-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2020 a las 03:55:53
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
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `cover_name` varchar(255) DEFAULT NULL,
  `thumbnail_cover` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `featured_cover` varchar(255) DEFAULT NULL,
  `featured_cover_name` varchar(255) DEFAULT NULL,
  `featured_at` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = No Disponible. 1 = Disponible',
  `likes` int(10) UNSIGNED DEFAULT 0 COMMENT 'Para guardar el numero de likes que tiene ese curso',
  `shares` int(10) UNSIGNED DEFAULT 0 COMMENT 'Para guardar el numero de veces que ha sido compartido',
  `views` int(10) UNSIGNED DEFAULT 0 COMMENT 'Para guardar el numero de visualizaciones',
  `price` double DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `mentor_id`, `title`, `slug`, `category_id`, `subcategory_id`, `description`, `cover`, `cover_name`, `thumbnail_cover`, `featured`, `featured_cover`, `featured_cover_name`, `featured_at`, `status`, `likes`, `shares`, `views`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Finanzas personales', 'finanzas-personales', 1, 1, '<p>Curso de economia</p>', '1.jpg', 'curso1.jpg', '1-thumbnail.png', 1, 'destacado.png', 'destacado.png', '2020-09-09', 0, 1, 1, 3, 50, '2020-09-08 14:04:07', '2020-10-13 18:59:21', '2020-10-05 21:08:04'),
(2, 3, 'Curso completo de Inteligencia Artificial con Python', 'curso-completo-de-inteligencia-artificial-con-python', 8, 4, '<p>Curso completo de Inteligencia Artificial con Python</p>', '2.png', 'img-recommended2.png', '2-thumbnail.png', 0, '1.png', NULL, NULL, 0, 2, 4, 4, 50, '2020-09-08 14:55:12', '2020-10-13 13:27:28', '2020-10-06 19:23:31'),
(7, 8, 'Análisis Financiero desde 0', 'analisis-financiero-desde-0', 3, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus maximus eros malesuada arcu sagittis, et lobortis.', '7.png', 'curso3.jpg', '7-thumbnail.png', 0, '5.png', NULL, NULL, 0, 0, 0, 0, 0, '2020-09-11 19:40:44', '2020-10-13 18:50:40', '2020-10-13 18:50:40'),
(3, 4, 'Forex Begins: Curso de trading en Forex gratuito', 'forex-begins-curso-de-trading-en-forex-gratuito', 5, 1, 'Forex Begins: Curso de trading en Forex gratuito.', '3.png', 'img-recommended4.png', '3-thumbnail.png', 0, '4.png', NULL, NULL, 1, 2, 2, 2, 0, '2020-09-08 16:17:28', '2020-09-08 16:17:28', NULL),
(4, 5, 'Análisis Técnico de los Mercados Financieros', 'analisis-tecnico-de-los-mercados-financieros', 3, 5, NULL, '4.png', 'img-recommended5.png', '4-thumbnail.png', 0, NULL, NULL, NULL, 1, 3, 4, 4, 0, '2020-09-08 16:46:14', '2020-09-08 16:54:19', NULL),
(5, 6, 'Crecimiento financiero', 'crecimiento-financiero', 1, 1, 'Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.', '5.jpg', 'curso1.jpg', '5-thumbnail.png', 0, '3.png', NULL, NULL, 1, 44, 20, 44, 0, '2020-09-11 19:24:31', '2020-09-11 20:43:47', NULL),
(6, 7, 'Aprende Forex desde 0', 'aprende-forex-desde-0', 5, 1, NULL, '6.png', 'christina-wocintechchat-com--WGbMJU-lPI-unsplash (2).png', '6-thumbnail.png', 0, NULL, NULL, NULL, 1, 12, 10, 13, 0, '2020-09-11 19:30:48', '2020-10-13 18:44:54', NULL),
(8, 9, 'Curso de Criptomonedas', 'curso-de-criptomonedas', 9, 5, NULL, NULL, NULL, '8-thumbnail.png', 0, NULL, NULL, NULL, 1, 2, 0, 1, 0, '2020-09-11 19:46:19', '2020-09-11 19:46:19', NULL),
(9, 2, 'Esto es una prueba', 'esto-es-una-prueba', 1, 1, 'probando', '9.png', 'product-school-1ZYJqPwh-PI-unsplash@2x.png', '9-thumbnail.png', 0, '6.png', NULL, NULL, 1, 0, 0, 0, 25000, '2020-09-17 21:53:39', '2020-09-17 21:53:39', NULL),
(10, 4, 'Curso sin subcategoria y sin costo', 'curso-sin-subcategoria-y-sin-costo', 9, NULL, '<p>Esto es una prueba de Curso sin subcategoria y sin costo</p>', '10.jpg', 'andrew-buchanan-Fpc4Z5ScBB8-unsplash.jpg', '10-thumbnail.jpg', 0, '2.png', NULL, NULL, 1, 0, 0, 0, 0, '2020-10-08 10:31:24', '2020-10-08 10:34:24', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
