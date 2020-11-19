-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-11-2020 a las 14:48:04
-- Versión del servidor: 8.0.20
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bellojardin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calles`
--

CREATE TABLE `calles` (
  `id` int NOT NULL,
  `nombre` varchar(160) NOT NULL DEFAULT '',
  `id_sector` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  `cedula` varchar(15) NOT NULL DEFAULT '',
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `cedula`, `telefono`, `direccion`, `created_at`, `updated_at`) VALUES
(1, 'Maria Robles Martes', '00145853208', '8095243620', 'Calle 27 de febrero, Distrito nacional', '2019-11-18 20:11:48', '2019-11-18 20:12:11'),
(2, 'Pablo Ruiz', '01800756325', '8093625891', 'Zona oriental parque del prado #2', '2019-11-18 20:12:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condiciones`
--

CREATE TABLE `condiciones` (
  `id` int NOT NULL,
  `nombre` varchar(40) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `condiciones`
--

INSERT INTO `condiciones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Nuevo', '2019-11-18 20:13:36', '0000-00-00 00:00:00'),
(2, 'Usado', '2019-11-18 20:13:40', '0000-00-00 00:00:00'),
(3, 'En construcción', '2019-11-18 20:13:45', '0000-00-00 00:00:00'),
(4, 'Incautado', '2019-11-18 20:13:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deducibles`
--

CREATE TABLE `deducibles` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo_calculo` varchar(20) NOT NULL,
  `deducir` decimal(11,2) NOT NULL DEFAULT '0.00',
  `aumentar` decimal(11,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `deducibles`
--

INSERT INTO `deducibles` (`id`, `nombre`, `tipo_calculo`, `deducir`, `aumentar`, `created_at`, `updated_at`) VALUES
(1, 'Deducible 1', 'fijo', '10.00', '0.00', '2019-11-18 20:26:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_clientes`
--

CREATE TABLE `direccion_clientes` (
  `id_calle` int NOT NULL,
  `id_cliente` int NOT NULL,
  `informacion` varchar(200) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_inmuebles`
--

CREATE TABLE `direccion_inmuebles` (
  `id_calle` int NOT NULL DEFAULT '0',
  `id_inmueble` int NOT NULL DEFAULT '0',
  `informacion` varchar(200) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extras`
--

CREATE TABLE `extras` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo_calculo` varchar(20) NOT NULL,
  `deducir` decimal(11,2) NOT NULL DEFAULT '0.00',
  `aumentar` decimal(11,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `extras`
--

INSERT INTO `extras` (`id`, `nombre`, `tipo_calculo`, `deducir`, `aumentar`, `created_at`, `updated_at`) VALUES
(3, 'Extra 1', 'fijo', '0.00', '100.00', '2019-11-18 20:26:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE `inmuebles` (
  `id` int NOT NULL,
  `nombre` varchar(60) NOT NULL DEFAULT '',
  `tamano` decimal(11,2) NOT NULL DEFAULT '0.00',
  `banos` int NOT NULL DEFAULT '0',
  `parqueos` int NOT NULL DEFAULT '0',
  `habitaciones` int NOT NULL DEFAULT '0',
  `precio` decimal(11,2) NOT NULL DEFAULT '0.00',
  `direccion` varchar(200) NOT NULL,
  `id_condicion` int NOT NULL,
  `id_tipos_inmuebles` int NOT NULL,
  `id_cliente` int NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id`, `nombre`, `tamano`, `banos`, `parqueos`, `habitaciones`, `precio`, `direccion`, `id_condicion`, `id_tipos_inmuebles`, `id_cliente`, `created_at`, `updated_at`) VALUES
(1, 'Propiedad de maria robles', '72.00', 2, 2, 4, '1800000.00', 'Prolongación 27 de febrero, distrito nacional', 1, 2, 1, '2019-11-18 20:18:44', '0000-00-00 00:00:00'),
(2, 'Edificio AB', '150.00', 20, 10, 30, '7800000.00', 'Calle AB Uasd', 2, 1, 1, '2019-11-26 02:22:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles_materiales`
--

CREATE TABLE `inmuebles_materiales` (
  `id_material` int NOT NULL,
  `id_inmueble` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles_materiales`
--

INSERT INTO `inmuebles_materiales` (`id_material`, `id_inmueble`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-11-18 20:20:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales_construccion`
--

CREATE TABLE `materiales_construccion` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo_calculo` varchar(20) NOT NULL,
  `deducir` decimal(11,2) NOT NULL DEFAULT '0.00',
  `aumentar` decimal(11,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materiales_construccion`
--

INSERT INTO `materiales_construccion` (`id`, `nombre`, `tipo_calculo`, `deducir`, `aumentar`, `created_at`, `updated_at`) VALUES
(1, 'Ladrillos', 'porciento', '10.00', '0.00', '2019-11-18 20:14:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `id_provincia` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`, `id_provincia`, `created_at`, `updated_at`) VALUES
(1, 'Distrito Nacional', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Azua de Compostela', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Estebanía', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Guayabal', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Las Charcas', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Las Yayas de Viajama', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Padre Las Casas', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Peralta', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Pueblo Viejo', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Sabana Yegua', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Tábara Arriba', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Neiba', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Galván', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Los Ríos', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Tamayo', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Villa Jaragua', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Barahona', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Cabral', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'El Peñón', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Enriquillo', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Fundación', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Jaquimeyes', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'La Ciénaga', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Las Salinas', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Paraíso', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Polo', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Vicente Noble', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Dajabón', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'El Pino', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Loma de Cabrera', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Partido', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Restauración', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'San Francisco de Macorís', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Arenoso', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Castillo', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Eugenio María de Hostos', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Las Guáranas', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Pimentel', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Villa Riva', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'El Seibo', 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Miches', 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Comendador', 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Bánica', 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'El Llano', 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Hondo Valle', 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Juan Santiago', 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Pedro Santana', 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Moca', 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Cayetano Germosén', 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Gaspar Hernández', 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Jamao al Norte', 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Hato Mayor del Rey', 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'El Valle', 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Sabana de la Mar', 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Salcedo', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Tenares', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Villa Tapia', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Jimaní', 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Cristóbal', 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Duvergé', 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'La Descubierta', 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Mella', 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Postrer Río', 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Higüey', 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'San Rafael del Yuma', 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'La Romana', 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Guaymate', 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Villa Hermosa', 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'La Concepción de La Vega', 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Constanza', 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Jarabacoa', 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Jima Abajo', 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Nagua', 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'Cabrera', 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'El Factor', 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'Río San Juan', 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'Bonao', 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'Maimón', 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'Piedra Blanca', 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Montecristi', 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Castañuela', 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Guayubín', 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Las Matas de Santa Cruz', 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Pepillo Salcedo', 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Villa Vásquez', 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Monte Plata', 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Bayaguana', 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Peralvillo', 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Sabana Grande de Boyá', 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Yamasá', 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Pedernales', 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Oviedo', 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Baní', 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Nizao', 21, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Puerto Plata', 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Altamira', 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Guananico', 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Imbert', 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'Los Hidalgos', 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'Luperón', 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'Sosúa', 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'Villa Isabela', 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'Villa Montellano', 22, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'Samaná', 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'Las Terrenas', 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Sánchez', 23, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'San Cristóbal', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'Bajos de Haina', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Cambita Garabito', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'Los Cacaos', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'Sabana Grande de Palenque', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'San Gregorio de Nigua', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'Villa Altagracia', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'Yaguate', 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'San José de Ocoa', 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'Rancho Arriba', 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'Sabana Larga', 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'San Juan de la Maguana', 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'Bohechío', 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'El Cercado', 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'Juan de Herrera', 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'Las Matas de Farfán', 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Vallejuelo', 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'San Pedro de Macorís', 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Consuelo', 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Guayacanes', 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Quisqueya', 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Ramón Santana', 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'San José de Los Llanos', 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Cotuí', 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Cevicos', 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Fantino', 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'La Mata', 24, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'Santiago', 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'Bisonó', 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'Jánico', 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Licey al Medio', 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'Puñal', 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'Sabana Iglesia', 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'San José de las Matas', 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'Tamboril', 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'Villa González', 29, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'San Ignacio de Sabaneta', 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'Los Almácigos', 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'Monción', 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'Santo Domingo Este', 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'Boca Chica', 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Los Alcarrizos', 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'Pedro Brand', 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'San Antonio de Guerra', 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'Santo Domingo Norte', 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'Santo Domingo Oeste', 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'Mao', 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'Esperanza', 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'Laguna Salada', 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polizas`
--

CREATE TABLE `polizas` (
  `id` int NOT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_final` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_inmueble` int NOT NULL,
  `id_seguro` int NOT NULL,
  `id_deducible` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `polizas`
--

INSERT INTO `polizas` (`id`, `subtotal`, `total`, `fecha_inicio`, `fecha_final`, `id_inmueble`, `id_seguro`, `id_deducible`, `created_at`, `updated_at`) VALUES
(1, '1290.00', '1290.00', '2019-11-18 04:00:00', '2020-11-18 04:00:00', 1, 1, 1, '2019-11-18 20:31:37', '0000-00-00 00:00:00'),
(3, '5690.00', '5690.00', '2019-11-25 04:00:00', '2020-11-25 04:00:00', 2, 2, 1, '2019-11-26 02:23:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polizas_extras`
--

CREATE TABLE `polizas_extras` (
  `id_extra` int NOT NULL,
  `id_poliza` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `polizas_extras`
--

INSERT INTO `polizas_extras` (`id_extra`, `id_poliza`, `created_at`, `updated_at`) VALUES
(3, 3, '2019-11-26 02:23:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Azua', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Bahoruco', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Barahona', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Dajabón', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Distrito Nacional', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Duarte', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Elías Piña', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'El Seibo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Espaillat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Hato Mayor', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Hermanas Mirabal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Independencia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'La Altagracia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'La Romana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'La Vega', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'María Trinidad Sánchez', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Monseñor Nouel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Monte Cristi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Monte Plata', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Pedernales', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Peravia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Puerto Plata', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Samaná', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Sánchez Ramírez', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'San Cristóbal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'San José de Ocoa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'San Juan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'San Pedro de Macorís', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Santiago', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Santiago Rodríguez', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Santo Domingo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Valverde', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `id` int NOT NULL,
  `nombre` varchar(60) NOT NULL DEFAULT '',
  `id_municipio` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguros`
--

CREATE TABLE `seguros` (
  `id` int NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `costo` decimal(11,2) NOT NULL,
  `informacion` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seguros`
--

INSERT INTO `seguros` (`id`, `nombre`, `costo`, `informacion`, `created_at`, `updated_at`) VALUES
(1, 'Seguro Basico', '1200.00', 'Informacion', '2019-11-18 20:27:47', '0000-00-00 00:00:00'),
(2, 'Plan VIP', '5600.00', 'El mejor de todos', '2019-11-26 02:23:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos_clientes`
--

CREATE TABLE `telefonos_clientes` (
  `id` int NOT NULL,
  `numero` int NOT NULL DEFAULT '0',
  `id_cliente` int NOT NULL,
  `id_tipo_telefono` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_inmuebles`
--

CREATE TABLE `tipos_inmuebles` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_inmuebles`
--

INSERT INTO `tipos_inmuebles` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Apartamento', '2019-11-18 20:14:48', '0000-00-00 00:00:00'),
(2, 'Casa', '2019-11-18 20:14:51', '0000-00-00 00:00:00'),
(3, 'Finca', '2019-11-18 20:14:55', '0000-00-00 00:00:00'),
(4, 'Solar', '2019-11-18 20:14:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_telefonos`
--

CREATE TABLE `tipos_telefonos` (
  `id` int NOT NULL,
  `nombre` varchar(60) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(80) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `password` text NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `is_show` text NOT NULL COMMENT 'Se muestra la contraseña aqui',
  `rol_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`, `status`, `is_show`, `rol_id`, `created_at`, `updated_at`) VALUES
(1, 'Ever Cuevas', 'evercuevas1000@gmail.com', '8293993299', '5179ac87b0d5b9b508a7e6b0af458575be893a7e', 1, 'admin', 1, '2019-11-18 15:52:12', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calles`
--
ALTER TABLE `calles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CALLE_SEC` (`id_sector`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `condiciones`
--
ALTER TABLE `condiciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `deducibles`
--
ALTER TABLE `deducibles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `direccion_clientes`
--
ALTER TABLE `direccion_clientes`
  ADD PRIMARY KEY (`id_calle`,`id_cliente`),
  ADD KEY `FK_DIR_CLIEN_CLE` (`id_cliente`);

--
-- Indices de la tabla `direccion_inmuebles`
--
ALTER TABLE `direccion_inmuebles`
  ADD PRIMARY KEY (`id_calle`,`id_inmueble`),
  ADD UNIQUE KEY `id_inmueble` (`id_inmueble`);

--
-- Indices de la tabla `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_INM_CONDICI` (`id_condicion`),
  ADD KEY `FK_INM_TIP_INMUE` (`id_tipos_inmuebles`),
  ADD KEY `FK_INM_CLIENTES` (`id_cliente`);

--
-- Indices de la tabla `inmuebles_materiales`
--
ALTER TABLE `inmuebles_materiales`
  ADD PRIMARY KEY (`id_material`,`id_inmueble`),
  ADD KEY `FK_INMUEMAT_INMUE` (`id_inmueble`);

--
-- Indices de la tabla `materiales_construccion`
--
ALTER TABLE `materiales_construccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_MUNICIPIO_PRO` (`id_provincia`);

--
-- Indices de la tabla `polizas`
--
ALTER TABLE `polizas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_POLIZA_INMUE` (`id_inmueble`),
  ADD KEY `FK_POLIZA_SEGURO` (`id_seguro`),
  ADD KEY `FK_POLIZA_DEDUCI` (`id_deducible`);

--
-- Indices de la tabla `polizas_extras`
--
ALTER TABLE `polizas_extras`
  ADD PRIMARY KEY (`id_extra`,`id_poliza`),
  ADD KEY `FK_PE_POLIZA` (`id_poliza`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_SECTOR_MUNIC` (`id_municipio`);

--
-- Indices de la tabla `seguros`
--
ALTER TABLE `seguros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `telefonos_clientes`
--
ALTER TABLE `telefonos_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_TCC` (`id_cliente`),
  ADD KEY `FK_TCTT` (`id_tipo_telefono`);

--
-- Indices de la tabla `tipos_inmuebles`
--
ALTER TABLE `tipos_inmuebles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_telefonos`
--
ALTER TABLE `tipos_telefonos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK` (`email`),
  ADD UNIQUE KEY `UK_PHONE` (`phone`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calles`
--
ALTER TABLE `calles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `condiciones`
--
ALTER TABLE `condiciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `deducibles`
--
ALTER TABLE `deducibles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materiales_construccion`
--
ALTER TABLE `materiales_construccion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de la tabla `polizas`
--
ALTER TABLE `polizas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguros`
--
ALTER TABLE `seguros`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `telefonos_clientes`
--
ALTER TABLE `telefonos_clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_inmuebles`
--
ALTER TABLE `tipos_inmuebles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipos_telefonos`
--
ALTER TABLE `tipos_telefonos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calles`
--
ALTER TABLE `calles`
  ADD CONSTRAINT `FK_CALLE_SEC` FOREIGN KEY (`id_sector`) REFERENCES `sectores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `direccion_clientes`
--
ALTER TABLE `direccion_clientes`
  ADD CONSTRAINT `FK_DIR_CLIEN_CALL` FOREIGN KEY (`id_calle`) REFERENCES `calles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DIR_CLIEN_CLE` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `direccion_inmuebles`
--
ALTER TABLE `direccion_inmuebles`
  ADD CONSTRAINT `FK_DIR_INBLUE_CALL` FOREIGN KEY (`id_calle`) REFERENCES `calles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DIR_INBLUE_CLE` FOREIGN KEY (`id_inmueble`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD CONSTRAINT `FK_INM_CLIENTES` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_INM_CONDICI` FOREIGN KEY (`id_condicion`) REFERENCES `condiciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_INM_TIP_INMUE` FOREIGN KEY (`id_tipos_inmuebles`) REFERENCES `tipos_inmuebles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inmuebles_materiales`
--
ALTER TABLE `inmuebles_materiales`
  ADD CONSTRAINT `FK_INMUEMAT_INMUE` FOREIGN KEY (`id_inmueble`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_INMUEMAT_MAT` FOREIGN KEY (`id_material`) REFERENCES `materiales_construccion` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `FK_MUNICIPIO_PRO` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `polizas`
--
ALTER TABLE `polizas`
  ADD CONSTRAINT `FK_POLIZA_DEDUCI` FOREIGN KEY (`id_deducible`) REFERENCES `deducibles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_POLIZA_INMUE` FOREIGN KEY (`id_inmueble`) REFERENCES `inmuebles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_POLIZA_SEGURO` FOREIGN KEY (`id_seguro`) REFERENCES `seguros` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `polizas_extras`
--
ALTER TABLE `polizas_extras`
  ADD CONSTRAINT `FK_PE_EXTRA` FOREIGN KEY (`id_extra`) REFERENCES `extras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_PE_POLIZA` FOREIGN KEY (`id_poliza`) REFERENCES `polizas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD CONSTRAINT `FK_SECTOR_MUNIC` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `telefonos_clientes`
--
ALTER TABLE `telefonos_clientes`
  ADD CONSTRAINT `FK_TCC` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_TCTT` FOREIGN KEY (`id_tipo_telefono`) REFERENCES `tipos_telefonos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
