<?php
require_once("connection.php");
session_start();
$peticiones=[];
$id=$_SESSION['user']['user-id'];
$sql = "SELECT * FROM amigos WHERE usuario_id2 = ? AND aceptada = 0";
$sql=$mysqli->prepare($sql);
$sql->bind_param("i",$id);
$sql->execute();
$result=$sql->get_result();
while ($row = $result->fetch_assoc()) {
    $sql="SELECT nombre FROM usuarios WHERE id = ?";
    $sql=$mysqli->prepare($sql);
    $id2=$row['usuario_id1'];
    $sql->bind_param("i",$id2);
    $sql->execute();
    $result2=$sql->get_result();
    $row2=$result2->fetch_assoc();
    $peticiones[] = 
    "<p style='text-align:center;'>". "<a href='perfil.php?id=$id2'><span style='font-weight:bold;'>". $row2['nombre']. "</span></a>" . " quiere ser tu amigo" . "</p>".
    "<div class='peticion-buttons'>". "<input type='hidden' id='userId' name='userId' value=". $id2 .">" ."<button class='aceptar-button'>Aceptar</button>".
    "<button class='cancelar-button'>Cancelar</button>"."</div>";
}

echo implode($peticiones);