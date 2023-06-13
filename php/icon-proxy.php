<?php
    header("Content-Type: application/javascript");

    header('Access-Control-Allow-Origin: *');

    $url = $_GET['url'];
    $rss = file_get_contents($url);
    echo $rss;
?>