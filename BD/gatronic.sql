-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2024 a las 04:09:29
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
(1, 'Gerardo Manuel', 'Barrera Barca', 'df@udg.mx', '4d186321c1a7f0f354b297e8914ab240', 1, '2d32a12a37fb5df7435b5ef81f96e861.jpeg', '2d32a12a37fb5df7435b5ef81f96e861.jpeg', 1, 0),
(2, 'Sebastián ', 'Reyes ', 'reyes@gmail.com', '958a74a4695ec722416c949165fd7c50', 1, 'a9f2e9cb304f353ca3bd733d6d438eb0.jpeg', 'descargar (1).jpeg', 1, 0),
(3, 'German', 'Garmindi', 'hola@gmail.com', 'a6d414ac4f293187dd042025834925f7', 2, 'd88abf720b2be4649cf3fd7cf7fde3a4.jpeg', 'descargar (2).jpeg', 1, 0),
(4, 'Fernando', 'De la Barranca', 'acantilado@gmail.com', 'ab2e9cc6b0b38268340a8ea698d525a8', 1, '6244e1af7d19dc4fc261795878271ef4.jpeg', 'descargar (3).jpeg', 1, 0),
(5, 'Octavio', 'Paz', 'tavio@gmail.com', 'e003268a052a053ee5ec481e2a097648', 1, 'e767b45fa03d0edbb13f0bf5cdc458a2.jpeg', 'descargar (4).jpeg', 1, 0),
(6, 'Sofía', 'Estrada', 'sofi@gmail.com', '17da1ae431f965d839ec8eb93087fb2b', 2, 'a5b73e55dc8e6c40fe9fdc970450bbfe.jpeg', 'descargar (5).jpeg', 1, 0),
(7, 'Maricarmen', 'Maciel', 'mari@gmail.com', '74028300cc4d75a9a2d4d67f0e9097c7', 1, 'b1656bc00b1a7997e731ec08b212ed79.jpeg', 'descargar (7).jpeg', 1, 0),
(8, 'Teresa', 'De la Barrera', 'tere@gmail.com', '5f0cbc3f99acb914d429cfdf23dd75e3', 1, 'f58176fe457f73905eddda41ad3a2eea.jpeg', 'descargar (8).jpeg', 1, 0),
(9, 'Adela', 'Rivera', 'dela@gmail.com', 'bbad14bc2a2ddb9244a72058cddf15cb', 2, '62fd130e55743e9620e41ccef76114c7.jpeg', 'descargar (6).jpeg', 1, 0),
(10, 'Luz María', 'Bermu', 'luz@gmail.com', '4a45763fb8832658b8cfdf27bba1bd77', 1, '1f2066a405b7a026b308f5f90e0f737a.jpeg', 'descargar (9).jpeg', 1, 0);

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
(4, '2024-04-15 11:04:41', 2, 1),
(5, '2024-04-16 04:50:41', 1, 0),
(6, '2024-04-19 03:43:28', 10, 0),
(7, '2024-04-19 03:45:14', 8, 0),
(8, '2024-04-19 03:46:39', 9, 1);

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
(42, 4, 4, 3, 4511),
(45, 5, 1, 1, 499),
(46, 5, 5, 4, 8999),
(47, 5, 10, 6, 130),
(48, 5, 12, 10, 39890),
(49, 5, 13, 1, 39999),
(50, 5, 21, 1, 1869),
(51, 6, 14, 1, 10239),
(52, 6, 7, 1, 23999),
(53, 6, 17, 1, 8649),
(54, 6, 2, 5, 2727),
(56, 6, 9, 3, 298),
(57, 7, 20, 1, 899),
(58, 7, 5, 1, 8999),
(59, 7, 19, 1, 5129),
(60, 7, 15, 1, 15999),
(61, 7, 1, 1, 499),
(62, 7, 11, 8, 2264),
(67, 8, 16, 1, 2789),
(68, 8, 18, 1, 9429),
(69, 8, 12, 1, 39890),
(70, 8, 8, 1, 3499),
(71, 8, 7, 2, 23999),
(72, 8, 1, 10, 499),
(73, 8, 13, 2, 39999);

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
(5, 'Laptop Lenovo Ideapad Slim 3 15.6\' Ci5 8gb + 512gb Ssd', '23242525', 'Laptop panorámica de 15.6 pulgadas equipado con procesadores Intel Core de 12.a generación. La configuración te permite optimizar el rendimiento, prolongar la duración de la batería y mantener el sistema más ventilado. Gracias a la tecnología de carga rápida, puedes trabajar más tiempo sin enchufarlo. Inicio de sesión y arranque instantáneos. Fantástico para las videollamadas: cámara web con obturador de privacidad, Dolby Audio y cancelación de ruido.\r\n\r\nIntel Core i5-12450H 12.a generación\r\nMemoria ram 8GB LPDDR5.\r\nDisco duro 512GB SSD M.2\r\n\r\nConexiones: 1x Lector de tarjetas, 1x HDMI 1.4, 1 x Conector combinado de auriculares/micrófono (3.5mm), 1 x Conector de alimentación, 1x USB-C 3.2 Gen 1 (admite transferencia de datos, Power Delivery y DisplayPort 1.2) , 2 x USB 3.2 Gen 1.\r\n\r\nTeclado en español, incluye la letra \"Ñ\".', 8999, 12, '1a8a6c4eccee955916c22dc52568f5c2.webp', 'laptop4.webp', 1, 0),
(6, 'Apple iPhone 15 (128 GB) - Negro', '23242545', 'Memoria RAM: 6 GB\r\nLa Dynamic Island te muestra alertas y actividades en vivo\r\nDiseño innovador con pantalla Super Retina XDR\r\nCámara gran angular de 48 MP con teleobjetivo de 2x\r\nRetratos de última generación\r\nSuperpotente chip A16 Bionic\r\nConexión USB-C\r\nFuncionalidad esencial de seguridad con detección de choques para pedir ayuda\r\nCon tecnologías de privacidad que te ayudan a mantener el control de tus datos', 13283, 50, '21e922eccc27c065cbf16c9aedc0d1fd.webp', 'D_NQ_NP_2X_779617-MLA71782867320_092023-F.webp', 1, 0),
(7, 'Apple iPhone 15 Pro (128 GB) - Titanio Natural', '23242598', 'Memoria RAM: 8 GB\r\nDiseño resistente y ligero\r\nPantalla Super Retina XDR con ProMotion con frecuencia de actualización hasta 120 Hz\r\nLa Dynamic Island muestra alertas y actividades en vivo al instante\r\nSistema de cámaras pro de super alta resolución\r\nBotón de acción personalizable para ir a tu funcionalidad favorita\r\nCon conector USB-C y WiFi 6 con el doble de velocidad\r\nFuncionalidad esencial de seguridad con detección de choques para pedir ayuda\r\nCon tecnologías de privacidad que te ayudan a mantener el control de tus datos', 23999, 34, '8ccaf647f8ece51c7a642b2fe29cadf8.webp', 'D_NQ_NP_2X_878826-MLA71783168396_092023-F.webp', 1, 0),
(8, 'Apple AirPods (3ª generación) con caja de carga MagSafe 1', '23242558', 'Audio espacial con seguimiento dinámico de la cabeza para un sonido envolvente(1).\r\nEcualización Adaptativa que ajusta la música automáticamente según la forma de tus oídos.\r\nUn nuevo diseño con ajuste anatómico.\r\nSensor de fuerza para controlar con facilidad lo que escuchas, responder o finalizar llamadas y mucho más.\r\nResistencia al agua y al sudor(3).\r\nHasta 6 horas de audio con una sola carga(2).\r\nHasta 30 horas de audio en total con el estuche de carga MagSafe(2).\r\nAcceso rápido a Siri con sólo decir “Oye Siri”(4).\r\nFácil configuración, detección de uso y cambio automático de dispositivo para una experiencia mágica(5).\r\nComparte fácilmente lo que estás escuchando entre dos pares de AirPods conectados a tu iPhone, iPad, iPod touch o Apple TV.', 3499, 17, '35762eade4391591c72cfb22a0061ad5.webp', 'D_NQ_NP_2X_703128-MLA48697190741_122021-F.webp', 1, 0),
(9, 'Audífonos gamer inalámbricos Emuael Bluetooth 8S B08ND51MX8', '23242532', 'Con micrófono incorporado.\r\nEl largo del cable es de 3.5mm.\r\nSonido superior y sin límites.\r\nCómodos y prácticos.', 298, 100, '18301a9965129dcc0665cdedafc0e41b.webp', 'D_NQ_NP_2X_707731-MLU73841910149_012024-F.webp', 1, 0),
(10, 'Audífonos in-ear gamer Time4buy 2xPro X2pro negro', '23242596', 'Con micrófono incorporado.\r\nEl largo del cable es de 1.2m.\r\nSonido superior y sin límites.\r\nCómodos y prácticos.', 130, 234, '7bed67fff23b899e120498f9956ae3da.webp', 'D_NQ_NP_2X_960053-MLA71545191629_092023-F.webp', 1, 0),
(11, 'Audífonos Beats Solo3 Wireless - Negro', '23242538', 'Conéctate a tu dispositivo mediante la tecnología Bluetooth® Class 1 para escuchar de forma inalámbrica.\r\nEl sonido y diseño galardonados que amas de Beats.\r\nHasta 40 horas de batería para usarlos todo el día.\r\nCon Fast Fuel, 5 minutos de carga son suficientes para obtener 3 horas de reproducción cuando la batería está baja.\r\nAjustables, con almohadillas acolchadas para más comodidad y uso diario.\r\nDiseño estilizado y elegante, duradero y plegable para ir contigo a todos lados.\r\nRecibe llamadas, controla tu música y activa Siri (2) con los controles multifunción sobre la oreja.', 2264, 55, '93f3195b79f012efb89504ef493950cf.webp', 'D_NQ_NP_2X_744290-MLU75834816007_042024-F.webp', 1, 0),
(12, 'Apple Macbook Pro (16 pulgadas, Intel Core i7, 512 GB de SSD, 16 GB de RAM, AMD Radeon Pro 5300M) - Gris espacial', '232425916', 'Tarjeta gráfica: AMD Radeon Pro 5300M\r\nSistema operativo: macOS\r\nCapacidad de disco SSD: 512 GB\r\nMemoria RAM: 16 GB\r\nProcesador Intel Core i7 de 6 núcleos o Intel Core i9 de 8 núcleos de novena generación.\r\nBrillante pantalla Retina de 16 pulgadas con tecnología True Tone (1).\r\nTouch Bar y Touch ID.\r\nProcesador gráfico AMD Radeon Pro 5300M o 5500M con memoria GDDR6.\r\nSSD ultrarrápido.\r\nIntel UHD Graphics 630.', 39890, 10, '9abda7a878efb77961f822ed2cca8a49.webp', 'D_NQ_NP_2X_797873-MLA48708091504_122021-F.webp', 1, 0),
(13, 'MacBook Pro Pro gris Apple Core i5 A4 8GB de RAM 1 TB SSD 8GB Optane, 5300M 60 Hz 3024x1964px macOS Sierra Pro', '23242599', 'Procesador Apple Core i5.\r\nMemoria RAM de 8GB.\r\nResolución de 3024x1964 px.\r\nTarjeta gráfica 5300M.', 39999, 9, 'ede7a50aa76dc9874d9724adc808f8b0.webp', 'D_NQ_NP_2X_624593-MLA74327742885_012024-F.webp', 1, 0),
(14, 'Laptop Lenovo IdeaPad L340-15API abyss blue 15.6\", AMD Ryzen 5 3500U 8GB de RAM 2TB HDD, AMD Radeon RX Vega 8 1366x768px Windows', '23242586', 'Sistema operativo: Windows 10 Home\r\nCapacidad del disco duro: 2 TB\r\nProcesador AMD Ryzen 5.\r\nMemoria RAM de 8GB.\r\nPantalla LED de 15.6\".\r\nResolución de 1366x768 px.\r\nEs antirreflejo.\r\nTarjeta gráfica AMD Radeon RX Vega 8.\r\nConexión wifi y bluetooth.\r\nCuenta con 3 puertos USB y puerto HDMI.\r\nPosee pad numérico.\r\nModo de sonido Dolby Digital.', 10239, 27, 'e0a93487ba8a8d0348ac774075068f1b.webp', 'D_NQ_NP_2X_668478-MLU73128540870_122023-F.webp', 1, 0),
(15, 'Laptop Asus Tuf Fx506 RTX 3050 Ci5 8gb 512gb Fx506hc-hn101w', '23242583', 'Con pantalla táctil: No Procesador: Intel Core i5 I5-11400H Sistema operativo: Windows 11 Home Capacidad de disco SSD: 512 GB Procesador Intel Core i5. Memoria RAM de 8GB. Pantalla LCD de 15.6\". Es antirreflejo. Tarjeta gráfica NVIDIA GeForce RTX 3050. Conexión wifi y bluetooth. Cuenta con 4 puertos USB y puerto HDMI. Modo de sonido Stereo. Con teclado retroiluminado.', 15999, 23, '06dba3cb90b1b6d9f6cc81832706ebd6.webp', 'D_NQ_NP_2X_879990-MLA73983306180_012024-F.webp', 1, 0),
(16, 'Nintendo Lite Switch Lite 32GB Standard color coral', '23242572', 'Capacidad: 32 GB\r\nEs portátil, ideal para llevar a donde quieras y jugar con tus amistades y familia.\r\nIncluye control.\r\nResolución de 1920 px x 1080 px.\r\nMemoria RAM de 4GB.\r\nTiene pantalla táctil.\r\nCuenta con: 1 adaptador de corriente.', 2789, 5, '05d26d2538a104c6584c05745d0f7ae9.webp', 'D_NQ_NP_2X_659239-MLU69972232487_062023-F.webp', 1, 0),
(17, 'Consola Microsoft Xbox Series X 1tb Ssd 4k 120hz Disco Negro', '23242574', 'Capacidad: 1 TB\r\nIncluye control.\r\nResolución de 7680 px x 4320 px.\r\nMemoria RAM de 16GB.\r\nCuenta con: 1 cable hdmi.', 8649, 45, 'ab16125c7fbe90ec55c069857aeb6331.webp', 'D_NQ_NP_2X_942133-MLA74651936102_022024-F.webp', 1, 0),
(18, 'Consola Playstation 5 Sony Slim Standard 1tb', '232425764', 'Capacidad: 1 TB\r\nIncluye control.\r\nMemoria RAM de 16GB.\r\nCuenta con: control inalámbrico dualsense base.', 9429, 16, '48d94f10a23766cedbeb5ece08844d29.webp', 'D_NQ_NP_2X_765553-MLU73326247921_122023-F.webp', 1, 0),
(19, 'Nintendo Switch Oled 64gb Standard Color Rojo Neón Color Rojo Neón/azul Neón/negro', '23242595', 'Capacidad: 64 GB\r\n Incluye 2 controles.\r\nResolución de 1920 px x 1080 px.\r\nMemoria RAM de 4GB.\r\nTiene pantalla táctil.', 5129, 150, '131ef2156f7f88dac06efffe40a9c112.webp', 'D_NQ_NP_2X_989383-MLU70320451445_072023-F.webp', 1, 0),
(20, 'Nintendo Game & Watch Super Mario Bros. color rojo y dorado', '23242501', 'Es portátil, ideal para llevar a donde quieras y jugar con tus amistades y familia.\r\nIncluye control.\r\nCuenta con: 1 cable usb-c.\r\nLa duración de la batería depende del uso que se le dé al producto...', 899, 599, 'bd8ce8e79ea4813e4d5251087d25c4ab.webp', 'D_NQ_NP_2X_882318-MLU72677134943_112023-F.webp', 1, 0),
(21, 'Nintendo Super NES Classic Edition 512MB Standard color gris y violeta', '23242502', 'Capacidad: 512 MB\r\n Incluye 2 controles.\r\nResolución de 1280 px x 720 px.\r\nMemoria RAM de 256MB.\r\nConsola clásica de Nintendo.\r\nCuenta con: 1 cable hdmi.', 1869, 1, 'b4da50eb74c5dd894caf2ed7b0f32663.webp', 'D_NQ_NP_2X_922126-MLA32731490477_112019-F.webp', 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
