<?php 

//ziparchive sinifi ile beraber dinamik olarak sectigimiz dosyalardan zip dosyasi olusturmamizi sagliyor
//Oncelikle ZipArchive bir php class idir ondan dolayi tabi ki onu memory ye cikarip islevlerini kullanabilmek icin new lememiz veya ondan bir instance olsuturmamiz gerekiyor

//$zip=new ZipArchive();
//Ilk once olusturacagimz zip dosya ismi ve bir tane flag olarak girdigmz 2 tane parametre ile open methodunu invoke ederek zip dosyasi olustururuz
//$zip->open("my_zipfiles.zip",ZipArchive::CREATE);//zip dosya adi, flag() ZipArchive::CREATE ile zip dosyamizi yeniden olusturmak istedgimizi soyluyoruz
//Zip dosyasi olustuurma isleminden sonra, da bu zip dosyasi icerisine atacaigmz dosyalari seciyoruz
// $zip->addFile("test.html","my_test.html");//test.html i zip dosyasi icerisine my_test.html isminde at demis oluyyruz bu sekilde
// $zip->addFile("style.css","main.css");
// $zip->addFile("img1.jpg","review.jpg");
// $zip->close();
//Bu icinde bulundgumuz dosyayi localhostta calistirdgimz zaman zip dosyamizin olustugunu gorebilirzi

/*
1-open-connection
2-Eger databas-ftpserver-username,password,hostadress
3-close-baglantiyi koparmak veya kapatmak

*/





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

//$zip=new ZipArchive();
//$zip->open("my_zipfiles.zip",ZipArchive::CREATE);
// $zip->addFile("style.css","main.css");
// $zip->addFile("img1.jpg","review.jpg");
// $zip->close();

foreach ($files as $file) {
    if($file!=basename(__FILE__))://uzerinde bulundgumuz index.php yi haric birak demis oluyoruz
       echo  $file."<br>"; 
    endif;
}

?>