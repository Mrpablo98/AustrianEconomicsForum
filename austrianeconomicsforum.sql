-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2023 at 04:12 AM
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
(15, 14, 1, '2023-06-01 10:19:11'),
(20, 14, 1, '2023-06-07 11:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`id`, `post_id`, `usuario_id`, `username`, `contenido`, `fecha_publicacion`) VALUES
(2, 23, 14, 'pablo', 'hola', '2023-05-30 11:09:37'),
(3, 23, 14, 'pablo', 'prueba dinámica', '2023-05-31 09:35:06'),
(4, 23, 14, 'pablo', 'prueba dinámica 2', '2023-05-31 10:16:32'),
(5, 23, 14, 'pablo', 'prueba rANDOM 3', '2023-05-31 10:21:35'),
(7, 23, 14, 'pablo', 'prueba random x', '2023-05-31 10:32:56'),
(8, 23, 14, 'pablo', 'adios', '2023-05-31 10:33:32'),
(12, 23, 14, 'pablo', 'prueba scroll', '2023-05-31 10:55:35'),
(13, 23, 14, 'pablo', 'prueba scroll 2', '2023-05-31 10:55:45'),
(14, 23, 14, 'pablo', 'prueba scroll 3', '2023-05-31 10:55:50'),
(17, 23, 14, 'pablo', 'prueba scroll 4', '2023-06-01 08:03:39'),
(18, 43, 14, 'pablo', 'gracias por tu comentario de prueba guapo', '2023-06-02 09:01:51'),
(19, 47, 14, 'pablo', 'Una estafa piramidal de toda la vida', '2023-06-06 09:11:29'),
(20, 44, 14, 'pablo', 'holaa', '2023-06-06 09:30:38'),
(23, 23, 18, 'prueba3', 'eseeeee', '2023-06-06 09:54:25'),
(24, 25, 14, 'pablo', 'juujuju', '2023-06-06 10:43:19'),
(25, 23, 14, 'pablo', 'jujuju', '2023-06-06 10:46:09'),
(39, 43, 14, 'pablo', '1', '2023-06-06 13:44:05'),
(40, 43, 14, 'pablo', '1', '2023-06-06 13:44:06'),
(41, 43, 14, 'pablo', '1', '2023-06-06 13:44:06'),
(42, 43, 14, 'pablo', '1', '2023-06-06 13:44:06'),
(43, 43, 14, 'pablo', '1', '2023-06-06 13:44:07'),
(44, 43, 14, 'pablo', '1', '2023-06-06 13:44:07'),
(45, 43, 14, 'pablo', '1', '2023-06-06 13:44:07'),
(46, 43, 14, 'pablo', '1', '2023-06-06 13:44:08'),
(47, 43, 14, 'pablo', '1', '2023-06-06 13:44:08'),
(48, 43, 14, 'pablo', '1', '2023-06-06 13:44:08'),
(49, 43, 14, 'pablo', '1', '2023-06-06 13:44:08'),
(50, 43, 14, 'pablo', '1', '2023-06-06 13:44:09'),
(51, 43, 14, 'pablo', '1', '2023-06-06 13:44:09'),
(52, 23, 14, 'pablo', '1', '2023-06-06 13:51:40'),
(53, 23, 14, 'pablo', '2', '2023-06-06 13:51:40'),
(54, 23, 14, 'pablo', '3', '2023-06-06 13:51:40'),
(55, 23, 14, 'pablo', '4', '2023-06-06 13:51:41'),
(56, 23, 14, 'pablo', '5', '2023-06-06 13:51:41'),
(57, 23, 14, 'pablo', '6', '2023-06-06 13:51:42'),
(58, 23, 14, 'pablo', '7', '2023-06-06 13:51:42'),
(59, 23, 14, 'pablo', '8', '2023-06-06 13:51:42'),
(60, 23, 14, 'pablo', '9', '2023-06-06 13:51:43'),
(61, 23, 14, 'pablo', '10', '2023-06-06 13:51:44'),
(62, 23, 14, 'pablo', '11', '2023-06-06 13:51:45'),
(63, 23, 14, 'pablo', '12', '2023-06-06 13:51:46'),
(64, 23, 14, 'pablo', '13', '2023-06-06 13:51:46'),
(65, 23, 14, 'pablo', '14', '2023-06-06 13:51:47'),
(66, 23, 14, 'pablo', '15', '2023-06-06 13:51:48'),
(67, 23, 14, 'pablo', '16', '2023-06-06 13:51:49'),
(68, 23, 14, 'pablo', '17', '2023-06-06 13:51:49'),
(69, 23, 14, 'pablo', '17', '2023-06-06 13:51:52'),
(70, 23, 14, 'pablo', '18', '2023-06-06 13:51:53'),
(71, 43, 14, 'pablo', '2', '2023-06-06 13:52:36'),
(72, 43, 14, 'pablo', '3', '2023-06-06 13:52:36'),
(73, 43, 14, 'pablo', '4', '2023-06-06 13:52:36'),
(74, 43, 14, 'pablo', '5', '2023-06-06 13:52:37'),
(75, 43, 14, 'pablo', '6', '2023-06-06 13:52:37'),
(76, 43, 14, 'pablo', '7', '2023-06-06 13:52:37'),
(77, 43, 14, 'pablo', '8', '2023-06-06 13:52:38'),
(78, 43, 14, 'pablo', '9', '2023-06-06 13:52:38'),
(79, 43, 14, 'pablo', '10', '2023-06-06 13:52:40'),
(80, 43, 14, 'pablo', '11', '2023-06-06 13:52:40'),
(81, 43, 14, 'pablo', '12', '2023-06-06 13:52:41'),
(82, 43, 14, 'pablo', '13', '2023-06-06 13:52:42'),
(83, 43, 14, 'pablo', '14', '2023-06-06 13:52:43'),
(84, 43, 14, 'pablo', '15', '2023-06-06 13:52:43'),
(85, 43, 14, 'pablo', '16', '2023-06-06 13:52:44'),
(86, 43, 14, 'pablo', '17', '2023-06-06 13:52:45'),
(87, 43, 14, 'pablo', '18', '2023-06-06 13:52:46'),
(88, 43, 14, 'pablo', '19', '2023-06-06 13:52:47'),
(89, 43, 14, 'pablo', '20', '2023-06-06 13:52:49'),
(90, 43, 14, 'pablo', '21', '2023-06-06 13:52:50'),
(91, 43, 14, 'pablo', '22', '2023-06-06 13:52:50'),
(92, 43, 14, 'pablo', '23', '2023-06-06 13:52:51'),
(93, 43, 14, 'pablo', '24', '2023-06-06 13:52:52'),
(94, 43, 14, 'pablo', '25', '2023-06-06 13:52:52'),
(95, 38, 14, 'pablo', '1', '2023-06-06 14:27:07'),
(96, 38, 14, 'pablo', '2', '2023-06-06 14:27:07'),
(97, 38, 14, 'pablo', '3', '2023-06-06 14:27:08'),
(98, 38, 14, 'pablo', '4', '2023-06-06 14:27:08'),
(99, 38, 14, 'pablo', '5', '2023-06-06 14:27:08'),
(100, 38, 14, 'pablo', '6', '2023-06-06 14:27:09'),
(101, 38, 14, 'pablo', '7', '2023-06-06 14:27:10'),
(102, 53, 14, 'Pablo_pablete_pollo', 'buenisimaa', '2023-06-08 10:27:07'),
(103, 53, 14, 'Pablo_pablete_pollo', 'olee', '2023-06-08 10:28:05'),
(110, 58, 14, 'pablete_pollo', 'hol', '2023-06-12 00:32:58'),
(111, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:32:58'),
(112, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:32:58'),
(113, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:32:59'),
(114, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:32:59'),
(115, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:32:59'),
(116, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:32:59'),
(117, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:32:59'),
(118, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:33:00'),
(119, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:33:00'),
(120, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:33:00'),
(121, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:33:00'),
(122, 58, 14, 'pablete_pollo', 'S', '2023-06-12 00:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `url_recurso` text,
  `objectName` varchar(255) DEFAULT NULL,
  `tipo` enum('video','imagen','archivo','audio') DEFAULT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `usuario_id`, `titulo`, `contenido`, `url_recurso`, `objectName`, `tipo`, `fecha_publicacion`) VALUES
(23, 14, 'funcionalidad tipos', 'prueba de la funcionalidad tipos', 'https://storage.googleapis.com/austrian-economics-forum/icon.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=HiYxJYi6yKCBwjwzFMSdQHy6XFbclEGXUAg9LlwpTkkj%2FFYyGfK0grEWm5zumgG8%2FEzsqhydEYMT1LfLnbX6u2W6LT%2BqLFYTRMP%2BiF7W0kQakBlZArfsGPhJnIYoOeLC08DyFa47JxyJ9WrSr34HWH7AQiyGfmsIf5kG2nFrLQO6gn7oP%2FSLYmD3Dx5u16Taa9RbnRUr%2FSIpNQ%2BP4bhPqqXc8IypqbBKOy6KgwPNxrqLHDcdROSiZYR5gP4NR2drmt1KdM1NnZMmkKVXMSZ0%2FwCIAzK31SiWT%2FjyvlU2Tp8%2F3v5kYniF6Q6PqrqWcRa9vV3q0fZtliZ9WBnxVSAhGA%3D%3D&generation=1684220578916605', '', 'imagen', '2023-05-16 05:02:46'),
(25, 14, 'post 2 de 15', 'post 2 de 15', 'https://storage.googleapis.com/austrian-economics-forum/Captura%20de%20pantalla%202023-04-14%20115542.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=af9W28ySRBYka%2BLKp2eCgVxskveC0gkcW7vs86PdlcXNnNhK5LSouQNvH5udyT2VxELI7pAXq7HCwxyXfRtZJcNVayAeu%2FYXsBqNhSMhWTz%2FoQ9lgFsSUiu7YxQcfIUWnprAM3GEFWONx2TcWF88T0JlGphI2%2BxH%2F6FwiGdR33Vpde6f%2Be0bgb9q7PwN%2BeOCsBJYupCaeFZ1lTcM1d9w7RcnKrgtsYQ%2B93LBacTGThFI0%2FhY78gflYFZvAxwcD2Rc3jWFLuNp55a8vjuD6KeSGMMFjmeMRkV9wNvj9wiIKVEbI2K9L%2FDTJt6zUGpfYXM0C1GtQdTnuhqXe6e5W8q%2FA%3D%3D&generation=1684222968451853', '', 'imagen', '2023-05-16 05:42:38'),
(26, 14, 'post 3 de 15', 'post 3 de 15', 'https://storage.googleapis.com/austrian-economics-forum/Captura%20de%20pantalla%202023-04-26%20123446.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=lG0XWpWzrYKutY1jQuWVy6Xi5eUnfvMgtBO7PF4Le%2FJGJa5c0po8kSBwxfhXUSiZUTPBGiNvJ%2FyyenCEonh7T6Vza6oyZANaXKtnLYNBIrETY4N4YG%2F0%2FlEJGse44y6%2BepE%2F0s2YCSGUYywaW1sKVCmdd%2BWPr%2FeFTMwIOJbhR%2B0s4rcZJnMcmBTaMTLdd0zodzq7DXaueTVn2IyX%2F30QOFoC70S64%2FzqdjGEhu7baSFqVy3PijBBEHUwcivSQ%2BWAP02E5qt1mb1eRBc3mgffd3q4ZKYhiBPdAZ0YEstCy6N6HZKIHw4dBahwpwdO3g6bB3jl%2BnJmpwQ8f9VkRPbb%2Bw%3D%3D&generation=1684222983838513', '', 'imagen', '2023-05-16 05:42:53'),
(27, 14, 'post 4 de 15', 'post 4 de 15', 'https://storage.googleapis.com/austrian-economics-forum/Captura%20de%20pantalla%202023-04-26%20125141.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=M14av6qJggMqlgpBfHK30yQXHZqz9HFMMExVz%2F8TgrMcwg8dKoUadetf%2Fct%2Bu%2FM183BESN3ERUMQ7PQInwwlw69UPRtSv3A7j0XRZRnTM0InweuK9tAXKeWmdr3SaUjGzxNSxIayjS%2BU6XloE6Ng77Uj2%2FRmFsn5DNhMqfnwp9shUWQa2LNOuA42W3ZFnm46J0JzJFuLL6xDW40eo6hzlecdThTiod4XovC%2BQw9FIUeyoyfh1%2Bhfo6O1DODVlEItsWX89U%2F8Hjy08Tj5AWn4Cb81zHlMGGcNycieX8P%2FbEVnc1%2FYhIZ7G59rrjVB36GRjumJsuU1pRUhXnrD6njyHg%3D%3D&generation=1684223001458169', '', 'imagen', '2023-05-16 05:43:11'),
(28, 14, 'post 5 de 15', 'post 5 de 15', 'https://storage.googleapis.com/austrian-economics-forum/Captura%20de%20pantalla%202023-04-27%20164229.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=WAktwtdvm%2BSr4km72WxGOR2DPcYiFcNh4pzfdcyC5f9zFwjoER7Hsg%2BwjoNR2nHVaDGMHq28uMSDFYqBcqiH1eteiuzDTmc%2FVFedo55H3Nb0nlgy3E5TiH9%2Fq%2BZTb9XaeQ%2BSvh6w8bJhppkaFmu5obUYncE%2BzJNB7UB%2FP4yYG8H39S9tf0yyatSwZQTYHQRUYG90CcdxgShEmt7yfiEXoERt1QXw4DvFu86V1EH6Wbjhowek8fkKEpE9zQ%2Bg9aZqdpB1VpfrUv5PRkYOEVvV2V922LrfXdOuZE%2Fw5YksWByeJoQ6vDZFm8YtUjBH3S%2F7pH6Xkycn%2BzwwPbtFeFMDsQ%3D%3D&generation=1684223021205244', '', 'imagen', '2023-05-16 05:43:30'),
(29, 14, 'post 6 de 15', 'post 6 de 15', 'https://storage.googleapis.com/austrian-economics-forum/Captura%20de%20pantalla%202023-04-28%20091646.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=FP0BjpWoJYcSzSxQwJqjq3FfVasTibP9SZPz2QJa4hu9r5%2B5PBak7S7978%2FiqqB8%2Fh3DP4AULfawOld7qewdqyWmRzHe1vLLEJfXyZ9%2FXTtTEklNDke5sA8yBTIYd7%2F5zafzlsckkWtFItaTXpyLFsiSgc6dcwDOoYKQTfEEdj2rn%2FOzYnRQByX550%2FQg%2FQ%2F%2BNeqwRWd62M4HIPpV4P8obGnoh0XGTHQVUPSLE0C8X8YJoyhtL1wavKDQPJbZ08ci5wDKrw31C7%2BTBFf5ypwiY3WW3QLFCT3v5JE71hbgDz1Aflp%2FTnyBdt5%2B6IO01ci4iG%2FjWa%2FK20eAPozEqi7dA%3D%3D&generation=1684223217331576', '', 'imagen', '2023-05-16 05:46:46'),
(30, 14, 'post 7 de 15', 'post 7 de 15', 'https://storage.googleapis.com/austrian-economics-forum/Captura%20de%20pantalla%202023-04-28%20111248.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=mfEMJh8eOBMegRw7AZ9k6WuURKLecqX7g%2Bv61GUGtpEpJkWTox6eBE2KpufidceVkg4VfTL%2FDQRov%2BVoht3sq5mRhPbFhGCBgxVHMjJOROps8rMHf2yFVzWHSZU8N7RO64Yg0KdmGWh6TNTkMmVMCwUO9wMmQVgQNHTMc1F%2ByLsb%2F8SpZCCFceEbkbOz7sIkgJG2%2B1e3FqfKlRiaHrkj4NNcthZrcGwPQ%2BdJjTA8eVxRQHzGzozwAMuNyX7ubX3fojfyuZUbtYA2diUSLFyh%2B9dKdm31Pe4K9Onfjj5bG13XzP%2BA%2F%2FFh2bzLeYfBjuH8np%2BPIiHf%2F3bgimb%2BUpZ11A%3D%3D&generation=1684223237693711', '', 'imagen', '2023-05-16 05:47:07'),
(31, 14, 'post 8 de 15', 'post 8 de 15', 'https://storage.googleapis.com/austrian-economics-forum/Captura%20de%20pantalla%202023-04-28%20134432.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=dVRkrKOKm6Pl4m1Ct7QVrWl5b%2BxSq%2Bkw7Dw1uCIwLWfHcpbxd1pdFs2SJxlXNgxcm2VsxsSkZAZm7gOn%2BKY9hRKshDvhfYLeawiBq99qOk6S3uKBK0rKB%2FlTNlFnWLxGnBtiBeHT2RYWDVjiVvgq%2BARbgyZLK6QitEdi3kGzYvKY60i5Q26%2B8gPvopPFHCFMU0cPcnq7CfgWblHa6UepWX7rA1Dup57fRSwkZTy5wpR3Gmy2ZkG84c7p8xjYa3wMbg2XnSdufxrL59RGUA7qgmdHAqfpOshGN%2Bk56DReBr9msp4yD3MFRN%2F8P%2BEYjrPeORISgCqcV%2FPt3ylVrxBRqg%3D%3D&generation=1684223253822547', '', 'imagen', '2023-05-16 05:47:23'),
(32, 14, 'post 9 de 15', 'post 9 de 15', 'https://storage.googleapis.com/austrian-economics-forum/Captura%20de%20pantalla%202023-05-11%20123022.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=Ab7dNm8NN0D28lQs%2BWr3QYXeW6Xy%2BApa4AiU3Jeg9UL%2BmOE2QNqyLMhL0xcFJQVvu5jPTWjseSNn6fr431jGT3F0cQtFh3cH7wLm62X86oD6MyW7g5jvEE6o1rxFwvLgZJSfkNSJz9JJ9aX7FrsWZkvR0A6byeDKDRL0uLC2cECa8jx%2BRnBL9Xav3MOsR%2FrEs6Uh8njMcQ8BqToXKw1iTFx4%2BEWsi2eFVKiGTq2%2BWmPZCo4oQEmNjX2WMq9quaqM2M7WKoYX6uhzUnRuySD%2FPFMKfUal4i0h1BzzxuymtRV%2FKmDLQUZXp%2BYdaADU%2BZ%2BsaXH0pJ7B75SNw3FplSfmxw%3D%3D&generation=1684223279562545', '', 'imagen', '2023-05-16 05:47:49'),
(33, 14, 'post 10 de 15', 'post 10 de 15', 'https://storage.googleapis.com/austrian-economics-forum/Claseusuario.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=AYW4HhUJY0RTWmlcNDcmOj3DHYQ%2FUO7BUe6w7gHwAbj8n10%2BQ%2FPB44DLxRd%2B%2BA3hgvndPvKN%2F%2FZ%2BONllo7%2FWFBzDjXqCEz3zz32xVhK6qXtSLbPzUJEcS3dKz5uMKhkqqhmeCYy2i6dde%2F0hXFg9zWJS9oR%2F%2Fca%2FVRx9Vpwq1Jf0%2BD%2BNT4yFzCsTSWEfYzqkPku6S7rcouq%2B50e%2FdwWQ%2Fbxqa6zNfFrmTLVL5I2XBj%2BBCQlRdhoUDQmqiYMp9nW5hdNgZmS5Zqr%2BUYIZ6a7NjmQipjHm0hC079n%2BdRblRPRCJrUvPffO3ufjm5cRG1JJeK6AWh52GNQVA1aYVbhXkQ%3D%3D&generation=1684223299975782', '', 'imagen', '2023-05-16 05:48:09'),
(35, 14, 'post 12 de 15', 'post 12 de 15', 'https://storage.googleapis.com/austrian-economics-forum/logo-dark.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=B4GVL0VKMIt9%2Fc5OwxglGQ%2BjYOMqAiEExthH91yTghgtWU%2BvhqkNJTv1WGkzKhFjf%2FfmymWNWeVIB0b1Ij%2BpnCUGbCpXyTFUDLJ8ouRkMeNuBHUT7HLa%2BMn6rfL5nBv33JYCEWewgx0eQiMijj4MrtseUYjUsK1kZm5mZtZfGmwkcRK%2BKH99o6DzRdH%2BvMXE7ajDkcYYUnS9ZfFHh%2FRGb0pZkT6DoYQh4itRTloiQhb7fzDk7jQCK8SRzMR2mHRN1bCPTzp1MLevcpdbp8BqkxlmGZgi4643w8s6lAIwPehZlS20sGoAAFnJskdToBVhj9C6kSHNlxAmewCx4ssFtA%3D%3D&generation=1684223366317750', '', 'imagen', '2023-05-16 05:49:15'),
(36, 14, 'post 13 de 15', 'post 13 de 15', 'https://storage.googleapis.com/austrian-economics-forum/multiusosSar.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=B8sd5kjYToFAoS556r7cgFG1VW5NlJdNzBvsOvMO%2FB36sa6hC4CNGCM2DBQ38Ip%2Fd2UCWySq1%2FcRMmvH8P9ZIDuM%2FjFIZ0pARIYvsJQd6g%2F%2BCSmEHUSGWz8%2FbA3Qu9jAQ7m9OmJZ7uTFgFgwcZ0g9uGXG2wUVa9Qw42xAovKyBWkOxR6dv0tgpQO4M%2Bx6v%2FHExD9tVkM5Hg4hy1ODbjq%2FNIK6jU%2BXXLPjHCGdLeSteGRd7pNOOJ4jy5G%2FXoNPz%2FsONWczyqvCKMDcWt%2B%2BarYwce7DGivFZQrI5ab9FHwK%2BjW6LwoRwdtZf0q1eKFUOiytsKUaGGWEx9G58uiEkVyYQ%3D%3D&generation=1684223384654401', '', 'imagen', '2023-05-16 05:49:34'),
(38, 14, 'post 15 de 15', 'post 15 de 15', 'https://storage.googleapis.com/austrian-economics-forum/ObtenUsuarios.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=HMFfMwK9e8Qz%2F72pGgOyz9iTAsjGx9a5IAaXUp1Dx%2BDfj2JK8lQ8Qw6th48ccAZRigNgzsgEtgQcDTTVsFIPNd%2FmLM%2FJo8eISb0HV5TEy%2F8Gozgj%2FxPxalCgIQFMKEit2IUeF0zdtPBmc4egxXxP0XJjEURxWSCxy6cYfQ7B1EapF%2BnsmckPc61HCkjKASAjq%2BDhPsr7DL3eCjbGkHGNehK2swROQuJNH%2FzC7cwVU%2BoarTDp9oAUs6TCBXFniSOsEJy3k2qV41vhAt2k2%2FGSxzVR1W5y2QhwIot3b1mNtzDWlG6CkjNjgKhoDMUmmVU7BdXIaL44iKTEIi5OJXNUkg%3D%3D&generation=1684223428312267', '', 'imagen', '2023-05-16 05:50:17'),
(39, 14, 'post 16 de 15', 'post 16 de 15', 'https://storage.googleapis.com/austrian-economics-forum/revertir-devops.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=eyXfZf%2Fhu1dJmxmoBhvTl8hybYSkbw0OaP3hyj1RE5WDi4Ff5MYq8R8HijuKF2Imx5IN1CCHpucfaT3CqKys4PcxQKmgpMmN2fRghAs4doFeaTZsRp1Jy%2FEmVgQwIjvayqjkviT4JX9KGdhxOtQEFWPti24b7GDIaDKb9lr2FOG0zJ17HRVyf%2B%2B4%2F8WCWcvATPenNRQQ%2FyPyL8CVCAnfgKqss1BZye%2FHnykDmEY97gC%2BTDgwkKf%2FdrZ61GSu545dqnQS2GiT5Wmk6OxuuC%2BXPuouqyDa23JhOMyXIVH7WxAO0HpgsMzSt5SRkxDPLCU0Vx2x4KDfIx7E3FWL2KODvg%3D%3D&generation=1684223444431195', '', 'imagen', '2023-05-16 05:50:33'),
(40, 14, 'post 17', 'post 17', 'https://storage.googleapis.com/austrian-economics-forum/VisualizarUsuarios.png?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=Y9%2FnR2RSIg6nzvPdeHHV74jfRGSrHCTXNiKLaQB%2BAHq4YofZwjidMCkkN98l00DULNTqDTsJngMfRan0z3GiI9AX%2B8lUxoQYO1dWDbGqy9reS80hGmTuJx%2B0rCt8w%2B%2F%2FNvDSLOnkt%2F8WnDYJrh02kPduD31JRdrqxQ%2F4v755KZQ5ZQFzY8dxagPpnI4fZ1VZtfVc7G3ArHWCim1FHEdV80q7xIRyWvxf9znQeBw7%2FWawXCrUKskxZIHccVPHkp2vbN%2B5SfJp9xScb%2Fany8SVo6B7e7tW22b0bTyHdhpE6CoWDvpaUOIrjjqLXh9QyJCyEXWQrcJkGfA7FgkLAJ%2FlOg%3D%3D&generation=1684223653677655', '', 'imagen', '2023-05-16 05:54:03'),
(41, 14, 'post 18', 'post 18', 'https://storage.googleapis.com/austrian-economics-forum/codebit2023.jpg?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=fzXimGCL7H0q5Gagw4pDGkANv7K3OSCkeew9apZ7w4fTtX6trKDKbDdvWHjnNCgmkixLIqVNFW9rIbPpHw9OxnrxHyxhDHQIs2cxLbOIZ5xZIcL2Dg2dRB80ibZpgiDZ8fCZFdFfGtF68wiwF8rZY1dshK5faOTwSV%2BAHRc7B8gE5Hzv%2FHTqQI5lVAtzeb01CzUO2Zb9ZsLCTriFdMsfGVW0SW68B%2FMIzcS9zTxv8WXVpJV6fqAVnjkthSfBmfHyLs4D0HjiyvbCpN7smLON06%2Fr%2FZqTu2DV3Ij4j7YwSh%2BoT2Zo18KkuNwEG7oIuKjXO5AxHCmTTj%2B%2F0xMDWvf2lQ%3D%3D&generation=1684223672268447', '', 'imagen', '2023-05-16 05:54:21'),
(42, 14, 'prueba de texto largo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\nSección 1.10.32 de \"de Finibus Bonorum et Malorum\", escrito por Cicero en el 45 antes de Cristo\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipis', 'https://storage.googleapis.com/austrian-economics-forum/naves-servicios.jpg?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=DOr4BbjvDgl%2FQdqJXjjND9RTsRtLyRqk%2FK469QRjEkfL5hsb4ImQyUXj9avvCctYQ4%2BsRUBxA4qBIFQ7rnTD9Irfpf5EMCN%2F7v9Qdt8OM%2FXLcSXXyEi0Nl8BNElZy9usLLd95TeT1MDb6fXy7xBExYWamY4s3q21CcVBKGc7supnJZ3RX5yNiuJwkkOCENybGyPPgn2sYABiBk9U7n%2FQagaP9h1QT%2BCEM3OTUbKFeiIguLtNJLRMb9nG6pTyfmPDAli4viqvddKNkST8YqpVVkzQJVcw6pRxT3OFHkmNuH4P2zQ3tNC6SnSibWI%2BYCedzkzo8Rrn940FUzSNcYly0A%3D%3D&generation=1685089327072341', '', 'imagen', '2023-05-26 06:21:51'),
(43, 15, 'Post de prueba para amigos', 'Post de prueba para amigos en index', 'https://storage.googleapis.com/austrian-economics-forum/finObra-servicios.jpg?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=l53lSQ3%2FqMwWb075uS0WSVA9mMFvL2rBjzbaEHLQC4G8XPme3y5uO9mLCluZrVnXgyqQ6HoME22THT0tNhKr5esXubiLEG5%2Boby78CV7A4uIXAaTjLrvGR0t4a01ejUIkc41pA%2BhTQLdxPUt2Tl%2BTURQwjMGswje0QGISoOzl866w02KXTR6WIC4G7Er7p2qpWyvnmKbzKxYO8ZMkDDJWArWdhfkfZEvA0SD7bZPMz0EKNX6Sz5mkhEfiAiVfH0sK1YWhB%2BhP6ULW5pVBGFbVygO6F%2F42wO4XQET6JtelutnAUNJu1vqW67nd2CCX7lxd4yHON0b08kS6%2BU6mi8fwQ%3D%3D&generation=1685694848521098', '', 'imagen', '2023-06-02 06:34:08'),
(44, 14, 'Los VÍNCULOS entre el BANCO CENTRAL y el SOCIALISMO | Jesús Huerta de Soto', 'El profesor Jesús Huerta de Soto explica cómo y por qué debemos abolir el banco central.\r\n\r\nCAPITALISMO, AHORRO Y TRABAJO DURU!!! MIAU...\r\nVIVA EL ANARCOCAPITALISMO', 'https://storage.googleapis.com/austrian-economics-forum/Los%20V%C3%8DNCULOS%20entre%20el%20BANCO%20CENTRAL%20y%20el%20SOCIALISMO%20_%20Jes%C3%BAs%20Huerta%20de%20Soto.mp4?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=UpAxcsEr5Wc2jgJ2gxb9lp7Y9jrtWJykQwH1sVGnoZyM3ekV4VVuREGM0KcRXC2n3xmizGfvdKZGy5YRf697eOa2KIh6UHydpGvJKUIcY898ZLJJza3qn19qrkYK2I%2BfkWtqmjfv8to2qK0xmHw3uJ6%2FXuMUAwY4HNC8%2BoeRq3FEERVYpokkKVv4MRICO0aczdps%2Bpyn6LKTWFLliQoftCcXpx9zUzNs7%2FkutM9G4yuQjKB9AMkQ%2BiwScZfV0oufh5heyWKX3rozZbYRqggBpeYjKQh3LywsTCBzdXwURfE95XVHgDEZH1z7MFbvu6kjMq%2Bn4dIkKB9J%2Bwq84k8hqw%3D%3D&generation=1686039792520975', '', 'video', '2023-06-06 06:23:02'),
(47, 14, 'NI ES JUSTICIA, NI ES SOCIAL', 'Primer capítulo de la serie \"Ni es justicia, ni es social\", una coproducción de Value School dirigida por el profesor Jesús Huerta de Soto que abordará a lo largo de tres entregas los pilares del Estado de Bienestar: las pensiones, la educación y la sanidad.', 'https://storage.googleapis.com/austrian-economics-forum/Nies_Justicia_Ni_Es_Social.m4a14?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=E5e%2BFppdYxeJkTMKi%2BmFmmSdw15jwNAAQnDp8TgwqpgA7Zd%2BZvfRpHP%2Bp3ts%2Bj8iUgfk2Lwt6rvT62xhi6M5iWucd20HzZ46WTxUfXmEuuH1T7zNnVIFD7k%2Ff%2FoJ94a4LaENSxugUsM1QL4Ev8pOFMrfYyL7JmYqDnOT6LX40mnkP98WxfEEC69HLzWHG3mRphTL15ohvhwigtI4OmL4MWner%2B07bGzF4qCcr%2FfMqG213XOSS0bF0xmLBx5fqlF2D8LnC5RUG0g2leh3fspEooxisbQJ8NmPk3Q6j8E1wqucGjAA%2FV6pzZzHKMgcf2LjNWUCpDNMsoPIljXce4tG6Q%3D%3D&generation=1686042031343259', '', 'audio', '2023-06-06 07:00:20'),
(48, 20, 'Solitario - A contracultura [ Letra ] (7. En defensa del arte)', 'A contracultura.\r\n\r\n[ La publicación de las nuevas obras se sostiene económicamente gracias a los seguidores que están apoyando el proyecto en Patreon. Si quieres que continúe puedes apoyarlo aquí: https://www.patreon.com/SolitarioOf \r\nTambién he abierto una TIENDA: https://solitarioropaoficial.com', 'https://storage.googleapis.com/austrian-economics-forum/SnapSave.io-Solitario%20-%20A%20contracultura%20%5B%20Letra%20%5D%20%287.%20En%20defensa%20del%20arte%29%28720p%29.mp420?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=oPKYyRke7MYH8psxLCA5qF2Kq1ZkT%2B%2FyLOMWAtBREvlMxgMLk4%2B3Kd6eZm9XF3uhDAt4KMrvTI%2B0jwudIWtmFeqGON4UZa%2FeA3bb59rncNHrrIKw94YQG%2F6MEd1Y5I52uUvkUNzKlGnRc20wgjKwi1JqNvHtovAhVmo2EPSJ6sNJHqEg8irfB%2B1JJySqZoNxoZQx57Ib7FJehMKbi8EdvV1D70WTsoHmuLkPguaDf7A8Vg11KhVvs9kJMXyJ7SX%2BqosWELl4yV2byM%2F9H4SaGQ840I%2BQD8b93uCGnVlQtGvtR2Nriizixej3Ot8q1aGlNACwbxsGW%2FVm%2F3%2B8ftAG%2Bw%3D%3D&generation=1686144295139005', '', 'video', '2023-06-07 11:24:44'),
(49, 20, 'prueba archivo', 'prueba archivo', 'https://storage.googleapis.com/austrian-economics-forum/WCF%20Tutorial.pdf20?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=ah93SL3zmsoYFLORjul1AxjHDx5jw5y8dykdjJp%2BVsa4ajPdBZEQDC7msO36VE55oYzaw3jzZ5ZNpGyNeHBnzGQRkzDUVzv13uoImQhpjpvWf7NKO9oNSO70aowlLZFpZwqGee0RuLCNQvoG2OJIo7r594v8I2f3sWEjlcHrZWNIIrgNTocZZIa6J87fbe4e7geAhwZxn59tH23LPuqkJokgRU6SEtT%2BE4RSdK3SnPuryCByH8Qw%2FyHDVXRjlnRdhjFM6GxABvHiDoxq42S1N6Qh1gNMJ8fwlJ%2FTE7iE4%2BWwbkiB0fW%2BO3%2BlqPa2d2%2BpnGNNTB6BWjs1FMa4U1S9cw%3D%3D&generation=1686144494941255', '', 'archivo', '2023-06-07 11:28:06'),
(50, 14, 'Recycled J - DIME ALGO (Audio Oficial)', 'Audio oficial de la canción de Recycled J \"DIME ALGO\" \r\n\r\nProducido por Pablo Rouss. Escrito por Jorge Escorial Moreno y Pablo Rouss. Grabado en Metropol Studios y por Pablo Rouss. Mezclado por Pablo Rouss. Masterizado por Alex Ferrer.', 'https://storage.googleapis.com/austrian-economics-forum/SnapSave.io-Recycled%20J%20-%20DIME%20ALGO%20%28Audio%20Oficial%29%28720p%29.mp414?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=K6nFp%2FTOuNLNlFskSXJOv641M6AHfmuraaBUlgZ6IjfN3B3RgD%2Bs32Uw%2B5w328n%2Bs567DyoCd3aMejSs4PEpJjtK1j6iqoNXNKJ7HNILXEK9IWWNdHsTTJz4usOZSDfzgOSQYgKv1Lvm5Lk3Z%2FFL98TsOKeSzi4q3q2bqKjeHLJLC5P6IJTNhYE0Nlvs%2FTjQLEwNov1G1MfBKaTvIAGW9nl63s%2Fj3i0p64XeB5Z8O%2FfK27sYqOdZ3QVIqMhjcGlaTteRrN1ncR8h%2FZuhWseNNua0G8GhwwVeHNFobtIbs%2BPAJ5quu6gEdd9wNxNFf3xXzfcVe9tDETCIsjGVSWpSRA%3D%3D&generation=1686146418962710', '', 'video', '2023-06-07 12:00:10'),
(51, 14, 'Recycled J, Selecta - LOS MUERTOS Y LAS FLORES (Audio Oficial)', 'Audio oficial de la canción de Recycled J \"LOS MUERTOS Y LAS FLORES\" junto a Selecta. Track 9 de CASANOVA.\r\n\r\nProducido por Selecta. Escrito por Jorge Escorial Moreno. Arreglos de guitarra por Pablo Rouss. Solo de guitarra por Juan Pablo Mejía. Grabado en Metropol Studios por Selecta. Mezclado por Pablo Jimenez. Masterizado por Alex Ferrer.', 'https://storage.googleapis.com/austrian-economics-forum/SnapSave.io-Recycled%20J%2C%20Selecta%20-%20LOS%20MUERTOS%20Y%20LAS%20FLORES%20%28Audio%20Oficial%29%28720p%29.mp414?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=TO7BTQInQg6K1i7dX8DQXqz8Yz%2FSIKReWtPVixrtpwm5BqzSAp3YajL34LoeLDKmAcXSTLv4QbBOUr9vXiwAuxMiGCh9n8ik%2FhFVejN969jpOiWfnEAbctTzSLsolwlPEIIut97TVevKRImPSGiIHtGYK55TMfGSnHWFoD%2FjwQV8%2F7oD50LnGZ%2BYRT%2FcKZ2JePFU1YbnjyPgG8EE64ih2OaNstQG57zUGbnuzwk1pTluOa75F6tMhj2DgV5WUoD0MoinoL9d1BPELSW%2B76K0K8igrtycS%2Fw9SXdpDyQmsSN7WYbsLpcSK4s4Q028M%2FmkzuVv%2FGnxYdt%2BsQKj021X%2FQ%3D%3D&generation=1686147148301445', '', 'video', '2023-06-07 12:12:19'),
(52, 14, 'El HOMBRE-MASA y la dictadura de la mayoría: por qué la actual democracia nos está destruyendo', 'Hoy la mayoría acepta que la democracia es la mejor forma de gobierno jamás concebida por el ser humano. Pero, ¿es realmente así? En su nuevo libro \"Contra la mayoría\", @JanoGarcia sostiene que, en democracia, el poder y la soberanía no los tiene el pueblo. Los mismos engranajes democráticos modernos impiden que el pueblo se gobierne a sí mismo y conducen inevitablemente a la peor de las dictaduras: un totalitarismo degenerado pero alegremente consentido y apoyado por la masa.', 'https://storage.googleapis.com/austrian-economics-forum/SnapSave.io-El%20HOMBRE-MASA%20y%20la%20dictadura%20de%20la%20mayor%C3%ADa_%20por%20qu%C3%A9%20la%20actual%20democracia%20nos%20est%C3%A1%20destruyendo%28720p%29.mp414?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=ESa3AN4GViAYyA2V0HcpYC7NZAKvLxol%2FLyvQfMLB%2FljEEvpbQBiWF2hCiXHEHmXu5GbpsaztvGUYJgkjUzWes3Ce9XNOUTWW1O381JOGkHKsaU2TdmdDoWq7BpqKWd1Cj1T3BnvncIFAINc4tq3Bjjhlx%2BWyJ0eCfsjS4RgxLWgBZn2pm1C3RkALIADTt6GXxdVPau2rFyIam%2FtXsbxp5Dd8jUYV8iAYXMTSrIgYtwiY4SjOwFDbp1%2F3mEmccK8KZbKmFwjvfwCMaP2BqDnsGGjIbDV2NAOwWB3RNR%2BjHfcTvRCOB1%2BDit%2B7WlLM9Y%2BX8%2Bpsp4Jc0O78VTt3A0YWw%3D%3D&generation=1686148351930087', '', 'video', '2023-06-07 12:32:23'),
(53, 14, 'ODISEA CAPITULO II - Zelia Narros', 'Colaboración con la artista emergente independiente @i.am.zelianarros  \r\nEn esta sesión hemos integrado varios instrumentos y sonidos Andaluces, destacando sobre todo la caja, utilizada normalmente en las agrupaciones musicales de Semana Santa.', 'https://storage.googleapis.com/austrian-economics-forum/SnapSave.io-ODISEA%20CAPITULO%20II%20-%20Zelia%20Narros%28720p%29.mp414?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=Oha9DCi2m8pw4CxhTxv9lzG69MvaVMYYytLplfILPnPym4UYUS8QnUn7yZnRkvgUdGCv57227c1w%2BM%2BqqcDnWazTP4hVcY%2Fh8bkVKr6wCh7awahxLbp3nj%2FteKibs2fGThXcQKBLioQv4Yp0hP1hxW9RMlmZ8VQS1o3cwHO%2Fnvx4YJefhqFJbTQLrFUs0w7Oy6k8rOxW03BBkMRLxw3joilgP67RzUgjFnh9VJv9LMxktSwC%2FQnsetLrKY2SMCdzbPhCPchRRSz%2FLcCvKip3YhpA9c1mwrMn7osE0F6kmxI9bg7g%2Fpz%2FBccG49paCfljRmDiWlFrKNkf5Czpu0%2FB6Q%3D%3D&generation=1686152851690256', '', 'video', '2023-06-07 13:47:20'),
(54, 14, 'prueba ordenacion por fecha', 'prueba ordenación por fecha', 'https://storage.googleapis.com/austrian-economics-forum/NOA.mp414?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=J1Yd%2Fivc3O9YHkyZwGGiDh1vp8wT2UrIJfaPN9MMQN9%2B9cxo4oTXqNLu5vdJHonxvbfPtFh0v38S22iC4s4qF4GRlw7rmdwz8%2F9VsevxlBl3EKVqwrvIwXhYTbm0zxiQ3wRh8k8RM7hnngcGWegQUQs57qXzuEji3PylqR2n9mk8qD2U%2FrIB4PQA14iPdJqbJdBMx5YYqveIrC3n6a6DiPbeTv6dZ4xE%2BilpsSRRQF9TbwFMsEEZfKm2ZkMVyHUP0zG4iTheGfCQyh%2BviTTylNFDzkxEpNGt4z87yFOVAN6bjsaN2e%2FoJW5rZfgMM7YhidJGa%2B7VwvWaGwb%2BhK34RA%3D%3D&generation=1686504444219330', '', 'video', '2023-06-11 15:27:19'),
(55, 14, 'prueba', 'prueba125', NULL, '', NULL, '2023-06-11 17:31:17'),
(56, 14, 'prueba imagen', 'prueba imagen 125', 'https://storage.googleapis.com/austrian-economics-forum/Aragorn.webp14?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=QefcyxgyolqJbV%2B%2Bv6FzwKyaDx1m22l1POWtT0EnAgeepL6fhYITNNRIHqxX1U%2F5Lwld4%2FzQrtu1t1Q%2BuAnDJcMh2kno%2BMCzt%2FeAhETI2xIWQf3zMnq2emvXpaXbTIVS4RBIBahnNKpgOcsseQ0tNUvRBgpjZEwHB3o89VIiam8N03zEPfz0qd1NHlgN1zj3ZAXoq6TPv%2FM0dtaW8napXVozGJFCdsXfMwhH25NmUKkSWS%2FsvLLHlMip0zkCYplXiQ0lBlFVIguAy2BBBYCBlp894AOwvY3Ke6NWCWihBPHuSn%2FlJY%2BmC%2BUkmU8cu6Aeu0T%2F8d637bMKASkI6qDC5A%3D%3D&generation=1686504724741348', '', 'imagen', '2023-06-11 15:32:04'),
(57, 14, 'prueba video', 'prueba video 130', 'https://storage.googleapis.com/austrian-economics-forum/Aprende%20a%20usar%20estos%20m%C3%A9todos%20de%20Array%20en%20JavaScript%20para%20mejorar%20tu%20c%C3%B3digo.mp414?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=LYjJXcgRPx3cXxugfyahKa4zft8znquLuDj1BKMF5DhvtcXD42IDIK42rbMf%2F7w%2B9aUcpm8cNWWKv%2FsWPIOYinvktBIVM0Q0wqL74cq69BKej%2Fr6qOEpOhswZftFdlzJCcAQ0sWuX0ADdbunhdT%2FfIIwLOYF2Sys%2BoiqdgmSqtIIG0MAaPVLv04oIRdmt5iWwXCbJ2CQE6Ne0GDOtieNyEfLqgWyv08oKWf%2BGyE9kIGfxjZySZbXhdWaekJXDHvi%2BYdHEYOHJDnevzHjfxXcyhXlxbEVNJ7pDEKAUMcSfulJQISv3tDlYVSIfTwfPntm%2BC6ps93G7I5E5%2B5d8dY62g%3D%3D&generation=1686504781276410', '', 'video', '2023-06-11 15:32:57'),
(58, 14, 'prueba eliminacion de objetos en google storage', 'prueba eliminacion de objetos en google storage', 'https://storage.googleapis.com/austrian-economics-forum/Ni%C3%B1o%20Anarquista%20-%20Un%20Rey%20En%20Nueva%20York%20%28charles%20chaplin%29.mp41414?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=Lf5raRDjIW8wunGrAsn6SH6mKeH7%2B0ST4hUROMVJWeZ4%2FXPcy2ISNNmOCd4xIcK8wVicWy6qS9EBYpEv3V4nveXGrvK15MRdJhYQqRU6arE7q5JrtQ4w%2Faj0%2BqYmguELXCQIO6ISy66kKMggRRSl6GZhR3rWgyLmdwKL92cTpbwDXWvB6XnwjrF1QY8FpRgpUERDW96Jtz%2BV3DC5cbJ%2FN%2FBIST3kvVgCh8i%2FhuUtrmkxCR%2BFUDqMLBeZ15yMBbSV6eo1MUJqV9bhKUWTJKtPPVCVou12cgXmaupJIrMgmpKYStI59Styux9oKqtnceoKysPks2qhoCU8A6Wgw5knRQ%3D%3D&generation=1686505724073442', 'Niño Anarquista - Un Rey En Nueva York (charles chaplin).mp41414', 'video', '2023-06-11 15:48:39'),
(59, 14, 'Murray Rothbard', 'Murray Rothbard', 'https://storage.googleapis.com/austrian-economics-forum/511-2cc0883763f598364c16600902008735-640-0.png1414?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=nF2H%2BkcDmbZiNGWnYGbLuCdykcirJwqFIqopDM8liVmDPwdxhpchQEoQD4EnJ6m2L20VVMbzH7kkZjPRfek5mOkox8wtEbmXItpvQCeCAgmCU4euyE7mJSC%2F5eEC7yYeHJ1%2Fs1iTPVS2wPR5GIFKFtOIXq5vrFrkKTLPQnPKyiRi7HrDxz0xwWUjNXcIkyPPX8DoPFw3lhfdRtX3xXQlW4Db0eAFj7JNCw2jle128PNIr7COSt2xP2LT%2Fue8c2rtrJZPcRHkfq2p%2FhOPXt01EHc%2B%2B2qVw%2BmVzb%2BWf0JllUYtYKzNtMw4ek48aqzAezfhKjz34DhEGAgLbKXJnTTuNw%3D%3D&generation=1686521377113403', '511-2cc0883763f598364c16600902008735-640-0.png1414', 'imagen', '2023-06-11 20:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes_dislikes`
--

CREATE TABLE `post_likes_dislikes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_likes_dislikes`
--

INSERT INTO `post_likes_dislikes` (`id`, `post_id`, `usuario_id`, `fecha`) VALUES
(9, 38, 14, '2023-06-02 11:46:22'),
(32, 25, 14, '2023-06-02 11:56:57'),
(41, 47, 14, '2023-06-06 09:10:47'),
(44, 44, 20, '2023-06-07 08:01:38'),
(47, 43, 14, '2023-06-07 12:58:49'),
(56, 23, 14, '2023-06-07 13:08:48'),
(57, 44, 14, '2023-06-07 13:11:24'),
(58, 48, 20, '2023-06-07 13:52:16'),
(59, 48, 14, '2023-06-07 13:52:33'),
(60, 50, 14, '2023-06-07 14:02:43'),
(61, 51, 14, '2023-06-07 14:12:34'),
(62, 52, 14, '2023-06-07 14:36:15'),
(64, 53, 14, '2023-06-08 10:37:12'),
(65, 49, 14, '2023-06-11 17:26:10'),
(69, 59, 14, '2023-06-11 23:26:45');

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
(14, 'pablete_pollo', 'pabloskyisan1998@gmail.com', '$2y$10$e8RK5kst3/eXQs55sjvdXOQJsNq7x7eeV8SzWqd8SQwO85kFQ62l6', '2023-05-02 07:09:37'),
(15, 'oscar', 'mail@pruebas.com', '$2y$10$u/NR1gDYGBj2UVeDXBm7IOol2A6kD9J9HyEI.bpBodZfPTbk8qhyO', '2023-05-16 10:11:38'),
(17, 'pruebas', 'mail1@pruebas.com', '$2y$10$2W1LpQs.ggSQQQ6XqcAe/uPMjmDFuwRhuxtaZj4gs9Ra8S7uQUv2W', '2023-06-02 09:17:38'),
(18, 'prueba3', 'prueba3@gmail.com', '$2y$10$3XDu.9eq1.HfWz3ptXCeSO2OQZypKHy7G5orBMtf69gP.mAgTDLOK', '2023-06-02 10:36:18'),
(20, 'pruebaIndex', 'pruebaIndex@gmail.com', '$2y$10$jzsFsrhQ6x1N2CFia/Qjou0Q1FHMWjG5QdQCHlirSUvjzY6cuF/q2', '2023-06-07 07:55:18');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `post_likes_dislikes`
--
ALTER TABLE `post_likes_dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `amigos_ibfk_1` FOREIGN KEY (`usuario_id1`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `amigos_ibfk_2` FOREIGN KEY (`usuario_id2`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `post_likes_dislikes`
--
ALTER TABLE `post_likes_dislikes`
  ADD CONSTRAINT `post_likes_dislikes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_likes_dislikes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
