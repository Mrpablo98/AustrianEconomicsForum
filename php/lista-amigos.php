
<?php
session_start();
require_once("../connection.php");
$userId=$_GET['id'];
$loggedUserId = $_SESSION['user']['user-id'];;
$sql= "
SELECT * 
FROM usuarios 
JOIN amigos 
ON (usuarios.id = amigos.usuario_id2 OR usuarios.id = amigos.usuario_id1) 
WHERE amigos.aceptada = 1 
AND (amigos.usuario_id1 = ? OR amigos.usuario_id2 = ?) 
AND usuarios.id <> ?
";
if(!$sql){
    echo "Error: " . $sql . "<br>" . $mysqli->error;}
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iii", $userId, $userId, $userId);
$stmt->execute();
if(!$stmt){
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$result = $stmt->get_result();
$amigos = [];
while($row = $result->fetch_assoc()) {
    $amigos[] = $row;
}
$response=array("amigos"=>$amigos, "loggedUserId"=>$loggedUserId);
echo json_encode($response);