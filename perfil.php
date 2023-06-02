
<?php

    session_start();
    require("connection.php");
    $user=$_SESSION['user'];
    $amigoAcepted=false;
    $amigo=false;
    if(!isset($user['username']) || strlen($user['username']) < 4){
        header("Location: log-in.html");
    }
    if(isset($_GET['Iduser'])){
        $userId=$_GET['Iduser'];
        $user1=$user['user-id'];
        $resultFriens=mysqli_query($mysqli,"SELECT * FROM amigos WHERE usuario_id1 = $userId OR usuario_id2 = $userId AND aceptada = 1");
        if($resultFriens){$numamigos=mysqli_num_rows($resultFriens);}else{echo 'Error: ' . mysqli_error($mysqli);};
        $resultPosts=mysqli_query($mysqli,"SELECT * FROM posts WHERE usuario_id = $userId");
        if($resultPosts){$numPosts=mysqli_num_rows($resultPosts);}else{echo 'Error: ' . mysqli_error($mysqli);};
        $result=mysqli_query($mysqli,"SELECT nombre FROM usuarios WHERE id = $userId");
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $username = $row['nombre'];
        } else {
            echo "No se encontró ningún usuario con ese ID";
        }
    }else{
        $id=$_GET['id'];
        $userId='';
        $userLogged=$user['user-id'];
        $resultFriens=mysqli_query($mysqli,"SELECT * FROM amigos WHERE usuario_id1 = $id  OR usuario_id2 = $id AND aceptada = 1");
        if($resultFriens){$numamigos=mysqli_num_rows($resultFriens);}else{echo 'Error: ' . mysqli_error($mysqli);};
        $resultPosts=mysqli_query($mysqli,"SELECT * FROM posts WHERE usuario_id = $id");
        if($resultPosts){$numPosts=mysqli_num_rows($resultPosts);}else{echo 'Error: ' . mysqli_error($mysqli);};
        $result=mysqli_query($mysqli,"SELECT nombre FROM usuarios WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $username = $row['nombre'];
        } else {
            echo "No se encontró ningún usuario con ese ID";
        }
        $resultAmigosAcepted=mysqli_query($mysqli,"SELECT * FROM amigos WHERE usuario_id1 = $id AND usuario_id2 = $userLogged AND aceptada = 1 OR usuario_id1 = $userLogged AND usuario_id2 = $id AND aceptada = 1");
        if($resultAmigosAcepted){$numAmigosAcepted=mysqli_num_rows($resultAmigosAcepted);}else{echo 'Error: ' . mysqli_error($mysqli);};
        if($numAmigosAcepted>0){
            $amigoAcepted=true;
        }
        $resultAmigosPendiente=mysqli_query($mysqli,"SELECT * FROM amigos WHERE usuario_id1 = $id AND usuario_id2 = $userLogged AND aceptada = 0 OR usuario_id1 = $userLogged AND usuario_id2 = $id AND aceptada = 0");
        if($resultAmigosPendiente){$numAmigosPendiente=mysqli_num_rows($resultAmigosPendiente);}else{echo 'Error: ' . mysqli_error($mysqli);};
        if($numAmigosPendiente>0){
            $amigo=true;
        }
    }
    
   
    
    
       
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                    <img src="img/icon.png" class="index-perfil-img"><p><?php echo $user['username']; ?></p>
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
            <img class='perfil-photo' src='img/icon.png'>
            <div class='perfil-data'>
                <div class='perfil-name'>
                    <p style='color:white; '><?php  echo $username; ?></p>
                    <?php $id=$_GET['id']; if($id==$user['user-id']){echo "<button class='normal_button'>Editar perfil</button>";}else if($amigoAcepted){
                        echo "<a href='delete_friend.php?user1=$userLogged&user2=$id'><button class='normal_button'>Eliminar amigo</button></a>";
                    }else if($amigo){
                        echo "<button class='normal_button'>Pendiente</button>";
                    }else{
                        echo "<a href='new_friend.php?user1=$userLogged&user2=$id'><button class='normal_button'>Solicitar amistad</button></a>";
                    } ?>
                    
                </div>
                <div class='perfil-numbers'>
                    <p style='color:white'><?php echo $numamigos ?> contactos</p>
                    <p style='color:white'><?php echo $numPosts ?> publicaciones</p>
                </div>
            </div>
        </div>
        <div class="content-container" id='posts'>
        </div>
    </div>
    <script src=js/loadposts-perfil.js></script>
    <script src="js/search.js"></script>
    <script src='js/options.js'></script>
    <script src='js/peticiones-amistad.js'></script>
</body>
</html>