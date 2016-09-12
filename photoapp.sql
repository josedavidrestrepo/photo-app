-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2016 a las 01:16:06
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
  `album_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `albums`
--

INSERT INTO `albums` (`album_id`, `name`, `description`, `fk_user_id`) VALUES
  (1, 'Vacaciones', 'Mis vacaciones en guadalajara', 2),
  (2, 'Seminario', 'Seminario en bogotá', 2),
  (3, 'Bikinis', 'bikinis', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `photo` varchar(767) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `tittle` varchar(100) NOT NULL,
  `comments` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`image_id`, `photo`, `description`, `tittle`, `comments`) VALUES
  (1,
   'http://www.visitmexico.com/work/models/VisitMexico30/WebPage/Guadalajara/photoEscudo_Guadalajara_JALGuadMain.jpg',
   'guadalajara', 'guadalajara', 'guadalajara'),
  (2, 'http://www.hghotelgdl.com/wp-content/uploads/2014/04/Catedral_Guadalajara.jpg', 'guadalajara1', 'guadalajara1',
   'guadalajara1'),
  (3,
   'http://www.ucentral.edu.co/images/galerias/auditorios-teatros/jorge-enrique-molina-7/teatro-mexico-fotografica-bogota-2015-2.jpg',
   'teatro mexico', 'teatro mexico', 'teatro mexico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images_x_album`
--

CREATE TABLE `images_x_album` (
  `fk_album_id` int(11) NOT NULL,
  `fk_image_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `images_x_album`
--

INSERT INTO `images_x_album` (`fk_album_id`, `fk_image_id`, `order_number`) VALUES
  (1, 1, 1),
  (1, 2, 2),
  (2, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `avatar`) VALUES
(2, 'Jose David Restrepo', 'jdavidr', 'admin', 'prueba3.jpg'),
(4, 'Samuel Rendon', 'srendon', 'admin', 'prueba.jpg'),
  (5, 'Wilson Ospina', 'wospina', 'admin', 'prueba.jpg'),
  (6, 'Maria Elena Duque', 'malena', 'admin', 'prueba.jpg'),
  (7, 'Samuel Rendon', 'samren', 'admin', 'prueba.jpg'),
  (8, 'Daniel Leon', 'dleon', 'admin', 'prueba.jpg'),
  (12, 'wilson ospina', 'wrgospina', 'admin', 'prueba.jpg');

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
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `ix_unique_username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `image_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 13;
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
  ADD CONSTRAINT `ck_fk_image_id` FOREIGN KEY (`fk_image_id`) REFERENCES `images` (`image_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
