<?php

require_once("../connection.php");
session_start();

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
    exit;
}

require '../vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;

putenv('GOOGLE_CLOUD_PHP_REST_HTTP_CLIENT_TLS_CA_FILE=C:\certs\cacert.pem');
putenv('CURL_CA_BUNDLE=C:\certs\cacert.pem');
putenv('GOOGLE_CLOUD_PHP_REST_HTTP_CLIENT_TLS_VERIFY=false');

function delete_object(string $bucketName, string $objectName): void
{
    try {
        $storage = new StorageClient([
            'projectId' => 'hardy-baton-385508',
            'keyFilePath' => '../hardy-baton-385508-d296bb99ca54.json',
            'restOptions' => [
                'verify' => false
            ]
        ]);
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->object($objectName);
        $object->delete();
    } catch (Exception $e) {
        // Manejo de errores de Google Cloud Storage
        echo json_encode(['error' => 'Error al eliminar objeto en Google Cloud Storage: ' . $e->getMessage()]);
        exit;
    }
}

$postId = isset($_POST['postId']) ? intval($_POST['postId']) : null;

if ($postId === null) {
    echo json_encode(['error' => 'ID del post no proporcionado o inválido.']);
    exit;
}

try {
    $sql = $mysqli->prepare("SELECT posts.objectName, posts.usuario_id FROM posts WHERE id=?");
    
    $sql->bind_param("i", $postId);
    $sql->execute();
    $sql->bind_result($objectName, $userId);
    if ($_SESSION['user-id'] != $userId) {
        http_response_code(403);
        echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
        exit;
    }
    if ($objectName!=null) {
        delete_object('austrian-economics-forum', $objectName);
    }
    $sql->close();

    $sql = $mysqli->prepare("DELETE FROM posts WHERE id=?");
    $sql->bind_param("i", $postId);
    $sql->execute();
    $sql->close();
    echo json_encode("deleted");
} catch (mysqli_sql_exception $e) {
    // Manejo de errores de MySQL
    echo json_encode(['error' => 'Error en la operación de base de datos: ' . $e->getMessage()]);
    exit;
}

