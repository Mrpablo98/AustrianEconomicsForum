<?php

$server="localhost";
$usernamebd="root";
$password="root";
$db="austrianeconomicsforum";

$mysqli=new mysqli($server,$usernamebd,$password,$db);

if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
