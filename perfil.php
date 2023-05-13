
<?php
/*include('validate-publi.php');
header('Content-Type: ' . $tipo);
header('Content-Disposition: inline; filename="' . $fileName . '"');
readfile($url); // Mostrar el contenido del archivo*/
    session_start();
    include("connection.php");
    $userId=$_SESSION['user']['user-id'];
    $sql = $mysqli->prepare('SELECT * FROM posts WHERE usuario_id = ?');
    $sql->bind_param("i", $userId);
    $sql->execute();
    $result=$sql->get_result();
    

  
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

                <a href="perfil.php" ><div class="menu_item">
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
            <form method='POST' action='session-destroy.php'>
                <input placeholder="Search..." class="search-bar" type="text">
            </form>
        </div>
        <div id='result'></div>
        <div class="content-container">
            <img style='width:500px; height:auto;' src='https://storage.googleapis.com/austrian-economics-forum/post-prueba?GoogleAccessId=pablo-prueba%40hardy-baton-385508.iam.gserviceaccount.com&Expires=4072377600&Signature=Yywiv6%2BiptyYimt4HAi22Aa6benvfS1i9T%2FM6KklpQboHZHw%2B582o0Jca42XZGRk%2B8%2FwaiJVJTDIkHe9rPPX81W0GtQnBxo21CxLja3SKvIpVz9AN3JLrN9mdBW717A%2BvqO3YifpquxYNQ%2B48%2Bz65K3Va%2FVwpXTv0sgA5tg6uZHeAFsOVN3pMBJUY%2FDy59NdM8UwL8phbRCWKWGTN36Swt89UXT9JNlCykx9oxpXCPGeqkENNQtxw600cg7rWV0Tkc7GPhHYnAYJ3Un32JMEPYc%2FUCVsaY5pGY76ChvlI0xK9dPZ%2FN%2F0deKfT%2BGHcGXE3eor1oPPgwWCCsdA%2F7%2BDuw%3D%3D&generation=1684014670181467'>
            <?php
            $j=0;
            for($i=0;$i<$result->num_rows;$i++){
                if($j%2==0){
                    echo "<div class='post-container'>";
                    
                }
                else{
                    echo "<div class='post-container1'>";
                }
                echo "<h2>{$post['titulo']}</h2>";
                $post=$result->fetch_assoc();

                echo "<h2 style='text-align:center;'>".$post['titulo']."</h2>".'<br>';
                echo $post['contenido'];
                echo "</div>";
                $i++;
            }
            ?>
            
        </div>
    </div>
    <script src="js/search.js"></script>
    <script src='js/options.js'></script>
</body>
</html>