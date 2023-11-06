-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2023 a las 08:20:13
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
  `Dificultad` varchar(32) NOT NULL DEFAULT 'Facil',
  `Utilizada` tinyint(1) NOT NULL,
  `contador_respuestas_correctas` int(11) NOT NULL DEFAULT 0,
  `contador_respuestas_incorrectas` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`Pregunta_ID`, `Pregunta_texto`, `Tematica_ID`, `Dificultad`, `Utilizada`, `contador_respuestas_correctas`, `contador_respuestas_incorrectas`) VALUES
(1, '¿Cuál es el resultado de 2 + 2?', 1, 'Facil', 0, 23, 1),
(2, '¿Quién fue el primer presidente de Estados Unidos?', 2, 'Facil', 0, 21, 8),
(3, '¿Cuál es el símbolo químico del oxígeno?', 3, 'Facil', 0, 26, 1),
(4, '¿Cuál es la capital de Francia?', 4, 'Facil', 0, 25, 4),
(5, '¿Cuanto es 15 multiplicado por 4?', 5, 'Medio', 0, 8, 1),
(6, '¿En qué año se fundó la ONU?', 6, 'Medio', 0, 6, 5),
(7, '¿Cuál es el símbolo químico del agua?', 7, 'Facil', 0, 7, 1),
(8, '¿En qué continente se encuentra Egipto?', 8, 'Medio', 0, 5, 2),
(9, '¿Cuál es la raíz cuadrada de 25?', 9, 'Facil', 0, 1, 0),
(10, '¿Quién escribió la Declaración de Independencia de los Estados Unidos?', 10, 'Medio', 0, 0, 1),
(11, '¿Cuál es el número atómico del carbono?', 11, 'Dificil', 0, 1, 4),
(12, '¿Cuál es el río más largo del mundo?', 12, 'Facil', 0, 2, 0),
(13, '¿Cuánto es 12 dividido por 4?', 13, 'Facil', 0, 1, 0),
(14, '¿En qué año se fundó la Organización de las Naciones Unidas (ONU)?', 14, 'Medio', 0, 2, 1),
(15, '¿Cuál es el símbolo químico del sodio?', 15, 'Dificil', 0, 2, 2),
(16, '¿Cuál es la montaña más alta del mundo?', 16, 'Facil', 0, 1, 0),
(28, '¿Cuál es el planeta más grande del sistema solar?', NULL, 'Facil', 0, 0, 0),
(29, '¿Cuál es el río más largo del mundo?', NULL, 'Facil', 0, 0, 0),
(36, 'cual es una medida de distancia', NULL, 'Facil', 0, 0, 0),
(37, 'Prueba1?', NULL, 'Facil', 0, 0, 0),
(38, 'Prueba2?', NULL, 'Facil', 0, 0, 0);

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
  `aprobada` tinyint(1) NOT NULL DEFAULT 0,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `Respuesta_ID` int(11) NOT NULL,
  `Pregunta_ID` int(11) NOT NULL,
  `correcta` tinyint(1) NOT NULL DEFAULT 0,
  `Respuesta_texto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`Respuesta_ID`, `Pregunta_ID`, `correcta`, `Respuesta_texto`) VALUES
(1, 1, 1, '4'),
(2, 1, 0, '5'),
(127, 1, 0, '3'),
(128, 1, 0, '6'),
(169, 2, 1, 'George Washington'),
(170, 2, 0, 'Thomas Jefferson'),
(171, 2, 0, 'Abraham Lincoln'),
(172, 2, 0, 'Benjamin Franklin'),
(176, 3, 1, 'O'),
(177, 3, 0, 'H'),
(178, 3, 0, 'C'),
(179, 3, 0, 'N'),
(183, 4, 0, 'Berlín'),
(184, 4, 0, 'Madrid'),
(185, 4, 1, 'París'),
(186, 4, 0, 'Londres'),
(191, 5, 1, '60'),
(192, 5, 0, '50'),
(193, 5, 0, '45'),
(194, 5, 0, '55'),
(198, 6, 1, '1945'),
(199, 6, 0, '1939'),
(200, 6, 0, '1955'),
(201, 6, 0, '1960'),
(205, 7, 0, 'O2'),
(206, 7, 0, 'CO2'),
(207, 7, 0, 'H2SO4'),
(208, 7, 1, 'H2O'),
(212, 8, 1, 'África'),
(213, 8, 0, 'Asia'),
(214, 8, 0, 'Europa'),
(215, 8, 0, 'América'),
(219, 9, 1, '5'),
(220, 9, 0, '4'),
(221, 9, 0, '6'),
(222, 9, 0, '7'),
(226, 10, 1, 'Thomas Jefferson'),
(227, 10, 0, 'George Washington'),
(228, 10, 0, 'Benjamin Franklin'),
(229, 10, 0, 'John Adams'),
(233, 11, 1, '6'),
(234, 11, 0, '12'),
(235, 11, 0, '8'),
(236, 11, 0, '14'),
(240, 12, 1, 'El río Amazonas'),
(241, 12, 0, 'El río Nilo'),
(242, 12, 0, 'El río Misisipi'),
(243, 12, 0, 'El río Yangtsé'),
(247, 13, 1, '3'),
(248, 13, 0, '4'),
(249, 13, 0, '2'),
(250, 13, 0, '5'),
(254, 14, 1, '1945'),
(255, 14, 0, '1918'),
(256, 14, 0, '1955'),
(257, 14, 0, '1960'),
(261, 15, 1, 'Na'),
(262, 15, 0, 'So'),
(263, 15, 0, 'Sa'),
(264, 15, 0, 'Ni'),
(268, 16, 1, 'El monte Everest'),
(269, 16, 0, ''),
(270, 16, 0, 'El monte Fuji'),
(271, 16, 0, 'El monte McKinley'),
(311, 36, 1, 'metros'),
(312, 36, 0, 'litros'),
(313, 36, 0, 'kilos'),
(314, 36, 0, 'libras'),
(318, 37, 1, 'si'),
(319, 37, 0, 'no'),
(320, 37, 0, 'no'),
(321, 37, 0, 'no'),
(325, 38, 1, 'si'),
(326, 38, 0, 'no'),
(327, 38, 0, 'no'),
(328, 38, 0, 'no');

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
  `rol` varchar(1) NOT NULL DEFAULT 'u',
  `latitud` varchar(100) DEFAULT NULL,
  `longitud` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `ano_nacimiento`, `sexo`, `pais`, `ciudad`, `correo_electronico`, `contrasena`, `nombre_usuario`, `foto_perfil`, `puntuacion_actual`, `puntuacion_masalta`, `activo`, `fecha_registro`, `contador_respuestas_correctas`, `contador_respuestas_incorrectas`, `nivel`, `rol`) VALUES
(1, 'Shushu', '0000-00-00', 'Masculino', 'Argentina', 'Buenos Aires', 'ashfa@gmail.com', 'test1', '123456', '', 0, 2, 0, '2023-10-09 16:51:43', 2, 1, 'Principiante', 'u'),
(2, 'Usuario Test', '0000-00-00', '', 'Argentina', 'Villa Luzuriaga', 'test@test.com', '123456', 'test', '', 0, 0, 0, '2023-10-09 17:13:47', 0, 0, 'Principiante', 'u'),
(3, 'Ain Ponce', '1995-08-09', 'Masculino', 'Argentina', 'Buenos Aires', 'ponce.ain@gmail.com', '123456', 'ainponce', '', 0, 9, 0, '2023-10-09 17:53:18', 7, 2, 'Principiante', 'e'),
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
  ADD PRIMARY KEY (`Pregunta_ID`),
  ADD KEY `tematicaID` (`Tematica_ID`);

--
-- Indices de la tabla `preguntas_sugeridas`
--
ALTER TABLE `preguntas_sugeridas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`Respuesta_ID`) USING BTREE,
  ADD KEY `Pregunta_ID` (`Pregunta_ID`) USING BTREE;

--
-- Indices de la tabla `tematicas`
--
ALTER TABLE `tematicas`
  ADD PRIMARY KEY (`Tematica_ID`);

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
  MODIFY `Pregunta_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `preguntas_sugeridas`
--
ALTER TABLE `preguntas_sugeridas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `Respuesta_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `tematicaID` FOREIGN KEY (`Tematica_ID`) REFERENCES `tematicas` (`Tematica_ID`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `preguntaID` FOREIGN KEY (`Pregunta_ID`) REFERENCES `preguntas` (`Pregunta_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
