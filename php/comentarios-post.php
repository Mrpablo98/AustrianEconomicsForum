<?php
session_start();
if (!isset($_SESSION['user'])) {
    // Si el usuario no está autenticado, devolver un error 403
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
    exit;
}
include("../connection.php");

$start = isset($_GET['startComent']) ? intval($_GET['startComent']) : 0;
$limit = isset($_GET['limitComent']) ? intval($_GET['limitComent']) : 15;
$postId = isset($_GET['postId']) ? intval($_GET['postId']) : $postId;
$userId = isset($_SESSION['user']['user-id']) ? intval($_SESSION['user']['user-id']) : 0;
$sql = $mysqli->prepare('SELECT * FROM comentarios WHERE post_id = ? ORDER BY comentarios.id DESC LIMIT ?, ?');
$sql->bind_param("iii", $postId, $start, $limit);
$sql->execute();
$Comentresult=$sql->get_result();

$coments = [];
while($row = $Comentresult->fetch_assoc()) {
    $coments[] = $row;
}

$response = array(
    "coments" => $coments,
    "userId" => $userId
);

echo json_encode($response);