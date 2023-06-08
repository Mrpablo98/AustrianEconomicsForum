<?php
session_start();
require_once("../connection.php");
$userId=$_SESSION['user']['user-id'];
$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
$oldPassword=$_POST['old-password'];
$error=false;

$sql=$mysqli->prepare('SELECT * FROM usuarios WHERE id = ?');
$sql->bind_param("i", $userId);
$sql->execute();
$result = $sql->get_result();
$user = $result->fetch_assoc();

if(!password_verify($oldPassword, $user['password_hash'])){
    $error=true;
}
if (!isset($username) || strlen($username) < 4) {
    $error = true;
    echo 'El nombre se usuario debe contener al menos 4 caracteres';
}
if (!isset($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $error = true;
    echo 'Introduce un e_mail valido';
}
if (!isset($password) || strlen($password) < 6) {
    $error = true;
    echo 'La contraseña debe contener al menos 6 caracteres';
}


if(!$error){
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql=$mysqli->prepare('UPDATE usuarios SET nombre=?, email=?, password_hash=? WHERE id=?');
    $sql->bind_param("sssi", $username, $email, $password_hash, $userId);
    $sql->execute();
    $sql->close();
    $mysqli->close();
    $_SESSION['user']=[
        'user-id' => $userId,
        'username' => $username,
    ];
    header("Location: ../edit-perfil.php?id=$userId");
}else{
    header("Location: ../edit-perfil.php?error=error");
}



?>