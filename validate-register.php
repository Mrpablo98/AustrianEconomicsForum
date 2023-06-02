<?php
extract($_POST);
$password = trim($_POST['password']);
$Rpassword = trim($_POST['Rpassword']);
$error = false;

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
if (!isset($Rpassword) || $password != $Rpassword) {
    $error = true;
    echo 'Las contraseñas no coinciden';
}


include("connection.php");

if (!$error) {




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


        header("Location: log-in.html");
    }
}
