-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-03-2026 a las 04:18:51
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
-- Base de datos: `helados`
--
CREATE DATABASE IF NOT EXISTS `helados` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `helados`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--
-- Creación: 21-03-2026 a las 18:01:17
-- Última actualización: 22-03-2026 a las 03:13:30
--

CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre_trabajador` varchar(100) DEFAULT NULL,
  `hora_entrada` datetime DEFAULT NULL,
  `estatus` varchar(50) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `usuario_id`, `nombre_trabajador`, `hora_entrada`, `estatus`) VALUES
(1, NULL, 'admin', '2026-03-21 19:05:29', 'Activo'),
(2, NULL, 'admin', '2026-03-21 19:10:41', 'Activo'),
(3, NULL, 'admin', '2026-03-21 19:28:35', 'Activo'),
(4, NULL, 'admin', '2026-03-21 19:41:19', 'Activo'),
(5, NULL, 'admin', '2026-03-22 03:37:01', 'Activo'),
(6, NULL, 'admin', '2026-03-22 03:48:41', 'Activo'),
(7, NULL, 'admin', '2026-03-22 04:13:30', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--
-- Creación: 21-03-2026 a las 16:39:57
--

CREATE TABLE `cliente` (
  `clienteID` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `puntos` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`clienteID`, `nombre`, `puntos`) VALUES
(1, 'Juan Pérez', 0),
(2, 'Ana López', 0),
(3, 'Carlos Ruiz', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--
-- Creación: 21-03-2026 a las 16:41:19
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--
-- Creación: 22-03-2026 a las 00:06:28
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `estado` varchar(20) DEFAULT 'Activo',
  `ventas_totales` decimal(10,2) DEFAULT 0.00,
  `sesiones_activas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `rol`, `estado`, `ventas_totales`, `sesiones_activas`) VALUES
(2, 'Pedro Cliente', 'Vendedor', 'Inactivo', 450.00, 0),
(3, 'Ale', 'Almacenista', 'Activo', 0.02, 0),
(4, 'Mario', 'Vendedor', 'Activo', 400.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--
-- Creación: 22-03-2026 a las 01:34:25
--

CREATE TABLE `producto` (
  `productoID` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` int(11) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `nombre_cliente` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `imagen` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`productoID`, `nombre`, `precio`, `stock`, `nombre_cliente`, `estado`, `fecha`, `imagen`) VALUES
(1, 'Nissan Versa', 280000, 0, NULL, 'Inactivo', NULL, 'imagenes/versa.jpg'),
(2, 'Chevrolet Onix', 295000, 0, NULL, 'Inactivo', NULL, 'imagenes/onix.jpg'),
(3, 'Toyota Corolla', 420000, 0, NULL, NULL, NULL, 'imagenes/corolla.jpg'),
(4, 'Mazda 3', 450000, 0, NULL, NULL, NULL, 'imagenes/mazda3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--
-- Creación: 21-03-2026 a las 18:09:09
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--
-- Creación: 21-03-2026 a las 16:39:57
--

CREATE TABLE `venta` (
  `ventaID` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`ventaID`, `fecha`, `hora`) VALUES
(1, '2026-03-21', '21:38:16'),
(2, '2026-03-21', '21:40:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--
-- Creación: 21-03-2026 a las 16:42:13
--

CREATE TABLE `ventas` (
  `ventaID` int(11) NOT NULL,
  `cliente_email` varchar(150) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) DEFAULT 'Pendiente',
  `direccion_envio` text DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'No Pagado',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ventaID`, `cliente_email`, `producto`, `imagen`, `total`, `metodo_pago`, `direccion_envio`, `estado`, `fecha`) VALUES
(1, 'cliente@gmail.com', 'Sueter de Naruto', 'img/variedades-cliente7.webp', 370.00, 'Pendiente', NULL, 'En sucursal', '2026-03-21 16:46:26'),
(2, 'cliente@gmail.com', 'Goku Black', 'img/cosplay1.jpg', 450.00, 'Pendiente', NULL, 'En sucursal', '2026-03-21 16:51:14'),
(3, 'cliente@gmail.com', 'Manga The Apothecary', 'img/clien-manga.jpg', 350.00, 'Pendiente', NULL, 'En sucursal', '2026-03-21 16:51:17'),
(4, 'cliente_sesion@gmail.com', 'Sueter de Naruto', '', 370.00, 'Tarjeta de Crédito/Débito', 'venustiano', 'En sucursal', '2026-03-21 16:57:34'),
(5, 'cliente@gmail.com', 'Taza One Punch', 'img/clien-taza1.jpg', 300.00, 'Pendiente', NULL, 'En sucursal', '2026-03-21 17:01:55'),
(6, 'cliente@gmail.com', 'Collar', 'img/clien-taza2.jpg', 70.00, 'Pendiente', NULL, 'En sucursal', '2026-03-21 17:01:58'),
(7, 'cliente@gmail.com', 'Collar', 'img/clien-taza2.jpg', 70.00, 'Pendiente', NULL, 'En sucursal', '2026-03-21 17:03:33'),
(8, 'cliente@gmail.com', 'Manga The Apothecary', 'img/clien-manga.jpg', 350.00, 'Pendiente', NULL, 'En sucursal', '2026-03-21 17:04:28'),
(9, 'cliente@gmail.com', 'Manga Jujutsu Kaisen', 'img/clien-manga2.jpg', 420.00, 'Pendiente', NULL, 'En sucursal', '2026-03-21 17:04:31'),
(10, 'cliente@gmail.com', 'Manga Jujutsu Kaisen', 'img/logo.png', 420.00, 'PayPal', 'Venustiano', 'En sucursal', '2026-03-21 17:04:52'),
(11, 'cliente@gmail.com', 'Manga Jujutsu Kaisen', 'img/logo.png', 420.00, 'Tarjeta de Crédito/Débito', 'Venustiano', 'En sucursal', '2026-03-21 17:05:11'),
(12, 'cliente@gmail.com', 'Manga Jujutsu Kaisen', 'img/logo.png', 420.00, 'Tarjeta de Crédito/Débito', 'venustison', 'En sucursal', '2026-03-21 17:10:53'),
(13, 'cliente@gmail.com', 'Manga Jujutsu Kaisen', 'img/logo.png', 420.00, 'Tarjeta de Crédito/Débito', 'america', 'En sucursal', '2026-03-21 17:14:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--
-- Creación: 21-03-2026 a las 16:39:57
--

CREATE TABLE `venta_detalle` (
  `detalleID` int(11) NOT NULL,
  `ventaID` int(11) NOT NULL,
  `productoID` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta_detalle`
--

INSERT INTO `venta_detalle` (`detalleID`, `ventaID`, `productoID`, `nombre`, `precio`, `cantidad`, `subtotal`) VALUES
(1, 2, 1, '', 100, 1, 100);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`clienteID`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`productoID`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`ventaID`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ventaID`);

--
-- Indices de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD PRIMARY KEY (`detalleID`),
  ADD KEY `ventaID` (`ventaID`),
  ADD KEY `productoID` (`productoID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `clienteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `productoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `ventaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ventaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  MODIFY `detalleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD CONSTRAINT `venta_detalle_ibfk_1` FOREIGN KEY (`ventaID`) REFERENCES `venta` (`ventaID`),
  ADD CONSTRAINT `venta_detalle_ibfk_2` FOREIGN KEY (`productoID`) REFERENCES `producto` (`productoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
