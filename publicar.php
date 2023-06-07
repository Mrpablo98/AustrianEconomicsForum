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
    <?php
    session_start();
    $user = $_SESSION['user'];
    if (!isset($user['username']) || strlen($user['username']) < 4) {
        header("Location: log-in.html");
    }
    $id=$user['user-id'];
    ?>
    <div class="container-all-index">
        <div class="menu">
            <a href="index.php"><img src="img/logo-dark-menu.png" class="menu_logo"></a>
            <nav class="navbar">
                <a href="index.php">
                    <div class="menu_item">
                        <i class="fa-solid fa-house fa-lg" style="color: #ffffff;"></i>
                        <p>Inicio</p>
                    </div>
                </a>

                <div class="menu_item" id="search-button">
                    <i class="fa-solid fa-magnifying-glass fa-lg" style="color: #ffffff;"></i>
                    <p>Buscar</p>
                </div>

                <a href="explore.php">
                    <div class="menu_item">
                        <i class="fa-solid fa-compass fa-lg" style="color: #ffffff;"></i>
                        <p>Explorar</p>
                    </div>
                </a>

                <a href="publicar.php">
                    <div class="menu_item">
                        <i class="fa-solid fa-plus fa-lg" style="color: #ffffff;"></i>
                        <p>Publicar</p>
                    </div>
                </a>

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
            <form method='POST' action='search.php'>
                <input placeholder="Search..." class="search-bar" id='search-bar' type="text">
                <button type='submit' class='search-button normal_button'>Buscar</button>
            </form>
        </div>
        <div id='result'></div>
        <div class="content-container">
            <form class='public-form' action="validate-publi.php" method='POST' enctype="multipart/form-data">
                <input class='input' id='title' name='title' type='text' placeholder='Título del post...'>
                <textarea id='body' name='body' class='input' maxlength='10000' placeholder='Texto del post...' style="height:150px;"></textarea>
                <input class="input-file" id='file' name='file' type="file" accept="image/*, video/*, audio/*,  text/plain, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf">
                <p style="margin: 0 auto;">Tamaño máximo de archivos 60MB aprox.</p>
                <input class='input' type='text' id='hagstag' name='hagstag' placeholder='Introduce temáticas relacionadas con el post: #inflacion #pesoargentino #2023'>
                <button type="submit" class='normal_button public_button'>Publicar</button>
            </form>
            <img class="loading-publi" src="img/gif_loading.gif">
            <div class="archivo-subido"><p>La publicacion se ha subido con éxito!</p><i class="fas fa-check" style="color: #00ff40;"></i></div>
            <div class="archivo-fallido"><p>El archivo no se ha podido subir con éxito!</p><i class="fa-solid fa-xmark" style="color: #red;"></i></i></div>
        </div>
        <script src="js/search.js"></script>
        <script src='js/options.js'></script>
        <script src='js/peticiones-amistad.js'></script>
        <script src="js/subir-publicacion.js"></script>
</body>

</html>