<?php
require("connection.php");
session_start();
if (isset($_POST['search'])) {
    $users = [];
    $search = $_POST['search'];
    $userId=$_SESSION['user']['user-id'];
    //$query = "SELECT * FROM usuarios WHERE nombre LIKE ? LIMIT 5";
    $query = "SELECT usuarios.nombre FROM usuarios
    INNER JOIN amigos ON usuarios.id = amigos.usuario_id2 OR usuarios.id = amigos.usuario_id1
    WHERE amigos.usuario_id1 = ? AND usuarios.nombre LIKE ?
    LIMIT 5";
    $stmt = $mysqli->prepare($query);
    $searchWithWildcards = "%" . $search . "%";
    $stmt->bind_param("is", $userId, $searchWithWildcards);
    $stmt->execute();
    $results = $stmt->get_result();
    while ($row = $results->fetch_assoc()) {
        $users[] = '<a class="search-link" href="perfil.php?id=' . $row['id'] . '">'.'<p >' . $row['nombre'] . '</p>' . '</a>';
    }
    
    echo implode( $users);
}
