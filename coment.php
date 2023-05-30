<?php
session_start();
require_once("connection.php");
$userId=$_SESSION['user']['user-id'];
$comentario=$_POST['comentario'];
$postId=$_POST['postId'];
$sql='INSERT INTO comentarios (contenido, post_id, usuario_id) VALUES (?, ?, ?)';
$sql=$mysqli->prepare($sql);
$sql->bind_param("sii", $comentario, $postId, $userId);
$sql->execute();
$sql->close();
$mysqli->close();
