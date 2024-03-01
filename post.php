
<?php
    session_start();
        $user=$_SESSION['user'];
        $id=$user['user-id'];
        
require_once("connection.php");

// Verificar si el post ID está presente en la solicitud
if (!isset($_GET['p'])) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Falta el parámetro de identificación del post.']);
    exit;
}

$postId = $_GET['p'];

// Preparar la consulta SQL
$sql = 'SELECT usuarios.nombre, posts.id, posts.titulo, posts.contenido, posts.url_recurso, posts.tipo, posts.usuario_id, COUNT(post_likes_dislikes.usuario_id) AS likes
        FROM usuarios
        INNER JOIN amigos ON (usuarios.id = amigos.usuario_id2 OR usuarios.id = amigos.usuario_id1)
        INNER JOIN posts ON usuarios.id = posts.usuario_id
        LEFT JOIN post_likes_dislikes ON posts.id = post_likes_dislikes.post_id
        WHERE posts.id = ?  GROUP BY usuarios.nombre, posts.id, posts.titulo, posts.contenido, posts.url_recurso, posts.tipo, posts.usuario_id';

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Error interno del servidor: ' . $mysqli->error]);
    exit;
}

// Vincular el parámetro del post ID a la consulta
$stmt->bind_param('i', $postId);

// Ejecutar la consulta
$stmt->execute();

if ($stmt->error) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Error durante la consulta: ' . $stmt->error]);
    exit;
}

// Obtener resultados de la consulta
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404); // Not Found
    echo json_encode(['error' => 'No se encontró el post con el ID proporcionado.']);
    exit;
}

// Obtener los datos del post
$postData = $result->fetch_assoc();

// Suponiendo que ya has obtenido los datos del post en $postData

$postHtml = '<div class="cortina-post ">' .
                '<div class="complete-Post ">' .
                    '<div class="complete-post-image ">';

// Verificar si hay un recurso URL y qué tipo es
if ($postData['url_recurso'] != null) {
    if ($postData['tipo'] == "imagen") {
        $postHtml .= '<div class="media"><img src="' . $postData['url_recurso'] . '" /></div>';
    } elseif ($postData['tipo'] == "video") {
        $postHtml .= '<div class="media"><video src="' . $postData['url_recurso'] . '" controls ></video></div>';
    } elseif ($postData['tipo'] == "audio") {
        $postHtml .= '<div class="cortina-audio"><audio src="' . $postData['url_recurso'] . '" controls ></audio></div>';
    } elseif ($postData['tipo'] == "archivo") {
        $postHtml .= '<div class="post-image">' . "<a class='post-archivo' href='" . $postData['url_recurso'] . "'>" . $postData['titulo'] . "<i class='fa-solid fa-file-arrow-down' style='color: #dbdbdb;'></i></a>" . '</div>';
    }
}

$postHtml .= '<div>' .
                '<h2 style="text-align:center;">' . $postData['titulo'] . ' || ' . '<a href="perfil?id=' . $postData['usuario_id'] . '">' . $postData['nombre'] . '</h2></a>' .
                '<div class="overflow-post-content">' .
                    '<p>' . $postData['contenido'] . '</p>' .
                    '<div id="coments' . $postData['id'] . '" class="coments">' .
                        
                    '</div>' .
                '</div>' .
                '<div class="like-container">' .
                    '<img  class="like" src="' . $Likesrc . '">' .
                    '<p class="numLikes">' . $postData['likes'] . ' likes' . '</p>' .
                '</div>' .
                '<div class="comentar-container">' .
                    '<form class="form-coment">' .
                        '<input type="hidden" name="postId" value="' . $postData['id'] . '">' .
                        '<input class="coment-input" type="text" id="comentario" name="comentario" placeholder="Comentario" required>' .
                        '<button name="submit" class="coment-button"><i class="far fa-comment" style="color: #e6e6e6;"></i></button>' .
                    '</form>' .
                '</div>' .
            '</div>' .
        '</div>' .
        '<i class="closeIcon fas fa-times" style="color: #d9d9d9;"></i>' .
    '</div>';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Declaramos los atributos prefix, itemscope e itemtype en la etiqueta html -->
<html prefix="http://ogp.me/ns#" itemscope itemtype="http://schema.org/WebPage">

<!-- Open Graph para Facebook -->
<meta property="og:title" content="Título de la página aquí" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://www.midominio.com/" />
<meta property="og:image" content="http://midominio.com/imagen.jpg" />
<meta property="og:description" content="Descripción de la página" />
<meta property="og:site_name" content="Nombre de la página web" />

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="Título página">
<meta name="twitter:description" content="Descripción de la página">
<meta name="twitter:creator" content="@autor">
<meta name="twitter:image" content="http://www.midominio.com/image.jpg">

<!-- Schema.org para Google+ -->
<meta itemprop="name" content="Nombre de la página web">
<meta itemprop="description" content="Descripción de la página">
<meta itemprop="image" content="http://www.midominio.com/imagen.jpg">
    <title>Post | AustrianEconomicsForum</title>
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
                <a href="index.php." ><div class="menu_item">
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
            <form action="searching" method="POST">
                <input autocomplete="off" placeholder="Search..." class="search-bar" id='search-bar' name='search-bar' type="text"></input>
                <button class='search-button normal_button' id='search-button2' type="submit">Buscar</button>
            </form>
        </div>
        <div id='result'></div>
        <div class="content-container" id='posts'>
           <?php echo $postHtml; ?>
        </div>
    </div>
    
    <script src='js/options.js'></script>
    <script src='js/peticiones-amistad.js'></script>
    <script src="js/loadposts-index.js"></script>
    <script src="js/search.js"></script>
</body>
</html>