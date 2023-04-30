<?php

$server="localhost";
$usernamebd="root";
$passwordbd="root";
/*!q[Oux6ww!t]R\l+*/
$db="austrianeconomicsforum";

$mysqli=new mysqli($server,$usernamebd,$passwordbd,$db);

if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
