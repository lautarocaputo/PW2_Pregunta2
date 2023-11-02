-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2023 a las 03:00:47
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
  `Utilizada` tinyint(1) NOT NULL,
  `contador_respuestas_correctas` int(11) NOT NULL DEFAULT 0,
  `contador_respuestas_incorrectas` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`Pregunta_ID`, `Pregunta_texto`, `Tematica_ID`, `Dificultad`, `Utilizada`, `contador_respuestas_correctas`, `contador_respuestas_incorrectas`) VALUES
(1, '¿Cuál es el resultado de 2 + 2?', 1, 'Facil', 0, 23, 1),
(2, '¿Quién fue el primer presidente de Estados Unidos?', 2, 'Facil', 0, 20, 8),
(3, '¿Cuál es el símbolo químico del oxígeno?', 3, 'Facil', 0, 25, 1),
(4, '¿Cuál es la capital de Francia?', 4, 'Facil', 0, 24, 4),
(9, '¿Cuanto es 15 multiplicado por 4?', 5, 'Medio', 0, 8, 1),
(10, '¿En qué año se fundó la ONU?', 6, 'Dificil', 0, 5, 4),
(11, '¿Cuál es el símbolo químico del agua?', 7, 'Facil', 0, 7, 1),
(12, '¿En qué continente se encuentra Egipto?', 8, 'Medio', 0, 5, 2),
(13, '¿Cuál es la raíz cuadrada de 25?', 9, 'Facil', 0, 1, 0),
(14, '¿Quién escribió la Declaración de Independencia de los Estados Unidos?', 10, 'Medio', 0, 0, 0),
(15, '¿Cuál es el número atómico del carbono?', 11, 'Dificil', 0, 1, 4),
(16, '¿Cuál es el río más largo del mundo?', 12, 'Facil', 0, 1, 0),
(17, '¿Cuánto es 12 dividido por 4?', 13, 'Facil', 0, 0, 0),
(18, '¿En qué año se fundó la Organización de las Naciones Unidas (ONU)?', 14, 'Medio', 0, 0, 1),
(19, '¿Cuál es el símbolo químico del sodio?', 15, 'Dificil', 0, 1, 2),
(20, '¿Cuál es la montaña más alta del mundo?', 16, 'Facil', 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_reportadas`
--

CREATE TABLE `preguntas_reportadas` (
  `id_pregunta_reportada` int(11) NOT NULL,
  `motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas_reportadas`
--

INSERT INTO `preguntas_reportadas` (`id_pregunta_reportada`, `motivo`) VALUES
(1, ''),
(3, ''),
(4, ''),
(3, ''),
(2, ''),
(2, ''),
(14, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_sugeridas`
--

CREATE TABLE `preguntas_sugeridas` (
  `pregunta` varchar(255) NOT NULL,
  `respuesta_correcta` varchar(255) NOT NULL,
  `primera_respuesta_incorrecta` varchar(255) NOT NULL,
  `segunda_respuesta_incorrecta` varchar(255) NOT NULL,
  `tercera_respuesta_incorrecta` varchar(255) NOT NULL,
  `aprobada` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas_sugeridas`
--

INSERT INTO `preguntas_sugeridas` (`pregunta`, `respuesta_correcta`, `primera_respuesta_incorrecta`, `segunda_respuesta_incorrecta`, `tercera_respuesta_incorrecta`, `aprobada`) VALUES
('¿Cuál es el planeta más grande del sistema solar?', 'Júpiter', 'Marte', 'Venus', 'Saturno', 0),
('¿Cuál es el río más largo del mundo?', 'El río Amazonas', 'El río Nilo', 'El río Misisipi', 'El río Yangtsé', 0),
('quien es el mascapito?', 'alan', 'ain', 'lautoro', 'guido', 0);

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
(16, 4, 'Londres', 0),
(17, 5, '60', 1),
(18, 5, '50', 0),
(19, 5, '45', 0),
(20, 5, '55', 0),
(21, 6, '1945', 1),
(22, 6, '1939', 0),
(23, 6, '1955', 0),
(24, 6, '1960', 0),
(26, 7, 'O2', 0),
(27, 7, 'CO2', 0),
(28, 7, 'H2SO4', 0),
(29, 8, 'África', 1),
(30, 8, 'Asia', 0),
(31, 8, 'Europa', 0),
(32, 8, 'América', 0),
(33, 7, 'H2O', 1),
(37, 9, '5', 1),
(38, 9, '4', 0),
(39, 9, '6', 0),
(40, 9, '7', 0),
(41, 10, 'Thomas Jefferson', 1),
(42, 10, 'George Washington', 0),
(43, 10, 'Benjamin Franklin', 0),
(44, 10, 'John Adams', 0),
(45, 11, '6', 1),
(46, 11, '12', 0),
(47, 11, '8', 0),
(48, 11, '14', 0),
(49, 12, 'El río Amazonas', 1),
(50, 12, 'El río Nilo', 0),
(51, 12, 'El río Misisipi', 0),
(52, 12, 'El río Yangtsé', 0),
(53, 13, '3', 1),
(54, 13, '4', 0),
(55, 13, '2', 0),
(56, 13, '5', 0),
(57, 14, '1945', 1),
(58, 14, '1918', 0),
(59, 14, '1955', 0),
(60, 14, '1960', 0),
(61, 15, 'Na', 1),
(62, 15, 'So', 0),
(63, 15, 'Sa', 0),
(64, 15, 'Ni', 0),
(65, 16, 'El monte Everest', 1),
(66, 16, 'El monte Kilimanjaro', 0),
(67, 16, 'El monte Fuji', 0),
(68, 16, 'El monte McKinley', 0);

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
(4, 'Geografía'),
(5, 'Matemáticas'),
(6, 'Historia'),
(7, 'Química'),
(8, 'Geografía'),
(9, 'Matemáticas'),
(10, 'Historia'),
(11, 'Química'),
(12, 'Geografía'),
(13, 'Matemáticas'),
(14, 'Historia'),
(15, 'Química'),
(16, 'Geografía');

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
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `contador_respuestas_correctas` int(11) NOT NULL DEFAULT 0,
  `contador_respuestas_incorrectas` int(11) NOT NULL DEFAULT 0,
  `nivel` varchar(32) NOT NULL,
  `rol` varchar(1) NOT NULL DEFAULT 'u'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `ano_nacimiento`, `sexo`, `pais`, `ciudad`, `correo_electronico`, `contrasena`, `nombre_usuario`, `foto_perfil`, `puntuacion_actual`, `puntuacion_masalta`, `activo`, `fecha_registro`, `contador_respuestas_correctas`, `contador_respuestas_incorrectas`, `nivel`, `rol`) VALUES
(1, 'Shushu', '0000-00-00', 'Masculino', 'Argentina', 'Buenos Aires', 'ashfa@gmail.com', 'test1', '123456', '', 0, 0, 0, '2023-10-09 16:51:43', 0, 0, 'Principiante', 'u'),
(2, 'Usuario Test', '0000-00-00', '', 'Argentina', 'Villa Luzuriaga', 'test@test.com', '123456', 'test', '', 0, 0, 0, '2023-10-09 17:13:47', 0, 0, 'Principiante', 'u'),
(3, 'Ain Ponce', '1995-08-09', 'Masculino', 'Argentina', 'Buenos Aires', 'ponce.ain@gmail.com', '123456', 'ainponce', '', 0, 9, 0, '2023-10-09 17:53:18', 0, 1, 'Principiante', 'e'),
(4, 'asd', '4222-03-12', 'Masculino', 'asd', 'asd', 'lautaro0611@gmail.com', 'asd', 'asd', '', 0, 8, 0, '2023-10-28 15:27:50', 11, 8, 'Intermedio', 'a'),
(6, '123', '3222-03-12', 'Masculino', '123', '123', '123@123.com', '123', '123', '', 0, 0, 0, '2023-10-28 15:49:20', 0, 0, 'Principiante', 'u'),
(7, 'aaa', '1232-03-12', 'Masculino', 'aa', 'aa', 'aa@aa.com', 'aaa', 'aaa', '', 0, 0, 0, '2023-10-28 16:29:59', 0, 0, 'Principiante', 'u');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`Pregunta_ID`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`Respuesta_ID`);

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
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `Pregunta_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `Respuesta_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
