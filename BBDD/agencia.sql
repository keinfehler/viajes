-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2024 a las 18:38:27
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agencia`
--
CREATE DATABASE IF NOT EXISTS `agencia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `agencia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo` (
  `ID_cargo` int(11) NOT NULL,
  `Descripción` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`ID_cargo`, `Descripción`) VALUES
(0, 'Usuario'),
(1, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `ID_Cliente` int(2) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellido` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Fecha_registro` date NOT NULL,
  `Contrasena` varchar(10) NOT NULL,
  `num_rva` int(11) NOT NULL DEFAULT 0,
  `ID_cargo` int(11) NOT NULL,
  `Puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_Cliente`, `Nombre`, `Apellido`, `Email`, `Fecha_registro`, `Contrasena`, `num_rva`, `ID_cargo`, `Puntos`) VALUES
(10, 'Juan', 'Lopez', 'lopez@gmail.com', '0000-00-00', '1234', 149, 1, 0),
(11, 'Camila11', 'Garcia', 'camila@gmail.com', '0000-00-00', '1234', 0, 0, 0),
(12, 'Maria1', 'Diaz', 'Maria11@gmail.com', '0000-00-00', '123', 145, 0, 0),
(13, 'Judith', 'Diez', 'judith@gmail.com', '0000-00-00', '', 0, 0, 0),
(14, 'Miguel', 'Cervantes', 'Miguel@test.com', '0000-00-00', 'test', 0, 0, 0),
(15, 'Sara', 'Corrales', 'sara@gmail.com', '0000-00-00', '', 0, 0, 0),
(23, 'viviana', '', 'v@gmail.com', '0000-00-00', '123', 0, 0, 0),
(24, 'Luna', '', 'luna@gmail.com', '2024-01-21', '123', 0, 0, 0),
(29, 'camilo', '', 'camilo@hotmail.com', '2024-03-04', '123', 0, 1, 0),
(31, 'Mario', 'Garcia', 'mario@garcia.com', '2024-04-08', '123', 0, 0, 0),
(35, 'admin', '', 'admin@agencia.com', '2024-04-12', 'test', 120, 1, 0);

--
-- Disparadores `clientes`
--
DROP TRIGGER IF EXISTS `actualizar_fecha_registro`;
DELIMITER $$
CREATE TRIGGER `actualizar_fecha_registro` BEFORE INSERT ON `clientes` FOR EACH ROW SET NEW.Fecha_registro =NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comerciales`
--

DROP TABLE IF EXISTS `comerciales`;
CREATE TABLE `comerciales` (
  `ComercialID` int(11) NOT NULL,
  `Nombre_comercial` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `FechaContratacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comerciales`
--

INSERT INTO `comerciales` (`ComercialID`, `Nombre_comercial`, `Email`, `Telefono`, `FechaContratacion`) VALUES
(1, 'Juan Perez', 'juan.perez@example.com', '555-1234', '2022-01-15'),
(2, 'Ana Gómez', 'ana.gomez@example.com', '555-5678', '2021-03-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinos`
--

DROP TABLE IF EXISTS `destinos`;
CREATE TABLE `destinos` (
  `ID_Destino` int(2) NOT NULL,
  `Nombre_destino` varchar(20) NOT NULL,
  `Descripcion` varchar(30) NOT NULL,
  `Precio_promedio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `destinos`
--

INSERT INTO `destinos` (`ID_Destino`, `Nombre_destino`, `Descripcion`, `Precio_promedio`) VALUES
(20, 'Cartagena', 'Playa', 1800),
(21, 'SantaMarta', 'Playa', 1850),
(22, 'Bogotá', 'Ciudad', 1900),
(23, 'EjeCafetero', 'Paisaje', 1780),
(24, 'Cali', 'Ciudad', 1600),
(25, 'Medellin', 'Ciudad', 1790);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `ID_empleado` int(2) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellido` varchar(20) NOT NULL,
  `Cargo` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Telefono` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`ID_empleado`, `Nombre`, `Apellido`, `Cargo`, `Email`, `Telefono`) VALUES
(30, 'Marisol', 'Villamarin', 'Logistica', 'marisol@gmail.com', 632598741),
(31, 'Leticia', 'Marulanda', 'Asistencia cliente', 'leticia@gmail.com', 632598752),
(32, 'Mauricio', 'Sierra', 'Atencion telefonica', 'mauricio@gmail.com', 698524785),
(33, 'Viviana', 'Herrera', 'Administrativa', 'vivianagmail.com', 695847125),
(34, 'Rodrigo', 'Caballero', 'Ejecutivo', 'rodrigo@gmail.com', 698523456),
(35, 'Vanesa', 'Sanchez', 'Comercial', 'vanesa@gmail.com', 698521478);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresias`
--

DROP TABLE IF EXISTS `membresias`;
CREATE TABLE `membresias` (
  `ID_Membresia` int(11) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `PuntosMinimos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `membresias`
--

INSERT INTO `membresias` (`ID_Membresia`, `Nombre`, `PuntosMinimos`) VALUES
(1, 'Basico', 1),
(2, 'Plata', 10),
(3, 'Oro', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
CREATE TABLE `ofertas` (
  `OfertaID` int(11) NOT NULL,
  `ComercialID` int(11) NOT NULL,
  `ClienteID` int(2) NOT NULL,
  `PaqueteID` int(2) NOT NULL,
  `Estado` enum('ofertado','aceptado','rechazado','pagado') DEFAULT 'ofertado',
  `FechaOferta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`OfertaID`, `ComercialID`, `ClienteID`, `PaqueteID`, `Estado`, `FechaOferta`) VALUES
(32, 2, 15, 51, 'ofertado', '2024-06-12'),
(33, 2, 10, 51, 'ofertado', '2024-06-12'),
(34, 1, 10, 52, 'ofertado', '2024-06-12'),
(35, 2, 23, 54, 'ofertado', '2024-06-12'),
(36, 2, 35, 52, 'ofertado', '2024-06-12'),
(37, 2, 35, 51, 'ofertado', '2024-06-12'),
(38, 2, 12, 50, 'ofertado', '2024-06-12'),
(39, 2, 12, 51, 'ofertado', '2024-06-12'),
(40, 2, 12, 52, 'ofertado', '2024-06-12'),
(41, 2, 12, 53, 'ofertado', '2024-06-12'),
(42, 1, 11, 50, 'aceptado', '2024-06-12'),
(43, 2, 14, 50, 'ofertado', '2024-06-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE `pagos` (
  `ID_pago` int(2) NOT NULL,
  `Fecha_pago` date NOT NULL,
  `Monto` int(10) NOT NULL,
  `ID_reserva` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

DROP TABLE IF EXISTS `paquetes`;
CREATE TABLE `paquetes` (
  `ID_paquete` int(2) NOT NULL,
  `Nombre_paquete` varchar(20) NOT NULL,
  `Descripcion` varchar(20) NOT NULL,
  `Precio_total` int(10) NOT NULL,
  `ID_destino` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`ID_paquete`, `Nombre_paquete`, `Descripcion`, `Precio_total`, `ID_destino`) VALUES
(50, 'small', 'Basico', 1900, 20),
(51, 'xs', 'Viaje 2x1', 2000, 21),
(52, 'Medium', 'Transporte incluido', 2100, 22),
(53, 'M', 'Traslados por la ciu', 2200, 23),
(54, 'M', 'Comida incluida', 2200, 24),
(55, 'XL', 'Todo incluido', 2600, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE `reservas` (
  `ID_reserva` int(2) NOT NULL,
  `Fecha_inicio` date NOT NULL,
  `Fecha_fin` date NOT NULL,
  `Precio_total` int(10) NOT NULL,
  `ID_paquete` int(2) NOT NULL,
  `ID_cliente` int(2) NOT NULL,
  `ID_empleado` int(2) NOT NULL,
  `id_temporada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`ID_reserva`, `Fecha_inicio`, `Fecha_fin`, `Precio_total`, `ID_paquete`, `ID_cliente`, `ID_empleado`, `id_temporada`) VALUES
(69, '2024-04-25', '2024-04-28', 2000, 51, 15, 30, 2),
(70, '2024-04-12', '2024-04-26', 2000, 51, 10, 30, 3),
(71, '2024-04-12', '2024-04-26', 2100, 52, 10, 30, 1),
(105, '2024-04-12', '2024-04-26', 2200, 54, 23, 30, 2),
(119, '2024-04-10', '2024-04-18', 2100, 52, 35, 30, 1),
(120, '2024-04-24', '2024-05-07', 2000, 51, 35, 30, 0),
(121, '2024-04-03', '2024-04-19', 1900, 50, 12, 30, 0),
(122, '2024-04-24', '2024-04-24', 2000, 51, 12, 30, 0),
(123, '2024-04-24', '2024-04-24', 2000, 51, 12, 30, 0),
(124, '2024-04-25', '2024-04-06', 2000, 51, 12, 30, 0),
(125, '2024-04-10', '2024-04-20', 2100, 52, 12, 30, 0),
(133, '2024-04-04', '2024-04-04', 2000, 51, 12, 30, 0),
(134, '2024-04-10', '2024-04-19', 2200, 53, 12, 30, 0),
(135, '2024-04-10', '2024-04-19', 2200, 53, 12, 30, 0),
(136, '2024-04-11', '2024-04-11', 2200, 53, 12, 30, 0),
(137, '2024-04-11', '2024-04-11', 2200, 53, 12, 30, 0),
(138, '2024-04-11', '2024-04-11', 2200, 53, 12, 30, 0),
(139, '2024-04-18', '2024-04-12', 2000, 51, 12, 30, 0),
(140, '2024-04-18', '2024-04-12', 2000, 51, 12, 30, 1),
(141, '2024-04-12', '2024-04-19', 2100, 52, 12, 30, 1),
(142, '2024-04-12', '2024-04-19', 2100, 52, 12, 30, 1),
(143, '2024-04-04', '2024-04-25', 2100, 52, 12, 30, 1),
(144, '2024-04-04', '2024-04-25', 2100, 52, 12, 30, 3),
(145, '2024-04-18', '2024-04-20', 1900, 50, 12, 30, 3),
(146, '2024-04-10', '2024-04-18', 2000, 51, 10, 30, 2),
(147, '2024-04-11', '2024-04-26', 2100, 52, 10, 30, 3),
(148, '2024-04-03', '2024-04-04', 1900, 50, 11, 30, 3),
(149, '2024-04-23', '2024-04-25', 1900, 50, 14, 30, 0);

--
-- Disparadores `reservas`
--
DROP TRIGGER IF EXISTS `update_num_rva`;
DELIMITER $$
CREATE TRIGGER `update_num_rva` AFTER INSERT ON `reservas` FOR EACH ROW update clientes   
  set num_rva = NEW.ID_reserva
  where ID_Cliente = NEW.ID_cliente
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporadas`
--

DROP TABLE IF EXISTS `temporadas`;
CREATE TABLE `temporadas` (
  `id_temporada` int(11) NOT NULL DEFAULT 1,
  `Nombre_Temporada` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temporadas`
--

INSERT INTO `temporadas` (`id_temporada`, `Nombre_Temporada`) VALUES
(1, 'Alta'),
(2, 'media'),
(3, 'baja');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`ID_cargo`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_Cliente`),
  ADD KEY `ID_cargo` (`ID_cargo`),
  ADD KEY `ID_cargo_2` (`ID_cargo`);

--
-- Indices de la tabla `comerciales`
--
ALTER TABLE `comerciales`
  ADD PRIMARY KEY (`ComercialID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indices de la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD PRIMARY KEY (`ID_Destino`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`ID_empleado`);

--
-- Indices de la tabla `membresias`
--
ALTER TABLE `membresias`
  ADD PRIMARY KEY (`ID_Membresia`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`OfertaID`),
  ADD UNIQUE KEY `OFERTA_UNICA` (`ComercialID`,`PaqueteID`,`ClienteID`) USING BTREE,
  ADD KEY `ClienteID` (`ClienteID`),
  ADD KEY `PaqueteID` (`PaqueteID`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`ID_pago`,`ID_reserva`),
  ADD KEY `ID_reserva` (`ID_reserva`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`ID_paquete`,`ID_destino`),
  ADD KEY `ID_destino` (`ID_destino`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`ID_reserva`,`ID_paquete`,`ID_cliente`,`ID_empleado`),
  ADD KEY `ID_empleado` (`ID_empleado`),
  ADD KEY `ID_cliente` (`ID_cliente`),
  ADD KEY `fk_reservas_pais` (`id_temporada`);

--
-- Indices de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  ADD PRIMARY KEY (`id_temporada`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `ID_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `comerciales`
--
ALTER TABLE `comerciales`
  MODIFY `ComercialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `membresias`
--
ALTER TABLE `membresias`
  MODIFY `ID_Membresia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `OfertaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `ID_reserva` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`ID_reserva`) REFERENCES `reservas` (`ID_reserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD CONSTRAINT `paquetes_ibfk_1` FOREIGN KEY (`ID_destino`) REFERENCES `destinos` (`ID_Destino`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`ID_empleado`) REFERENCES `empleados` (`ID_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`ID_cliente`) REFERENCES `clientes` (`ID_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
