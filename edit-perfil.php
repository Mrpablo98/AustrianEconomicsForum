<?php
session_start();
require_once("connection.php");
$userId=$_SESSION['user']['user-id'];
$errorOld=$_GET['errorOld'];
$errorName=$_GET['errorName'];
$errorMail=$_GET['errorMail'];
$errorPassword=$_GET['errorPassword'];
$errorRpassword=$_GET['errorRpassword'];
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
            <form action="searching.php" method="POST">
                <input autocomplete="off" placeholder="Search..." class="search-bar" id='search-bar' name='search-bar' type="text"></input>
                <button class='search-button normal_button' id='search-button2' type="submit">Buscar</button>
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
                <div class="edit-data"><label for="email">Nuevo E-mail: </label><input disabled <?php  echo "value='". $email ."'" ?> placeholder="Nuevo E-mail" type="email" name="email" id="email" ><i class="fa-solid fa-pen-to-square" style="color: #d6d6d6;"></i></div>
                <?php if($errorMail){echo "<p style='text-align:center; border:1px solid red; padding:10px; width:20%; margin:0 auto; color:red; border-radius:5%; margin-bottom:30px;'>El email introducido no es válido</p>";} ?>
                <div class="edit-data"><label for="username">Nuevo nombre de usuario: </label><input disabled <?php  echo "value='". $userName ."'" ?> placeholder="Nuevo nombre de usuario" type="text" name="username" id="username"></div>
                <?php if($errorName){echo "<p style='text-align:center; border:1px solid red; padding:10px; width:20%; margin:0 auto; color:red; border-radius:5%; margin-bottom:30px;'>El nombre de usuario introducido no es válido</p>";} ?>
                <div class="edit-data"><label for="password">Nueva contraseña: </label><input disabled placeholder="Nueva contraseña" type="password" name="password" id="password"></div>
                <?php if($errorPassword){echo "<p style='text-align:center; border:1px solid red; padding:10px; width:20%; margin:0 auto; color:red; border-radius:5%; margin-bottom:30px;'>La nueva contraseña introducida no es válida</p>";} ?>
                <div class="edit-data"><label for="password">Repite la nueva contraseña: </label><input disabled placeholder="Repetir nueva contraseña" type="password" name="Rpassword" id="Rpassword"></div>
                <?php if($errorRpassword){echo "<p style='text-align:center; border:1px solid red; padding:10px; width:20%; margin:0 auto; color:red; border-radius:5%; margin-bottom:30px;'>Las nuevas contraseñas deben ser iguales entre ellas</p>";} ?>
                <div class="edit-data"><label for="old-password">Antigua contraseña: </label><input disabled  placeholder="Antigua contraseña" type="password" name="old-password" id="old-password"></div>
                <?php  if($errorOld){echo "<p style='text-align:center; border:1px solid red; padding:10px; width:20%; color:red; margin:0 auto; border-radius:5%; margin-bottom:30px;'>Tu antigua contraseña no es correcta</p>";}    ?>
                <div class=editButton-container><button class="editButton" type="submit">Editar</button></div>
            </form>
            <a href='php/delete-user.php'><button class="deleteButton">Borrar perfil</button></a>
        </div>
    </div>
    <script src='js/options.js'></script>
    <script src='js/peticiones-amistad.js'></script>
    <script src="js/search.js"></script>
    <script src="js/edit.js"></script>
</body>
</html>

