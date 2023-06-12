<?php
session_start();
require_once("../connection.php");
$userId=$_SESSION['user']['user-id'];
$sql=$mysqli->prepare('DELETE FROM usuarios WHERE id = ?');
$sql->bind_param("i", $userId);
$sql->execute();
if(!$sql){
    die( "Id: " . $userId . " Error: " . $sql . "<br>" . $mysqli->error);
}
$sql->close();
$mysqli->close();
header("Location: ../session-destroy.php");