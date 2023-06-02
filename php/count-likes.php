<?php
require_once("../connection.php");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['postId'])) {
    $postId = $_POST['postId'];
    
    $stmt = $mysqli->prepare("SELECT COUNT(*) as likes FROM post_likes_dislikes WHERE post_id = ?");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['likes'];
    } else {
        echo 0;
    }
}