-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2021 a las 23:46:19
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `2122_balartarnau`
--
CREATE DATABASE IF NOT EXISTS `2122_balartarnau` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `2122_balartarnau`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_incidencia`
--

CREATE TABLE `tbl_incidencia` (
  `id_incidencia` int(11) NOT NULL,
  `desc_incidencia` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estat_incidencia` int(11) DEFAULT NULL,
  `num_taula` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reserva`
--

CREATE TABLE `tbl_reserva` (
  `id_reserva` int(11) NOT NULL,
  `data_ini_reserva` datetime(6) DEFAULT NULL,
  `data_fi_reserva` datetime(6) DEFAULT NULL,
  `nom_reserva` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancelacio_reserva` int(1) NOT NULL,
  `num_taula` int(11) DEFAULT NULL,
  `id_usuari` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_reserva`
--

INSERT INTO `tbl_reserva` (`id_reserva`, `data_ini_reserva`, `data_fi_reserva`, `nom_reserva`, `cancelacio_reserva`, `num_taula`, `id_usuari`) VALUES
(17, '2021-12-19 19:00:00.000000', '2021-12-19 20:00:00.000000', 'nau', 0, 1, 4),
(18, '2021-12-31 13:00:00.000000', '2021-12-31 14:00:00.000000', 'ds', 0, 10, 4),
(20, '2021-12-19 21:00:00.000000', '2021-12-19 23:00:00.000000', 'uaaanra', 1, 1, 4),
(22, '2021-12-19 22:00:00.000000', '2021-12-19 23:00:00.000000', 'test', 1, 1, 4),
(23, '2021-12-19 22:00:00.000000', '2021-12-19 23:00:00.000000', 'preuba', 1, 1, 4),
(24, '2021-12-19 22:00:00.000000', '2021-12-19 23:00:00.000000', 'UANRA', 1, 3, 4),
(25, '2021-12-20 18:00:00.000000', '2021-12-20 20:00:00.000000', 'preuba', 0, 1, 4),
(26, '2021-12-20 14:00:00.000000', '2021-12-20 15:00:00.000000', 'PEPE', 0, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_restaurant`
--

CREATE TABLE `tbl_restaurant` (
  `id_rest` int(11) NOT NULL,
  `nom_rest` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_sales_rest` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_restaurant`
--

INSERT INTO `tbl_restaurant` (`id_rest`, `nom_rest`, `num_sales_rest`) VALUES
(1, 'ivarda', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sala`
--

CREATE TABLE `tbl_sala` (
  `id_sala` int(11) NOT NULL,
  `nom_sala` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_sala` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_rest` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_sala`
--

INSERT INTO `tbl_sala` (`id_sala`, `nom_sala`, `foto_sala`, `id_rest`) VALUES
(1, 'Menjador Radiohead', 'radiohead.png', 1),
(2, 'Menjador Queen', 'queen.png', 1),
(6, 'Sala privada ABBA', 'abba.png', 1),
(7, 'Sala privada Green Day', 'greenday.png', 1),
(8, 'Sala privada Beatles', 'beatles.png', 1),
(9, 'Sala privada My Chemical Romance', 'mcromance.png', 1),
(10, 'Terrassa ACDC', 'acdc.png', 1),
(11, 'Terrassa Nirvana', 'nirvana.png', 1),
(12, 'Terrassa Guns n Roses', 'gunsnroses.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_taula`
--

CREATE TABLE `tbl_taula` (
  `num_taula` int(11) NOT NULL,
  `num_llocs_taula` int(2) DEFAULT NULL,
  `id_sala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_taula`
--

INSERT INTO `tbl_taula` (`num_taula`, `num_llocs_taula`, `id_sala`) VALUES
(1, 6, 6),
(2, 10, 7),
(3, 6, 8),
(4, 4, 9),
(5, 6, 1),
(6, 5, 12),
(7, 6, 1),
(8, 6, 2),
(9, 6, 2),
(10, 6, 2),
(11, 4, 10),
(12, 4, 10),
(13, 4, 11),
(14, 4, 11),
(15, 6, 12),
(17, 6, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuari`
--

CREATE TABLE `tbl_usuari` (
  `id_usuari` int(11) NOT NULL,
  `nom_usuari` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cognom_usuari` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contra_usuari` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipus_usuari` enum('cambrer','manteniment','administrador') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_usuari`
--

INSERT INTO `tbl_usuari` (`id_usuari`, `nom_usuari`, `cognom_usuari`, `contra_usuari`, `tipus_usuari`) VALUES
(1, 'David', 'Ortega', '1fa3356b1eb65f144a367ff8560cb406', 'cambrer'),
(3, 'Ivan', 'Aguinaga', '47496afd0bb349059c000e89235b1d87', 'cambrer'),
(4, 'Danny', 'Larrea', '0192023a7bbd73250516f069df18b500', 'manteniment'),
(5, 'Jaime', 'Casas', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador'),
(6, 'Carmen', 'Molinero', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador'),
(7, 'Sole', 'Turmo', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador'),
(8, 'Pere', 'Valls', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador'),
(9, 'Pedro', 'Diaz', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador'),
(10, 'Sergio', 'Jimenez', '81dc9bdb52d04dc20036dbd8313ed055', 'cambrer'),
(11, 'Agnes', 'Plans', '81dc9bdb52d04dc20036dbd8313ed055', 'cambrer'),
(16, 'SD', 'ff', '6f04aa8324068801354b01b63f16f331', 'manteniment');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  ADD PRIMARY KEY (`id_incidencia`),
  ADD KEY `fk_incidencia_taula_idx` (`num_taula`);

--
-- Indices de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `fk_reserva_taula_idx` (`num_taula`),
  ADD KEY `fk_reserva_usuari_idx` (`id_usuari`);

--
-- Indices de la tabla `tbl_restaurant`
--
ALTER TABLE `tbl_restaurant`
  ADD PRIMARY KEY (`id_rest`);

--
-- Indices de la tabla `tbl_sala`
--
ALTER TABLE `tbl_sala`
  ADD PRIMARY KEY (`id_sala`),
  ADD KEY `fk_sala_restaurant_idx` (`id_rest`);

--
-- Indices de la tabla `tbl_taula`
--
ALTER TABLE `tbl_taula`
  ADD PRIMARY KEY (`num_taula`),
  ADD KEY `fk_taulsa_sala_idx` (`id_sala`);

--
-- Indices de la tabla `tbl_usuari`
--
ALTER TABLE `tbl_usuari`
  ADD PRIMARY KEY (`id_usuari`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  MODIFY `id_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tbl_restaurant`
--
ALTER TABLE `tbl_restaurant`
  MODIFY `id_rest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_sala`
--
ALTER TABLE `tbl_sala`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_usuari`
--
ALTER TABLE `tbl_usuari`
  MODIFY `id_usuari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  ADD CONSTRAINT `fk_incidencia_taula` FOREIGN KEY (`num_taula`) REFERENCES `tbl_taula` (`num_taula`);

--
-- Filtros para la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD CONSTRAINT `fk_reserva_taula` FOREIGN KEY (`num_taula`) REFERENCES `tbl_taula` (`num_taula`),
  ADD CONSTRAINT `fk_reserva_usuari` FOREIGN KEY (`id_usuari`) REFERENCES `tbl_usuari` (`id_usuari`);

--
-- Filtros para la tabla `tbl_sala`
--
ALTER TABLE `tbl_sala`
  ADD CONSTRAINT `fk_sala_restaurant` FOREIGN KEY (`id_rest`) REFERENCES `tbl_restaurant` (`id_rest`);

--
-- Filtros para la tabla `tbl_taula`
--
ALTER TABLE `tbl_taula`
  ADD CONSTRAINT `fk_taula_sala` FOREIGN KEY (`id_sala`) REFERENCES `tbl_sala` (`id_sala`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
