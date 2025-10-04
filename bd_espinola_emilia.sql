-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2025 a las 06:58:00
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `descripcion`, `activo`) VALUES
(1, 'Baby tees', 1),
(3, 'Minis', 1),
(5, 'Buzos', 1),
(7, 'Jeans', 1),
(9, 'Tops', 1),
(10, ' sweaters', 0),
(11, 'Musculosas', 1),
(12, 'Camisas', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id_colores` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `codigo_hex` varchar(7) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id_colores`, `nombre`, `codigo_hex`, `estado`) VALUES
(1, 'rojo', '#ff0000', 0),
(2, 'negro', '#000000', 1),
(3, 'blanco', '#ffffff', 1),
(4, 'Bordo', '#7a0b0b', 1),
(5, 'Azul', '#080746', 1),
(6, 'Celeste', '#70b8f0', 1),
(7, 'Verde pantano', '#078a05', 1),
(8, 'Amarillo pastel', '#f9f6ae', 1),
(9, 'Marrón', '#4e3532', 1),
(10, 'Gris claro', '#aeadad', 1);

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
  `resuelto` tinyint(2) NOT NULL DEFAULT 0,
  `activo` tinyint(4) NOT NULL DEFAULT 1,
  `telefono` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `nombre_apellido`, `email`, `motivo`, `mensaje`, `resuelto`, `activo`, `telefono`) VALUES
(1, 'Emilia Espinola', 'espinolaemilia865@gmail.com', 'Comprar', 'Hola!, como realizo una compra?', 1, 1, '0'),
(5, 'Andrea', 'andreaRivera878@gmail.com', 'Comprar', 'como comprar?', 1, 0, '0'),
(9, 'Andrea Maleni', 'andreamaleni781@gmail.com', 'Más info', 'Hola necesito saber más sobre la calidad de las ropas, y cuanto tarda el envió aproximadamente.', 0, 1, '3794774978'),
(10, 'Matías Fernández', 'fernandezmatias@gmail.com', 'Más info', 'Holaa. tienen local?', 1, 1, '3794774978'),
(11, 'Sebastian Colaneri', 'sebastianUWU56@gmail.com', 'no tengo', 'Puedo retirar mi pedido en el local o hacen envíos en moto en la ciudad?', 0, 1, '3794545678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfiles` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `imagen`, `categoria_id`, `precio`, `stock`, `estado`, `descripcion`) VALUES
(75, 'Minifaldas', '1753993583_fdbba5bda3cb4db8b035.webp', 3, 5000.00, 59, 1, ''),
(76, 'Falda sastrera', '1759175218_89386bb0c46d4b5c1804.webp', 3, 25000.00, 2, 1, 'Falda sastrera con  short abajo.'),
(77, 'baby  tee estampa', '1753994033_9805437b73b9dd0b00be.webp', 1, 20000.00, 4, 1, ''),
(78, 'Top estraple', '1753994203_e8c8ed98bec7507fc170.webp', 9, 25000.00, 60, 1, ''),
(79, 'Buzo a rayas', '1753994275_3546dc6fdc31d17d067d.webp', 5, 40000.00, 10, 1, ''),
(80, 'Blusas', '1753994390_78c808bb241b2dbd9bec.webp', 9, 17000.00, 42, 1, ''),
(81, 'Remera', '1753994486_8f7c89901e5cb98792d6.webp', 9, 23000.00, 0, 1, ''),
(82, 'chombas', '1753994550_91cf049be95e9d47aa73.webp', 9, 12000.00, 8, 1, ''),
(83, 'Short baquero', '1753994897_cd4cf95b6143a98929f7.webp', 7, 24000.00, 1, 1, 'Short engomado estilo baquero, talle único.'),
(84, 'Top argolla', '1758300778_ed1ab42f3232a3d3e615.webp', 9, 19900.00, 23, 1, ''),
(87, 'Short de volados', '1758303751_fba7252f452688ca8fba.webp', 3, 30000.00, 27, 1, ''),
(88, 'Short pollera', '1759175412_c9dd3397e3afce909656.webp', 3, 3600.00, 0, 1, 'Short pollera de Jeans mezquilla - Talle único.'),
(89, 'Musculosas Tachas', '1759175801_f69274bc56d9fd49d797.webp', 11, 18900.00, 19, 1, ''),
(90, 'Musculosas a rayas', '1759175991_f7260710ac1b3eb89687.webp', 11, 16900.00, 35, 1, ''),
(91, 'Bodys tiras', '1759176703_9ecfa8fb893afc606617.webp', 11, 22000.00, 18, 1, ''),
(92, 'Short jeans', '1759176852_3242d98e5edb35cdba13.webp', 7, 40000.00, 9, 1, 'Short de jeans tiro bajo.'),
(93, 'Tops encaje', '1759176971_bcb9ce58a3019917d9d6.webp', 9, 27000.00, 29, 1, ''),
(98, 'Mini jeans', '1759546414_f61d115cb86ebcd33a44.webp', 7, 23999.00, 12, 1, 'Mini de jeans tiro bajo.'),
(102, 'Musculosa Morley', '1759546954_af9e61fcdbc0a8a9364a.webp', 11, 3999.00, 9, 1, 'kj');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_detalle`
--

CREATE TABLE `productos_detalle` (
  `id_producto` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `talle_id` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `color_id` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_detalle`
--

INSERT INTO `productos_detalle` (`id_producto`, `producto_id`, `talle_id`, `stock`, `color_id`, `estado`) VALUES
(32, 75, 2, 30, 2, 1),
(33, 75, 1, 16, 2, 1),
(34, 76, 1, 2, 2, 1),
(36, 77, 1, 1, 3, 1),
(37, 77, 3, 3, 2, 1),
(38, 78, 2, 22, 2, 1),
(39, 78, 3, 38, 2, 1),
(40, 80, 2, 15, 2, 1),
(41, 80, 1, 14, 2, 1),
(42, 80, 2, 13, 3, 1),
(43, 82, 2, 3, 3, 1),
(44, 82, 4, 5, 2, 1),
(48, 84, 6, 10, 4, 1),
(49, 87, 6, 27, 3, 1),
(50, 84, 6, 13, 2, 1),
(58, 75, 2, 13, 3, 1),
(60, 89, 6, 9, 8, 1),
(61, 89, 6, 10, 9, 1),
(62, 90, 1, 20, 2, 1),
(63, 90, 1, 15, 4, 1),
(64, 91, 1, 6, 3, 1),
(65, 91, 1, 7, 9, 1),
(66, 91, 1, 5, 8, 1),
(67, 92, 7, 9, 9, 1),
(68, 93, 6, 8, 3, 1),
(69, 93, 6, 1, 7, 1),
(70, 93, 6, 10, 2, 1),
(71, 93, 6, 10, 4, 1),
(72, 102, 2, 9, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talles`
--

CREATE TABLE `talles` (
  `id_talle` int(11) NOT NULL,
  `talle` varchar(50) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `talles`
--

INSERT INTO `talles` (`id_talle`, `talle`, `estado`) VALUES
(1, 'L', 1),
(2, 'M', 1),
(3, 'X', 1),
(4, 'XL', 1),
(5, 'XXL', 0),
(6, 'Unico', 1),
(7, '38', 1),
(8, '40', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `perfil_id` int(11) NOT NULL DEFAULT 2,
  `estado` tinyint(2) NOT NULL DEFAULT 1,
  `carrito` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `pass`, `perfil_id`, `estado`, `carrito`) VALUES
(19, 'Emilia Espinola', 'espinolaemilia8@gmail.com', '$2y$10$Lc7gyUdHg.PaA.x53rIT2uF3ruHV.jpYL3oAMWy1ymSQvJJdCjXLS', 2, 1, '{\"70\":{\"id_detalle_producto\":\"70\",\"cantidad\":2,\"nombre\":\"Tops encaje\",\"talle\":\"Unico\",\"color\":\"negro\",\"imagen\":\"1759176971_bcb9ce58a3019917d9d6.webp\",\"precio\":\"27000.00\",\"producto_id\":\"93\"},\"68\":{\"id_detalle_producto\":\"68\",\"cantidad\":\"1\",\"nombre\":\"Tops encaje\",\"talle\":\"Unico\",\"color\":\"blanco\",\"imagen\":\"1759176971_bcb9ce58a3019917d9d6.webp\",\"precio\":\"27000.00\",\"producto_id\":\"93\"}}'),
(20, 'Emilia Rivero', 'espinolaemilia86@gmail.com', '$2y$10$pEEZ9NgUnABAV7pNDv/sluku3dh03uOUfatD7PZH7aDKNCBC.Q676', 2, 1, '0'),
(21, 'Sofia González', 'espinolaemilia4@gmail.com', '$2y$10$6ORUY7zRqTECpcSn.mvPmeWhtnO8hgirLEvbPR1dGFrv25UDEZ2jG', 2, 0, '0'),
(22, 'María José', 'espinolaemilia45@gmail.com', '$2y$10$BexaKkjyLvdpNxh7FFkIoeIskyfSSSVa5pGhdWYfAt3/8QM2t.N/G', 2, 1, '{\"48\":{\"id_detalle_producto\":\"48\",\"cantidad\":\"1\",\"nombre\":\"Top argolla\",\"talle\":\"Unico\",\"color\":\"Bordo\",\"imagen\":\"1758300778_ed1ab42f3232a3d3e615.webp\",\"precio\":\"19900.00\",\"producto_id\":\"84\"}}'),
(23, 'Josefina Emilia', 'joseespinola4@gmail.com', '$2y$10$SGMhKBSoPcOompg716q58.21Sai/K9OsH8Yg8foBXd41BkhwJZipC', 1, 1, '0'),
(24, 'Ramírez Martina', 'martinaramirez@gmail.com', '$2y$10$j4MhmYfI6pH3ye6tsUaMm.io.a3MQPcfZU0fK.xwhUcDNw5EUHbAe', 2, 1, ''),
(25, 'Fran Exequiel', 'espinolafran889@gmail.com', '$2y$10$7kWkz3DrynfJqN9P6kJd0.vSvzYOy//yq1sLkVx0OgFXZpYHtG8WC', 2, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cabecera`
--

CREATE TABLE `ventas_cabecera` (
  `id_ventas` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `hora` time NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `total_venta` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_cabecera`
--

INSERT INTO `ventas_cabecera` (`id_ventas`, `fecha`, `hora`, `usuario_id`, `total_venta`) VALUES
(29, '2025-09-28', '00:21:00', 19, 53900.00),
(30, '2025-09-28', '00:21:24', 19, 60000.00),
(31, '2025-09-28', '00:21:50', 19, 117000.00),
(32, '2025-09-28', '00:22:15', 19, 5000.00),
(33, '2025-09-28', '00:23:24', 19, 24000.00),
(34, '2025-09-29', '16:13:42', 19, 49000.00),
(35, '2025-09-29', '17:24:34', 22, 67000.00),
(36, '2025-09-29', '17:25:33', 22, 60900.00),
(37, '2025-09-29', '17:26:07', 22, 22500.00),
(38, '2025-09-30', '02:19:58', 19, 100000.00),
(39, '2025-09-30', '21:35:33', 19, 111000.00),
(40, '2025-10-04', '00:19:19', 22, 51997.00),
(41, '2025-10-04', '00:19:35', 22, 20000.00),
(42, '2025-10-04', '00:29:42', 22, 3600.00),
(43, '2025-10-04', '00:29:45', 22, 3600.00),
(44, '2025-10-04', '00:44:02', 22, 3600.00),
(45, '2025-10-04', '00:58:20', 22, 3600.00),
(46, '2025-10-04', '01:03:19', 22, 3600.00),
(47, '2025-10-04', '01:09:17', 22, 37800.00),
(48, '2025-10-04', '01:09:34', 22, 18900.00),
(49, '2025-10-04', '01:10:30', 22, 25000.00),
(50, '2025-10-04', '01:11:02', 22, 25000.00),
(51, '2025-10-04', '01:16:05', 22, 27000.00),
(52, '2025-10-04', '01:16:15', 22, 27000.00),
(53, '2025-10-04', '01:16:56', 22, 24000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `subtotal` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio`, `subtotal`) VALUES
(31, 29, 80, 2, 17000.00, 34000.00),
(32, 29, 84, 1, 19900.00, 19900.00),
(33, 30, 87, 2, 30000.00, 60000.00),
(34, 31, 81, 4, 23000.00, 92000.00),
(35, 31, 78, 1, 25000.00, 25000.00),
(36, 32, 75, 1, 5000.00, 5000.00),
(37, 33, 83, 1, 24000.00, 24000.00),
(38, 34, 80, 2, 17000.00, 34000.00),
(39, 34, 75, 3, 5000.00, 15000.00),
(40, 35, 92, 1, 40000.00, 40000.00),
(41, 35, 93, 1, 27000.00, 27000.00),
(42, 36, 91, 1, 22000.00, 22000.00),
(43, 36, 91, 1, 22000.00, 22000.00),
(44, 36, 90, 1, 16900.00, 16900.00),
(45, 37, 89, 1, 18900.00, 18900.00),
(46, 37, 88, 1, 3600.00, 3600.00),
(47, 38, 91, 3, 22000.00, 66000.00),
(48, 38, 80, 2, 17000.00, 34000.00),
(49, 39, 93, 3, 27000.00, 81000.00),
(50, 39, 87, 1, 30000.00, 30000.00),
(51, 40, 102, 1, 3999.00, 3999.00),
(52, 40, 98, 2, 23999.00, 47998.00),
(53, 41, 77, 1, 20000.00, 20000.00),
(54, 47, 89, 2, 18900.00, 37800.00),
(55, 48, 89, 1, 18900.00, 18900.00),
(56, 49, 78, 1, 25000.00, 25000.00),
(57, 50, 78, 1, 25000.00, 25000.00),
(58, 51, 93, 1, 27000.00, 27000.00),
(59, 52, 93, 1, 27000.00, 27000.00),
(60, 53, 83, 1, 24000.00, 24000.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id_colores`),
  ADD KEY `nombre` (`nombre`);

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
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `productos_detalle`
--
ALTER TABLE `productos_detalle`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `talle_id` (`talle_id`),
  ADD KEY `productos_detalle_ibfk_3` (`producto_id`);

--
-- Indices de la tabla `talles`
--
ALTER TABLE `talles`
  ADD PRIMARY KEY (`id_talle`),
  ADD UNIQUE KEY `talle` (`talle`);

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id_colores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfiles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `productos_detalle`
--
ALTER TABLE `productos_detalle`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `talles`
--
ALTER TABLE `talles`
  MODIFY `id_talle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `productos_detalle`
--
ALTER TABLE `productos_detalle`
  ADD CONSTRAINT `productos_detalle_ibfk_1` FOREIGN KEY (`color_id`) REFERENCES `colores` (`id_colores`),
  ADD CONSTRAINT `productos_detalle_ibfk_2` FOREIGN KEY (`talle_id`) REFERENCES `talles` (`id_talle`),
  ADD CONSTRAINT `productos_detalle_ibfk_3` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_producto`);

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
  ADD CONSTRAINT `ventas_detalle_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas_cabecera` (`id_ventas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
