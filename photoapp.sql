-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2016 a las 12:57:35
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `photoapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albums`
--

CREATE TABLE `albums` (
  `album_id`    INT(11)      NOT NULL,
  `name`        VARCHAR(50)  NOT NULL,
  `description` varchar(200) NOT NULL,
  `fk_user_id`  INT(11)      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `albums`
--

INSERT INTO `albums` (`album_id`, `name`, `description`, `fk_user_id`) VALUES
  (19, 'Vacaciones', 'Mis vacaciones en guadalajara', 17),
  (20, 'Seminario', 'Seminario de ingenieria de software', 17),
  (21, 'San Andres', 'Vacaciones en San Andres', 17),
  (25, 'Aplicaciones', 'Aplicaciones desarrolladas', 17),
  (27, 'Costa atlantica', 'Paseo por la costa atlantica', 18),
  (28, 'Vacaciones', 'En la costa', 19),
  (29, 'Entregable', '', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `image_id`    INT(11)      NOT NULL,
  `photo`       VARCHAR(767) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `tittle`      VARCHAR(50)  NOT NULL,
  `comments`    VARCHAR(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`image_id`, `photo`, `description`, `tittle`, `comments`) VALUES
  (376, 'Captura(1).png', 'cap', 'cap', 'cap');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images_x_album`
--

CREATE TABLE `images_x_album` (
  `fk_album_id`  INT(11) NOT NULL,
  `fk_image_id`  INT(11) NOT NULL,
  `order_number` INT(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `images_x_album`
--

INSERT INTO `images_x_album` (`fk_album_id`, `fk_image_id`, `order_number`) VALUES
  (19, 376, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persons`
--

CREATE TABLE `persons` (
  `person_id` INT(11)      NOT NULL,
  `name`      VARCHAR(100) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Volcado de datos para la tabla `persons`
--

INSERT INTO `persons` (`person_id`, `name`) VALUES
  (1, 'Jose David Restrepo Duque'),
  (2, 'Samuel Rendon'),
  (3, 'Danny Alvarez'),
  (6, 'Wilson Ospina'),
  (7, 'Maria Elena Duque'),
  (8, 'Alejandra Zapata');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id`      int(11) NOT NULL,
  `username`     varchar(100) NOT NULL,
  `password`     varchar(100) NOT NULL,
  `avatar`       VARCHAR(100) DEFAULT NULL,
  `fk_person_id` INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `avatar`, `fk_person_id`) VALUES
  (17, 'jdavidr', '$2y$10$c6QhYoRAlZ5KUq7Hys51N.iqakLXHd3EEl3bKunK9bQN/p2L5eP2K', 'prueba.jpg', 1),
  (18, 'srendon', '$2y$10$ghXuQIZZ6tXSErq4kdhCoOUdbe0.b8iPnfprm54pq6kuUU48Z4keK', 'prueba.jpg', 2),
  (19, 'dalvarez', '$2y$10$gE5snGOQVJUIdSK/zQIXpuHeCf2hvZ4pwmHgY/zHz0OT1DKGRaGRS', 'prueba.jpg', 3),
  (20, 'wospina', '$2y$10$y2f6q7YFPIDsAs7Swr1U4uI5eZuD1fkg.5Apf7losuBmZUv.fA6GC', 'prueba.jpg', 6),
  (21, 'mduque', '$2y$10$jX5Cvn2rPQ810CYwvSuNWeQBrs6IjtGjCo0UreD9sgltTXe2DOJCK', 'prueba.jpg', 7),
  (22, 'azapata', '$2y$10$cROMxAh15WOhfDfe8gAJ1eGvxWeY5OHMsTmMYmRkC7.wvFswWQzUi', 'prueba.jpg', 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_user_id_2` (`fk_user_id`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD UNIQUE KEY `ix_unique_photo` (`photo`),
  ADD KEY `image_id` (`image_id`);

--
-- Indices de la tabla `images_x_album`
--
ALTER TABLE `images_x_album`
  ADD PRIMARY KEY (`fk_album_id`,`fk_image_id`),
  ADD UNIQUE KEY `fk_album_id` (`fk_album_id`,`order_number`),
  ADD KEY `ck_fk_image_id` (`fk_image_id`);

--
-- Indices de la tabla `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `ix_unique_username` (`username`),
  ADD UNIQUE KEY `fk_person_id` (`fk_person_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 257;
--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `image_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 377;
--
-- AUTO_INCREMENT de la tabla `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 9;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 23;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `ck_fk_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

--
-- Filtros para la tabla `images_x_album`
--
ALTER TABLE `images_x_album`
  ADD CONSTRAINT `ck_fk_album_id` FOREIGN KEY (`fk_album_id`) REFERENCES `albums` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ck_fk_image_id` FOREIGN KEY (`fk_image_id`) REFERENCES `images` (`image_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `ck_fk_person_id` FOREIGN KEY (`fk_person_id`) REFERENCES `persons` (`person_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
