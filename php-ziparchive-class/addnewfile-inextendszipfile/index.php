<?php 

/*
BU KISMA COOK DIKKKAT ETMELIYIZ.... BAZEN DENK OLUYOR AMA ESIT OLMUYOR
YANI 
$zip->open("newzipfile22.zip")  biz int(9) donuyor
$zip->open("newzipfile22.zip")==true   denktir 
$zip->open("newzipfile22.zip")===false ama esit degildir
Dolayisi ile, == kullanirsak  islemimiz yanlis oluyor..burasi cok onemli

*/
$zip=new ZipArchive();
var_dump($zip->open("newzipfile22.zip"));
echo "<br>";
$check_zipFile=$zip->open("newzipfile22.zip");//Bunu bilerek olmayan bir zip dosyasi verip test etmis olduk normalde var olan bir zip dosyasi verince dosyamizi ekliyor

if($check_zipFile===true):
    $zip->addFile("style.css","main.css");
$zip->close();
echo "File is added"."<br>";
else:echo "File is not added"."<br>";
endif;

echo "<hr>";

//BIR SAYI TRUE YA DENKTIR AMA TRUE YA ESIT DEGILDIR...COK ONEMLI BESTPRACTISE..
echo 5==true;//1-true
echo "<hr>";

echo 5===true;//0-false

?>