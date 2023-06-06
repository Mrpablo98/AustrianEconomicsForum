<?php
require_once("../connection.php");
session_start();
$comentId=$_POST['comentId'];
$sql=$mysqli->prepare("DELETE FROM comentarios WHERE id=?");
$sql->bind_param("i", $comentId);
$sql->execute();
echo json_encode("deleted"); 
?>