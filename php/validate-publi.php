<?php
session_start();
if (!isset($_SESSION['user'])) {
    // Si el usuario no está autenticado, devolver un error 403
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado para acceder a este recurso.']);
    exit;
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$userId=$_SESSION['user']['user-id'];
require '../vendor/autoload.php';
include('../connection.php');
use Google\Cloud\Storage\StorageClient;

ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');
ini_set('max_execution_time', '300');
ini_set('max_input_time', '300');

function upload_file($bucketName, $objectName, $source, $tipo)
{
    
    $expiration = new \DateTime('2099-01-18');

    $storage = new StorageClient([
        'projectId' => 'hardy-baton-385508',
        'keyFilePath' => '/home/u483069059/domains/aeforum.es/public_html/hardy-baton-385508-d296bb99ca54.json',
        'restOptions' => [
            'verify' => false
        ]
    ]);
        $file = fopen($_FILES['file']['tmp_name'], 'r');
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->upload($file, [
            'name' => $objectName,
        ]);
        $info=$object->info();
        $tipo=$info['contentType'];
        $options = ['method' => 'GET', 'expires' => $expiration];
        $signedUrl = $object->signedUrl($expiration, $options);
        echo $source . '\n';
    printf('Archivo %s subido a %s en el bucket %s.' . PHP_EOL, $objectName, $object->name(), $bucketName);
    $url= $object->info()['mediaLink'];
    return $datos=[
        'url'=>$signedUrl
    ];

}

$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$body = isset($_POST['body']) ? trim($_POST['body']) : '';
if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $idUser=$userId;
    $fileName = $userId . $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $tipo='archivo';
    $fecha=date("Y-m-d H:i:s");
    if(strpos($fileType, 'application')!==false || strpos($_FILES['file']['type'], 'text')!==false){$tipo='archivo';}
    if(strpos($fileType, 'image')!==false){$tipo='imagen';}
    if(strpos($fileType, 'video')!==false){$tipo='video';}
    if(strpos($fileType, 'audio')!==false){$tipo='audio';}
    $datos=upload_file('austrian-economics-forum', $fileName, $fileName, $tipo);
   
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$sql=$mysqli->prepare("INSERT INTO posts (usuario_id, titulo, contenido, url_recurso, objectName, tipo, fecha_publicacion) VALUES (?,?,?,?,?,?,?)");
if ($sql) {
    $sql->bind_param("issssss", $userId, $title, $body, $datos['url'], $fileName, $tipo, $fecha);
    // ...
} else {
    echo "Error en la preparación de la consulta: " . $mysqli->error;
}

$sql->execute();
if ($sql->error) {
    die(json_encode(['status' => 'error', 'message' => 'Error al ejecutar la consulta: ' . $sql->error]));
} else {
    echo json_encode(['status' => 'success', 'message' => 'Publicado']);
}

