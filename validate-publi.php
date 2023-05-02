<?php
extract($_POST);
require 'vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;
$url='';
function upload_post($bucketName, $objectName, $source, $title, $body)
{
    $storage = new StorageClient([
        'projectId' => 'hardy-baton-385508',
        'keyFilePath' => 'C:\MAMP\htdocs\AustrianEconomicsForum\hardy-baton-385508-d23cdb6005cc.json'
    ]);
    if(strlen($source)>0){
        $file = fopen($source, 'r');
        $metadata = [
                'title' => $title,
                'body' => $body,
        ];
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->upload($file, [
            'name' => $objectName,
            'metadata' => $metadata
        ]);
    }else{
        $metadata = [
                'title' => $title,
                'body' => $body,
        ];
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->upload([
            'name' => $objectName,
            'metadata' => $metadata
        ]);
    }
    printf('Archivo %s subido a %s en el bucket %s.' . PHP_EOL, $objectName, $object->name(), $bucketName);
    $url== $object->info()['mediaLink'];

    
}
