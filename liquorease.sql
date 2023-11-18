-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2023 a las 03:10:44
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
-- Base de datos: `liquorease`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_ventas`
--

CREATE TABLE `informe_ventas` (
  `id` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

-- Estructura de tabla actualizada para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `sede_id` int(11) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos actualizado para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `nombre_producto`, `cantidad`, `sede_id`, `fecha_vencimiento`, `precio`, `descripcion`, `estado`) VALUES
(1, 'Trago 1', 10, 1, '2023-12-31', 5.99, 'Descripción del Trago 1', 'disponible'),
(2, 'Trago 2', 15, 2, '2023-11-30', 6.49, 'Descripción del Trago 2', 'disponible'),
(3, 'Trago 3', 20, 3, '2024-01-15', 7.99, 'Descripción del Trago 3', 'disponible'),
(4, 'Trago 4', 12, 1, '2023-12-20', 5.25, 'Descripción del Trago 4', 'disponible'),
(5, 'Trago 5', 18, 2, '2023-11-30', 6.99, 'Descripción del Trago 5', 'disponible'),
(6, 'Trago 6', 25, 3, '2024-01-10', 8.50, 'Descripción del Trago 6', 'disponible'),
(7, 'Trago 7', 8, 1, '2023-12-25', 4.75, 'Descripción del Trago 7', 'disponible'),
(8, 'Trago 8', 14, 2, '2023-11-30', 6.75, 'Descripción del Trago 8', 'disponible'),
(9, 'Trago 9', 22, 3, '2024-01-05', 7.25, 'Descripción del Trago 9', 'disponible'),
(10, 'Trago 10', 10, 1, '2023-12-31', 5.99, 'Descripción del Trago 10', 'disponible'),
(11, 'Trago 11', 15, 2, '2023-11-30', 6.49, 'Descripción del Trago 11', 'disponible'),
(12, 'Trago 12', 20, 3, '2024-01-15', 7.99, 'Descripción del Trago 12', 'disponible'),
(13, 'Trago 13', 12, 1, '2023-12-20', 5.25, 'Descripción del Trago 13', 'disponible'),
(14, 'Trago 14', 18, 2, '2023-11-30', 6.99, 'Descripción del Trago 14', 'disponible'),
(15, 'Trago 15', 25, 3, '2024-01-10', 8.50, 'Descripción del Trago 15', 'disponible'),
(16, 'Trago 16', 8, 1, '2023-12-25', 4.75, 'Descripción del Trago 16', 'disponible'),
(17, 'Trago 17', 14, 2, '2023-11-30', 6.75, 'Descripción del Trago 17', 'disponible'),
(18, 'Trago 18', 22, 3, '2024-01-05', 7.25, 'Descripción del Trago 18', 'disponible'),
(19, 'Trago 19', 10, 1, '2023-12-31', 5.99, 'Descripción del Trago 19', 'disponible'),
(20, 'Trago 20', 15, 2, '2023-11-30', 6.49, 'Descripción del Trago 20', 'disponible');


--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `numero_mesa` int(11) NOT NULL,
  `estado` varchar(20) DEFAULT 'disponible',
  `descripcion` varchar(255) DEFAULT NULL,
  `sede_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `numero_mesa`, `estado`, `descripcion`, `sede_id`) VALUES
(1, 1, 'disponible', 'Mesa 1 de Sede 1', 1),
(2, 2, 'disponible', 'Mesa 2 de Sede 1', 1),
(3, 3, 'disponible', 'Mesa 3 de Sede 1', 1),
(4, 15, 'disponible', 'Mesa 15 de Sede 1', 1),
(5, 1, 'disponible', 'Mesa 1 de Sede 2', 2),
(6, 2, 'disponible', 'Mesa 2 de Sede 2', 2),
(7, 3, 'disponible', 'Mesa 3 de Sede 2', 2),
(8, 15, 'disponible', 'Mesa 15 de Sede 2', 2),
(9, 1, 'disponible', 'Mesa 1 de Sede 3', 3),
(10, 2, 'disponible', 'Mesa 2 de Sede 3', 3),
(11, 3, 'disponible', 'Mesa 3 de Sede 3', 3),
(12, 15, 'disponible', 'Mesa 15 de Sede 3', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id`, `nombre`) VALUES
(1, 'Sede 1'),
(2, 'Sede 2'),
(3, 'Sede 3'),
(4, 'Sede 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rol` enum('administrador','cajero','mesero') NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `hora_inicio_sesion` datetime DEFAULT NULL,
  `hora_finalizacion_sesion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `direccion`, `telefono`, `email`, `rol`, `usuario`, `contrasena`, `hora_inicio_sesion`, `hora_finalizacion_sesion`) VALUES
(1, 'Jonathan (Admin)', 'Dirección de Jonathan (Admin)', '123-456-7890', 'admin@liquorease.com', 'administrador', 'admin_jonathan', '$argon2i$v=19$m=65536,t=4,p=1$R0RRbG9PWDJSWlcwazF1aA$yluEtXm9QP5nliKn/LTQqj7nLpmJqw4c+ET9EUDAXAY', '2023-11-17 03:04:56', NULL),
(2, 'Jonathan (Cajero)', 'Dirección de Jonathan (Cajero)', '987-654-3210', 'cajero@liquorease.com', 'cajero', 'cajero_jonathan', '$argon2i$v=19$m=65536,t=4,p=1$NnRDMnplRUMua2xCbDdkdg$X2PfMNdLiAccLTLco9wfQNeQgHOAv2D+LyM7vLXY5Yw', '2023-11-17 03:09:52', NULL),
(3, 'Jonathan (Mesero)', 'Dirección de Jonathan (Mesero)', '555-123-4567', 'mesero@liquorease.com', 'mesero', 'mesero_jonathan', '$argon2i$v=19$m=65536,t=4,p=1$V2Y1cHdRby5SVUhSVWhCSQ$nr7UanVCWsaqKGfC3wvK3Ik1p/4Erjeu54gQ71VfOy4', '2023-11-17 03:10:05', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `informe_ventas`
--
ALTER TABLE `informe_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `informe_ventas`
--
ALTER TABLE `informe_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD CONSTRAINT `mesas_ibfk_1` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
