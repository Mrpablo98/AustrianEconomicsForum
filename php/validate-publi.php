<?php
session_start();
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
        'keyFilePath' => 'C:\MAMP\htdocs\AustrianEconomicsForum\hardy-baton-385508-d23cdb6005cc.json',
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
    $_FILES['file']['name'] = $_FILES['file']['name'].strval($idUser);
    $fileName = $_FILES['file']['name'] . $userId;
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
$sql=$mysqli->prepare("INSERT INTO posts (usuario_id, titulo, contenido, url_recurso, objectName, tipo, fecha_publicacion) VALUES (?,?,?,?,?,?,?)");
$sql->bind_param("issssss", $userId, $title, $body, $datos['url'], $fileName, $tipo, $fecha);
$sql->execute();
if($sql->error){
    echo "Error al ejecutar la consulta" . $sql->error;
}else{
    header("Location: ../index.php?post=success");
}
