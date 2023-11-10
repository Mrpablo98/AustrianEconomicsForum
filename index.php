
<?php
    session_start();
        $user=$_SESSION['user'];
        if(!isset($user['username']) || strlen($user['username']) < 4){
            header("Location: log-in.html");
        }
        $id=$user['user-id'];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AustrianEconomicsForum</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png">
    <script src="php/icon-proxy.php?url=https://kit.fontawesome.com/b685f735ab.js" crossorigin="anonymous"></script>


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

                <a <?php  echo "href='perfil.php?id=$id'"?> ><div class="menu_item">
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
            <form action="searching.php" method="POST">
                <input autocomplete="off" placeholder="Search..." class="search-bar" id='search-bar' name='search-bar' type="text"></input>
                <button class='search-button normal_button' id='search-button2' type="submit">Buscar</button>
            </form>
        </div>
        <div id='result'></div>
        <div class="content-container" id='posts'>
        <img src='img/gif_loading.gif' id='loading'>
            <h2 class="indexTitle">Explora los posts de tus amigos: </h2>
            <div class="indexNoPost invisible"><p>¡Vaya, aún no tinenes gente a la que seguir!<br>Puedes explorar las publicaciones más famosas o buscar nuevos amigos en las siguientes secciones</p>
            <div class="buttonContainerIndex"><a href="explore.php"><button>Explorar</button></a><button id="searchButton2">Buscar</button></div></div>
        </div>
    </div>
    
    <script src='js/options.js'></script>
    <script src='js/peticiones-amistad.js'></script>
    <script src="js/loadposts-index.js"></script>
    <script src="js/search.js"></script>
</body>
</html>