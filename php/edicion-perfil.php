<?php
session_start();
require_once("../connection.php");
$userId=$_SESSION['user']['user-id'];
$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
$Rpassword=$_POST['Rpassword'];
$oldPassword=$_POST['old-password'];
$error=false;
$oldPasswordError=false;
$emailError=false;
$usernameError=false;
$passwordError=false;
$RpasswordError=false;
$url='Location: ../edit-perfil.php?id='.$userId;
$sql=$mysqli->prepare('SELECT * FROM usuarios WHERE id = ?');
$sql->bind_param("i", $userId);
$sql->execute();
$result = $sql->get_result();
$user = $result->fetch_assoc();

if(!password_verify($oldPassword, $user['password_hash'])){
    $error=true;
    $oldPasswordError=true;
    $url=$url.'&errorOld=oldPassword';
}
if (!isset($username) || strlen($username) < 4) {
    $error = true;
    $usernameError=true;
    $url=$url.'&errorName=username';
    
}
if (!isset($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $error = true;
    $emailError=true;
    $url=$url.'&errorMail=email';
}
if (!isset($password) || strlen($password) < 6) {
    $error = true;
    $passwordError=true;
    $url=$url.'&errorPassword=password';
}
if ($password != $Rpassword) {
    $error = true;
    $RpasswordError=true;
    $url=$url.'&errorRpassword=Rpassword';
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
}else if($error){
    if($oldPasswordError){
        header($url);
    }else if($usernameError){
        header($url);
    }else if($emailError){
        header($url);
    }else if($passwordError){
        header($url);
    }
    else if($RpasswordError){
        header($url);
    }
}



?>