<?php
session_start();
require_once("connection.php");
$userId=$_SESSION['user']['user-id'];
$username=$_SESSION['user']['username'];
$comentario=$_POST['comentario'];
$postId=$_POST['postId'];
$sql='INSERT INTO comentarios (post_id, usuario_id, contenido, username) VALUES (?, ?, ?, ?)';
$sql=$mysqli->prepare($sql);
if(!$sql){echo 'Error: ' . $mysqli->error;}
$sql->bind_param("iiss", $postId, $userId, $comentario, $username);
$sql->execute();
echo json_encode($sql->error);
$sql->close();
$mysqli->close();
