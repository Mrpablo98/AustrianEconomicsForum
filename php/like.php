<?php
require_once("../connection.php");
session_start();
if (!isset($_SESSION['user'])) {
    // Si el usuario no está autenticado, devolver un error 403
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
    exit;
}
$userId=$_SESSION['user']['user-id'];
$postId=$_POST['postId'];
$liked=$_POST['liked'];
if($liked=="true"){
    $sql='DELETE FROM post_likes_dislikes WHERE post_id = ? AND usuario_id = ?';
    $action="unliked";
    
}else{
    $sql='INSERT INTO post_likes_dislikes (post_id, usuario_id) VALUES (?, ?)';
    $action='liked';
}

    $sql=$mysqli->prepare($sql);
    $sql->bind_param("ii", $postId, $userId);
    $sql->execute();
    $sql->close();
    $mysqli->close();
    echo json_encode($action);
