<?php
session_start();
$userId=$_SESSION['user']['user-id'];
require 'vendor/autoload.php';
include('connection.php');
use Google\Cloud\Storage\StorageClient;

ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');
ini_set('max_execution_time', '300');
ini_set('max_input_time', '300');

function upload_file($bucketName, $objectName, $source, $tipo)
{
    //$finfo=finfo_open(FILEINFO_MIME_TYPE);
    //$tipo=finfo_file($finfo, $source);
    //finfo_close($finfo);
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
extract($_POST);
$title=trim($_POST['title']);
$body=trim($_POST['body']);
if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $tipo='archivo';
    $fecha=date("Y-m-d H:i:s");
    if(strpos($fileType, 'application')!==false || strpos($_FILES['file']['type'], 'text')!==false){$tipo='archivo';}
    if(strpos($fileType, 'image')!==false){$tipo='imagen';}
    if(strpos($fileType, 'video')!==false){$tipo='video';}
    $datos=upload_file('austrian-economics-forum', $fileName, $fileName, $tipo);
   
}
$sql=$mysqli->prepare("INSERT INTO posts (usuario_id, titulo, contenido, url_recurso, tipo, fecha_publicacion) VALUES (?,?,?,?,?,?)");
$sql->bind_param("isssss", $userId, $title, $body, $datos['url'], $tipo, $fecha);
$sql->execute();
if($sql->error){
    echo "Error al ejecutar la consulta" . $sql->error;
}else{
    header("Location: index.php?post=success");
}
