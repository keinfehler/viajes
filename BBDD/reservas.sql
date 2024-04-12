-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2024 a las 03:37:32
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

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
(60, '2024-01-01', '2024-01-01', 1900, 50, 10, 30),
(61, '2024-01-02', '2024-01-02', 1900, 51, 11, 31),
(62, '2024-01-03', '2024-01-03', 1900, 52, 12, 32),
(63, '2024-01-04', '2024-01-04', 1900, 53, 13, 33),
(64, '2024-01-05', '2024-01-05', 1900, 54, 14, 34),
(65, '2024-01-06', '2024-01-06', 1900, 55, 15, 35);

--
-- Disparadores `reservas`
--
DELIMITER $$
CREATE TRIGGER `actualizar_fecha_inicial` BEFORE INSERT ON `reservas` FOR EACH ROW SET NEW.Fecha_inicio = NOW()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actualizar_fechainicio` BEFORE INSERT ON `reservas` FOR EACH ROW SET NEW.Fecha_inicio = NOW()
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`ID_reserva`,`ID_paquete`,`ID_cliente`,`ID_empleado`),
  ADD KEY `ID_empleado` (`ID_empleado`),
  ADD KEY `ID_cliente` (`ID_cliente`);

--
-- Restricciones para tablas volcadas
--

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
