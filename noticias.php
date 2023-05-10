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
        include('rss-periodicos.php');
    ?>
    
    <div class="container-all-index">
        
        <div class="search-bar-container" id="search-bar-container">
            <form>
                <input placeholder="Search..." class="search-bar" type="text">
            </form>
        </div>
        <div class="content-container" id='newsContainer'>
            <form class='form-periodicos' id='form-periodicos' action='rss-periodicos.php' method='POST'>
                <div class='form-container'>
                    <input type="checkbox" id='LaVoz' name='LaVoz' value='LaVoz' checked='true'>La voz de galicia</input>
                    <input type="checkbox" id='LibreMercado' name='LibreMercado' value='LibreMercado' checked='true'>LibreMercado</input>
                    <input type="checkbox" id='ElEconomista' name='ElEconomista' value='ElEconomista' checked='true'>El económista</input>
                    <input type="checkbox" id='ElPeriodico' name='ElPeriodico' value='ElPeriodico' checked='true'>El periódico</input>
                </div>
                <div class='form-container'>
                    <input type="checkbox" id='NosDiario' name='NosDiario' value='NosDiario' checked='true'>Nós diario</input>
                    <input type="checkbox" id='LaVanguardia' name='LaVanguardia' value='LaVnguardia' checked='true'>La vanguardia</input>
                    <input type="checkbox" id='ElPais' naame='ElPais' value='ElPais' checked='true'>El país</input>
                    <input type="checkbox" id='ElMundo' name='ElMundo' value='ElMundo' checked='true'>El mundo</input>
                </div>
                <button type="submit" class='normal_button'>Filtrar</button>
            </form>
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

                <a href="perfil.php" ><div class="menu_item">
                    <img src="img/icon.png" class="index-perfil-img"><p><?php echo $user['username']; ?></p>
                </div></a>
            
            </nav>
        </div>
    <script src="js/search.js"></script>
    <script src='rss-periodicos.js'></script>
    
</body>
</html>