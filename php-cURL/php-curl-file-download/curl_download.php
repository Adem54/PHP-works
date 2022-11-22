<?php 


$file=fopen("php.txt","w+");//php.txt te dosyasini yazmak icin acagiz ve once boyle bir dosya var mi bakar eger bulamaz ise kendisi olustursun diye w+ yaparz
$img_file=fopen("test.jpg","w+");
$curl=curl_init("https://www.php.net/");

$curl_img=curl_init("https://images.pexels.com/photos/326055/pexels-photo-326055.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1");

//Bu islem ile her seferinde ayri ayri bu sekilde de yazabiliriz ya da asagida dizi icersinde de yazabiliriz
curl_setopt($curl,CURLOPT_FILE,$file);
curl_setopt($curl_img,CURLOPT_FILE,$img_file);
//Bu sekilde request attgimz bot atttmiz curl ile bot atgimz sitenin donen degri ne ise onu dosyaya yazmis olacak

// curl_setopt_array($curl,[
//     CURLOPT_RETURNTRANSFER=>true,//burayi kullanmiyoruz sayfayi donduremeyecemiz icin, 
//     CURLOPT_FILE=>$file//buraya dosya yazacagiz
// ]);

//Biz yukarda kaynak kodlarini bir dosyaya yazdik ayni mantikla istegimiz herhangi bir sitedeki resmi de yazabilirz
//veya herhangi bir resmi de link adresi uzerinden indirebiliyoruz


curl_exec($curl);
curl_exec($curl_img);

curl_close($curl);
curl_close($curl_img);

//Biz normalde ne yapiyorduk bot attgimiz sayfanin kaynak kodunu bir degisknimize aktariyorduk 
//Ve de bu degiskene aktaridmig kaynak kodlarini bir dosyaya yazabiliyoruz

?>