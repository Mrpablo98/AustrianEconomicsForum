<?php
require("connection.php");
session_start();
if (isset($_POST['search'])) {
    $users = [];
    $search = $_POST['search'];
    $userId=$_SESSION['user']['user-id'];
    $username=$_SESSION['user']['username'];
    //$query = "SELECT * FROM usuarios WHERE nombre LIKE ? LIMIT 5";
    $query = "SELECT usuarios.nombre, usuarios.id FROM usuarios
    INNER JOIN amigos ON (usuarios.id = amigos.usuario_id2 OR usuarios.id = amigos.usuario_id1)
    WHERE (amigos.usuario_id1 = ? OR amigos.usuario_id2 = ?) AND usuarios.nombre LIKE ? AND usuarios.nombre != ?
    LIMIT 5";
    $stmt = $mysqli->prepare($query);
    $searchWithWildcards = "%" . $search . "%";
    $stmt->bind_param("iiss", $userId, $userId, $searchWithWildcards, $username);
    $stmt->execute();
    $results = $stmt->get_result();
    while ($row = $results->fetch_assoc()) {
        $users[] = '<a class="search-link" href="perfil.php?id=' . $row['id'] . '">'.'<p >' . $row['nombre'] . '</p>' . '</a>';
    }
    
    echo implode( $users);
}
