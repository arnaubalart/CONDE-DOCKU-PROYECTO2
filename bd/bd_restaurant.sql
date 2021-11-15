CREATE DATABASE  IF NOT EXISTS `bd_restaurant` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bd_restaurant`;
-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2021 a las 16:19:09
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
-- Base de datos: `bd_restaurant`
--

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
  `data_reserva` datetime(6) DEFAULT NULL,
  `data_alliberament_reserva` datetime(6) DEFAULT NULL,
  `num_taula` int(11) DEFAULT NULL,
  `id_usuari` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id_rest` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_sala`
--

INSERT INTO `tbl_sala` (`id_sala`, `nom_sala`, `id_rest`) VALUES
(1, 'Menjador Radiohead', 1),
(2, 'Menjador Queen', 1),
(6, 'Sala privada ABBA', 1),
(7, 'Sala privada Green Day', 1),
(8, 'Sala privada Beatles', 1),
(9, 'Sala privada My Chemical Romance', 1),
(10, 'Terrassa ACDC', 1),
(11, 'Terrassa Nirvana', 1),
(12, 'Terrassa Guns n Roses', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_taula`
--

CREATE TABLE `tbl_taula` (
  `num_taula` int(11) NOT NULL,
  `num_llocs_taula` int(2) DEFAULT NULL,
  `id_sala` int(11) DEFAULT NULL,
  `estat_taula` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_taula`
--

INSERT INTO `tbl_taula` (`num_taula`, `num_llocs_taula`, `id_sala`, `estat_taula`) VALUES
(1, 6, 6, 0),
(2, 10, 7, 0),
(3, 6, 8, 0),
(4, 4, 9, 0),
(5, 6, 1, 0),
(6, 6, 1, 0),
(7, 6, 1, 0),
(8, 6, 2, 0),
(9, 6, 2, 0),
(10, 6, 2, 0),
(11, 4, 10, 0),
(12, 4, 10, 0),
(13, 4, 11, 0),
(14, 4, 11, 0),
(15, 6, 12, 0),
(16, 2, 1, 0),
(17, 6, 12, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuari`
--

CREATE TABLE `tbl_usuari` (
  `id_usuari` int(11) NOT NULL,
  `nom_usuari` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cognom_usuari` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contra_usuari` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipus_usuari` enum('cambrer','manteniment') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_usuari`
--

INSERT INTO `tbl_usuari` (`id_usuari`, `nom_usuari`, `cognom_usuari`, `contra_usuari`, `tipus_usuari`) VALUES
(1, 'David', 'Ortega', '1fa3356b1eb65f144a367ff8560cb406', 'cambrer'),
(2, 'Arnau', 'Balart', '8af3982673455323883c06fa59d2872a', 'cambrer'),
(3, 'Ivan', 'Aguinaga', '47496afd0bb349059c000e89235b1d87', 'cambrer'),
(4, 'Danny', 'Larrea', '0192023a7bbd73250516f069df18b500', 'manteniment');

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
  MODIFY `id_incidencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_usuari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
