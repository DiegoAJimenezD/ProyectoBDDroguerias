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


CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `horario` time DEFAULT NULL,
  `sucursal` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `empleado` (`idEmpleado`, `nombre`, `horario`, `sucursal`, `eliminado`, `email`, `contrasena`)
VALUES
(1, 'Juan Pérez', '08:00:00', 1, 0, 'juan.perez@example.com', 'password123'), -- Sucursal Centro
(2, 'María Gómez', '09:00:00', 1, 0, 'maria.gomez@example.com', 'password456'), -- Sucursal Centro
(3, 'Carlos Rodríguez', '10:00:00', 2, 0, 'carlos.rodriguez@example.com', 'password789'), -- Sucursal Norte
(4, 'Ana Torres', '08:30:00', 2, 0, 'ana.torres@example.com', 'password101'), -- Sucursal Norte
(5, 'Luis Martínez', '07:45:00', 4, 1, 'luis.martinez@example.com', 'password202'), -- Sucursal Occidente
(6, 'Patricia López', '11:00:00', 3, 0, 'patricia.lopez@example.com', 'password303'), -- Sucursal Sur
(7, 'Jorge Díaz', '08:15:00', 6, 0, 'jorge.diaz@example.com', 'password404'), -- Sucursal Chapinero
(8, 'Raquel Sánchez', '09:30:00', 6, 0, 'raquel.sanchez@example.com', 'password505'), -- Sucursal Chapinero
(9, 'Eduardo Jiménez', '07:00:00', 7, 0, 'eduardo.jimenez@example.com', 'password606'), -- Sucursal Teusaquillo
(10, 'Sofía Fernández', '10:30:00', 10, 1, 'sofia.fernandez@example.com', 'password707'); -- Sucursal Kennedy


CREATE TABLE `cajero` (
  `idEmpleado` int(11) NOT NULL,
  `turno` varchar(50) NOT NULL,
  `tiempoServicio` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cajero` (`idEmpleado`, `turno`, `tiempoServicio`) VALUES
(1, 'Mañana', '08:00:00'),
(2, 'Tarde', '07:30:00');

CREATE TABLE `farmaceutico` (
  `idEmpleado` int(11) NOT NULL,
  `especializacion` int(11) NOT NULL,
  `licenciaFarmaceutico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `farmaceutico` (`idEmpleado`, `especializacion`, `licenciaFarmaceutico`) VALUES
(3, 1, 12345),
(4, 2, 67890);

CREATE TABLE `licenciafarmaceutico` (
  `idLicenciaF` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `licenciafarmaceutico` (`idLicenciaF`, `idEmpleado`, `descripcion`) VALUES
(1, 3, 'Licencia válida por 2 años'),
(2, 4, 'Licencia otorgada por la autoridad sanitaria');

CREATE TABLE `personalinventario` (
  `idEmpleado` int(11) NOT NULL,
  `tiempoServicio` time NOT NULL,
  `idTipoResponsabilidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `personalinventario` (`idEmpleado`, `tiempoServicio`, `idTipoResponsabilidad`) VALUES
(5, '08:00:00', 1),
(6, '07:30:00', 2);

CREATE TABLE `tiporesponsabilidad` (
  `idTipoResponsabilidad` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tiporesponsabilidad` (`idTipoResponsabilidad`, `nombre`, `descripcion`) VALUES
(1, 'Control de stock', 'Encargado de controlar los inventarios de productos'),
(2, 'Reabastecimiento', 'Responsable de realizar pedidos de productos según el inventario');

CREATE TABLE `gerente` (
  `idEmpleado` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `certificado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `gerente` (`idEmpleado`, `titulo`, `certificado`) VALUES
(7, 'Licenciado en Administración', 1),
(8, 'Máster en Dirección', 2);

CREATE TABLE `certificado` (
  `tipoCertificado` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `certificado` (`tipoCertificado`, `idEmpleado`, `descripcion`) VALUES
(1, 7, 'Certificado en Gestión Empresarial'),
(2, 8, 'Certificado en Liderazgo y Gestión');

CREATE TABLE `tipocertificado` (
  `idTipoCertificado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tipocertificado` (`idTipoCertificado`, `nombre`) VALUES
(1, 'Gestión Empresarial'),
(2, 'Liderazgo y Gestión');

CREATE TABLE `repartidor` (
  `idEmpleado` int(11) NOT NULL,
  `licenciaConduccion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `repartidor` (`idEmpleado`, `licenciaConduccion`) VALUES
(9, 'B123456789'),
(10, 'C987654321');

CREATE TABLE `licenciaconduccion` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `licenciaconduccion` (`idEmpleado`, `nombre`, `descripcion`) VALUES
(9, 'Licencia de Conducción A', 'Licencia para conducir vehículos de pasajeros'),
(10, 'Licencia de Conducción B', 'Licencia para conducir vehículos de carga');


CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` double NOT NULL,
  `categoriaProducto` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT 0,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `producto` (`idProducto`, `nombre`, `precio`, `categoriaProducto`, `eliminado`, `imagen`) VALUES
(1, 'Paracetamol', 3500, 1, 0, 'https://example.com/images/paracetamol.jpg'),
(2, 'Crema Hidratante', 15000, 2, 0, 'https://example.com/images/crema_hidratante.jpg'),
(3, 'Shampoo', 30000, 2, 0, 'https://example.com/images/shampoo.jpg'),
(4, 'Legrip', 1400, 1, 0, 'https://example.com/images/legrip.jpg'),
(5, 'Pomada antiinflamatoria', 35000, 1, 0, 'https://example.com/images/pomada_antiinflamatoria.jpg'),
(6, 'Jarabe para la tos', 25000, 1, 0, 'https://example.com/images/jarabe_tos.jpg'),
(7, 'Crema para cicatrices', 50000, 2, 0, 'https://example.com/images/crema_cicatrices.jpg'),
(8, 'Crema hidratante', 60000, 2, 0, 'https://example.com/images/crema_hidratante_2.jpg'),
(9, 'Gel limpiador facial', 40000, 2, 0, 'https://example.com/images/gel_limpiador.jpg'),
(10, 'Shampoo anti-caída', 50000, 2, 0, 'https://example.com/images/shampoo_anti_caida.jpg'),
(11, 'Crema antiarrugas', 80000, 2, 0, 'https://example.com/images/crema_antiarrugas.jpg'),
(12, 'Exfoliante facial', 45000, 2, 0, 'https://example.com/images/exfoliante_facial.jpg'),
(13, 'Aceite esencial de lavanda', 55000, 2, 0, 'https://example.com/images/aceite_esencial.jpg'),
(14, 'Jabón Dove Beauty Humectante 90 Gr X 3 Und', 17950, 3, 0, 'https://example.com/images/jabon_dove.jpg');

CREATE TABLE `categoriaproducto` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categoriaproducto` (`idCategoria`, `nombre`, `estado`, `descripcion`) VALUES
(1, 'Medicamentos', 'ACTIVO', 'Productos farmacéuticos para el tratamiento de enfermedades'),
(2, 'Cosméticos', 'ACTIVO', 'Productos para el cuidado personal y la belleza, incluyendo maquillaje y cuidado de la piel.'),
(3, 'Higiene Personal', 'ACTIVO', 'Productos relacionados con la limpieza personal.');


CREATE TABLE `inventario` (
  `idInventario` int(11) NOT NULL,
  `cantidadStock` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `inventario` (`idInventario`, `cantidadStock`, `fecha`, `idProducto`) VALUES
(1, 50, CURDATE(), 1),
(2, 50, CURDATE(), 2),
(3, 50, CURDATE(), 3),
(4, 50, CURDATE(), 4),
(5, 50, CURDATE(), 5),
(6, 50, CURDATE(), 6),
(7, 50, CURDATE(), 7),
(8, 50, CURDATE(), 8),
(9, 50, CURDATE(), 9),
(10, 50, CURDATE(), 10),
(11, 50, CURDATE(), 11),
(12, 50, CURDATE(), 12),
(13, 50, CURDATE(), 13),
(14, 50, CURDATE(), 14);


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


CREATE TABLE `venta` (
  `idVenta` int(11) NOT NULL,
  `descuento` double NOT NULL,
  `metodoPago` int(11) NOT NULL,
  `idFactura` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `venta` (`idVenta`, `descuento`, `metodoPago`, `idFactura`, `cedula`) VALUES
(1, 500.00, 1, 1, '1234567890'),
(2, 1000.00, 2, 2, '2345678901'),
(3, 1500.00, 3, 3, '3456789012'),
(4, 2000.00, 1, 4, '4567890123'),
(5, 300.00, 2, 5, '5678901234'),
(6, 700.00, 3, 6, '6789012345'),
(7, 800.00, 1, 7, '7890123456'),
(8, 1000.00, 2, 8, '8901234567'),
(9, 1200.00, 3, 9, '9012345678'),
(10, 1500.00, 1, 10, '0123456789');

CREATE TABLE `metodopago` (
  `idMetodoPago` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `metodopago` (`idMetodoPago`, `nombre`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta'),
(3, 'Transferencia');


CREATE TABLE `empleadoventa` (
  `idEmpleado` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `empleadoventa` (`idEmpleado`, `idVenta`) VALUES
(1, 1),  -- Juan Pérez realizó la venta 1
(2, 2),  -- María Gómez realizó la venta 2
(3, 3),  -- Carlos Rodríguez realizó la venta 3
(4, 4),  -- Ana Torres realizó la venta 4
(6, 5),  -- Patricia López realizó la venta 5
(7, 6),  -- Jorge Díaz realizó la venta 6
(8, 7),  -- Raquel Sánchez realizó la venta 7
(9, 8),  -- Eduardo Jiménez realizó la venta 8
(10, 9), -- Sofía Fernández realizó la venta 9
(1, 10); -- Juan Pérez realizó la venta 10


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

INSERT INTO `factura` (`idFactura`, `impuesto`, `precio`, `fechaCompra`, `estado`, `fechaVencimiento`, `domicilio`, `clienteCedula`) VALUES
(1, 500.00, 18000.00, '2024-11-20', 'PENDIENTE', '2024-12-05', 'Calle Ficticia 123, Ciudad X', '1234567890'),
(2, 1000.00, 25000.00, '2024-11-21', 'PENDIENTE', '2024-12-06', 'Avenida Central 456, Ciudad Y', '2345678901'),
(3, 700.00, 35000.00, '2024-11-22', 'PENDIENTE', '2024-12-07', 'Carrera 5, Edificio Z, Ciudad Z', '3456789012'),
(4, 800.00, 42000.00, '2024-11-23', 'PENDIENTE', '2024-12-08', 'Calle Verde 789, Ciudad A', '4567890123'),
(5, 600.00, 27000.00, '2024-11-24', 'PENDIENTE', '2024-12-09', 'Calle Sol 101, Ciudad B', '5678901234'),
(6, 1200.00, 38000.00, '2024-11-25', 'PENDIENTE', '2024-12-10', 'Avenida Libertad 201, Ciudad C', '6789012345'),
(7, 900.00, 32000.00, '2024-11-26', 'PENDIENTE', '2024-12-11', 'Calle Norte 323, Ciudad D', '7890123456'),
(8, 1100.00, 46000.00, '2024-11-27', 'PENDIENTE', '2024-12-12', 'Calle Río 454, Ciudad E', '8901234567'),
(9, 1000.00, 50000.00, '2024-11-28', 'PENDIENTE', '2024-12-13', 'Calle del Mar 565, Ciudad F', '9012345678'),
(10, 1300.00, 55000.00, '2024-11-29', 'PENDIENTE', '2024-12-14', 'Calle Árbol 676, Ciudad G', '0123456789');


CREATE TABLE `facturaventa` (
  `idFactura` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `facturaventa` (`idFactura`, `idVenta`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

CREATE TABLE `productofactura` (
  `idFactura` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `productofactura` (`idFactura`, `idProducto`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10),
(6, 11),
(6, 12),
(7, 13),
(7, 14),
(8, 1),
(8, 2),
(9, 3),
(9, 4),
(10, 5);

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

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `proveedor` (`idProveedor`, `nombre`, `email`)
VALUES
(1, 'Proveedor A', 'proveedorA@example.com'),
(2, 'Proveedor B', 'proveedorB@example.com'),
(3, 'Proveedor C', 'proveedorC@example.com'),
(4, 'Proveedor D', 'proveedorD@example.com'),
(5, 'Proveedor E', 'proveedorE@example.com'),
(6, 'Proveedor F', 'proveedorF@example.com'),
(7, 'Proveedor G', 'proveedorG@example.com'),
(8, 'Proveedor H', 'proveedorH@example.com'),
(9, 'Proveedor I', 'proveedorI@example.com'),
(10, 'Proveedor J', 'proveedorJ@example.com');



CREATE TABLE `productoproveedor` (
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `costo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `productoproveedor` (`idProducto`, `idProveedor`, `costo`) VALUES
(1, 1, 3000),  -- Paracetamol de Proveedor A
(1, 2, 3200),  -- Paracetamol de Proveedor B
(2, 3, 12000), -- Crema Hidratante de Proveedor C
(2, 4, 15000), -- Crema Hidratante de Proveedor D
(3, 2, 25),    -- Shampoo de Proveedor B
(3, 5, 28),    -- Shampoo de Proveedor E
(4, 6, 1200),  -- Legrip de Proveedor F
(5, 7, 34000), -- Pomada antiinflamatoria de Proveedor G
(6, 8, 24000), -- Jarabe para la tos de Proveedor H
(7, 9, 48000), -- Crema para cicatrices de Proveedor I
(8, 10, 59000), -- Crema hidratante de Proveedor J
(9, 6, 39000),  -- Gel limpiador facial de Proveedor F
(10, 4, 48000), -- Shampoo anti-caída de Proveedor D
(11, 7, 77000), -- Crema antiarrugas de Proveedor G
(12, 9, 44000), -- Exfoliante facial de Proveedor I
(13, 3, 53000), -- Aceite esencial de lavanda de Proveedor C
(14, 5, 17500); -- Jabón Dove de Proveedor E



CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `fechaPedido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pedido` (`idPedido`, `fechaPedido`) VALUES
(1, '2024-10-01'),
(2, '2024-10-05'),
(3, '2024-10-10'),
(4, '2024-10-15'),
(5, '2024-10-20'),
(6, '2024-10-25'),
(7, '2024-10-30'),
(8, '2024-11-01'),
(9, '2024-11-05'),
(10, '2024-11-10');


CREATE TABLE `pedidoproductoproveedor` (
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar en la tabla pedidoproductoproveedor
INSERT INTO `pedidoproductoproveedor` (`idPedido`, `idProducto`, `idProveedor`, `cantidad`) VALUES
(1, 1, 1, 5),   -- Pedido 1: 5 unidades de Paracetamol de Proveedor A
(1, 2, 2, 3),   -- Pedido 1: 3 unidades de Crema Hidratante de Proveedor B
(2, 3, 3, 10),  -- Pedido 2: 10 unidades de Shampoo de Proveedor C
(2, 4, 1, 2),   -- Pedido 2: 2 unidades de Legrip de Proveedor A
(3, 5, 4, 6),   -- Pedido 3: 6 unidades de Pomada antiinflamatoria de Proveedor D
(3, 6, 5, 4),   -- Pedido 3: 4 unidades de Jarabe para la tos de Proveedor E
(4, 7, 6, 8),   -- Pedido 4: 8 unidades de Crema para cicatrices de Proveedor F
(5, 8, 7, 5),   -- Pedido 5: 5 unidades de Crema hidratante de Proveedor G
(6, 9, 8, 7),   -- Pedido 6: 7 unidades de Gel limpiador facial de Proveedor H
(7, 10, 9, 3),  -- Pedido 7: 3 unidades de Shampoo anti-caída de Proveedor I
(8, 11, 10, 2), -- Pedido 8: 2 unidades de Crema antiarrugas de Proveedor J
(9, 12, 3, 9),  -- Pedido 9: 9 unidades de Exfoliante facial de Proveedor C
(10, 13, 4, 4), -- Pedido 10: 4 unidades de Aceite esencial de lavanda de Proveedor D
(10, 14, 5, 6); -- Pedido 10: 6 unidades de Jabón Dove Beauty Humectante 90 Gr X 3 Und de Proveedor E

CREATE TABLE `sucursal` (
  `idSucursal` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `subsidio` (
  `idSubsidio` int(11) NOT NULL,
  `monto` double NOT NULL,
  `fecha` date NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `idFactura` int(11) NOT NULL,
  `tipoSubsidio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `subsidio` (`idSubsidio`, `monto`, `fecha`, `cedula`, `idFactura`, `tipoSubsidio`) VALUES
(1, 5000.00, '2024-11-21', '1234567890', 1, 1),
(2, 10000.00, '2024-11-22', '2345678901', 2, 2),
(3, 15000.00, '2024-11-23', '3456789012', 3, 3),
(4, 20000.00, '2024-11-24', '4567890123', 4, 4),
(5, 5000.00, '2024-11-25', '5678901234', 5, 1),
(6, 8000.00, '2024-11-26', '6789012345', 6, 2),
(7, 12000.00, '2024-11-27', '7890123456', 7, 3),
(8, 15000.00, '2024-11-28', '8901234567', 8, 4),
(9, 7000.00, '2024-11-29', '9012345678', 9, 1),
(10, 9000.00, '2024-11-30', '0123456789', 10, 2);

CREATE TABLE `tiposubsidio` (
  `idTipoSubsidio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tiposubsidio` (`idTipoSubsidio`, `nombre`, `descripcion`) VALUES
(1, 'Subsidio Alimentario', 'Subsidio destinado a la compra de alimentos para los clientes de bajos recursos.'),
(2, 'Subsidio Vivienda', 'Subsidio destinado a la adquisición o mejora de vivienda para los clientes.'),
(3, 'Subsidio Educativo', 'Subsidio para apoyar los costos educativos de los clientes.'),
(4, 'Subsidio de Salud', 'Subsidio para cubrir gastos médicos de los clientes.');


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

CREATE TABLE `tipotelefono` (
  `idTipoTelefono` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tipotelefono` (`idTipoTelefono`, `nombre`) VALUES
(1, 'Fijo'),
(2, 'Celular'),
(3, 'Trabajo'),
(4, 'Casa');

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
