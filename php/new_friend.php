<?php
require("../connection.php");
session_start();
if (!isset($_SESSION['user'])) {
    // Si el usuario no está autenticado, devolver un error 403
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
    exit;
}
if (!isset($_SESSION['user'])) {
    // Si el usuario no está autenticado, devolver un error 403
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
    exit;
}
$Id1 = $_GET['user1'];
$Id2= $_GET['user2'];
$sql = $mysqli->prepare('INSERT INTO amigos (usuario_id1, usuario_id2, aceptada) VALUES (?, ?, ?)');
$aceptada=false;    
$sql->bind_param("iii", $Id1, $Id2, $aceptada);
$sql->execute();
header("Location: ../perfil.php?id=$Id2");

?>