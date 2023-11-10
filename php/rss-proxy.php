<?php
    header('Content-Type: text/xml');
    header('Access-Control-Allow-Origin: *');

    $url = $_GET['url'];
    $rss = file_get_contents($url);
    echo $rss;
?>