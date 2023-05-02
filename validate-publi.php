<?php

require 'vendor/autoload.php';
include('connection.php');
use Google\Cloud\Storage\StorageClient;

function upload_file($bucketName, $objectName, $source)
{
    $finfo=finfo_open(FILEINFO_MIME_TYPE);
    $tipo=finfo_file($finfo, $source);
    finfo_close($finfo);
    $storage = new StorageClient([
        'projectId' => 'hardy-baton-385508',
        'keyFilePath' => 'C:\MAMP\htdocs\AustrianEconomicsForum\hardy-baton-385508-d23cdb6005cc.json'
    ]);
        $file = fopen($source, 'r');
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->upload($file, [
            'name' => $objectName,
        ]);
    
    printf('Archivo %s subido a %s en el bucket %s.' . PHP_EOL, $objectName, $object->name(), $bucketName);
    $url= $object->info()['mediaLink'];
    return $datos=[
        'url'=>$url,
        'tipo'=>$tipo
    ];

}
extract($_POST);
$title=trim($_POST['title']);
$body=trim($_POST['body']);
if(isset($_FILES['file'])) {
    $datos=upload_file('austrian-economics-forum', 'post-prueba', $_FILES['file']['tmp_name']);
}
$sql=$mysqli->prepare("INSERT INTO posts (titulo, contenido, tipo, url_recurso) VALUES (?,?,?,?)");
$sql->bind_param("ssss", $title, $body, $datos['tipo'], $datos['url']);
$sql->execute();
if($sql->error){
    echo "Error al ejecutar la consulta" . $sql->error;
}else{
    header("Location: index.php?post=success");
}
