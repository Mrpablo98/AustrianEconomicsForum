<?php
require_once("../connection.php");
$id1=$_GET['user1'];
$id2=$_GET['user2'];
$sql="DELETE FROM amigos WHERE usuario_id1 = ? AND usuario_id2 = ? OR usuario_id1 = ? AND usuario_id2 = ?";
$sql=$mysqli->prepare($sql);
$sql->bind_param("iiii",$id1,$id2,$id2,$id1);
$sql->execute();
header("Location: ../perfil.php?id=$id2");

