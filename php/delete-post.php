<?php

require_once("../connection.php");
session_start();
$postId=$_POST['postId'];
$sql=$mysqli->prepare("DELETE FROM posts WHERE id=?");
$error="error";
if ($sql===false) {
    $error=$mysqli->error;
}

$bind_result = $sql->bind_param("i", $postId);
if ($bind_result === false) {
    $error=$mysqli->error;
}

$execute_result = $sql->execute();
if ($execute_result === false) {
    $error=$mysqli->error;
}
$sql->close();
echo json_encode("deleted"); 
?>
