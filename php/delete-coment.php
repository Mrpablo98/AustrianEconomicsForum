<?php
require_once("../connection.php");
session_start();
if (!isset($_SESSION['user'])) {
    // Si el usuario no está autenticado, devolver un error 403
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
    exit;
}
$comentId=$_POST['comentId'];
$sql=$mysqli->prepare("DELETE FROM comentarios WHERE id=?");
$sql->bind_param("i", $comentId);
$sql->execute();
echo json_encode("deleted"); 
?>