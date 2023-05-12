<?php
session_start();
$userId=$_SESSION['user']['user-id'];
require 'vendor/autoload.php';
include('connection.php');
use Google\Cloud\Storage\StorageClient;

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
        $file = fopen($source, 'r');
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->upload($file, [
            'name' => $objectName,
        ]);
        $info=$object->info();
        $tipo=$info['contentType'];
        $options = ['method' => 'GET', 'expires' => $expiration, 'responseDisposition'=>'inline', 'responseType'=>$tipo];
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
   
    if(strpos($fileName, 'application')!==false || strpos($_FILES['file']['type'], 'text')!==false){$tipo=='archivo';}
    if(strpos($fileName, 'image')!==false){$tipo=='imagen';}
    if(strpos($fileName, 'video')!==false){$tipo=='video';}
    $datos=upload_file('austrian-economics-forum', 'post-prueba', $fileName, $tipo);
   
}
$sql=$mysqli->prepare("INSERT INTO posts (usuario_id, titulo, contenido, url_recurso, tipo, fecha_publicacion) VALUES (?,?,?,?,?,?)");
$sql->bind_param("isssss", $userId, $title, $body, $datos['url'], $tipo, date("Y-m-d H:i:s"));
$sql->execute();
if($sql->error){
    echo "Error al ejecutar la consulta" . $sql->error;
}else{
    //header("Location: index.php?post=success");
}
