-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2024 a las 01:13:46
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
-- Base de datos: `sistema_gestion_inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `idarticulo` int(11) NOT NULL,
  `nombre_articulo` varchar(55) NOT NULL,
  `stock` varchar(55) DEFAULT NULL,
  `precio_unitario` decimal(20,2) DEFAULT NULL,
  `codigo` varchar(255) NOT NULL,
  `categoria` int(11) NOT NULL,
  `unidad_referencia` varchar(55) DEFAULT NULL,
  `zona_deposito` varchar(55) DEFAULT NULL,
  `stock_minimo` int(11) DEFAULT NULL,
  `proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`idarticulo`, `nombre_articulo`, `stock`, `precio_unitario`, `codigo`, `categoria`, `unidad_referencia`, `zona_deposito`, `stock_minimo`, `proveedor`) VALUES
(12, 'Articulo Prueba', '8', 4.99, '5896855', 7, 'Unidad', 'FESSW457', 10, 12),
(13, 'Articulo de Prueba 2', '3', 6.00, '778965845', 8, 'Unidad', 'FRE7896', 5, 12),
(14, 'Prueba 10', '15', 78.00, '58968774', 8, 'Unidad', 'FRE8968', 10, 12),
(15, 'Articulo Prueba 15', '44', 79.00, '8968965', 8, 'Unidad', 'FRES8966', 50, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nombre`) VALUES
(7, 'PRUEBA '),
(8, 'PRUEBA 1'),
(9, 'PRUEBA 2'),
(10, 'PRUEBA 3'),
(13, 'PRUEBA 6'),
(14, 'PRUEBA 7'),
(16, 'PRUEBA 8'),
(18, 'PRUEBA 9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_proveedores`
--

CREATE TABLE `categorias_proveedores` (
  `idcategoria_proveedor` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_proveedores`
--

INSERT INTO `categorias_proveedores` (`idcategoria_proveedor`, `idproveedor`, `idcategoria`) VALUES
(54, 12, 7),
(55, 12, 8),
(56, 12, 9),
(57, 12, 10),
(58, 12, 13),
(59, 12, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `id_lote` int(11) NOT NULL,
  `codigo_articulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_lote` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id_lote`, `codigo_articulo`, `descripcion`, `fecha_lote`) VALUES
(1, '58968774', 'Lote por Defecto', '2024-06-29'),
(2, '58968774', 'Lote de Prueba ', '2024-07-31'),
(4, '58968774', 'Lote de Prueba 2', '2024-08-02'),
(5, '5896855', 'Lote de Prueba', '2024-08-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idproveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(55) NOT NULL,
  `domicilio` varchar(55) NOT NULL,
  `numero_telefono` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `numero_cuit` varchar(55) DEFAULT NULL,
  `persona_contacto` varchar(55) DEFAULT NULL,
  `forma_pago` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idproveedor`, `nombre_proveedor`, `domicilio`, `numero_telefono`, `email`, `numero_cuit`, `persona_contacto`, `forma_pago`) VALUES
(12, 'Prueba Proveedor 1', '   Inventada 895, Junín Buenos Aires', '   5896578965', 'proveedor1@mail.com', '   866324475', '   Contacto Prueba 1', '  Efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `idtipo_usuario` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idtipo_usuario`, `tipo`) VALUES
(1, 'administrador'),
(2, 'basico'),
(3, 'empleado'),
(4, 'dep_rr_hh');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre_de_usuario` varchar(55) NOT NULL,
  `rol` int(11) NOT NULL,
  `avatar` varchar(11) NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `telefono` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre_de_usuario`, `rol`, `avatar`, `domicilio`, `telefono`, `email`) VALUES
(71, 'Matias Jose Di Carlo', 1, '1', '', '', 'matiasdicarlo342@gmail.com'),
(72, 'Juan Perez', 2, '3', 'Inventado 355 Junín- Buenos Aires', '02352543616', 'jp@mail.com'),
(74, 'Camila Lopez', 2, '4', '   Inventado 425 Junín- Buenos Aires', '02352543616', 'camila@mail.com'),
(75, 'Matias Di Carlo', 1, '3', 'Inventado 425 Junín- Buenos Aires', '02352543616', 'limonsoft342@gmail.com'),
(76, 'Matias Di Carlo Unnoba', 2, '3', 'Inventado 425 Junín- Buenos Aires', '02352543616', 'mdicarlo@comunidad.unnoba.edu.ar'),
(77, 'Matias Acuña ', 2, '6', 'Sargento Cabral 112, Pergamino (B)', '02474445720', 'acunamatias27@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`idarticulo`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `proveedor` (`proveedor`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `categorias_proveedores`
--
ALTER TABLE `categorias_proveedores`
  ADD PRIMARY KEY (`idcategoria_proveedor`),
  ADD KEY `idproveedor` (`idproveedor`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id_lote`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`idtipo_usuario`),
  ADD UNIQUE KEY `idtipo_usuario_UNIQUE` (`idtipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`,`rol`) USING BTREE,
  ADD UNIQUE KEY `id_usuario` (`idusuario`) USING BTREE,
  ADD KEY `fk_tipo_usuario` (`rol`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `idarticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `categorias_proveedores`
--
ALTER TABLE `categorias_proveedores`
  MODIFY `idcategoria_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `idtipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`idcategoria`),
  ADD CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`proveedor`) REFERENCES `proveedores` (`idproveedor`);

--
-- Filtros para la tabla `categorias_proveedores`
--
ALTER TABLE `categorias_proveedores`
  ADD CONSTRAINT `categorias_proveedores_ibfk_2` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categorias_proveedores_ibfk_3` FOREIGN KEY (`idproveedor`) REFERENCES `proveedores` (`idproveedor`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `tipo_usuario` (`idtipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
