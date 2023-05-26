<?php
session_start();
include("connection.php");

$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 15;
$postId = isset($_GET['id']) ? intval($_GET['id']) : $postId;
$sql = $mysqli->prepare('SELECT * FROM comentarios WHERE post_id = ? LIMIT ?, ?');
$sql->bind_param("iii", $postId, $start, $limit);
$sql->execute();
$Comentresult=$sql->get_result();

$coments = [];
while($row = $Comentresult->fetch_assoc()) {
    $coments[] = $row;
}

echo json_encode($coments);