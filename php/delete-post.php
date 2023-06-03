<?php

require_once("../connection.php");
session_start();
$postId=$_POST['postId'];
$sql=$mysqli->prepare("DELETE FROM posts WHERE id=?");
$error="error";


$bind_result = $sql->bind_param("i", $postId);


$execute_result = $sql->execute();

$sql->close();
echo json_encode("deleted"); 
?>
