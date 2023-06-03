<?php
session_start();
include("connection.php");
$userId=$_SESSION['user']['user-id'];

$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 15;
$sql = $mysqli->prepare('SELECT usuarios.nombre, posts.id, posts.titulo, posts.contenido, posts.url_recurso, posts.tipo, COUNT(post_likes_dislikes.usuario_id) AS likes
FROM usuarios
INNER JOIN amigos ON (usuarios.id = amigos.usuario_id2 OR usuarios.id = amigos.usuario_id1)
INNER JOIN posts ON usuarios.id = posts.usuario_id
LEFT JOIN post_likes_dislikes ON posts.id = post_likes_dislikes.post_id
WHERE (amigos.usuario_id1 = ? OR amigos.usuario_id2= ?) AND posts.usuario_id != ?
GROUP BY posts.id
ORDER BY posts.id DESC LIMIT ?, ?');
if(!$sql){ 'Error: ' . $mysqli->error;}
$sql->bind_param("iiiii", $userId, $userId, $userId, $start, $limit);
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