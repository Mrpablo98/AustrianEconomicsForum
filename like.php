<?php
require_once("connection.php");
session_start();
$userId=$_SESSION['user']['user-id'];
$postId=$_POST['postId'];
$liked=$_POST['liked'];
if($liked){
    $sql='DELETE FROM likes WHERE post_id = ? AND usuario_id = ?';
    $action="unliked";
    
}else{
    $sql='INSERT INTO likes (post_id, usuario_id) VALUES (?, ?)';
    $action='liked';
}
    $sql=$mysqli->prepare($sql);
    $sql->bind_param("ii", $postId, $userId);
    $sql->execute();
    $sql->close();
    $mysqli->close();
    echo json_encode($action);
