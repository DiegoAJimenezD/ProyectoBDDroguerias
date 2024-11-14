-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2024 a las 08:18:42
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
-- Base de datos: `drogueriasconfe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajero`
--

CREATE TABLE `cajero` (
  `idEmpleado` int(11) NOT NULL,
  `turno` varchar(50) NOT NULL,
  `tiempoServicio` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cajero`
--

INSERT INTO `cajero` (`idEmpleado`, `turno`, `tiempoServicio`) VALUES
(5, 'Mañana', '00:00:04'),
(7, 'Mañana', '00:00:01'),
(9, 'Tarde', '00:00:04'),
(12, 'Tarde', '00:00:03'),
(15, 'Mañana', '00:00:03'),
(19, 'Noche', '00:00:03'),
(23, 'Tarde', '00:00:02'),
(28, 'Tarde', '00:00:02'),
(34, 'Noche', '00:00:05'),
(41, 'Mañana', '00:00:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaproducto`
--

CREATE TABLE `categoriaproducto` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoriaproducto`
--

INSERT INTO `categoriaproducto` (`idCategoria`, `nombre`, `estado`, `descripcion`) VALUES
(1, 'Medicamentos', 'ACTIVO', 'Productos farmacéuticos para el tratamiento de enfermedades'),
(2, 'Cosméticos', 'INACTIVO', 'Productos para el cuidado personal y la belleza, incluyendo maquillaje y cuidado de la piel.'),
(3, 'Cuidado personal', 'ACTIVO', 'Productos relacionados con el cuidado personal, como cosméticos, productos de higiene y cuidado de la piel.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificado`
--

CREATE TABLE `certificado` (
  `tipoCertificado` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cedula` varchar(20) NOT NULL,
  `primernombre` varchar(100) NOT NULL,
  `segundonombre` varchar(100) DEFAULT NULL,
  `primerApellido` varchar(100) NOT NULL,
  `segundoApellido` varchar(100) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cedula`, `primernombre`, `segundonombre`, `primerApellido`, `segundoApellido`, `fechaNacimiento`, `direccion`, `email`, `contrasena`) VALUES
('0987654321', 'Ana', 'Esperanza', 'Rodríguez', 'Quintero', '1985-02-21', NULL, 'ana.rodriguez@gmail.com', '987'),
('1004779035', 'Juan', 'Camilo', 'Cuenca', 'Sepuveda', '2003-09-18', 'crr 23# 7', 'camilocuenca1810@gmail.com', 'camilo123'),
('1004871338', 'Diego', 'Alexander', 'Jimenez', 'Jimenez', '2002-12-06', 'Bosques de Pinares Manzana 3 Casa 17', 'diego15kxl@gmail.com', 'd123'),
('1234567890', 'Juan', 'Carlos', 'Pérez', 'Gómez', '1990-05-15', NULL, 'juan.perez@example.com', '123'),
('1478523690', 'Juan', 'Carlos', 'Pérez', 'Gómez', '1990-05-15', 'Calle 123, Bogotá', 'juan.perez@mail.com', 'contrasena123'),
('2345678901', 'María', 'Fernanda', 'López', 'Sánchez', '1985-08-22', 'Calle 456, Medellín', 'maria.lopez@mail.com', 'contrasena456'),
('3456789012', 'Carlos', 'Eduardo', 'Martínez', 'Ruiz', '1992-11-30', 'Calle 789, Cali', 'carlos.martinez@mail.com', 'contrasena789'),
('4567890123', 'Ana', 'Isabel', 'Rodríguez', 'Morales', '1988-03-12', 'Calle 101, Barranquilla', 'ana.rodriguez@mail.com', 'contrasena101'),
('5678901234', 'Luis', 'Antonio', 'García', 'Díaz', '1995-07-18', 'Calle 202, Cartagena', 'luis.garcia@mail.com', 'contrasena202'),
('6789012345', 'Lucía', 'Estefanía', 'Hernández', 'Paredes', '1993-02-03', 'Calle 303, Bucaramanga', 'lucia.hernandez@mail.com', 'contrasena303'),
('7890123456', 'Pedro', 'Alfredo', 'Jiménez', 'Vargas', '1982-09-25', 'Calle 404, Manizales', 'pedro.jimenez@mail.com', 'contrasena404');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `horario` time DEFAULT NULL,
  `sucursal` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombre`, `horario`, `sucursal`, `email`, `contrasena`) VALUES
(1, 'Carlos Díaz', '08:00:00', 1, 'carlos.diaz@empresa.com', 'contrasena001'),
(2, 'Sofía Pérez', '09:00:00', 2, 'sofia.perez@empresa.com', 'contrasena002'),
(3, 'Pedro Martínez', '08:30:00', 3, 'pedro.martinez@empresa.com', 'contrasena003'),
(4, 'Ana Gómez', '10:00:00', 4, 'ana.gomez@empresa.com', 'contrasena004'),
(5, 'Luis Rodríguez', '08:00:00', 5, 'luis.rodriguez@empresa.com', 'contrasena005'),
(6, 'María Jiménez', '09:30:00', 6, 'maria.jimenez@empresa.com', 'contrasena006'),
(7, 'Fernando López', '07:45:00', 7, 'fernando.lopez@empresa.com', 'contrasena007'),
(8, 'Lucía García', '08:15:00', 8, 'lucia.garcia@empresa.com', 'contrasena008'),
(9, 'Juan Sánchez', '09:00:00', 9, 'juan.sanchez@empresa.com', 'contrasena009'),
(10, 'Marta Torres', '08:30:00', 10, 'marta.torres@empresa.com', 'contrasena010'),
(11, 'David Ruiz', '09:00:00', 1, 'david.ruiz@empresa.com', 'contrasena011'),
(12, 'Laura Pérez', '08:00:00', 2, 'laura.perez@empresa.com', 'contrasena012'),
(13, 'José Martínez', '09:30:00', 3, 'jose.martinez@empresa.com', 'contrasena013'),
(14, 'Carmen López', '08:00:00', 4, 'carmen.lopez@empresa.com', 'contrasena014'),
(15, 'Fernando González', '10:00:00', 5, 'fernando.gonzalez@empresa.com', 'contrasena015'),
(16, 'Ricardo Díaz', '08:15:00', 6, 'ricardo.diaz@empresa.com', 'contrasena016'),
(17, 'Paula Jiménez', '07:45:00', 7, 'paula.jimenez@empresa.com', 'contrasena017'),
(18, 'Antonio Rodríguez', '08:30:00', 8, 'antonio.rodriguez@empresa.com', 'contrasena018'),
(19, 'Claudia Martínez', '09:00:00', 9, 'claudia.martinez@empresa.com', 'contrasena019'),
(20, 'Luis Fernández', '08:00:00', 10, 'luis.fernandez@empresa.com', 'contrasena020'),
(21, 'Beatriz Torres', '09:30:00', 1, 'beatriz.torres@empresa.com', 'contrasena021'),
(22, 'Ricardo Sánchez', '08:15:00', 2, 'ricardo.sanchez@empresa.com', 'contrasena022'),
(23, 'Javier González', '08:00:00', 3, 'javier.gonzalez@empresa.com', 'contrasena023'),
(24, 'Elena López', '10:00:00', 4, 'elena.lopez@empresa.com', 'contrasena024'),
(25, 'Andrés Martínez', '08:30:00', 5, 'andres.martinez@empresa.com', 'contrasena025'),
(26, 'Mónica García', '09:00:00', 6, 'monica.garcia@empresa.com', 'contrasena026'),
(27, 'Carlos Sánchez', '08:00:00', 7, 'carlos.sanchez@empresa.com', 'contrasena027'),
(28, 'Rosa Pérez', '09:30:00', 8, 'rosa.perez@empresa.com', 'contrasena028'),
(29, 'José Gómez', '08:00:00', 9, 'jose.gomez@empresa.com', 'contrasena029'),
(30, 'Patricia Rodríguez', '09:00:00', 10, 'patricia.rodriguez@empresa.com', 'contrasena030'),
(31, 'Vicente Díaz', '08:30:00', 1, 'vicente.diaz@empresa.com', 'contrasena031'),
(32, 'Teresa López', '08:15:00', 2, 'teresa.lopez@empresa.com', 'contrasena032'),
(33, 'Carlos Fernández', '07:45:00', 3, 'carlos.fernandez@empresa.com', 'contrasena033'),
(34, 'Silvia González', '08:00:00', 4, 'silvia.gonzalez@empresa.com', 'contrasena034'),
(35, 'Manuel Rodríguez', '08:00:00', 5, 'manuel.rodriguez@empresa.com', 'contrasena035'),
(36, 'Patricia Sánchez', '09:30:00', 6, 'patricia.sanchez@empresa.com', 'contrasena036'),
(37, 'Juanita Torres', '08:00:00', 7, 'juanita.torres@empresa.com', 'contrasena037'),
(38, 'David García', '09:30:00', 8, 'david.garcia@empresa.com', 'contrasena038'),
(39, 'Lucía Fernández', '08:00:00', 9, 'lucia.fernandez@empresa.com', 'contrasena039'),
(40, 'José López', '08:15:00', 10, 'jose.lopez@empresa.com', 'contrasena040'),
(41, 'Antonio Sánchez', '09:00:00', 1, 'antonio.sanchez@empresa.com', 'contrasena041'),
(42, 'Ana Torres', '08:30:00', 2, 'ana.torres@empresa.com', 'contrasena042'),
(43, 'Ricardo Rodríguez', '07:45:00', 3, 'ricardo.rodriguez@empresa.com', 'contrasena043'),
(44, 'María García', '08:00:00', 4, 'maria.garcia@empresa.com', 'contrasena044'),
(45, 'José Fernández', '09:30:00', 5, 'jose.fernandez@empresa.com', 'contrasena045'),
(46, 'Patricia Ruiz', '08:15:00', 6, 'patricia.ruiz@empresa.com', 'contrasena046'),
(47, 'Carmen Rodríguez', '09:00:00', 7, 'carmen.rodriguez@empresa.com', 'contrasena047'),
(48, 'Luis González', '08:00:00', 8, 'luis.gonzalez@empresa.com', 'contrasena048'),
(49, 'Rosa Fernández', '08:30:00', 9, 'rosa.fernandez@empresa.com', 'contrasena049'),
(50, 'Javier Ruiz', '09:00:00', 10, 'javier.ruiz@empresa.com', 'contrasena050');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleadoventa`
--

CREATE TABLE `empleadoventa` (
  `idEmpleado` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleadoventa`
--

INSERT INTO `empleadoventa` (`idEmpleado`, `idVenta`) VALUES
(2, 5),
(3, 7),
(4, 10),
(6, 2),
(8, 15),
(9, 3),
(11, 1),
(12, 8),
(13, 12),
(14, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `impuesto` decimal(10,2) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `fechaCompra` date DEFAULT NULL,
  `estado` enum('PAGADA','PENDIENTE','CANCELADA') DEFAULT 'PENDIENTE',
  `fechaVencimiento` date DEFAULT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `clienteCedula` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `impuesto`, `precio`, `fechaCompra`, `estado`, `fechaVencimiento`, `domicilio`, `clienteCedula`) VALUES
(1, 15.00, 150000.00, '2024-11-01', 'PAGADA', '2024-11-10', 'Calle 1 #123', '0987654321'),
(2, 12.00, 120000.00, '2024-11-02', 'PENDIENTE', '2024-11-12', 'Carrera 2 #456', '1004779035'),
(3, 18.00, 180000.00, '2024-11-03', 'CANCELADA', '2024-11-13', 'Avenida 3 #789', '1234567890'),
(4, 10.00, 100000.00, '2024-11-04', 'PAGADA', '2024-11-14', 'Calle 4 #101', '1478523690'),
(5, 20.00, 200000.00, '2024-11-05', 'PENDIENTE', '2024-11-15', 'Carrera 5 #202', '2345678901'),
(6, 14.00, 140000.00, '2024-11-06', 'CANCELADA', '2024-11-16', 'Avenida 6 #303', '3456789012'),
(7, 22.00, 220000.00, '2024-11-07', 'PAGADA', '2024-11-17', 'Calle 7 #404', '4567890123'),
(8, 16.00, 160000.00, '2024-11-08', 'PENDIENTE', '2024-11-18', 'Carrera 8 #505', '5678901234'),
(9, 17.00, 170000.00, '2024-11-09', 'PAGADA', '2024-11-19', 'Avenida 9 #606', '6789012345'),
(10, 19.00, 190000.00, '2024-11-10', 'CANCELADA', '2024-11-20', 'Calle 10 #707', '7890123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturaventa`
--

CREATE TABLE `facturaventa` (
  `idFactura` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturaventa`
--

INSERT INTO `facturaventa` (`idFactura`, `idVenta`) VALUES
(1, 5),
(2, 7),
(3, 10),
(4, 2),
(5, 15),
(6, 3),
(7, 1),
(8, 8),
(9, 12),
(10, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmaceutico`
--

CREATE TABLE `farmaceutico` (
  `idEmpleado` int(11) NOT NULL,
  `especializacion` int(11) NOT NULL,
  `turno` varchar(20) NOT NULL,
  `licenciaFarmaceutico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `farmaceutico`
--

INSERT INTO `farmaceutico` (`idEmpleado`, `especializacion`, `turno`, `licenciaFarmaceutico`) VALUES
(1, 0, 'Mañana', 0),
(3, 0, 'Mañana', 0),
(4, 0, 'Mañana', 0),
(6, 0, 'Mañana', 0),
(8, 0, 'Mañana', 0),
(10, 0, 'Mañana', 0),
(11, 0, 'Mañana', 0),
(13, 0, 'Mañana', 0),
(14, 0, 'Mañana', 0),
(16, 0, 'Mañana', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gerente`
--

CREATE TABLE `gerente` (
  `idEmpleado` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idInventario` int(11) NOT NULL,
  `cantidadStock` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`idInventario`, `cantidadStock`, `fecha`, `idProducto`) VALUES
(1, 120, '2024-11-10', 1),
(2, 20, '2024-11-10', 2),
(3, 100, '2024-11-10', 3),
(4, 50, '2024-11-10', 4),
(5, 30, '2024-11-10', 5),
(6, 80, '2024-11-10', 6),
(7, 60, '2024-11-10', 7),
(8, 100, '2024-11-13', 8),
(9, 150, '2024-11-13', 9),
(10, 200, '2024-11-13', 10),
(11, 250, '2024-11-13', 11),
(12, 300, '2024-11-13', 12),
(13, 120, '2024-11-13', 13),
(14, 180, '2024-11-13', 14),
(15, 220, '2024-11-13', 15),
(16, 90, '2024-11-13', 16),
(17, 160, '2024-11-13', 17),
(18, 80, '2024-11-13', 18),
(19, 210, '2024-11-13', 19),
(20, 130, '2024-11-13', 20),
(21, 140, '2024-11-13', 21),
(22, 170, '2024-11-13', 22),
(23, 50, '2024-11-13', 23),
(24, 200, '2024-11-13', 24),
(25, 130, '2024-11-13', 25),
(26, 250, '2024-11-13', 26),
(27, 300, '2024-11-13', 27),
(28, 190, '2024-11-13', 28),
(29, 140, '2024-11-13', 29),
(30, 210, '2024-11-13', 30),
(31, 160, '2024-11-13', 31),
(32, 300, '2024-11-13', 32),
(33, 180, '2024-11-13', 33),
(34, 250, '2024-11-13', 34),
(35, 110, '2024-11-13', 35),
(36, 120, '2024-11-13', 36),
(37, 180, '2024-11-13', 37),
(38, 200, '2024-11-13', 38),
(39, 90, '2024-11-13', 39),
(40, 160, '2024-11-13', 40),
(41, 130, '2024-11-13', 41),
(42, 220, '2024-11-13', 42),
(43, 110, '2024-11-13', 43),
(44, 170, '2024-11-13', 44),
(45, 200, '2024-11-13', 45),
(46, 150, '2024-11-13', 46),
(47, 250, '2024-11-13', 47),
(48, 130, '2024-11-13', 48),
(49, 180, '2024-11-13', 49),
(50, 140, '2024-11-13', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licenciaconduccion`
--

CREATE TABLE `licenciaconduccion` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licenciafarmaceutico`
--

CREATE TABLE `licenciafarmaceutico` (
  `idLicenciaF` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `licenciafarmaceutico`
--

INSERT INTO `licenciafarmaceutico` (`idLicenciaF`, `idEmpleado`, `descripcion`) VALUES
(1, 1, 'Licencia para la práctica profesional como farmacéutico en droguerías.'),
(2, 3, 'Licencia para ejercer como farmacéutico en ventas de medicamentos.'),
(3, 4, 'Licencia que habilita al farmacéutico para trabajar en gestión de productos farmacéuticos.'),
(4, 6, 'Licencia de farmacéutico para atención al cliente en droguerías.'),
(5, 8, 'Licencia otorgada para supervisión y control de inventarios farmacéuticos.'),
(6, 10, 'Licencia para el manejo de medicamentos controlados y asesoramiento farmacéutico.'),
(7, 11, 'Licencia para atención en áreas de salud relacionadas con medicamentos.'),
(8, 13, 'Licencia para el control de medicamentos en droguerías y asesoría en salud.'),
(9, 14, 'Licencia para trabajar en la distribución y venta de productos farmacéuticos.'),
(10, 16, 'Licencia para el trabajo y asesoramiento en la compra y venta de productos farmacéuticos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodopago`
--

CREATE TABLE `metodopago` (
  `idMetodoPago` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodopago`
--

INSERT INTO `metodopago` (`idMetodoPago`, `nombre`) VALUES
(1, 'Tarjeta de Crédito'),
(2, 'Tarjeta de Débito'),
(3, 'PSE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `fechaPedido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `fechaPedido`) VALUES
(1, '2024-11-01'),
(2, '2024-11-08'),
(3, '2024-11-13'),
(4, '2024-11-14'),
(5, '2024-11-15'),
(6, '2024-11-16'),
(7, '2024-11-17'),
(8, '2024-11-18'),
(9, '2024-11-19'),
(10, '2024-11-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoproductoproveedor`
--

CREATE TABLE `pedidoproductoproveedor` (
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidoproductoproveedor`
--

INSERT INTO `pedidoproductoproveedor` (`idPedido`, `idProducto`, `idProveedor`, `cantidad`) VALUES
(1, 30, 4, 180),
(2, 35, 6, 110),
(3, 2, 3, 100),
(4, 5, 4, 50),
(5, 7, 6, 200),
(6, 8, 7, 150),
(7, 12, 8, 120),
(8, 20, 9, 300),
(9, 22, 10, 250),
(10, 25, 3, 80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personalinventario`
--

CREATE TABLE `personalinventario` (
  `idEmpleado` int(11) NOT NULL,
  `tiempoServicio` time NOT NULL,
  `idTipoResponsabilidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personalinventario`
--

INSERT INTO `personalinventario` (`idEmpleado`, `tiempoServicio`, `idTipoResponsabilidad`) VALUES
(2, '00:00:03', 1),
(3, '00:00:05', 2),
(4, '00:00:04', 3),
(6, '00:00:02', 4),
(8, '00:00:06', 5),
(9, '00:00:03', 1),
(11, '00:00:07', 2),
(12, '00:00:05', 3),
(13, '00:00:04', 4),
(14, '00:00:06', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` double NOT NULL,
  `categoriaProducto` int(11) NOT NULL,
  `eliminado` TINYINT(1) DEFAULT 0,  -- 0 = No eliminado, 1 = Eliminado
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `precio`, `categoriaProducto`, `imagen`, `eliminado`) VALUES
(1, 'Paracetamol', 3500, 1, 'https://example.com/images/paracetamol.jpg', 0),
(2, 'Crema Hidratante', 15000, 2, 'https://example.com/images/crema_hidratante.jpg', 0),
(3, 'Acetaminofén', 1000, 1, 'https://example.com/images/paracetamol.jpg', 0),
(4, 'Crema Hidratante', 15000, 2, 'https://example.com/images/crema_hidratante.jpg', 0),
(5, 'Antibiótico', 15000, 1, 'https://example.com/images/antibiotico.jpg', 0),
(6, 'Shampoo Suave', 18000, 2, 'https://example.com/images/shampoo.jpg', 0),
(7, 'Base de Maquillaje', 30000, 2, 'https://example.com/images/base_maquillaje.jpg', 0),
(8, 'Aspirina', 25000, 1, 'https://example.com/aspirina.jpg', 0),
(9, 'Ibuprofeno', 30000, 1, 'https://example.com/ibuprofeno.jpg', 0),
(10, 'Legrip', 1400, 1, 'https://example.com/paracetamol.jpg', 0),
(11, 'Pomada antiinflamatoria', 35000, 1, 'https://example.com/pomada-antiinflamatoria.jpg', 0),
(12, 'Jarabe para la tos', 25000, 1, 'https://example.com/jarabe-tos.jpg', 0),
(13, 'Antibiótico en crema', 40000, 1, 'https://example.com/antibiotico-crema.jpg', 0),
(14, 'Crema para cicatrices', 50000, 2, 'https://example.com/crema-cicatrices.jpg', 0),
(15, 'Crema hidratante', 60000, 2, 'https://example.com/crema-hidratante.jpg', 0),
(16, 'Gel limpiador facial', 40000, 2, 'https://example.com/gel-limpiador.jpg', 0),
(17, 'Shampoo anti-caída', 50000, 2, 'https://example.com/shampoo-anti-caida.jpg', 0),
(18, 'Crema antiarrugas', 80000, 2, 'https://example.com/crema-antiarrugas.jpg', 0),
(19, 'Exfoliante facial', 45000, 2, 'https://example.com/exfoliante.jpg', 0),
(20, 'Aceite esencial de lavanda', 55000, 2, 'https://example.com/aceite-lavanda.jpg', 0),
(21, 'Protector solar SPF 50', 38000, 2, 'https://example.com/protector-solar.jpg', 0),
(22, 'Pasta dental blanqueadora', 15000, 3, 'https://example.com/pasta-dental.jpg', 0),
(23, 'Cepillo de dientes eléctrico', 120000, 3, 'https://example.com/cepillo-electrico.jpg', 0),
(24, 'Desodorante en spray', 15000, 3, 'https://example.com/desodorante-spray.jpg', 0),
(25, 'Jabón líquido antibacteriano', 12000, 3, 'https://example.com/jabon-antibacterial.jpg', 0),
(26, 'Gel antibacterial', 9000, 3, 'https://example.com/gel-antibacterial.jpg', 0),
(27, 'Crema para manos', 18000, 3, 'https://example.com/crema-manos.jpg', 0),
(28, 'Champú hidratante', 28000, 2, 'https://example.com/champu-hidratante.jpg', 0),
(29, 'Acondicionador reparador', 32000, 2, 'https://example.com/acondicionador-reparador.jpg', 0),
(30, 'Limpiador de cara suave', 37000, 2, 'https://example.com/limpiador-cara-suave.jpg', 0),
(31, 'Tiritas adhesivas', 10000, 1, 'https://example.com/tiritas.jpg', 0),
(32, 'Vitamina C en tabletas', 60000, 1, 'https://example.com/vitamina-c.jpg', 0),
(33, 'Crema para pies', 20000, 3, 'https://example.com/crema-pies.jpg', 0),
(34, 'Desinfectante para manos', 12000, 3, 'https://example.com/desinfectante-manos.jpg', 0),
(35, 'Crema depilatoria', 15000, 3, 'https://example.com/crema-depilatoria.jpg', 0),
(36, 'Suero fisiológico', 12000, 1, 'https://example.com/suero-fisiologico.jpg', 0),
(37, 'Manteca de karité', 50000, 2, 'https://example.com/manteca-karite.jpg', 0),
(38, 'Bálsamo labial', 40000, 2, 'https://example.com/balsamo-labial.jpg', 0),
(39, 'Crema para acné', 45000, 2, 'https://example.com/crema-acne.jpg', 0),
(40, 'Pomada para quemaduras', 35000, 1, 'https://example.com/pomada-quemaduras.jpg', 0),
(41, 'Antiséptico en spray', 25000, 1, 'https://example.com/antiseptico-spray.jpg', 0),
(42, 'Lentes de sol protector UV', 60000, 3, 'https://example.com/lentes-solar.jpg', 0),
(43, 'Aceite de argán', 68000, 2, 'https://example.com/aceite-argan.jpg', 0),
(44, 'Geles de baño aromáticos', 50000, 2, 'https://example.com/gel-bano-aromatico.jpg', 0),
(45, 'Cera para depilación', 30000, 3, 'https://example.com/cera-depilacion.jpg', 0),
(46, 'Tónico facial', 45000, 2, 'https://example.com/tonico-facial.jpg', 0),
(47, 'Mascarilla capilar', 30000, 2, 'https://example.com/mascarilla-capilar.jpg', 0),
(48, 'Jabón para rostro', 20000, 2, 'https://example.com/jabon-rostro.jpg', 0),
(49, 'Rímel', 35000, 2, 'https://example.com/rimel.jpg', 0),
(50, 'Pincel para maquillaje', 30000, 2, 'https://example.com/pincel-maquillaje.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productofactura`
--

CREATE TABLE `productofactura` (
  `idFactura` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productofactura`
--

INSERT INTO `productofactura` (`idFactura`, `idProducto`) VALUES
(1, 2),
(2, 5),
(3, 8),
(4, 12),
(5, 15),
(6, 18),
(7, 3),
(8, 10),
(9, 14),
(10, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoproveedor`
--

CREATE TABLE `productoproveedor` (
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `costo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productoproveedor`
--

INSERT INTO `productoproveedor` (`idProducto`, `idProveedor`, `costo`) VALUES
(2, 3, 0),
(5, 4, 0),
(7, 6, 0),
(8, 7, 0),
(12, 8, 0),
(20, 9, 0),
(22, 10, 0),
(25, 3, 0),
(30, 4, 0),
(35, 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombre`, `email`) VALUES
(1, 'Laboratorios ABC', 'contacto@laboratoriosabc.com'),
(2, 'Farmacéutica XYZ', 'info@farmaceuticaxyz.com'),
(3, 'Farmacéutica Salud y Bienestar', 'contacto@farmasalud.com'),
(4, 'Cosméticos Bella', 'ventas@cosmeticabella.com'),
(5, 'Medicación Natural', 'info@medicanatural.com'),
(6, 'Higiene y Cuidado', 'atencion@higieneycuidado.com'),
(7, 'Dermocosméticos Avanzados', 'contacto@dermocosmeticos.com'),
(8, 'Cuidado Personal Total', 'soporte@cuidadopersonal.com'),
(9, 'Medicamentos y Salud', 'servicio@medicamentosysalud.com'),
(10, 'Bienestar Cosmético', 'contacto@bienestarcosmetico.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidor`
--

CREATE TABLE `repartidor` (
  `idEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `idRuta` int(11) NOT NULL,
  `horaSalida` time NOT NULL,
  `horaLlegada` time NOT NULL,
  `idFactura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`idRuta`, `horaSalida`, `horaLlegada`, `idFactura`) VALUES
(1, '08:00:00', '10:00:00', 1),
(2, '09:00:00', '11:00:00', 2),
(3, '10:00:00', '12:00:00', 3),
(4, '11:00:00', '13:00:00', 4),
(5, '12:00:00', '14:00:00', 5),
(6, '13:00:00', '15:00:00', 6),
(7, '14:00:00', '16:00:00', 7),
(8, '15:00:00', '17:00:00', 8),
(9, '16:00:00', '18:00:00', 9),
(10, '17:00:00', '19:00:00', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subsidio`
--

CREATE TABLE `subsidio` (
  `idSubsidio` int(11) NOT NULL,
  `monto` double NOT NULL,
  `fecha` date NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `idFactura` int(11) NOT NULL,
  `tipoSubsidio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subsidio`
--

INSERT INTO `subsidio` (`idSubsidio`, `monto`, `fecha`, `cedula`, `idFactura`, `tipoSubsidio`) VALUES
(1, 50000, '2024-01-15', '0987654321', 1, 1),
(2, 75000, '2024-02-10', '1004779035', 2, 2),
(3, 60000, '2024-03-05', '1234567890', 3, 3),
(4, 80000, '2024-04-12', '1478523690', 4, 1),
(5, 55000, '2024-05-20', '2345678901', 5, 2),
(6, 70000, '2024-06-18', '3456789012', 6, 3),
(7, 65000, '2024-07-25', '4567890123', 7, 1),
(8, 90000, '2024-08-30', '5678901234', 8, 2),
(9, 62000, '2024-09-15', '6789012345', 9, 3),
(10, 58000, '2024-10-22', '7890123456', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `idSucursal` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`idSucursal`, `nombre`, `direccion`) VALUES
(1, 'Sucursal Central', 'Cl. 16 # 15 -22, Armenia, Quindío'),
(2, 'Sucursal Centro', 'Calle 1, Armenia'),
(3, 'Sucursal Norte', 'Avenida 5, Armenia'),
(4, 'Sucursal Sur', 'Carrera 10, Armenia'),
(5, 'Sucursal Este', 'Calle 50, Armenia'),
(6, 'Sucursal Oeste', 'Avenida 80, Armenia'),
(7, 'Sucursal Norte 2', 'Calle 200, Armenia'),
(8, 'Sucursal Sur 2', 'Carrera 300, Armenia'),
(9, 'Sucursal Centro 2', 'Avenida 400, Armenia'),
(10, 'Sucursal Internacional', 'Calle 500, Armenia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE `telefono` (
  `idTelefono` int(11) NOT NULL,
  `idEntidad` int(11) NOT NULL,
  `tipoEntidad` enum('cliente','proveedor','empleado') NOT NULL,
  `numero` varchar(15) NOT NULL,
  `tipoTelefono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocertificado`
--

CREATE TABLE `tipocertificado` (
  `idTipoCertificado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipocertificado`
--

INSERT INTO `tipocertificado` (`idTipoCertificado`, `nombre`) VALUES
(1, 'Certificado de Gerente de Droguería'),
(2, 'Certificado en Gestión Farmacéutica'),
(3, 'Certificado en Dirección de Droguerías'),
(4, 'Certificado en Gestión de Inventarios Farmacéuticos'),
(5, 'Certificado en Administración de Droguerías'),
(6, 'Certificado de Liderazgo en Salud'),
(7, 'Certificado en Gestión Comercial para Droguerías'),
(8, 'Certificado en Normativa y Regulación Farmacéutica'),
(9, 'Certificado en Marketing para Droguerías'),
(10, 'Certificado en Estrategias de Ventas en Droguerías');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiporesponsabilidad`
--

CREATE TABLE `tiporesponsabilidad` (
  `idTipoResponsabilidad` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiporesponsabilidad`
--

INSERT INTO `tiporesponsabilidad` (`idTipoResponsabilidad`, `nombre`, `descripcion`) VALUES
(1, 'Gestión de Inventarios', 'Responsabilidad de controlar y mantener el inventario actualizado, incluyendo el seguimiento de productos y existencias.'),
(2, 'Control de Stock', 'Responsabilidad de asegurar que haya suficiente stock de productos y realizar los pedidos necesarios cuando los niveles de inventario sean bajos.'),
(3, 'Auditoría de Inventarios', 'Responsabilidad de realizar auditorías periódicas para verificar la exactitud del inventario y detectar discrepancias.'),
(4, 'Manejo de Productos Vencidos', 'Responsabilidad de gestionar y remover productos vencidos del inventario, garantizando que no se vendan productos fuera de fecha.'),
(5, 'Actualización de Precios', 'Responsabilidad de actualizar los precios de los productos en el sistema de inventarios según las indicaciones del departamento comercial.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposubsidio`
--

CREATE TABLE `tiposubsidio` (
  `idTipoSubsidio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiposubsidio`
--

INSERT INTO `tiposubsidio` (`idTipoSubsidio`, `nombre`, `descripcion`) VALUES
(1, 'Cuota Monetaria', 'Es una prestación social en dinero que está dirigida a los trabajadores afiliados a Comfenalco Quindío'),
(2, 'Subsidio Especial', 'Sin limitación en razón de su edad, se cancela doble cuota de subsidio familiar en dinero, a los hijos, padres y hermanos huérfanos de ambos padres'),
(3, 'Subsidio de Servicios', 'Es el derecho que tú y tus beneficiaros tienen para utilizar los servicios sociales de la Caja con tarifas preferenciales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipotelefono`
--

CREATE TABLE `tipotelefono` (
  `idTipoTelefono` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipotelefono`
--

INSERT INTO `tipotelefono` (`idTipoTelefono`, `nombre`) VALUES
(1, 'Celular'),
(2, 'Fijo'),
(3, 'Trabajo'),
(4, 'Oficina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idVenta` int(11) NOT NULL,
  `descuento` double NOT NULL,
  `metodoPago` int(11) NOT NULL,
  `idFactura` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idVenta`, `descuento`, `metodoPago`, `idFactura`, `cedula`) VALUES
(1, 10, 1, 1, '0987654321'),
(2, 5, 2, 2, '1004779035'),
(3, 15, 3, 3, '1234567890'),
(4, 8, 1, 4, '1478523690'),
(5, 12, 2, 5, '2345678901'),
(6, 20, 3, 6, '3456789012'),
(7, 10, 1, 7, '4567890123'),
(8, 7, 2, 8, '5678901234'),
(9, 13, 3, 9, '6789012345'),
(10, 18, 1, 10, '7890123456'),
(11, 9, 2, 1, '0987654321'),
(12, 11, 3, 2, '1004779035'),
(13, 5, 1, 3, '1234567890'),
(14, 6, 2, 4, '1478523690'),
(15, 14, 3, 5, '2345678901'),
(16, 16, 1, 6, '3456789012'),
(17, 17, 2, 7, '4567890123'),
(18, 19, 3, 8, '5678901234'),
(19, 8, 1, 9, '6789012345'),
(20, 4, 2, 10, '7890123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cajero`
--
ALTER TABLE `cajero`
  ADD PRIMARY KEY (`idEmpleado`,`turno`);

--
-- Indices de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `certificado`
--
ALTER TABLE `certificado`
  ADD PRIMARY KEY (`tipoCertificado`),
  ADD KEY `idEmpleado` (`idEmpleado`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `sucursal` (`sucursal`);

--
-- Indices de la tabla `empleadoventa`
--
ALTER TABLE `empleadoventa`
  ADD PRIMARY KEY (`idEmpleado`,`idVenta`),
  ADD KEY `idVenta` (`idVenta`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `clienteCedula` (`clienteCedula`);

--
-- Indices de la tabla `facturaventa`
--
ALTER TABLE `facturaventa`
  ADD PRIMARY KEY (`idFactura`,`idVenta`),
  ADD KEY `idVenta` (`idVenta`);

--
-- Indices de la tabla `farmaceutico`
--
ALTER TABLE `farmaceutico`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `gerente`
--
ALTER TABLE `gerente`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idInventario`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `licenciaconduccion`
--
ALTER TABLE `licenciaconduccion`
  ADD PRIMARY KEY (`nombre`),
  ADD KEY `idEmpleado` (`idEmpleado`);

--
-- Indices de la tabla `licenciafarmaceutico`
--
ALTER TABLE `licenciafarmaceutico`
  ADD PRIMARY KEY (`idLicenciaF`),
  ADD KEY `idEmpleado` (`idEmpleado`),
  ADD KEY `idEmpleado_2` (`idEmpleado`);

--
-- Indices de la tabla `metodopago`
--
ALTER TABLE `metodopago`
  ADD PRIMARY KEY (`idMetodoPago`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indices de la tabla `pedidoproductoproveedor`
--
ALTER TABLE `pedidoproductoproveedor`
  ADD PRIMARY KEY (`idPedido`,`idProducto`,`idProveedor`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- Indices de la tabla `personalinventario`
--
ALTER TABLE `personalinventario`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `idTipoResponsabilidad` (`idTipoResponsabilidad`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `categoriaProducto` (`categoriaProducto`);

--
-- Indices de la tabla `productofactura`
--
ALTER TABLE `productofactura`
  ADD PRIMARY KEY (`idFactura`,`idProducto`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `productoproveedor`
--
ALTER TABLE `productoproveedor`
  ADD PRIMARY KEY (`idProducto`,`idProveedor`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `repartidor`
--
ALTER TABLE `repartidor`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`idRuta`),
  ADD KEY `idFactura` (`idFactura`);

--
-- Indices de la tabla `subsidio`
--
ALTER TABLE `subsidio`
  ADD PRIMARY KEY (`idSubsidio`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `idFactura` (`idFactura`),
  ADD KEY `tipoSubsidio` (`tipoSubsidio`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`idSucursal`);

--
-- Indices de la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`idTelefono`),
  ADD KEY `tipoTelefono` (`tipoTelefono`);

--
-- Indices de la tabla `tipocertificado`
--
ALTER TABLE `tipocertificado`
  ADD PRIMARY KEY (`idTipoCertificado`);

--
-- Indices de la tabla `tiporesponsabilidad`
--
ALTER TABLE `tiporesponsabilidad`
  ADD PRIMARY KEY (`idTipoResponsabilidad`);

--
-- Indices de la tabla `tiposubsidio`
--
ALTER TABLE `tiposubsidio`
  ADD PRIMARY KEY (`idTipoSubsidio`);

--
-- Indices de la tabla `tipotelefono`
--
ALTER TABLE `tipotelefono`
  ADD PRIMARY KEY (`idTipoTelefono`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `metodoPago` (`metodoPago`),
  ADD KEY `idFactura` (`idFactura`),
  ADD KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `metodopago`
--
ALTER TABLE `metodopago`
  MODIFY `idMetodoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `idRuta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `subsidio`
--
ALTER TABLE `subsidio`
  MODIFY `idSubsidio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `idSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `telefono`
--
ALTER TABLE `telefono`
  MODIFY `idTelefono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipocertificado`
--
ALTER TABLE `tipocertificado`
  MODIFY `idTipoCertificado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tiporesponsabilidad`
--
ALTER TABLE `tiporesponsabilidad`
  MODIFY `idTipoResponsabilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tiposubsidio`
--
ALTER TABLE `tiposubsidio`
  MODIFY `idTipoSubsidio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipotelefono`
--
ALTER TABLE `tipotelefono`
  MODIFY `idTipoTelefono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cajero`
--
ALTER TABLE `cajero`
  ADD CONSTRAINT `cajero_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`);

--
-- Filtros para la tabla `certificado`
--
ALTER TABLE `certificado`
  ADD CONSTRAINT `certificado_ibfk_1` FOREIGN KEY (`tipoCertificado`) REFERENCES `tipocertificado` (`idTipoCertificado`),
  ADD CONSTRAINT `certificado_ibfk_2` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`sucursal`) REFERENCES `sucursal` (`idSucursal`);

--
-- Filtros para la tabla `empleadoventa`
--
ALTER TABLE `empleadoventa`
  ADD CONSTRAINT `empleadoventa_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`),
  ADD CONSTRAINT `empleadoventa_ibfk_2` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`clienteCedula`) REFERENCES `cliente` (`cedula`);

--
-- Filtros para la tabla `facturaventa`
--
ALTER TABLE `facturaventa`
  ADD CONSTRAINT `facturaventa_ibfk_1` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`),
  ADD CONSTRAINT `facturaventa_ibfk_2` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`);

--
-- Filtros para la tabla `farmaceutico`
--
ALTER TABLE `farmaceutico`
  ADD CONSTRAINT `farmaceutico_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`);

--
-- Filtros para la tabla `gerente`
--
ALTER TABLE `gerente`
  ADD CONSTRAINT `gerente_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `licenciaconduccion`
--
ALTER TABLE `licenciaconduccion`
  ADD CONSTRAINT `licenciaconduccion_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`);

--
-- Filtros para la tabla `licenciafarmaceutico`
--
ALTER TABLE `licenciafarmaceutico`
  ADD CONSTRAINT `licenciafarmaceutico_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`);

--
-- Filtros para la tabla `pedidoproductoproveedor`
--
ALTER TABLE `pedidoproductoproveedor`
  ADD CONSTRAINT `pedidoproductoproveedor_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`),
  ADD CONSTRAINT `pedidoproductoproveedor_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `pedidoproductoproveedor_ibfk_3` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`);

--
-- Filtros para la tabla `personalinventario`
--
ALTER TABLE `personalinventario`
  ADD CONSTRAINT `personalinventario_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`),
  ADD CONSTRAINT `personalinventario_ibfk_2` FOREIGN KEY (`idTipoResponsabilidad`) REFERENCES `tiporesponsabilidad` (`idTipoResponsabilidad`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoriaProducto`) REFERENCES `categoriaproducto` (`idCategoria`);

--
-- Filtros para la tabla `productofactura`
--
ALTER TABLE `productofactura`
  ADD CONSTRAINT `productofactura_ibfk_1` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`),
  ADD CONSTRAINT `productofactura_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `productoproveedor`
--
ALTER TABLE `productoproveedor`
  ADD CONSTRAINT `productoproveedor_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `productoproveedor_ibfk_2` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`);

--
-- Filtros para la tabla `repartidor`
--
ALTER TABLE `repartidor`
  ADD CONSTRAINT `repartidor_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`);

--
-- Filtros para la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD CONSTRAINT `ruta_ibfk_1` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`);

--
-- Filtros para la tabla `subsidio`
--
ALTER TABLE `subsidio`
  ADD CONSTRAINT `subsidio_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `cliente` (`cedula`),
  ADD CONSTRAINT `subsidio_ibfk_2` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`),
  ADD CONSTRAINT `subsidio_ibfk_3` FOREIGN KEY (`tipoSubsidio`) REFERENCES `tiposubsidio` (`idTipoSubsidio`);

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `telefono_ibfk_1` FOREIGN KEY (`tipoTelefono`) REFERENCES `tipotelefono` (`idTipoTelefono`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`metodoPago`) REFERENCES `metodopago` (`idMetodoPago`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`),
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`cedula`) REFERENCES `cliente` (`cedula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
