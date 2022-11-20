<?php 
//Zip dosyasini disari cikarmak
$zip=new ZipArchive();
// $zip->open("front-end.zip");
 //extract methodu
// $zip->extractTo("test/deneme");//parametre olarak cikaracagimiz yeri gosteren klasor verilir
 //test klasorumuz icindeki deneme klasorumuz icerisine zip dosyamiz cikarilmis oldu

//Sifreyi kaldirmak..
$zip->open("newzip.zip",ZipArchive::CREATE);
//Bu sekilde sifreyi girdikten  sonra biz ancak sifrelenmis zip dosyasini extract edebiliyoruz istedigmz herhangi bir dosya altina
$zip->setPassword("123123");
// $zip->addFile("newzip.zip/front-end.zip");
$zip->setEncryptionName("front-end.zip",ZipArchive::EM_AES_256,123123);
//EM_AES_256 sifreleme teknigidir.3.parametre de password
$zip->extractTo("test/");
echo "ok";

$zip->close();

?>