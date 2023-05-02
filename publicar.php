<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AustrianEconomicsForum</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/7fc86cc57f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    session_start();
    $user = $_SESSION['user'];
    if (!isset($user['username']) || strlen($user['username']) < 4) {
        header("Location: log-in.html");
    }

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

                <a href="perfil.php">
                    <div class="menu_item">
                        <img src="img/Captura de pantalla 2023-04-22 214534.png" class="index-perfil-img">
                        <p><?php echo $user['username']; ?></p>
                    </div>
                </a>

            </nav>
        </div>
        <div class="search-bar-container" id="search-bar-container">
            <form>
                <input placeholder="Search..." class="search-bar" type="text">
            </form>
        </div>
        <div class="content-container">
            <form class='public-form' action="validate-publi.php" actiion='POST'>
                <input class='input' id='title' name='title' type='text' placeholder='Título del post...'>
                <textarea id='body' name='body' class='input' placeholder='Texto del post...' style="height:150px;"></textarea>
                <input class="input-file" id='file' name='file' type="file" accept="image/*, video/*, audio/*,  text/plain, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf">
                <input class='input' type='text' id='hagstag' name='hagstag' placeholder='Introduce temáticas relacionadas con el post: #inflacion #pesoargentino #2023'>
                <button type="submit">Publicar</button>
            </form>
        </div>
        <script src="js/search.js"></script>
</body>

</html>