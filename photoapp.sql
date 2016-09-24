-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2016 a las 22:44:16
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
  `album_id`    int(11)      NOT NULL,
  `name`        VARCHAR(50)  NOT NULL,
  `description` varchar(200) NOT NULL,
  `fk_user_id`  int(11)      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `albums`
--

INSERT INTO `albums` (`album_id`, `name`, `description`, `fk_user_id`) VALUES
  (19, 'Vacaciones', 'Mis vacaciones en guadalajara', 17),
  (20, 'Seminario', 'Seminario de ingenieria de software', 17),
  (21, 'San Andres', 'Vacaciones en San Andres', 17),
  (22, 'Biografia', 'Fotos de perfil', 17),
  (23, 'Triatlon', 'Triatlon', 17),
  (24, 'Musica', 'Algunas instrumentos Musicales', 17),
  (25, 'Aplicaciones', 'Aplicaciones desarrolladas', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `image_id`    int(11)      NOT NULL,
  `photo`       varchar(767) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `tittle`      VARCHAR(50)  NOT NULL,
  `comments`    varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`image_id`, `photo`, `description`, `tittle`, `comments`) VALUES
  (15, 'http://www.hghotelgdl.com/wp-content/uploads/2014/04/Catedral_Guadalajara.jpg', 'Guadalajara', 'Catedral',
   'Guadalajara'),
  (16, 'http://69.64.52.17/conaquic_guadalajara/images/guadalajara-3-ok.jpg', '', 'Federacion', ''),
  (18, 'https://images.trvl-media.com/media/content/shared/images/travelguides/destination/1295/Guadalajara-62639.jpg', '', 'Guadalajara-62639', ''),
  (19, 'http://www.ucentral.edu.co/images/galerias/auditorios-teatros/jorge-enrique-molina-7/teatro-mexico-fotografica-bogota-2015-2.jpg', '', 'Teatro Mexico 1', ''),
  (20, 'http://www.ucentral.edu.co/images/galerias/auditorios-teatros/jorge-enrique-molina-5/teatro-mexico-cumbre-mundial-de-arte-y-cultura-para-la-paz-02.jpg', '', 'Teatro Mexico 2', ''),
  (21, 'http://www.ucentral.edu.co/images/galerias/auditorios-teatros/jorge-enrique-molina/auditorio-jorge-enrique-molina-02.jpg', '', 'Teatro Mexico 3', ''),
  (22, 'https://lugaresdeguadalajara.files.wordpress.com/2014/07/catedral-de-guadalajara.jpg', '', 'Catedral', ''),
  (23, 'http://www.cruceroturismo.net/images/SANANDRES.jpg', '', 'San Andres', ''),
  (24, 'https://unidos-por-colombia.wikispaces.com/file/view/san_andres7.jpg/272496054/san_andres7.jpg', '', 'Hotel', ''),
  (25, 'https://caracoltv-a.akamaihd.net/pmd/3827094934001/201604/3827094934001_4854455756001_200116-ni-o-terremoto-Ecuador.jpg?pubId=3827094934001', '', 'Biografia', ''),
  (26, 'http://www.publimetro.co/_internal/gxml!0/r0dc21o2f3vste5s7ezej9x3a10rp3w$48d3dxoia4twsga2mfnjetdd2594834/Captura-de-pantalla-2016-04-20-a-las-7.jpeg', '', 'Familia', ''),
  (27, 'http://farm8.staticflickr.com/7268/7489124186_0e0e5008e5_o.jpg', 'Una guitarra', 'Guitarra', ''),
  (28, 'http://1.bp.blogspot.com/_lZEwyJQMV9Q/TTbaaKHYezI/AAAAAAAAL0Q/PjNx1bIS2r8/s1600/TRIATLON6.jpg', '', 'Triatlon',
   '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images_x_album`
--

CREATE TABLE `images_x_album` (
  `fk_album_id`  int(11) NOT NULL,
  `fk_image_id`  int(11) NOT NULL,
  `order_number` INT(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `images_x_album`
--

INSERT INTO `images_x_album` (`fk_album_id`, `fk_image_id`, `order_number`) VALUES
  (19, 15, NULL),
  (19, 16, NULL),
  (19, 18, NULL),
  (19, 22, NULL),
  (20, 19, NULL),
  (20, 20, NULL),
  (20, 21, NULL),
  (21, 23, NULL),
  (21, 24, NULL),
  (22, 25, NULL),
  (22, 26, NULL),
  (23, 28, NULL),
  (24, 27, NULL);

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
  (17, 'Jose David Restrepo Duque', 'jdavidr', '$2y$10$c6QhYoRAlZ5KUq7Hys51N.iqakLXHd3EEl3bKunK9bQN/p2L5eP2K',
   'prueba.jpg');

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
  AUTO_INCREMENT = 26;
--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `image_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 29;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 18;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
