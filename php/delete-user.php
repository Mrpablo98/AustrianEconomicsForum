<?php
session_start();
require_once("../connection.php");

if (!isset($_SESSION['user']['user-id'])) {
    die("User ID not set in session");
}

$userId = $_SESSION['user']['user-id'];

$sql = $mysqli->prepare('DELETE FROM usuarios WHERE id = ?');

if (!$sql) {
    die("Error preparing SQL: " . $mysqli->error);
}

$sql->bind_param("i", $userId);

if (!$sql->execute()) {
    die("Error executing SQL: " . $sql->error);
}

$sql->close();
$mysqli->close();

header("Location: ../session-destroy.php");
exit;
?>
