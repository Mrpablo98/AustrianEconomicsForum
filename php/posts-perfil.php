<?php
session_start();
include("../connection.php");
$userId=$_SESSION['user']['user-id'];

$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 15;
$id = isset($_GET['id']) ? intval($_GET['id']) : $userId;
$sql = $mysqli->prepare('SELECT * FROM posts WHERE usuario_id = ? LIMIT ?, ?');
$sql->bind_param("iii", $id, $start, $limit);
$sql->execute();
$Postresult=$sql->get_result();

$posts = [];
while($row = $Postresult->fetch_assoc()) {
    $posts[] = $row;
}

$response = array(
    "posts" => $posts,
    "userId" => $userId
);

echo json_encode($response);
?>