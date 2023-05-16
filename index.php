
<?php
    session_start();
        $user=$_SESSION['user'];
        if(!isset($user['username']) || strlen($user['username']) < 4){
            header("Location: log-in.html");
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

                <a href="perfil.php?" ><div class="menu_item">
                    <img src="img/icon.png" class="index-perfil-img"><p><?php echo $user['username']; $id=$user['user-id']?></p><p id='user-id' style='visibility:hidden;'><?php echo $id?></p>
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
        <div class="content-container">
            
        </div>
    </div>
    <script src="js/search.js"></script>
    <script src='js/options.js'></script>
</body>
</html>