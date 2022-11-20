<?php 

//BIR KLASORDEKI TUM DOSYALARI DINAMIK OLARAK SECEREK ZIP DOSYASI OLUSTURMAK
//Mantik olarak dusunursek mevcut bir dizin icindeki tum dosyalari biz nasil seciyorduk ya scandir, ya da glob methodu ile herhangi bir klasor altindaki tum dosyalari dizi olarak alabiliyorduk...

//Biz su an uzerinde calistigmiz index.php yi ziplemesini istemiyoruz dogal olarak...

//Calistigmiz dosyanin dosya adini nasil aliriz

//BU SEKILDE HERHANGI BIR DOSYA YA AIT,FILENAME,EXTENSION,DIRNAME GIBI DATALARA ERISEBILIYORUZ
//print_r(pathinfo("my_zipfiles.zip"));
/*
{
    dirname: ".",
    basename: "my_zipfiles.zip",
    extension: "zip",
    filename: "my_zipfiles"
},

*/

//SU AN UZERINDE CALISTGIMIZ DOSYA ADI VE DIZIN ADI-DIRECTORY NAME I NASIL ALIRIZ
//1-__FILE__ UZERINDE CALISTIMGIZ DOSYAYI VERIR,BU COK KULLANISLIDIR VE COK ISMIZE YARAYACAK BIR BILGIDIR
echo __FILE__."<br>";//C:\Users\ae_netsense.no\utv\test\PHP-works\php-ziparchive-class\ziparchive-class1\index.php
//2-__DIR__ ile DINAMIK OLARAK HANGI DIRECTORY DE ISEK O DIRECTORY YI BIZE VERIR
echo __DIR__."<br>";//C:\Users\ae_netsense.no\utv\test\PHP-works\php-ziparchive-class\ziparchive-class1
$files=glob("*");//glob a * isareti verirsek su an uzerinde bulundugmuz directory deki tum dosyalari sececektir
//3- SU AN UZERINDE CALISTGIMIZ DOSYAYA AIT DOSYA BILGILERI, FILENAME,EXTENSION,DIRNAME,BASENAME(FULLNAME-WITH EXTENSION) BUNA DA BU YOLLA DINAMIK BIR SEKILDE ERISEBILIYORUZ
//print_r(pathinfo(__FILE__));
/*
{
    dirname: "C:\Users\ae_netsense.no\utv\test\PHP-works\php-ziparchive-class\ziparchive-class1",
    basename: "index.php",
    extension: "php",
    filename: "index"
},

*/

//4.PEKI UZERINDE CALISTIGMIZ DOSYANIN SADECE ADINI ALMAK ISTERSEK NASIL YAPARIZ..
echo basename(__FILE__)."<br> <hr>";//index.php

//5.glob(*) methodu sayesinde veya scandir("*") sayesinde icinde bulundgumuz dir(directory) veya herhangi bir klasorun, dizinin veya directory nun altindaki dosya listesini alabiliyoruz

$zip=new ZipArchive();
$zip->open("zipfiles.zip",ZipArchive::CREATE);

//Eger icinde bulundgumuz dizin icindeki dosyalari glob ile alip tek tek dondurdugmuzde foreach icinde her bir dosyasyi, icinde bulundgmuz index.php haric, zipleyecek ve her birisine ayri ayri yeni isim vermek istiyorsaak o zamn da yeni bir dizi olusturarak, ayni dosya sirasinda her birisi icin yeni vermek istdgimz isimleri veririz ve foreach icerisinde ya da $files i key-value olarak acariz ve burdaki key 0-1...indexerlar oldugunu kabul edersek bu indexer lari kullanarak yeni isimler dizisinden her bir dosyaya karsilik gelecek olan yeni ismi de yeni diziisimleri dizisinden alarak, $zip->addFile() 2.parametresi olarak kullanabiliriz
foreach ($files as $file) {
    if($file!=basename(__FILE__))://uzerinde bulundgumuz index.php yi haric birak demis oluyoruz
       echo  $file."<br>"; 
       $zip->addFile($file);
    endif;
}

 $zip->close();

?>