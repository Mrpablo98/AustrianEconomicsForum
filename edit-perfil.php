<?php
session_start();
require_once("connection.php");
$userId=$_SESSION['user']['user-id'];
$sql="SELECT * FROM usuarios WHERE id = ?";
$sql=$mysqli->prepare($sql);
$sql->bind_param("i", $userId);
$sql->execute();
$result=$sql->get_result();
$sql->close();
$mysqli->close();
$user=mysqli_fetch_assoc($result);

$userName=$user['nombre'];
$password=$user['password_hash'];
$email=$user['email'];
$user=$_SESSION['user'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AustrianEconomicsForum</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png">
    <script src="https://kit.fontawesome.com/7fc86cc57f.js" crossorigin="anonymous"></script>


</head>
<body>
    
    <div class="container-all-index">
        <div class="menu">
            <a href="index.php"><img src="img/logo-dark-menu.png" class="menu_logo"></a>
            <nav class="navbar">
                <a href="index.php" ><div class="menu_item">
                    <i class="fa-solid fa-house fa-lg" style="color: #ffffff;"></i><p>Inicio</p>
                </div></a>

                <div class="menu_item" id="search-button">
                    <i class="fa-solid fa-magnifying-glass fa-lg" style="color: #ffffff;"></i><p>Buscar</p>
                </div>

                <a href="explore.php" ><div class="menu_item">
                    <i class="fa-solid fa-compass fa-lg" style="color: #ffffff;"></i><p>Explorar</p>
                </div></a>

                <a href="publicar.php" ><div class="menu_item">
                <i class="fa-solid fa-plus fa-lg" style="color: #ffffff;"></i><p>Publicar</p>
                </div></a>

                <a href="noticias.php" ><div class="menu_item">
                <i class="fa-sharp fa-solid fa-newspaper"></i><p>Noticias</p>
                </div></a>

                <div class="menu_item " id="notificacion">
                <i class="fa-solid fa-bell" style="color: #f2f2f2;"></i><p>Notificaciones</p>
                <div id="noti-ball"></div>
                </div>
                <div class="lista-peticiones" id="lista-peticiones"><p style="text-align:center;">No tienes notificaciones pendientes.</p></div>

                <a <?php $id=$user['user-id'];  echo "href='perfil.php?id=$id'"?> ><div class="menu_item">
                    <img src="img/icon.png" class="index-perfil-img"><p ><?php echo $user['username']; ?></p>
                </div></a>
            
            </nav>
            <div class='options-container'>
                    <form class='closed-options' id='options-form' methos='POST' action='session-destroy.php'>
                        <ul class='closed-options'id='options-container'>
                            <li class='options-item'><button type='submit' class='options-button'>Cerrar sesión</button></li>
                            <li class='options-item'>Modo Día</li>
                        </ul>
                        
                    </form>
                <div class='menu_item options' id='options-button'><i id='bars' class="fa-sharp fa-solid fa-bars fa-lg"></i><p>Opciones</p></div>
            </div>
        </div>
        <div class="search-bar-container" id="search-bar-container">
            <form>
                <input placeholder="Search..." class="search-bar" id='search-bar' type="text">
                <button class='search-button normal_button' id='search-button2'>Buscar</button>
            </form>
        </div>
        <div id='result'></div>
        <div class='perfil-header'>
            <div><img class='perfil-photo' src='img/icon.png'></div>
            <div class='perfil-data'>
                <div class='perfil-name'>
                    <p class="userName" style='color:white; '><?php  echo $userName; ?></p> 
                    
                </div>
                
            </div>
        </div>
        <div class="content-container" id='posts'>
            <form class="edit-container"  method="POST" action="php/edicion-perfil.php">
                <div class="edit-data"><label for="email">E-mail: </label><input disabled <?php  echo "value='". $email ."'" ?> placeholder="E-mail" type="email" name="email" id="email" ><i class="fa-solid fa-pen-to-square" style="color: #d6d6d6;"></i></div>
                <div class="edit-data"><label for="username">Nombre de usuario: </label><input disabled <?php  echo "value='". $userName ."'" ?> placeholder="Nombre de usuario" type="text" name="username" id="username"><i class="fa-solid fa-pen-to-square" style="color: #d6d6d6;"></i></div>
                <div class="edit-data"><label for="password">Nueva contraseña: </label><input disabled placeholder="Nueva contraseña" type="password" name="password" id="password"><i class="fa-solid fa-pen-to-square" style="color: #d6d6d6;"></i></div>
                <div class="edit-data"><label for="old-password">Antigua contraseña: </label><input  placeholder="Antigua contraseña" type="password" name="old-password" id="old-password"></div>
                <div class=editButton-container><button class="editButton" type="submit">Editar</button><button class="deleteButton">Borrar perfil</button></div>
            </form>
        </div>
    </div>
    <script src='js/options.js'></script>
    <script src='js/peticiones-amistad.js'></script>
    <script src="js/search.js"></script>
    <script src="js/edit.js"></script>
</body>
</html>

