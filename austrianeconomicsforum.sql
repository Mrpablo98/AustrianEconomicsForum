-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2023 at 05:16 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

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
  `aceptada` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_amistad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `amigos`
--

INSERT INTO `amigos` (`usuario_id1`, `usuario_id2`, `aceptada`, `fecha_amistad`) VALUES
(21, 22, 1, '2023-05-17 14:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`id`, `post_id`, `usuario_id`, `contenido`, `username`, `fecha_publicacion`) VALUES
(144, 2, 21, 'd', 'pablo', '2023-06-03 13:13:33'),
(145, 2, 21, 'd', 'pablo', '2023-06-03 13:13:36'),
(146, 2, 21, 'd', 'pablo', '2023-06-03 13:14:33'),
(147, 7, 21, 'hola', 'pablo', '2023-06-03 13:14:48'),
(167, 7, 21, 'prueba', 'pablo', '2023-06-03 13:16:14'),
(168, 7, 21, 'juju', 'pablo', '2023-06-03 13:17:01'),
(169, 7, 21, 'prueba 2', 'pablo', '2023-06-03 13:25:53'),
(170, 7, 21, '1', 'pablo', '2023-06-03 13:27:18'),
(171, 7, 21, '2', 'pablo', '2023-06-03 13:27:19'),
(172, 7, 21, '3', 'pablo', '2023-06-03 13:27:20'),
(173, 7, 21, '4', 'pablo', '2023-06-03 13:27:20'),
(174, 7, 21, '5', 'pablo', '2023-06-03 13:27:21'),
(175, 7, 21, '6', 'pablo', '2023-06-03 13:27:22'),
(176, 3, 21, 'hola', 'pablo', '2023-06-03 13:40:36'),
(177, 3, 21, 'h', 'pablo', '2023-06-03 13:42:24'),
(184, 8, 21, 'siii están bien, trankii', 'pablo', '2023-06-03 15:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `tipo` enum('video','imagen','archivo','texto') DEFAULT NULL,
  `url_recurso` varchar(1000) DEFAULT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `usuario_id`, `titulo`, `contenido`, `tipo`, `url_recurso`, `fecha_publicacion`) VALUES
(2, 21, 'prueba 2', 'prueba de validación de tipos', 'imagen', 'https://storage.googleapis.com/austrian-economics-forum/post-prueba?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=Yywiv6%2BiptyYimt4HAi22Aa6benvfS1i9T%2FM6KklpQboHZHw%2B582o0Jca42XZGRk%2B8%2FwaiJVJTDIkHe9rPPX81W0GtQnBxo21CxLja3SKvIpVz9AN3JLrN9mdBW717A%2BvqO3YifpquxYNQ%2B48%2Bz65K3Va%2FVwpXTv0sgA5tg6uZHeAFsOVN3pMBJUY%2FDy59NdM8UwL8phbRCWKWGTN36Swt89UXT9JNlCykx9oxpXCPGeqkENNQtxw600cg7rWV0Tkc7GPhHYnAYJ3Un32JMEPYc%2FUCVsaY5pGY76ChvlI0xK9dPZ%2FN%2F0deKfT%2BGHcGXE3eor1oPPgwWCCsdA%2F7%2BDuw%3D%3D&generation=1684019204121071', '2023-05-13 21:06:42'),
(3, 21, 'Primer Post', 'Primer Post de AustrianEconomicsForum', 'imagen', 'https://storage.googleapis.com/austrian-economics-forum/Captura%20de%20pantalla%202023-05-13%20232025.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=AMk%2FEGMgc2TjVQKW%2F18%2BF8PEhyt5epoKXGref9CI%2FFlHkgD%2Bb5rOHdWQ1dVLpsK3ugJCJPUw%2FPq1Uff9I%2BAK8qGcY58886cCI2e7X%2FBaPqt55%2BCQxX%2BZGow1vgGsiI4HPd4PQYzVbTat24yKYJK0xjL5j3q%2FHI0f1R1q%2Fc5EBC7b6MZqOqvv3K226kO%2BUCb99EKLGJl1958KKAGOD1vfoY%2BL4zGN7Be6OZF1u%2FDUD5uXOpD%2FhSQeNc8NLjKROl3G09Cxp0Lfq5MUikO95ebj5SPaAP67TIbdVDJL70PJJGMyEF1GFMrq3dBCKWiGdG8PgSL0uEXSx5Yj1Ir%2BsWrH%2Fw%3D%3D&generation=1684019527266317', '2023-05-13 21:12:04'),
(5, 21, 'SSH', 'Adquirir un certificado SSL: Puedes comprar un certificado SSL a través de varios proveedores, o puedes obtener uno gratis a través de Let\'s Encrypt. Cuando compras un certificado, normalmente recibirás un par de archivos: el certificado público (normalmente un archivo .crt) y la clave privada (normalmente un archivo .key).\r\n\r\nInstalar el certificado SSL en tu servidor: Deberás subir los archivos del certificado a tu servidor y configurar tu software de servidor web para usarlos. Si estás usando Apache, esto implicará editar tu archivo de configuración de Apache (normalmente httpd.conf o un archivo en el directorio sites-available) para incluir líneas como estas:\r\n\r\nbash\r\n\r\nSSLCertificateFile /ruta/al/certificado.crt\r\nSSLCertificateKeyFile /ruta/a/la/clave.key\r\n\r\nSi estás usando Nginx, la configuración será similar pero las directivas se llamarán ssl_certificate y ssl_certificate_key.\r\n\r\nDespués de cambiar la configuración, tendrás que reiniciar el servidor web.\r\n\r\nForzar el uso de HTTPS: Una vez q', NULL, NULL, '2023-05-31 20:08:35'),
(7, 22, 'Post de PAPA', 'Primer post de PAPA', 'imagen', 'https://storage.googleapis.com/austrian-economics-forum/ywsos4yhhlr81.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=X7YGR8V%2BrbYq4TFtWjMDyh4oX4raNHZ6DHAK8OWOkTxjVQE8SjaU0thJIuQAoGlMy9QwubhPJ6w4CxxhCn7RYiHWeea%2FBJ7CA51Rz%2F%2Bn5pyYfxq4SENLeWToSWkhCrrpgotmDSD8jKtrNz7DAUxcwZBXbL9JjYgPwcuK00Eghb7JnV9tGOykRDA1Rv%2FseN8i6d0PSlgP9kjTqfFwe8PgCNWuVaRJ95I21cIPRWeS1bT7dSuSPOZSdoH0je8a%2BWstf%2BLqPB2EPc10LBeURBZgS%2BOIOl15ZZ5oQMkiDxLM8n1zJuVcHGaCNrw6BbMl3YkAd41YPcW37itlhrZVjZqx5A%3D%3D&generation=1685710755329250', '2023-06-02 10:59:09'),
(8, 22, 'prueba ordenacion index', 'Esto es una prueba para ver si los posts en el index de la red social se están ordenando correctamente', 'imagen', 'https://storage.googleapis.com/austrian-economics-forum/ELDELRING.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=Fpiw7%2FdtfirNA%2BN0%2F0SgqLRMUFt5Q%2FBsVlbzcfmjwfcvg9N8SJnBu5NZy%2B5MDaIdOZiNHI1J9DnM%2BtXH8ZVn3exEOJOEPf24VphYQt7sMn1hZ714xDYxnOaNvyVeWp8I%2Bwlm2zJh%2BFd4RoSx7KcfBxXMTxtviDZyx4fzDei9fO1BEz3GMMbFWY9C4jPRiKSQbymwoISHI%2FVOTBNJc2Dnn8nPwZgL01VgLoIJWlRKGoY03W%2ByqAHMh4hjuTrEgRhSTMvnoqd30BacVoauc7F4GfJKCQIel6fvBWHrDzdpeE6WAuexCgwJCRtGK4lDpS9L%2FFmEl7tM1ysOGC083juT%2Bw%3D%3D&generation=1685805296253271', '2023-06-03 13:14:43');

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

--
-- Dumping data for table `post_likes_dislikes`
--

INSERT INTO `post_likes_dislikes` (`id`, `post_id`, `usuario_id`, `tipo`, `fecha`) VALUES
(22, 5, 21, 'like', '2023-06-01 00:19:01'),
(28, 3, 21, 'like', '2023-06-02 12:56:42'),
(29, 3, 22, 'like', '2023-06-02 12:57:26'),
(30, 7, 22, 'like', '2023-06-02 12:59:32'),
(33, 2, 22, 'like', '2023-06-02 14:29:40'),
(41, 2, 21, 'like', '2023-06-03 13:08:01'),
(42, 7, 21, 'like', '2023-06-03 13:18:53');

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
(21, 'pablo', 'pabloskyisan1998@gmail.com', '$2y$10$HKeHVVBSQEL.EmzIljCSFOBo10A2YPnOZdcoTXs7WvYfrY4AasDv6', '2023-04-29 23:52:13'),
(22, 'Luis', 'euben@hotmail.com', '$2y$10$NdVoXd3epMnUtt3nY0Xeq../WKsTAqvEQXe6KddQD/yQH6r7MXp42', '2023-05-04 16:57:41');

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
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `post_id` (`post_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post_likes_dislikes`
--
ALTER TABLE `post_likes_dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `post_likes_dislikes`
--
ALTER TABLE `post_likes_dislikes`
  ADD CONSTRAINT `post_likes_dislikes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `post_likes_dislikes_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
