<?php
extract($_POST);
$password = trim($_POST['password']);
$Rpassword = trim($_POST['Rpassword']);
$error = '';
include("../connection.php");
$sql = $mysqli->prepare('SELECT id FROM usuarios WHERE nombre=?');
$sql->bind_param("s", $username);
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
    $error = 'username';
    echo 'El nombre de usuario ya existe';
}
$sql = $mysqli->prepare('SELECT id FROM usuarios WHERE email=?');
$sql->bind_param("s", $email);
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
    $error = 'email';
    echo 'El e_mail ya existe';
    
}

if (!isset($username) || strlen($username) < 4 || strlen($username) > 12) {
    $error = "name";
    echo 'El nombre se usuario debe contener al menos 4 caracteres y menos de 12';
}
if (!isset($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $error = 'email';
    echo 'Introduce un e_mail valido';
}
if (!isset($password) || strlen($password) < 6) {
    $error = 'password';
    echo 'La contraseña debe contener al menos 6 caracteres';
}
if (!isset($Rpassword) || $password != $Rpassword) {
    $error = 'Rpassword';
    echo 'Las contraseñas no coinciden';
}




if (strlen($error)==0) {




    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = $mysqli->prepare('INSERT INTO usuarios (nombre,email,password_hash,fecha_registro) VALUES (?,?,?,?)');
    if ($sql === false) {
        die("Error preparing statement: " . $mysqli->error);
    }
    date_default_timezone_set('Europe/Madrid');
    $fecha_registro = date("Y-m-d H:i:s");
    $sql->bind_param("ssss", $username, $email, $password_hash, $fecha_registro);
    if ($sql->execute() == false) {
        echo "Error al ejecutar la consulta" . $sql->error;
    } else {
        session_start();
        $_SESSION['user'] = [
            'username' => $username,
        ];


        header("Location: ../log-in");
    }
}else{
    header("Location: ../register?error=$error");
}
