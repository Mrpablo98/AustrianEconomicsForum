-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 29, 2023 at 09:53 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `austrianeconomicsforum`
--

-- --------------------------------------------------------

--
-- Table structure for table `amigos`
--

CREATE TABLE `amigos` (
  `usuario_id1` int(11) NOT NULL,
  `usuario_id2` int(11) NOT NULL,
  `fecha_amistad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `tipo` enum('video','imagen','archivo','texto') NOT NULL,
  `url_recurso` varchar(255) DEFAULT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_likes_dislikes`
--

CREATE TABLE `post_likes_dislikes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tipo` enum('like','dislike') NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password_hash`, `fecha_registro`) VALUES
(1, 'TheFirstOne', 'primerUsuario@primero.com', '$2y$10$bcSCUGHlWfVGGnceGv5m6u4MIqj5.NfhPDLCDgOE7Kd4ww7pCVoPu', '2023-04-29 15:15:25'),
(3, 'TheSecondOne', 'segundoUsuario@primero.com', '$2y$10$mns8CGqxMrjt1aNJBrXW1OUp5IlBadKZ6FN23Gfg0M65UW3ESeKo6', '2023-04-29 15:17:46'),
(4, 'pablo', 'pablo@hotmail.com', '$2y$10$hjM9EdPUmp0XmWpm.SaGI.DkpEeBly72g.E6OtNG9u6dObACzKLny', '2023-04-29 18:12:24'),
(5, 'prueba', 'prueba@prueba.com', '$2y$10$7Qh3G2LO4NRrgNPoqpkDm.Mj0IZi0nWp/yMH.fN69svCO.eS25Niu', '2023-04-29 18:14:01'),
(6, 'prueba1', 'prueba1@gmail.com', '$2y$10$pXtHZqC5w2VX1dST2f8tsuI.0KeG6vq.Zufg6cW3RW/rKAOLP6wp.', '2023-04-29 18:30:01'),
(7, 'prueba2', 'prueba2@gmail.es', '$2y$10$C0JfTX0RQRNT.t0ifveVt.r1SZBEmZMvR.4DEFqofFdWQGZzEkjO6', '2023-04-29 18:31:29'),
(8, 'prueba3', 'prueba3@gmail.es', '$2y$10$YRoHxRtVHO7IqH6sEPj5DuzUxJqXQ6gktOEA4lcHrKK0ko1mdq5Ou', '2023-04-29 18:41:35'),
(9, 'prueba4', 'prueba4@gmail.es', '$2y$10$usw0Omrv1tFYVFC6eXSQuua7fvlqxgQzlkKq30/o4E7J94jt6kFn6', '2023-04-29 18:42:05'),
(11, 'prueba5', 'prueba5@gmail.es', '$2y$10$CFEAoxaJ5UZvpfvKyEdi/upB8clWwzJrg4rDseOLqgR4IOYZiX.cm', '2023-04-29 18:43:23'),
(12, 'trim', 'trim@gmail.com', '$2y$10$64iBXZHZrgqJXmvnbzkFZem3qXJQaJvDGTCeb.VYXOpMEVjUviEni', '2023-04-29 19:16:54'),
(13, 'hash', 'hash@gmail.com', '$2y$10$1w0NMqceOWi.FnvTN3FjEesqbXSsSrUQRL5U.ODmJrSAF0pZetg3S', '2023-04-29 19:44:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`usuario_id1`,`usuario_id2`),
  ADD KEY `usuario_id2` (`usuario_id2`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `post_likes_dislikes`
--
ALTER TABLE `post_likes_dislikes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_id` (`post_id`,`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_likes_dislikes`
--
ALTER TABLE `post_likes_dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `amigos_ibfk_1` FOREIGN KEY (`usuario_id1`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `amigos_ibfk_2` FOREIGN KEY (`usuario_id2`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `post_likes_dislikes`
--
ALTER TABLE `post_likes_dislikes`
  ADD CONSTRAINT `post_likes_dislikes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_likes_dislikes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
