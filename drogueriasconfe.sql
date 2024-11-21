-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 09:19:19
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

INSERT INTO `cajero` (`idEmpleado`, `turno`, `tiempoServicio`) VALUES
(1, 'Mañana', '08:00:00'),
(2, 'Tarde', '07:30:00');

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
(2, 'Cosméticos', 'ACTIVO', 'Productos para el cuidado personal y la belleza, incluyendo maquillaje y cuidado de la piel.'),
(3, 'Higiene Personal', 'ACTIVO', 'Productos relacionados con la limpieza personal.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificado`
--

CREATE TABLE `certificado` (
  `tipoCertificado` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `certificado` (`tipoCertificado`, `idEmpleado`, `descripcion`) VALUES
(1, 7, 'Certificado en Gestión Empresarial'),
(2, 8, 'Certificado en Liderazgo y Gestión');


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

INSERT INTO `cliente` (`cedula`, `primernombre`, `segundonombre`, `primerApellido`, `segundoApellido`, `fechaNacimiento`, `direccion`, `email`, `contrasena`)
VALUES
('1234567890', 'Carlos', 'Andrés', 'Pérez', 'Sánchez', '1985-07-15', 'Calle Ficticia 123, Ciudad X', 'carlos.perez@example.com', 'password123'),
('2345678901', 'María', 'Fernanda', 'Gómez', 'Lopez', '1990-03-25', 'Avenida Central 456, Ciudad Y', 'maria.gomez@example.com', 'password456'),
('3456789012', 'Luis', 'Eduardo', 'Rodríguez', 'Martínez', '1992-06-10', 'Carrera 5, Edificio Z, Ciudad Z', 'luis.rodriguez@example.com', 'password789'),
('4567890123', 'Ana', 'Beatriz', 'Torres', 'Ramírez', '1988-02-22', 'Calle Verde 789, Ciudad A', 'ana.torres@example.com', 'password101'),
('5678901234', 'José', 'Antonio', 'Martínez', 'Hernández', '1995-09-30', 'Calle Sol 101, Ciudad B', 'jose.martinez@example.com', 'password202'),
('6789012345', 'Patricia', 'Elena', 'González', 'Muñoz', '1980-11-18', 'Avenida Libertad 201, Ciudad C', 'patricia.gonzalez@example.com', 'password303'),
('7890123456', 'Juan', 'Carlos', 'López', 'Paredes', '1993-12-05', 'Calle Norte 323, Ciudad D', 'juan.lopez@example.com', 'password404'),
('8901234567', 'Raquel', 'Inés', 'Martínez', 'Vásquez', '1987-08-14', 'Calle Río 454, Ciudad E', 'raquel.martinez@example.com', 'password505'),
('9012345678', 'Eduardo', 'Luis', 'Jiménez', 'Torres', '1998-05-21', 'Calle del Mar 565, Ciudad F', 'eduardo.jimenez@example.com', 'password606'),
('0123456789', 'Sofía', 'Paola', 'Fernández', 'Díaz', '1997-01-30', 'Calle Árbol 676, Ciudad G', 'sofia.fernandez@example.com', 'password707');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `horario` time DEFAULT NULL,
  `sucursal` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombre`, `horario`, `sucursal`, `eliminado`, `email`, `contrasena`)
VALUES
(1, 'Juan Pérez', '08:00:00', 1, 0, 'juan.perez@example.com', 'password123'), -- Sucursal Centro
(2, 'María Gómez', '09:00:00', 1, 0, 'maria.gomez@example.com', 'password456'), -- Sucursal Centro
(3, 'Carlos Rodríguez', '10:00:00', 2, 0, 'carlos.rodriguez@example.com', 'password789'), -- Sucursal Norte
(4, 'Ana Torres', '08:30:00', 2, 0, 'ana.torres@example.com', 'password101'), -- Sucursal Norte
(5, 'Luis Martínez', '07:45:00', 4, 0, 'luis.martinez@example.com', 'password202'), -- Sucursal Occidente
(6, 'Patricia López', '11:00:00', 3, 0, 'patricia.lopez@example.com', 'password303'), -- Sucursal Sur
(7, 'Jorge Díaz', '08:15:00', 6, 0, 'jorge.diaz@example.com', 'password404'), -- Sucursal Chapinero
(8, 'Raquel Sánchez', '09:30:00', 6, 0, 'raquel.sanchez@example.com', 'password505'), -- Sucursal Chapinero
(9, 'Eduardo Jiménez', '07:00:00', 7, 0, 'eduardo.jimenez@example.com', 'password606'), -- Sucursal Teusaquillo
(10, 'Sofía Fernández', '10:30:00', 10, 0, 'sofia.fernandez@example.com', 'password707'); -- Sucursal Kennedy

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleadoventa`
--

CREATE TABLE `empleadoventa` (
  `idEmpleado` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
(1, NULL, NULL, NULL, 'PENDIENTE', NULL, NULL, NULL),
(2, NULL, NULL, NULL, 'PENDIENTE', NULL, NULL, NULL),
(3, 9500.00, 59500.00, '2024-11-19', 'PENDIENTE', NULL, NULL, '1234567890'),
(4, 665.00, 4165.00, '2024-11-19', 'PENDIENTE', NULL, NULL, '1234567890'),
(5, 15200.00, 95200.00, '2024-11-19', 'PENDIENTE', NULL, NULL, '1234567890'),
(6, 665.00, 4165.00, '2024-11-20', 'PENDIENTE', NULL, NULL, '1234567890'),
(7, 665.00, 4165.00, '2024-11-20', 'PENDIENTE', NULL, NULL, '1234567890'),
(8, 665.00, 4165.00, '2024-11-20', 'PENDIENTE', NULL, NULL, '1234567890'),
(9, 266.00, 1666.00, '2024-11-20', 'PENDIENTE', NULL, NULL, '1234567890'),
(10, 266.00, 1666.00, '2024-11-20', '', NULL, NULL, '1234567890'),
(11, 266.00, 1666.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(12, 266.00, 1666.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(13, 665.00, 4165.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(14, 266.00, 1666.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(15, 266.00, 1666.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(16, 6650.00, 41650.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(17, 6650.00, 41650.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(18, 2850.00, 17850.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(19, 2850.00, 17850.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(20, 2850.00, 17850.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(21, 266.00, 1666.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(22, 266.00, 1666.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(23, 4750.00, 29750.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(24, 4750.00, 29750.00, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890'),
(25, 3410.50, 21345.50, '2024-11-20', 'PAGADA', NULL, NULL, '1234567890');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturaventa`
--
CREATE TABLE `facturaventa` (
  `idFactura` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `cantidad` int(20) NOT NULL,
  `idProducto` int(11) NOT NULL  -- Corregido para usar comillas invertidas y agregar espacio después de tipo de dato
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `facturaventa` (`idFactura`, `idVenta`, `cantidad`, `idProducto`) VALUES
(1, 3, 5, 1),
(2, 4, 10, 2),
(3, 5, 15, 3),
(4, 6, 20, 4),
(5, 7, 25, 5),
(6, 8, 30, 6),
(7, 9, 35, 7),
(8, 10, 40, 8),
(9, 11, 45, 9),
(10, 12, 50, 10),
(11, 13, 55, 11),
(12, 14, 60, 12),
(13, 15, 65, 13),
(14, 16, 70, 14),
(15, 17, 75, 15),
(16, 18, 80, 16),
(17, 19, 85, 17),
(18, 20, 90, 18),
(19, 21, 95, 19),
(20, 22, 100, 20),
(21, 23, 105, 21),
(22, 24, 110, 22),
(23, 25, 115, 23),
(24, 26, 120, 24),
(25, 27, 125, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmaceutico`
--

CREATE TABLE `farmaceutico` (
  `idEmpleado` int(11) NOT NULL,
  `especializacion` int(11) NOT NULL,
  `licenciaFarmaceutico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `farmaceutico` (`idEmpleado`, `especializacion`, `licenciaFarmaceutico`) VALUES
(3, 1, 12345),
(4, 2, 67890);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gerente`
--

CREATE TABLE `gerente` (
  `idEmpleado` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `certificado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `gerente` (`idEmpleado`, `titulo`, `certificado`) VALUES
(7, 'Licenciado en Administración', 1),
(8, 'Máster en Dirección', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idInventario` int(11) NOT NULL,
  `cantidadStock` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `idProducto` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`idInventario`, `cantidadStock`, `fecha`, `idProducto`,`eliminado`) VALUES
(1, 7, '2024-11-17', 1,0),
(2, 8, '2024-11-17', 2,0),
(3, 9, '2024-11-17', 9,0),
(4, 5, '2024-11-17', 10,0),
(5, 3, '2024-11-17', 11,0),
(7, 2, '2024-11-17', 11,0),
(8, 73, '2024-11-17', 12,0),
(9, 40, '2024-11-17', 13,0),
(10, 30, '2024-11-17', 14,0),
(11, 60, '2024-11-17', 15,0),
(12, 45, '2024-11-17', 16,0),
(13, 50, '2024-11-17', 17,0),
(14, 34, '2024-11-17', 18,0),
(15, 25, '2024-11-17', 19,0),
(16, 20, '2024-11-17', 20,0),
(17, 99, '2024-11-20', 21,0);

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

INSERT INTO `licenciafarmaceutico` (`idLicenciaF`, `idEmpleado`, `descripcion`) VALUES
(1, 3, 'Licencia válida por 2 años'),
(2, 4, 'Licencia otorgada por la autoridad sanitaria');


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
(1, 'Efectivo'),
(2, 'Tarjeta'),
(3, 'Transferencia');

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
(2, '2024-11-05'),
(3, '2024-11-10'),
(4, '2024-11-15'),
(5, '2024-11-20'),
(6, '2024-11-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoproductoproveedor`
--

CREATE TABLE `pedidoproductoproveedor` (
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `estado` enum('PENDIENTE', 'COMPLETADO') NOT NULL DEFAULT 'PENDIENTE',
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pedidoproductoproveedor` (`idPedido`, `idProducto`, `idProveedor`, `estado`, `cantidad`) VALUES
(1, 1, 1, 'PENDIENTE', 10),  -- Pedido 1, Producto 1 (Paracetamol), Proveedor 1, Cantidad 10
(1, 2, 2, 'PENDIENTE', 5),   -- Pedido 1, Producto 2 (Crema Hidratante), Proveedor 2, Cantidad 5
(2, 9, 3, 'COMPLETADO', 20), -- Pedido 2, Producto 9 (Shampoo), Proveedor 3, Cantidad 20
(3, 21, 4, 'PENDIENTE', 50), -- Pedido 3, Producto 21 (Jabón Dove), Proveedor 4, Cantidad 50
(4, 1, 5, 'COMPLETADO', 30), -- Pedido 4, Producto 1 (Paracetamol), Proveedor 5, Cantidad 30
(5, 2, 6, 'PENDIENTE', 12),  -- Pedido 5, Producto 2 (Crema Hidratante), Proveedor 6, Cantidad 12
(6, 9, 7, 'COMPLETADO', 15), -- Pedido 6, Producto 9 (Shampoo), Proveedor 7, Cantidad 15
(2, 21, 8, 'PENDIENTE', 10); -- Pedido 2, Producto 21 (Jabón Dove), Proveedor 8, Cantidad 10

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personalinventario`
--

CREATE TABLE `personalinventario` (
  `idEmpleado` int(11) NOT NULL,
  `tiempoServicio` time NOT NULL,
  `idTipoResponsabilidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `personalinventario` (`idEmpleado`, `tiempoServicio`, `idTipoResponsabilidad`) VALUES
(5, '08:00:00', 1),
(6, '07:30:00', 2);




-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` double NOT NULL,
  `categoriaProducto` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT 0,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `precio`, `categoriaProducto`, `eliminado`, `imagen`) VALUES
(1, 'Paracetamol', 3500, 1, 0, 'https://cdn.aerohealthcare.com/wp-content/uploads/2024/09/HV20G_01_1000px_5ba9ff294055adc7ededeb1c9f94f71d-600x600.png'),
(2, 'Crema Hidratante', 15000, 2, 0, 'https://laskin.com.co/cdn/shop/files/7707208614314.png?v=1707616926'),
(9, 'Shampoo', 30, 2, 0, 'data:image/jpeg;base64,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'),
(10, 'Legrip', 1400, 1, 0, 'https://www.drogueriasanjorge.com/wp-content/uploads/2021/11/7704768001943.jpg'),
(11, 'Pomada antiinflamatoria', 35000, 1, 0, 'data:image/jpeg;base64,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'),
(12, 'Jarabe para la tos', 25000, 1, 0, 'https://images.ctfassets.net/j0994xxhz671/Xtehv9811lt7Ch8xGrIj3/e9ec1ae136a9dfc7d54364bb013099d7/jarabe_44_240ml.Final_Color_Output.0004_840.png'),
(13, 'Antibiótico en crema', 40000, 1, 0, 'data:image/jpeg;base64,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'),
(14, 'Crema para cicatrices', 50000, 2, 0, 'https://lh3.googleusercontent.com/EIb3A6FeYF02p6QJAwITyt1IpjrzDDLDR5G8L8YeQHRDB_-rLRaNJqVsSLkGR4tr3g9oaZTl-gMIswYmRMiDQtUOnCqDoN64XhyJgMTXfLF5IsST=s650-rw'),
(15, 'Crema hidratante', 60000, 2, 0, 'https://http2.mlstatic.com/D_NQ_NP_989388-MLU78045110447_072024-O.webp'),
(16, 'Gel limpiador facial', 40000, 2, 0, 'https://www.garnier.es/-/media/project/loreal/brand-sites/garnier/emea/es/2023/productos/limpiadores-pure/reno/3600542488075/3600542488075_1.png?rev=02b1bf8852334a2997d29a73f345a3bb'),
(17, 'Shampoo anti-caída', 50000, 2, 0, 'https://pharmapiel.com.co/3465-large_default/lambdapil-shampoo-anticaida-isdin.jpg'),
(18, 'Crema antiarrugas', 80000, 2, 0, 'https://imagedelivery.net/4fYuQyy-r8_rpBpcY7lH_A/falabellaCO/119630439_01/w=800,h=800,fit=pad'),
(19, 'Exfoliante facial', 45000, 2, 0, 'data:image/jpeg;base64,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'),
(20, 'Aceite esencial de lavanda', 55000, 2, 0, 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxEREhUTExIWEhIWGBgXEhMVFxUaGBUVFhkYFhcSFRUYHigiGBslGxgWITEhJSkrLi4uGB8zODMtNygtLisBCgoKDg0OGhAQGi4lHR4vNy0vLTYtNS0tLS0vLS4tLS0rLS0wNS0rLS0tLS0vLS0tLS0tLS8tLS0tLS0tLTUtLf/AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAgIDAQAAAAAAAAAAAAAABQYCBAEDBwj/xABHEAABAwEEBAkJBgQFBQEAAAABAAIRAwQSITEFQVFhBhMiUnFygZGxBxYyM0KSodHSFCNiweHwCENToiWCk7LTFzRzg6MV/8QAGQEBAQADAQAAAAAAAAAAAAAAAAECAwQF/8QAKxEBAAICAAIJBAMBAAAAAAAAAAECAxExUQQSExQhM0Fh0VJxofAVgZEF/9oADAMBAAIRAxEAPwD3FERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEWnpfSlGy0jWrv4um2JdDjngMGgkqn2ryuaKYcKlSprltMj/fCC+IvNLT5atHsx4i1OaRIcG0YjtqgrU/69aM/oWv3KP/ACoPVkXlrfLtos/yrUP/AF0v+Rbti8sujavostHbTZ9aD0VFSj5UNHAgPNVk5Eskf2klT+guElktt77PVFS5F7kvaROWDwCglkREBERAREQEREBERAREQEREBERAREQEREBERBRPLWY0VV6zPFfMzD6PQF9LeW8/4VU67PzXzRT9noCCUtnqW9Rvgq8FYrUPuW9QeCrqLLNvzU/wU1qAHzU/wUzKsIkeERxZ2/kvR/4e3S+19FP815vwj9j96wvRf4eDy7X0U/EpI9rREUBERAREQEREBERAREQEREBERAREQEREBERB595cz/hT/wDyM/NfNdP2egL6G8v2kqTNHiiXgValRrms1lrQ6XbhJC+dG1wI3QgnLR6pvVHgq2peppRhYGwZDQO5RBKKzap7gpmVXw5SehNINok3px2Iie4R+x+9YXoX8PB+9tfVZ4ryvS+mqdS7dnDPDoXo/wDDzpGkLTaKZcGvqMHFtObrpkgb4xjp2KyPe0RFAREQEREBERAREQEREBERAREQEREBERAREQfLPljtD36WrNc4uDXB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'),
(21, 'Jabón Dove Beauty Humectante 90 Gr X 3 Und', 17950, 3, 0, 'images/jabonDove Gr X 3.jpg');

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
(1, 1),
(2, 12),
(3, 14),
(4, 1),
(5, 18),
(6, 1),
(7, 1),
(8, 1),
(9, 10),
(10, 10),
(11, 10),
(12, 10),
(13, 1),
(14, 10),
(15, 10),
(16, 11),
(17, 11),
(18, 2),
(19, 2),
(20, 2),
(21, 10),
(22, 10),
(23, 12),
(24, 12),
(25, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoproveedor`
--

CREATE TABLE `productoproveedor` (
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `costo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `productoproveedor` (`idProducto`, `idProveedor`, `costo`) VALUES
(1, 1, 3000),  -- Producto 'Paracetamol' del Proveedor 'Proveedor A' con costo 3000
(2, 2, 14000), -- Producto 'Crema Hidratante' del Proveedor 'Proveedor B' con costo 14000
(9, 3, 25),    -- Producto 'Shampoo' del Proveedor 'Proveedor C' con costo 25
(21, 4, 17500); -- Producto 'Jabón Dove Beauty Humectante 90 Gr X 3 Und' del Proveedor 'Proveedor D' con costo 17500

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombre`, `email`,`eliminado`)
VALUES
(1, 'Proveedor A', 'proveedorA@example.com',0),
(2, 'Proveedor B', 'proveedorB@example.com',0),
(3, 'Proveedor C', 'proveedorC@example.com',0),
(4, 'Proveedor D', 'proveedorD@example.com',0),
(5, 'Proveedor E', 'proveedorE@example.com',0),
(6, 'Proveedor F', 'proveedorF@example.com',0),
(7, 'Proveedor G', 'proveedorG@example.com',0),
(8, 'Proveedor H', 'proveedorH@example.com',0),
(9, 'Proveedor I', 'proveedorI@example.com',0),
(10, 'Proveedor J', 'proveedorJ@example.com',0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidor`
--

CREATE TABLE `repartidor` (
  `idEmpleado` int(11) NOT NULL,
  `licenciaConduccion` varchar(20) NOT NULL
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


INSERT INTO `subsidio` (`idSubsidio`,`monto`, `fecha`, `cedula`, `idFactura`, `tipoSubsidio`) VALUES
(1,3000, '2024-11-20', '1234567890', 1, 1),  -- Carlos Pérez, subsidio de transporte
(2,15000, '2024-11-21', '2345678901', 2, 2), -- María Gómez, subsidio de alimentación
(3,5000, '2024-11-22', '3456789012', 3, 3),  -- Luis Rodríguez, subsidio de vivienda
(4,10000, '2024-11-23', '4567890123', 4, 4), -- Ana Torres, subsidio educativo
(5,7000, '2024-11-24', '5678901234', 5, 5),  -- José Martínez, subsidio de salud
(6,3500, '2024-11-25', '6789012345', 6, 6),  -- Patricia González, subsidio familiar
(7,2000, '2024-11-26', '7890123456', 7, 1),  -- Juan López, subsidio de transporte
(8,88000, '2024-11-27', '8901234567', 8, 2),  -- Raquel Martínez, subsidio de alimentación
(9,12000, '2024-11-28', '9012345678', 9, 3), -- Eduardo Jiménez, subsidio de vivienda
(10,5000, '2024-11-29', '0123456789', 10, 4); -- Sofía Fernández, subsidio educativo



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
(1, 'Sucursal Centro', 'Carrera 7 #10-20, Bogotá, Colombia'),
(2, 'Sucursal Norte', 'Calle 100 #20-50, Bogotá, Colombia'),
(3, 'Sucursal Sur', 'Avenida 68 #45-30, Bogotá, Colombia'),
(4, 'Sucursal Occidente', 'Calle 13 #80-90, Bogotá, Colombia'),
(5, 'Sucursal Oriente', 'Calle 45 #33-12, Bogotá, Colombia'),
(6, 'Sucursal Chapinero', 'Carrera 15 #50-30, Bogotá, Colombia'),
(7, 'Sucursal Teusaquillo', 'Carrera 30 #60-70, Bogotá, Colombia'),
(8, 'Sucursal Suba', 'Calle 94 #11-80, Bogotá, Colombia'),
(9, 'Sucursal Fontibón', 'Avenida El Dorado #56-15, Bogotá, Colombia'),
(10, 'Sucursal Kennedy', 'Calle 10 #40-12, Bogotá, Colombia');

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


INSERT INTO `telefono` (`idTelefono`, `idEntidad`, `tipoEntidad`, `numero`, `tipoTelefono`) VALUES
-- Teléfonos de empleados
(1, 1, 'empleado', '3101234567', 2), -- Juan Pérez - Celular
(2, 2, 'empleado', '3122345678', 2), -- María Gómez - Celular
(3, 3, 'empleado', '3203456789', 2), -- Carlos Rodríguez - Celular
(4, 4, 'empleado', '3154567890', 2), -- Ana Torres - Celular
(5, 5, 'empleado', '6011234567', 1), -- Luis Martínez - Fijo
(6, 6, 'empleado', '6012345678', 1), -- Patricia López - Fijo

-- Teléfonos de clientes
(7, 1, 'cliente', '3009876543', 2), -- Cliente 1 - Celular
(8, 2, 'cliente', '3159876543', 2), -- Cliente 2 - Celular

-- Teléfonos de proveedores
(9, 1, 'proveedor', '6017654321', 1), -- Proveedor 1 - Fijo
(10, 2, 'proveedor', '6018765432', 1); -- Proveedor 2 - Fijo

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocertificado`
--

CREATE TABLE `tipocertificado` (
  `idTipoCertificado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tipocertificado` (`idTipoCertificado`, `nombre`) VALUES
(1, 'Gestión Empresarial'),
(2, 'Liderazgo y Gestión');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiporesponsabilidad`
--

CREATE TABLE `tiporesponsabilidad` (
  `idTipoResponsabilidad` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tiporesponsabilidad` (`idTipoResponsabilidad`, `nombre`, `descripcion`) VALUES
(1, 'Control de stock', 'Encargado de controlar los inventarios de productos'),
(2, 'Reabastecimiento', 'Responsable de realizar pedidos de productos según el inventario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposubsidio`
--

CREATE TABLE `tiposubsidio` (
  `idTipoSubsidio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `tiposubsidio` (`idTipoSubsidio`, `nombre`, `descripcion`) VALUES
(1, 'Subsidio de Transporte', 'Subsidio destinado a cubrir los costos de transporte público para empleados.'),
(2, 'Subsidio de Alimentación', 'Subsidio destinado a cubrir los gastos de alimentación de los empleados en el lugar de trabajo.'),
(3, 'Subsidio de Vivienda', 'Subsidio destinado a apoyar a los empleados con gastos relacionados con la vivienda.'),
(4, 'Subsidio Educativo', 'Subsidio destinado a financiar la educación de los empleados o sus dependientes.'),
(5, 'Subsidio de Salud', 'Subsidio destinado a cubrir gastos médicos y de salud para los empleados.'),
(6, 'Subsidio Familiar', 'Subsidio destinado a ayudar a las familias de los empleados en situaciones especiales.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipotelefono`
--

CREATE TABLE `tipotelefono` (
  `idTipoTelefono` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tipotelefono` (`idTipoTelefono`, `nombre`) VALUES
(1, 'Fijo'),
(2, 'Celular'),
(3, 'Trabajo'),
(4, 'Casa');


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
(3, 0, 1, 1, '1234567890'),
(4, 0, 1, 2, '1234567890'),
(5, 0, 1, 3, '1234567890'),
(6, 0, 1, 4, '1234567890'),
(7, 0, 2, 5, '1234567890'),
(8, 0, 1, 6, '1234567890'),
(9, 0, 1, 7, '1234567890'),
(10, 0, 1, 8, '1234567890'),
(11, 0, 1, 9, '1234567890'),
(12, 0, 1, 10, '1234567890'),
(13, 0, 1, 11, '1234567890'),
(14, 0, 1, 12, '1234567890'),
(15, 0, 1, 13, '1234567890'),
(16, 0, 1, 14, '1234567890'),
(17, 0, 1, 15, '1234567890'),
(18, 0, 1, 16, '1234567890'),
(19, 0, 1, 17, '1234567890'),
(20, 0, 1, 18, '1234567890'),
(21, 0, 1, 19, '1234567890'),
(22, 0, 1, 20, '1234567890'),
(23, 0, 1, 21, '1234567890'),
(24, 0, 1, 22, '1234567890'),
(25, 0, 1, 23, '1234567890'),
(26, 0, 1, 24, '1234567890'),
(27, 15, 1, 25, '1234567890');

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
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `certificado` (`certificado`);

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
  ADD KEY `idEmpleado` (`idEmpleado`);

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
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `licenciaConduccion` (`licenciaConduccion`);

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
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idInventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `metodopago`
--
ALTER TABLE `metodopago`
  MODIFY `idMetodoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `idRuta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subsidio`
--
ALTER TABLE `subsidio`
  MODIFY `idSubsidio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `idSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `telefono`
--
ALTER TABLE `telefono`
  MODIFY `idTelefono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipocertificado`
--
ALTER TABLE `tipocertificado`
  MODIFY `idTipoCertificado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiporesponsabilidad`
--
ALTER TABLE `tiporesponsabilidad`
  MODIFY `idTipoResponsabilidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposubsidio`
--
ALTER TABLE `tiposubsidio`
  MODIFY `idTipoSubsidio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipotelefono`
--
ALTER TABLE `tipotelefono`
  MODIFY `idTipoTelefono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  ADD CONSTRAINT `gerente_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`),
  ADD CONSTRAINT `gerente_ibfk_2` FOREIGN KEY (`certificado`) REFERENCES `certificado` (`tipoCertificado`);

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
  ADD CONSTRAINT `repartidor_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`),
  ADD CONSTRAINT `repartidor_ibfk_2` FOREIGN KEY (`licenciaConduccion`) REFERENCES `licenciaconduccion` (`nombre`);

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
