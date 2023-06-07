<?php
require("../connection.php");
$Id1 = $_GET['user1'];
$Id2= $_GET['user2'];
$sql = $mysqli->prepare('INSERT INTO amigos (usuario_id1, usuario_id2, aceptada) VALUES (?, ?, ?)');
$aceptada=false;    
$sql->bind_param("iii", $Id1, $Id2, $aceptada);
$sql->execute();
header("Location: ../perfil.php?id=$Id2");

?>