-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2021 a las 16:06:13
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `codigo_de_barra` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `stock` int(10) NOT NULL,
  `precio` float NOT NULL,
  `fecha_de_creacion` date NOT NULL,
  `fecha_de_modificacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES
(1001, 77900361, 'Westmacot\r\nt', 'liquido', 33, 15.87, '2021-02-09', '2020-09-26'),
(1002, 77900362, 'Spirit', 'solido', 45, 66.6, '2020-09-18', '2020-04-14'),
(1003, 77900363, 'Newgrosh', 'polvo', 0, 68.19, '2020-11-29', '2021-02-11'),
(1004, 77900364, 'McNickle', 'polvo', 0, 53.51, '2020-11-28', '2020-04-17'),
(1005, 77900365, 'Hudd', 'solido', 68, 66.6, '2020-12-19', '2020-06-19'),
(1006, 77900366, 'Schrader', 'polvo', 0, 96.54, '2020-08-02', '2020-04-18'),
(1007, 77900367, 'Bachellier', 'solido', 59, 66.6, '2021-01-30', '2020-06-07'),
(1008, 77900368, 'Fleming', 'solido', 38, 66.6, '2020-10-26', '2020-10-03'),
(1009, 77900369, 'Hurry', 'solido', 44, 66.6, '2020-07-04', '2020-05-30'),
(1012, 31231212, 'chocolate', 'solido', 25, 66.6, '2017-04-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `clave` int(10) NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_de_registro` date NOT NULL,
  `localidad` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) VALUES
(102, 'Esteban', 'Madou', 2345, 'dkantor0@example.com', '2021-01-07', 'Quilmes'),
(103, 'German', 'Gerram', 1234, 'ggerram1@hud.gov', '2020-05-08', 'Berazategui'),
(104, 'Deloris', 'Fosis', 5678, 'bsharpe2@wisc.edu', '2020-11-28', 'Avellaneda'),
(105, 'Broku', 'Neiner', 4567, 'bblazic3@desdev.cn', '2020-12-08', 'Quilmes'),
(106, 'Garrick', 'Brent', 6789, 'gbrent4@theguardian.com', '2020-12-17', 'Moron');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_producto` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `fecha_de_venta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES
(1001, 101, 2, '2020-07-19'),
(1008, 102, 3, '2020-06-16'),
(1007, 102, 4, '2021-01-24'),
(1006, 103, 5, '2021-01-14'),
(1003, 104, 6, '2021-03-20'),
(1005, 105, 7, '2021-02-22'),
(1003, 104, 6, '2020-12-02'),
(1003, 106, 6, '2020-06-10'),
(1002, 106, 6, '2021-02-04'),
(1001, 106, 1, '2020-05-17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1013;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
