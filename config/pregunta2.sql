-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2023 a las 22:45:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pregunta2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `Pregunta_ID` int(11) NOT NULL,
  `Pregunta_texto` text NOT NULL,
  `Tematica_ID` int(11) DEFAULT NULL,
  `Dificultad` varchar(32) NOT NULL,
  `Puntos` int(11) DEFAULT NULL,
  `Utilizada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`Pregunta_ID`, `Pregunta_texto`, `Tematica_ID`, `Dificultad`, `Puntos`, `Utilizada`) VALUES
(1, '¿Cuál es el resultado de 2 + 2?', 1, 'Fácil', 10, 0),
(2, '¿Quién fue el primer presidente de Estados Unidos?', 2, 'Medio', 15, 0),
(3, '¿Cuál es el símbolo químico del oxígeno?', 3, 'Difícil', 20, 0),
(4, '¿Cuál es la capital de Francia?', 4, 'Fácil', 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `Respuesta_ID` int(11) NOT NULL,
  `Tematica_ID` int(11) DEFAULT NULL,
  `Respuesta_texto` varchar(255) NOT NULL,
  `Correcta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`Respuesta_ID`, `Tematica_ID`, `Respuesta_texto`, `Correcta`) VALUES
(1, 1, '4', 1),
(2, 1, '5', 0),
(3, 1, '3', 0),
(4, 1, '6', 0),
(5, 2, 'George Washington', 1),
(6, 2, 'Thomas Jefferson', 0),
(7, 2, 'Abraham Lincoln', 0),
(8, 2, 'Benjamin Franklin', 0),
(9, 3, 'O', 1),
(10, 3, 'H', 0),
(11, 3, 'C', 0),
(12, 3, 'N', 0),
(13, 4, 'Berlín', 0),
(14, 4, 'Madrid', 0),
(15, 4, 'París', 1),
(16, 4, 'Londres', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tematicas`
--

CREATE TABLE `tematicas` (
  `Tematica_ID` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tematicas`
--

INSERT INTO `tematicas` (`Tematica_ID`, `Nombre`) VALUES
(1, 'Matemáticas'),
(2, 'Historia'),
(3, 'Ciencias'),
(4, 'Geografía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `ano_nacimiento` date NOT NULL,
  `sexo` enum('Masculino','Femenino','Prefiero no cargarlo') NOT NULL,
  `pais` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `foto_perfil` blob DEFAULT NULL,
  `puntuacion_actual` int(11) NOT NULL,
  `puntuacion_masalta` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `ano_nacimiento`, `sexo`, `pais`, `ciudad`, `correo_electronico`, `contrasena`, `nombre_usuario`, `foto_perfil`, `puntuacion_actual`, `puntuacion_masalta`, `activo`, `fecha_registro`) VALUES
(1, 'Shushu', '0000-00-00', 'Masculino', 'Argentina', 'Buenos Aires', 'ashfa@gmail.com', 'test1', '123456', '', 0, 0, 0, '2023-10-09 16:51:43'),
(2, 'Usuario Test', '0000-00-00', '', 'Argentina', 'Villa Luzuriaga', 'test@test.com', '123456', 'test', '', 0, 0, 0, '2023-10-09 17:13:47'),
(3, 'Ain Ponce', '1995-08-09', 'Masculino', 'Argentina', 'Buenos Aires', 'ponce.ain@gmail.com', '123456', 'ainponce', '', 0, 0, 0, '2023-10-09 17:53:18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
