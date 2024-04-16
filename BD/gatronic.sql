-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-04-2024 a las 09:45:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gatronic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `correo`, `pass`) VALUES
(1, 'Juan Perez', 'juan@gmail.com', 'abc12'),
(2, 'María Rodríguez', 'maria@gmail.com', 'xyz34'),
(3, 'Carlos López', 'carlos@gmail.com', 'def56'),
(4, 'Laura Martínez', 'laura@gmail.com', 'ghi78'),
(5, 'Pedro Sánchez', 'pedro@gmail.com', 'jkl90'),
(6, 'Ana González', 'ana@gmail.com', 'mno12'),
(7, 'Luisa Ramírez', 'luisa@gmail.com', 'pqr34'),
(8, 'Roberto Castro', 'roberto@gmail.com', 'stu56'),
(9, 'Elena Vargas', 'elena@gmail.com', 'vwx78'),
(10, 'Miguel Ruiz', 'miguel@gmail.com', 'yza01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `rol` int(1) NOT NULL,
  `archivo_n` varchar(255) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `rol`, `archivo_n`, `archivo`, `status`, `eliminado`) VALUES
(1, 'Gerardo Manuel', 'Barrera Barca', 'df@udg.mx', '4d186321c1a7f0f354b297e8914ab240', 1, '2d32a12a37fb5df7435b5ef81f96e861.jpeg', '2d32a12a37fb5df7435b5ef81f96e861.jpeg', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `id_cliente`, `status`) VALUES
(4, '2024-04-15 11:04:41', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `id_pedido`, `id_producto`, `cantidad`, `precio`) VALUES
(38, 4, 1, 10, 499),
(41, 4, 3, 2, 2526),
(42, 4, 4, 3, 4511);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `codigo` varchar(32) NOT NULL,
  `descripcion` text NOT NULL,
  `costo` float NOT NULL,
  `stock` int(11) NOT NULL,
  `archivo_n` varchar(255) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `descripcion`, `costo`, `stock`, `archivo_n`, `archivo`, `status`, `eliminado`) VALUES
(1, 'Audífonos Gamer', '23242527', 'Ideales para jugar', 499, 100, '7320dfd8451b44cc76ceb764777e6d69.jpg', 'audifonos3.jpg', 1, 0),
(2, 'Xiaomi Pocophone Poco M5s Dual Sim 256 Gb Gris 8 Gb Ram', '23242528', 'Memoria interna: 256 GB\r\n\r\n\r\nCámara trasera principal: 64 Mpx\r\n\r\n\r\nCon NFC: Sí\r\n\r\n\r\nCámara frontal principal: 13 Mpx\r\n\r\n\r\nDesbloqueo: Huella dactilar y reconocimiento facial', 2727, 15, '38b043cde100e729e6e18df7447e3a0e.jpg', 'celular (2).jpg', 1, 0),
(3, 'Celular Cubot P80 Dual Sim 256 Gb Global 8 Gb Ram 5200mah Android 13', '23242526', 'Artículo: P80\r\nSistema operativo: Android 13\r\nMemoria:\r\nRAM: 16GB(8GB+8GB Extendida).\r\nROM: 256GB.\r\nAdmite tarjeta TF de hasta 1 TB ampliada.\r\n\r\nRanura para tarjetas:\r\nDoble tarjeta Nano SIM o 1 Nano SIM y 1 tarjeta Micro/TF', 2526, 54, 'c21d2047a78f3591e00efdd31e3cfad6.webp', 'celular3.webp', 1, 0),
(4, 'Cubot KingKong 9 Dual SIM 256 GB black 12 GB RAM', '23242529', 'Fotografía profesional en tu bolsillo\r\nDescubre infinitas posibilidades para tus fotos con las 3 cámaras principales de tu equipo. Pon a prueba tu creatividad y juega con la iluminación, diferentes planos y efectos para obtener grandes resultados.\r\n\r\nAdemás, el dispositivo cuenta con cámara frontal de 32 Mpx para que puedas sacarte divertidas selfies o hacer videollamadas.\r\n\r\nCapacidad y eficiencia\r\nCon su potente procesador y memoria RAM de 12 GB tu equipo alcanzará un alto rendimiento con gran velocidad de transmisión de contenidos y ejecutará múltiples aplicaciones a la vez sin demoras.\r\n\r\nDesbloqueo veloz con tu huella digital\r\nCon el sensor de huella digital, el acceso es seguro y podrás desbloquearlo automáticamente con un toque.', 4511, 15, 'd5881872eb5785ec50a61684afdd26d1.webp', 'celular4.webp', 1, 0),
(5, 'Laptop Lenovo Ideapad Slim 3 15.6\' Ci5 8gb + 512gb Ssd', '23242525', 'Laptop panorámica de 15.6 pulgadas equipado con procesadores Intel Core de 12.a generación. La configuración te permite optimizar el rendimiento, prolongar la duración de la batería y mantener el sistema más ventilado. Gracias a la tecnología de carga rápida, puedes trabajar más tiempo sin enchufarlo. Inicio de sesión y arranque instantáneos. Fantástico para las videollamadas: cámara web con obturador de privacidad, Dolby Audio y cancelación de ruido.\r\n\r\nIntel Core i5-12450H 12.a generación\r\nMemoria ram 8GB LPDDR5.\r\nDisco duro 512GB SSD M.2\r\n\r\nConexiones: 1x Lector de tarjetas, 1x HDMI 1.4, 1 x Conector combinado de auriculares/micrófono (3.5mm), 1 x Conector de alimentación, 1x USB-C 3.2 Gen 1 (admite transferencia de datos, Power Delivery y DisplayPort 1.2) , 2 x USB 3.2 Gen 1.\r\n\r\nTeclado en español, incluye la letra \"Ñ\".', 8999, 12, '1a8a6c4eccee955916c22dc52568f5c2.webp', 'laptop4.webp', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `archivo` varchar(64) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `nombre`, `archivo`, `status`, `eliminado`) VALUES
(3, 'Promoción navideña', '5d728f5cee162822dddd8394c882fa76.jpg', 1, 0),
(4, 'hp_buen fin', '1c3ad19002b9c242549650055c281f7d.jpg', 1, 0),
(5, 'Promo hp', 'aea421f8e6218b46f22f966c7f3f8da1.jpg', 1, 0),
(6, 'Promo Samsung', '1491d95d0f5b6dbe9a196de9c2971f35.webp', 1, 1),
(7, 'Promo Hot Sale', 'cb85e48ab3fdb425891a7fe503650676.jpeg', 1, 1),
(8, 'Promo Registro', 'f99ccfd16fd6aab468fbb156d27650ca.webp', 1, 0),
(9, 'Promo Julio', 'ce92019037f5985108db44a94a7a0a2a.jpg', 1, 0),
(10, 'P', '51a3606e5544e2bc20054b0ea28e0fa5.webp', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
