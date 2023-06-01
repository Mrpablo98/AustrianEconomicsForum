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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <?php
    session_start();
        $user=$_SESSION['user'];
        if(!isset($user['username']) || strlen($user['username']) < 4){
            header("Location: log-in.html");
        }
        $id=$user['user-id'];
    ?>
    
    <div class="container-all-index">
        
    <div class="search-bar-container" id="search-bar-container">
            <form method='POST' action='search.php'>
                <input placeholder="Search..." class="search-bar" id='search-bar' type="text">
                <button type='submit' class='search-button normal_button'>Buscar</button>
            </form>
        </div>
        <div id='result'></div>
        <div class="content-container" id='newsContainer'>
            <div class='form-periodicos' id='form-periodicos'>
                <div class='form-container'>
                    <input type="checkbox" id='LaVoz' name='LaVoz' value='LaVoz' checked='true'></input>
                    <label for="LaVoz"><img src="img/LaVoz.png"></label>
                    <input type="checkbox" id='LibreMercado' name='LibreMercado' value='LibreMercado' checked='true' ></input>
                    <label for="LibreMercado"><img src="img/LibreMercado.png"></label>
                    <input type="checkbox" id='ElEconomista' name='ElEconomista' value='ElEconomista' checked='true'></input>
                    <label for="ElEconomista"><img src="img/eleconomista-logo.png"></label>
                    <input type="checkbox" id='ElPeriodico' name='ElPeriodico' value='ElPeriodico' checked='true'></input>
                    <label for="ElPeriodico"><img src="img/elPeriodico.png"></label>
                </div>
                <div class='form-container'>
                    <input type="checkbox" id='NosDiario' name='NosDiario' value='NosDiario' checked='true'></input>
                    <label for="NosDiario"><img src="img/Nós_Diario.png"></label>
                    <input type="checkbox" id='LaVanguardia' name='LaVanguardia' value='LaVanguardia' checked='true'></input>
                    <label for="LaVanguardia"><img src="img/LaVanguardia.png"></label>
                    <input type="checkbox" id='ElPais' naame='ElPais' value='ElPais' checked='true'></input>
                    <label for="ElPais"><img src="img/ElPais.png"></label>
                    <input type="checkbox" id='ElMundo' name='ElMundo' value='ElMundo' checked='true'></input>
                    <label for="ElMundo"><img src="img/ElMundo.png"></label>
                </div>
                <button type="submit" class='normal_button' id='filtrar'>Filtrar</button>
            </div>
           <img src='img/gif_loading.gif' id='loading'>
           
            
        </div>
    </div>
    <div class="menu" id="menu">
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
                    <form  id='options-form' methos='POST' action='session-destroy.php'>
                        <ul class='closed-options'id='options-container'>
                            <li class='options-item'><button type='submit' class='options-button'>Cerrar sesión</button></li>
                            <li class='options-item'>Modo Día</li>
                        </ul>
                        
                    </form>
                <div class='menu_item options' id='options-button'><i id='bars' class="fa-sharp fa-solid fa-bars fa-lg"></i><p>Opciones</p></div>
            </div>
        </div>
        
    <script src="js/search.js"></script>
    <script src='rss-periodicos.js'></script>
    <script src='js/options.js'></script>
    <script src='js/peticiones-amistad.js'></script>
    
</body>
</html>