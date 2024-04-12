-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-04-2024 a las 14:32:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
  `ID_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_Cliente`, `Nombre`, `Apellido`, `Email`, `Fecha_registro`, `Contrasena`, `num_rva`, `ID_cargo`) VALUES
(10, 'Juan', 'Lopez', 'lopez@gmail.com', '0000-00-00', '1234', 0, 1),
(11, 'Camila11', 'Garcia', 'camila@gmail.com', '0000-00-00', '', 0, 0),
(12, 'Maria1', 'Diaz', 'Maria11@gmail.com', '0000-00-00', '123', 0, 0),
(13, 'Judith', 'Diez', 'judith@gmail.com', '0000-00-00', '', 0, 0),
(14, 'Miguel', 'Cervantes', 'Miguel@test.com', '0000-00-00', 'test', 0, 0),
(15, 'Sara', 'Corrales', 'sara@gmail.com', '0000-00-00', '', 0, 0),
(23, 'viviana', '', 'v@gmail.com', '0000-00-00', '123', 0, 0),
(24, 'Luna', '', 'luna@gmail.com', '2024-01-21', '123', 0, 0),
(29, 'camilo', '', 'camilo@hotmail.com', '2024-03-04', '123', 0, 1),
(31, 'Mario', 'Garcia', 'mario@garcia.com', '2024-04-08', '123', 0, 0),
(35, 'admin', '', 'admin@agencia.com', '2024-04-12', 'test', 0, 1);

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
  `ID_empleado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`ID_reserva`, `Fecha_inicio`, `Fecha_fin`, `Precio_total`, `ID_paquete`, `ID_cliente`, `ID_empleado`) VALUES
(69, '2024-04-12', '2024-04-26', 2200, 54, 10, 30),
(70, '2024-04-12', '2024-04-26', 2200, 54, 10, 30),
(71, '2024-04-12', '2024-04-26', 2100, 52, 10, 30),
(105, '2024-04-12', '2024-04-26', 2200, 54, 23, 30);

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
  ADD KEY `ID_cliente` (`ID_cliente`);

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
  MODIFY `ID_Cliente` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `ID_reserva` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

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
