<?php

require_once("../connection.php");
session_start();
require '../vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;
/*putenv('GOOGLE_CLOUD_PHP_REST_HTTP_CLIENT_TLS_CA_FILE=C:\certs\cacert.pem');
putenv('CURL_CA_BUNDLE=C:\certs\cacert.pem');
putenv('GOOGLE_CLOUD_PHP_REST_HTTP_CLIENT_TLS_VERIFY=false');*/


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
        'keyFilePath' => 'C:\MAMP\htdocs\AustrianEconomicsForum\hardy-baton-385508-d296bb99ca54.json',
        'restOptions' => [
            'verify' => false
        ]
    ]);
    $bucket = $storage->bucket($bucketName);
    $object = $bucket->object($objectName);
    $object->delete();
    printf('Deleted gs://%s/%s' . PHP_EOL, $bucketName, $objectName);
}


try {
    
    $sql=$mysqli->prepare("SELECT posts.objectName FROM posts WHERE id=?");
$sql->bind_param("i", $postId);
$sql->execute();
$sql->bind_result($objectName);
if ($sql->fetch()) {
    delete_object('austrian-economics-forum', $objectName);
}


$sql=$mysqli->prepare("DELETE FROM posts WHERE id=?");
$error="error";


$bind_result = $sql->bind_param("i", $postId);


$execute_result = $sql->execute();

$sql->close();

    echo json_encode("deleted");
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

 
?>
