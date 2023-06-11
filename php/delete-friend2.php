<?php
session_start();
require_once("../connection.php");
$userId=$_SESSION['user']['user-id'];
$friendId=$_POST['id'];
$sql= "DELETE FROM amigos WHERE (usuario_id1 = ? AND usuario_id2 = ?) OR (usuario_id1 = ? AND usuario_id2 = ?)";
if(!$sql){
    die( "Error: " . $sql . "<br>" . $mysqli->error);}
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iiii", $userId, $friendId, $friendId, $userId);
$stmt->execute();
if(!$stmt){
    die( "Error: " . $sql . "<br>" . $mysqli->error);
}
echo json_encode("deleted");
