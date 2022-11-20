<?php 

$zip=new ZipArchive();

$zip->open("newzip.zip",ZipArchive::CREATE);
$zip->addFile("front-end.zip");
//Sifreleme islemi yapacagiz
$zip->setEncryptionName("front-end.zip",ZipArchive::EM_AES_256,123123);//EM_AES_256 sifreleme teknigidir.3.parametre de password
echo "ok";
//Bu sekilde newzip.zip dosyasi icersine attgimiz front-end.zip dosyasini sifrelemis olduk, artik direk acilmayacak





?>