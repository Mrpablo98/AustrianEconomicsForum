<?php

require_once("../connection.php");
session_start();
if (!isset($_SESSION['user'])) {
    // Si el usuario no está autenticado, devolver un error 403
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
    exit;
}
$userId = $_SESSION['user']['user-id'];
$postId = $_POST['postId'];

$sql = "SELECT * FROM post_likes_dislikes WHERE post_id = ? AND usuario_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $postId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // El usuario ha dado 'like' a este post
    echo "img/like2_icon.svg";
} else {
    // El usuario no ha dado 'like' a este post
    echo "img/like_icon.svg";
}

$stmt->close();
$mysqli->close();