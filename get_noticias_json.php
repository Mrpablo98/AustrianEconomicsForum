<?php
include("rss-periodicos.php");
// Obtén todas las noticias (recuerda reemplazar esto con tu función real para obtener noticias)
$Listanoticias = getNews();

// Verifica si se proporcionaron parámetros de inicio y límite
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;

// Filtra el rango específico de noticias
$noticias = array_slice($Listanoticias, $start, $limit);

// Devuelve las noticias como JSON
header('Content-Type: application/json');
echo json_encode($noticias);