<?php
require_once("../connection.php");
session_start();
if (!isset($_SESSION['user'])) {
    // Si el usuario no está autenticado, devolver un error 403
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
    exit;
}
$accion=$_POST['accion'];
$userId1=$_POST['userId'];
$userId2=$_SESSION['user']['user-id'];
if($accion=='aceptar'){
    $sql="UPDATE amigos SET aceptada = 1 WHERE usuario_id1 = ? AND usuario_id2 = ?";
    $response = "aceptada";
    
}else{
    $sql="DELETE FROM amigos WHERE usuario_id1 = ? AND usuario_id2 = ?";
    $response = "rechazada";
}
$sql=$mysqli->prepare($sql);
$sql->bind_param("ii",$userId1,$userId2);
$sql->execute();
echo json_encode("Id1: $userId1, Id2: $userId2, Accion: $accion, Response: $response");

