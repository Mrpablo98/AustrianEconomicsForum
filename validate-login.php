<?php
include("connection.php");
extract($_POST);
$password=trim($_POST['password']);
$sql = $mysqli->prepare('SELECT * FROM usuarios WHERE nombre = ?');
$sql->bind_param("s", $username);

// Ejecuta la consulta
$sql->execute();

// Obtiene el resultado
$result = $sql->get_result();

// Verifica si el usuario existe
if ($result->num_rows > 0) {
    // Obtiene los datos del usuario
    $user = $result->fetch_assoc();
    $passwordHash=$user["password_hash"];
    // Verifica la contraseña
    if (password_verify($password, $passwordHash)) {
        echo "Inicio de sesión exitoso";
        session_start();
        $_SESSION['user']=[
            'user-id' => $user['id'],
            'username' => $user['nombre'],
        ];
        echo $_SESSION['user']['username'];

       /* header("Location: index.php");*/
    } else {
        $contraseña=password_hash($password, PASSWORD_DEFAULT);
        echo "Contraseña incorrecta: $password<br>Contraseña incorrecta hasheada: $contraseña<br>Contraseña correcta: $user[password_hash]<br> Ususario: $user[nombre]";
        /*header("Location: log-in.html?error=password");*/
    }
} else {
    echo "El usuario no existe";
   
}

$sql->close();