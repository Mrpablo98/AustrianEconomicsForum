<?php
session_start();
require_once("connection.php");
$userId=$_SESSION['user']['user-id'];
$username=$_SESSION['user']['username'];
$comentario=$_POST['comentario'];
$postId=$_POST['postId'];
$sql='INSERT INTO comentarios (contenido, post_id, usuario_id, username) VALUES (?, ?, ?, ?)';
$sql=$mysqli->prepare($sql);
$sql->bind_param("siis", $comentario, $postId, $userId, $username);
$sql->execute();
$sql->close();
$mysqli->close();
