<?php

require_once("../connection.php");
session_start();

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