<?php
session_start();
if (!isset($_SESSION['user'])) {
    // Si el usuario no está autenticado, devolver un error 403
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
    exit;
}
require_once("../connection.php");
$userId=$_SESSION['user']['user-id'];
$username=$_SESSION['user']['username'];
$comentario=$_POST['comentario'];
$postId=$_POST['postId'];
$sql='INSERT INTO comentarios (post_id, usuario_id, contenido, username) VALUES (?, ?, ?, ?)';
$sql=$mysqli->prepare($sql);
if(!$sql){echo 'Error: ' . $mysqli->error;}
$sql->bind_param("iiss", $postId, $userId, $comentario, $username);
$sql->execute();
$comentId=$sql->insert_id;
echo json_encode(array('username' => $username, 'id' => $userId, 'comentId'=>$comentId));

$sql->close();
$mysqli->close();
