<?php

require_once("../connection.php");
session_start();
if (!isset($_SESSION['user'])) {
    // Si el usuario no está autenticado, devolver un error 403
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
    exit;
}
require '../vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;
putenv('GOOGLE_CLOUD_PHP_REST_HTTP_CLIENT_TLS_CA_FILE=C:\certs\cacert.pem');
putenv('CURL_CA_BUNDLE=C:\certs\cacert.pem');
putenv('GOOGLE_CLOUD_PHP_REST_HTTP_CLIENT_TLS_VERIFY=false');

/**
 * Delete an object.
 *
 * @param string $bucketName The name of your Cloud Storage bucket.
 *        (e.g. 'my-bucket')
 * @param string $objectName The name of your Cloud Storage object.
 *        (e.g. 'my-object')
 */
 $postId=$_POST['postId'];
function delete_object(string $bucketName, string $objectName): void
{
    $storage = new StorageClient([
        'projectId' => 'hardy-baton-385508',
        'keyFilePath' => '/home/u483069059/domains/aeforum.es/public_html/hardy-baton-385508-d296bb99ca54.json',
        'restOptions' => [
            'verify' => false
        ]
    ]);
    $bucket = $storage->bucket($bucketName);
    $object = $bucket->object($objectName);
    $object->delete();
 
}

$sql=$mysqli->prepare("SELECT posts.objectName FROM posts WHERE id=?");
$sql->bind_param("i", $postId);
$sql->execute();
$sql->bind_result($objectName);
if ($sql->fetch()) {
    delete_object('austrian-economics-forum', $objectName);
}
$sql->close();
$sql=$mysqli->prepare("DELETE FROM posts WHERE id=?");
$error="error";


$bind_result = $sql->bind_param("i", $postId);


$execute_result = $sql->execute();

$sql->close();
echo json_encode("deleted"); 
?>
