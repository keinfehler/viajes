-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Apr 2024 um 10:34
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `agencia`
--
CREATE DATABASE IF NOT EXISTS `agencia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `agencia`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo` (
  `ID_cargo` int(11) NOT NULL,
  `Descripción` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `cargo`
--

INSERT INTO `cargo` (`ID_cargo`, `Descripción`) VALUES
(0, 'Usuario'),
(1, 'Administrador');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `clientes`
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
-- Daten für Tabelle `clientes`
--

INSERT INTO `clientes` (`ID_Cliente`, `Nombre`, `Apellido`, `Email`, `Fecha_registro`, `Contrasena`, `num_rva`, `ID_cargo`) VALUES
(10, 'Juan', 'Lopez', 'lopez@gmail.com', '0000-00-00', '', 0, 0),
(11, 'Camila', 'Garcia', 'camila@gmail.com', '0000-00-00', '', 0, 0),
(12, 'Maria', 'Diaz', 'Maria@gmail.com', '0000-00-00', '', 0, 0),
(13, 'Judith', 'Diez', 'judith@gmail.com', '0000-00-00', '', 0, 0),
(14, 'Miguel', 'Cervantes', 'Miguel', '0000-00-00', '', 0, 0),
(15, 'Sara', 'Corrales', 'sara@gmail.com', '0000-00-00', '', 0, 0),
(23, 'viviana', '', 'v@gmail.com', '0000-00-00', '123', 0, 0),
(24, 'Luna', '', 'luna@gmail.com', '2024-01-21', '123', 0, 0),
(25, 'test', '', 't@gmail.com', '2024-01-30', 'test', 0, 0),
(26, 'p', '', 'p@gmail.com', '2024-01-30', 'test', 0, 0),
(27, 'camila', '', 'c@c.com', '2024-02-05', '123', 0, 0),
(28, 'Ricardo', '', 'r@r.com', '2024-02-17', '123', 112, 0),
(29, 'camilo', '', 'camilo@hotmail.com', '2024-03-04', '123', 0, 0),
(30, 'lili', '', 's@shot.com', '2024-04-03', '123', 0, 0),
(31, 'Mario', 'Garcia', 'mario@garcia.com', '2024-04-08', '123', 0, 0),
(32, 'Pepe', '', 'peter@gmail.com', '2024-04-11', 'test', 117, 0),
(33, 'hh1266abc', '', 'hhh@test.com', '2024-04-12', '123', 118, 0),
(34, 'admin', '', 'admin@agencia.com', '2024-04-12', 'test', 0, 1);

--
-- Trigger `clientes`
--
DROP TRIGGER IF EXISTS `actualizar_fecha_registro`;
DELIMITER $$
CREATE TRIGGER `actualizar_fecha_registro` BEFORE INSERT ON `clientes` FOR EACH ROW SET NEW.Fecha_registro =NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `destinos`
--

DROP TABLE IF EXISTS `destinos`;
CREATE TABLE `destinos` (
  `ID_Destino` int(2) NOT NULL,
  `Nombre_destino` varchar(20) NOT NULL,
  `Descripcion` varchar(30) NOT NULL,
  `Precio_promedio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `destinos`
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
-- Tabellenstruktur für Tabelle `empleados`
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
-- Daten für Tabelle `empleados`
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
-- Tabellenstruktur für Tabelle `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE `pagos` (
  `ID_pago` int(2) NOT NULL,
  `Fecha_pago` date NOT NULL,
  `Monto` int(10) NOT NULL,
  `ID_reserva` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `pagos`
--

INSERT INTO `pagos` (`ID_pago`, `Fecha_pago`, `Monto`, `ID_reserva`) VALUES
(40, '2024-01-01', 1900, 60),
(41, '2024-01-02', 1900, 61),
(42, '2024-01-03', 1900, 62),
(43, '2024-01-04', 1900, 63),
(44, '2024-01-05', 1900, 64),
(45, '2024-01-06', 1900, 65);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `paquetes`
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
-- Daten für Tabelle `paquetes`
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
-- Tabellenstruktur für Tabelle `reservas`
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
-- Daten für Tabelle `reservas`
--

INSERT INTO `reservas` (`ID_reserva`, `Fecha_inicio`, `Fecha_fin`, `Precio_total`, `ID_paquete`, `ID_cliente`, `ID_empleado`) VALUES
(60, '2024-01-01', '2024-01-01', 1900, 50, 10, 30),
(61, '2024-01-02', '2024-01-02', 1900, 51, 11, 31),
(62, '2024-01-03', '2024-01-03', 1900, 52, 12, 32),
(63, '2024-01-04', '2024-01-04', 1900, 53, 13, 33),
(64, '2024-01-05', '2024-01-05', 1900, 54, 14, 34),
(65, '2024-01-06', '2024-01-06', 1900, 55, 15, 35),
(66, '2024-03-12', '2024-04-26', 0, 54, 10, 30),
(67, '2024-06-14', '2024-08-04', 0, 0, 10, 30),
(68, '2024-06-14', '2024-08-04', 0, 0, 10, 30),
(69, '2024-06-14', '2024-08-04', 0, 0, 10, 30),
(70, '2024-01-10', '2024-01-18', 0, 53, 10, 30),
(71, '2024-01-03', '2024-01-25', 0, 50, 10, 30),
(104, '2024-01-12', '2024-01-04', 2200, 54, 26, 30),
(105, '2024-01-04', '2024-01-03', 2200, 54, 23, 30),
(108, '2024-03-05', '2024-03-20', 2100, 52, 28, 30),
(111, '2024-03-06', '2024-03-25', 1900, 50, 28, 30),
(112, '2024-04-04', '2024-04-18', 2600, 55, 28, 30),
(115, '2024-05-11', '2024-05-31', 2600, 55, 32, 30),
(116, '2024-06-13', '2024-07-25', 2000, 51, 32, 30),
(117, '2024-06-13', '2024-07-25', 2000, 51, 32, 30),
(118, '2024-04-12', '2024-04-19', 2000, 51, 33, 30);

--
-- Trigger `reservas`
--
DROP TRIGGER IF EXISTS `update_num_rva`;
DELIMITER $$
CREATE TRIGGER `update_num_rva` AFTER INSERT ON `reservas` FOR EACH ROW update clientes   
  set num_rva = NEW.ID_reserva
  where ID_Cliente = NEW.ID_cliente
$$
DELIMITER ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`ID_cargo`);

--
-- Indizes für die Tabelle `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_Cliente`),
  ADD KEY `ID_cargo` (`ID_cargo`),
  ADD KEY `ID_cargo_2` (`ID_cargo`);

--
-- Indizes für die Tabelle `destinos`
--
ALTER TABLE `destinos`
  ADD PRIMARY KEY (`ID_Destino`);

--
-- Indizes für die Tabelle `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`ID_empleado`);

--
-- Indizes für die Tabelle `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`ID_pago`,`ID_reserva`),
  ADD KEY `ID_reserva` (`ID_reserva`);

--
-- Indizes für die Tabelle `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`ID_paquete`,`ID_destino`),
  ADD KEY `ID_destino` (`ID_destino`);

--
-- Indizes für die Tabelle `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`ID_reserva`,`ID_paquete`,`ID_cliente`,`ID_empleado`),
  ADD KEY `ID_empleado` (`ID_empleado`),
  ADD KEY `ID_cliente` (`ID_cliente`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `cargo`
--
ALTER TABLE `cargo`
  MODIFY `ID_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT für Tabelle `reservas`
--
ALTER TABLE `reservas`
  MODIFY `ID_reserva` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`ID_reserva`) REFERENCES `reservas` (`ID_reserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `paquetes`
--
ALTER TABLE `paquetes`
  ADD CONSTRAINT `paquetes_ibfk_1` FOREIGN KEY (`ID_destino`) REFERENCES `destinos` (`ID_Destino`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`ID_empleado`) REFERENCES `empleados` (`ID_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`ID_cliente`) REFERENCES `clientes` (`ID_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
