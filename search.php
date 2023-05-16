<?php
require("connection.php");
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM usuarios WHERE nombre LIKE ? LIMIT 5";
    $stmt = $mysqli->prepare($query);
    $searchWithWildcards = "%" . $search . "%";
    $stmt->bind_param("s", $searchWithWildcards);
    $stmt->execute();
    $results = $stmt->get_result();
    while ($row = $results->fetch_assoc()) {
        $users[] = '<a class="search-link" href="perfil.php?Iduser=' . $row['id'] . '">'.'<p >' . $row['nombre'] . '</p>' . '</a>';
    }
    
    echo implode("<br>", $users);
}
