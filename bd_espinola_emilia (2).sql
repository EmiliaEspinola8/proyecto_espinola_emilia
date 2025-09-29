-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2024 a las 03:08:33
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_espinola_emilia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `activo` tinyint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `descripcion`, `activo`) VALUES
(1, 'collares', 1),
(3, 'anillos', 1),
(5, 'cadenas', 1),
(7, 'aritos', 1),
(9, 'Anteojos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id_contacto` int(11) NOT NULL,
  `nombre_apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `mensaje` varchar(1000) NOT NULL,
  `resuelto` varchar(2) NOT NULL DEFAULT 'NO',
  `activo` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `nombre_apellido`, `email`, `motivo`, `mensaje`, `resuelto`, `activo`) VALUES
(1, 'Emilia Espinola', 'espinolaemilia865@gmail.com', 'Comprar', 'Hola!, como realizo una compra?', 'SI', 1),
(2, 'Jose Rivero', 'espinolaemilia865@gmail.com', 'tipo de envió', 'Hola!, realizan envíos con andreani?', 'SI', 1),
(3, 'Emilia', 'espinolaemilia865@gmail.com', 'tipo de envió', 'no se', 'SI', 1),
(5, 'Andrea', 'andreaRivera878@gmail.com', 'Comprar', 'como comprar?', 'SI', 0),
(6, 'Andrea', 'andreaRivera878@gmail.com', 'Comprar', 'wqereetyuioipñl{}', 'SI', 0),
(7, 'Andrea', 'andreaRivera878@gmail.com', 'Comprar', 'QW457ITYUYOIOI', 'SI', 0),
(8, 'Andrea', 'andreaRivera878@gmail.com', 'Comprar', 'AARTYUIUÑI{', 'SI', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfiles` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfiles`, `descripcion`) VALUES
(1, 'administrador'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_prod` int(11) NOT NULL,
  `nombre_prod` varchar(100) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `precio_vta` float(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_prod`, `nombre_prod`, `imagen`, `categoria_id`, `precio`, `precio_vta`, `stock`, `eliminado`) VALUES
(10, 'Collar de diamante', '1717372285_5f8fbb75f34443557469.webp', 1, 25000.00, 2000.00, 98, 1),
(11, 'collar', '1717372312_7be79ffa13c40b0e9892.webp', 1, 2000.00, 3000.00, 2, 1),
(12, 'Anillo cher', '1717372325_1cffd0f3a46de5c1e0f2.webp', 3, 3000.00, 4000.00, 19, 1),
(13, 'Aros  de diamantes', '1718488348_fe73573ce98e1e1e2e6f.webp', 7, 123.00, 1234.00, 225, 1),
(14, 'Aros colgantes', '1718488028_da57dc752d3ec3fa3eaa.webp', 7, 1000.00, 3500.00, 30, 1),
(15, 'Aros colgantes', '1718488028_0bb3ec6f0db1428cf43e.webp', 7, 1000.00, 3500.00, 30, 0),
(16, 'Aritos mariposa', '1718488206_644bb27632b3bd16770f.webp', 7, 2000.00, 4000.00, 8, 1),
(17, 'Collar mariposa', '1718488295_dc2b41b8e0f1334007c9.webp', 1, 4999.00, 5999.00, 25, 1),
(18, 'Collar corazón', '1718489661_9a34ec5b9307a96f305f.webp', 1, 2800.00, 3900.00, 15, 1),
(19, 'Anillo amanda', '1718489875_561dcaf656d8cceddedb.webp', 3, 4800.00, 5000.00, 12, 1),
(20, 'Anillo dana', '1718490027_a7b402d7d0a5fe7892d4.webp', 3, 7000.00, 8000.00, 5, 1),
(21, 'Anillo amber', '1718490091_bce582855a3801947dc4.webp', 3, 5000.00, 6000.00, 8, 1),
(22, 'Cadena eduarda', '1718490210_f6540e367c2738d77333.webp', 5, 4500.00, 5500.00, 20, 1),
(23, 'Cadena selena', '1718490284_0d27d18bec614d958913.webp', 5, 9000.00, 1000.00, 3, 1),
(24, 'Cadena anabella', '1718490376_9a6f2662891bdf730bca.webp', 5, 3000.00, 5000.00, 10, 1),
(25, 'Cadena emilia', '1718490504_67c352710664d8f64edb.webp', 5, 10000.00, 12000.00, 2, 1),
(26, 'Aros karen', '1718491106_218aba1e80a9ded99d42.webp', 7, 9000.00, 10200.00, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `perfil_id` int(11) NOT NULL DEFAULT 2,
  `baja` tinyint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `usuario`, `pass`, `perfil_id`, `baja`) VALUES
(4, 'sofi', 'espínola', 'sofiaMartinez@gmail.com', 'sofi', '$2y$10$nUyocTOiueGPwoaUF4hxo.lbAeeYAmgv6o8nT8/prYjSLzZSjM1d2', 1, 1),
(5, 'zaira', 'espinola', 'zairaespinola@gmail.com', 'zai', '$2y$10$9qywqh2CHTpg4e4oD9VOcOOtFWVZjhAoWlnFnPJN6KuOdozEDs3ve', 1, 1),
(6, 'sofia', 'esinol', 'correoSofia@gmail.com', 'juan', '$2y$10$xXWfwImzpY1r0PcJq236NeapBlV0bK1s3vqyLttmpMPZbUAnNCWly', 2, 1),
(7, 'emilia', 'espínola', 'espinolaemilia866@gmail.com', 'Juancho', '$2y$10$Fr0RQ8/8rmPP.DxwqJlDN.seLCgin0.qmUplMqSsasrEgrVIpn.6q', 2, 1),
(14, 'Andrea', 'Rivera', 'andreaRivera878@gmail.com', 'Andre', '$2y$10$kkFjYCIHkwyH1NKQ.RlAf.pbfegS0jfkYXoWV6ixQLB5qgUlYGWvq', 2, 0),
(16, 'damian', 'espinola', 'damianEspinola865@gmail.com', 'dami', '$2y$10$8tmZUIkkqTF6zxs9YaDbXe1xpbxMFSP9ri9U9WqKBFouaWunzGVPq', 2, 0),
(17, 'Andrea', 'Rivera', 'andreaRivera589@gmail.com', '12345678', '$2y$10$vzoj2Zpkw.0U4EIKRGZEyu0DSquMsnG18M9F.u3T5LB/fF/332YpC', 2, 1),
(18, 'Andrea', 'Rivera', 'andreaRivera899@gmail.com', '12345678', '$2y$10$yl9ce40H6FoE3GbyU9vByOe4QjE4zjLqnQxjDlSFJFpgBTzV1CgmK', 2, 1),
(19, 'emilia', 'espínola', 'espinolaemilia8@gmail.com', 'emi', '$2y$10$Lc7gyUdHg.PaA.x53rIT2uF3ruHV.jpYL3oAMWy1ymSQvJJdCjXLS', 2, 1),
(20, 'emilia', 'espínola', 'espinolaemilia86@gmail.com', 'emi', '$2y$10$pEEZ9NgUnABAV7pNDv/sluku3dh03uOUfatD7PZH7aDKNCBC.Q676', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cabecera`
--

CREATE TABLE `ventas_cabecera` (
  `id_ventas` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `total_venta` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas_cabecera`
--

INSERT INTO `ventas_cabecera` (`id_ventas`, `fecha`, `usuario_id`, `total_venta`) VALUES
(6, '2024-06-07 16:44:25', 20, 6000.00),
(7, '2024-06-07 16:50:45', 20, 4000.00),
(8, '2024-06-07 17:15:09', 20, 9000.00),
(9, '2024-06-07 17:16:46', 20, 6000.00),
(10, '2024-06-08 10:07:21', 19, 1234.00),
(11, '2024-06-08 10:14:30', 19, 1234.00),
(12, '2024-06-08 13:46:54', 16, 6170.00),
(13, '2024-06-15 18:36:40', 19, 15000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio`) VALUES
(3, 6, 10, 1, 2000.00),
(4, 6, 12, 1, 4000.00),
(5, 7, 12, 1, 4000.00),
(6, 8, 12, 9, 36000.00),
(7, 8, 10, 2, 4000.00),
(8, 8, 11, 1, 3000.00),
(9, 9, 11, 2, 6000.00),
(10, 10, 13, 1, 1234.00),
(11, 11, 13, 1, 1234.00),
(12, 12, 13, 5, 6170.00),
(13, 13, 11, 5, 15000.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfiles`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfiles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id_perfiles`);

--
-- Filtros para la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD CONSTRAINT `ventas_cabecera_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD CONSTRAINT `ventas_detalle_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas_cabecera` (`id_ventas`),
  ADD CONSTRAINT `ventas_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_prod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
