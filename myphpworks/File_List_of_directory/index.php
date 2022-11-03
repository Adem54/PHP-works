<?php 
//Dizinlerdeki dosyalari listeleme
//Recrusive fonksiyon ile tum dizinleri okuyacagiz

//1.Yontem-scandir() dizi listelemk icin
//2.glob()

//scandir()
$my_files=scandir(".");//icerisine mevcut dosyamin calistigi dizini vermek istersek sadece "." veririz 
print_r($my_files);
/*
Bize mevcut dizinde var olan klasor ve dosyalari, bir dizi icine atarak getirir
{
0: ".",
1: "..",
2: "index.php",
3: "test1",
4: "test1.txt",
5: "test2",
6: "test3"
}


*/
//is_dir-icine girilen fonksiyonun dizin olup olmadigini verir
//is_file da dosya olup olmadigini anliyor
print_r(array_filter($my_files, function($value){
    return is_dir($value);
}));
//Burda bize .,..,test1,test2,test3 klasorlerini getiriyor sadece yani eger icinde bulundgumz dizin de dosya var ise onlari getirmiyor is_dir de
//cunku dir tum dosya ve klasorleri listeliyor normalde ama is_dir ile bunu sadece klasorleri getir demis gibi oluyoruz
//. ve .. is_dir ile filtreleyince de geliyor
/*
{
0: ".",
1: "..",
3: "test1",
5: "test2",
6: "test3"
}
*/

$my_files=glob("*");
print_r($my_files);
//glob(*) ile icinde bulundgumz directory altindaki tum dosya ve klasorleri getirir ama . ve .. yi getirmiyor
/*
{
0: "index.php",
1: "test1",
2: "test1.txt",
3: "test2",
4: "test3"
}
*/
//glob da ornegin sadece dizinleri listemek istersek 2. parametrede GLOBAL_ONLYDIR diyebilirdik veya
//glob(*/)
//$my_files=glob("*",GLOB_ONLYDIR);
$my_files=glob("*/");
print_r($my_files);
/*
{
0: "test1/",
1: "test2/",
2: "test3/"
}
*/
//Sadece php dosyalarini listelemek istersek
$my_php_files=glob("*.php");
print_r($my_php_files);
/*
{
0: "index.php"
}
*/

$my_txt_php_files=glob("*{php,txt}",GLOB_BRACE);//Hem php hem de txt dosyalarini listelemek istersek bu sekilde listeleriz
//Bir suru dosya icerisinden uzantisi php ve txt olanlari bulup bize getirecek bu sekilde
?>