<?php
session_start();
include("connection.php");
$userId=$_SESSION['user']['user-id'];

$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 15;
$userId = isset($_GET['id']) ? intval($_GET['id']) : $userId;
$sql = $mysqli->prepare('SELECT posts.id, posts.titulo, posts.contenido, posts.url_recurso, posts.tipo, COUNT(post_likes_dislikes.usuario_id) AS likes
FROM posts
LEFT JOIN post_likes_dislikes ON posts.id = post_likes_dislikes.post_id
GROUP BY posts.id
ORDER BY likes DESC LIMIT ?, ?');
$sql->bind_param("ii", $start, $limit);
$sql->execute();
$Postresult=$sql->get_result();

$posts = [];
while($row = $Postresult->fetch_assoc()) {
    $posts[] = $row;
}

echo json_encode($posts);
?>