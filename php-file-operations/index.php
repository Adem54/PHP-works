<?php 
//Bir dosya oku nacagi zaman once dosyaya fopen araciligi ile baglanilir dosya acilir sonra
//yapilacak islemler yapilir en son da o dosya ile baglanti koparilir fclose() methodu ile
//Aynen veritabani baglantsini kurup sonra islemler bitince kaldirmak gibi
$file=fopen("test.txt","r");
// fread($file,filesize("test.txt"));

//fgets(file,length) length belirtilmez ise satir sonuna kadar okur
//$readFile=fgets($file);//dosyadan sadece ilk satiri okur bu sekilde
// echo $readFile; ilk satirdaki Hello yazisini okuyor

//feof dosya kontrolu-EOF-END OF LINE
//en son satira ulasana kadar okumasi icin feof() methodunu kullaniriz

//feof() satir buldukca okur ve true gelir satir bulamadingda false gelecek ve artik okumayi durdurup fclose ile dosyayi kapatirz'

//BIR DOSYAYI BASTAN ASGAIYA KADAR OKUMA ISLEMINI BU SEKILDE YAPARIZ...BUNU COK FAZLA YAPACAGIZ COKK IYI BILMEMIZ GEREKIR
while(!feof($file)){
    $line=fgets($file);
    echo $line."<br>";
}



fclose($file);

?>