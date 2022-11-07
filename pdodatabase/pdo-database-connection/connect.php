<?php 
//Burda veritabani baglantisnini gerceklestirecegiz
//PDO bir inbuild php sinifidir ondan dolayi dogrudan kullanabilyoruz
//1.parameter=mysql:host=localhost;dbname=testdb   sadece testdb bizim veritabani adimz burda
//2.parameter  kullanici adi- bu veritabanina hangi kullanici ile girilebliyor ise
//3.parameter sifre

//Veritabani baglantisinda hata alma riskmiz  oldugu icin ve uzak bir baglanti oldugu icin try-catch ile yapmak mantiklidir hata olursa da yakalayabilmek icn

//PDO VERITABANI BAGLANTISI GERCEKLESTIRME
try {
$db=new PDO("mysql:host=localhost;dbname=testdb","root",""); 
} catch (PDOException $e) {//PDO nun Exception sinifida var, eger baglnti da hata olusursa kullnalim, hatayi yakalayip bize mantikli bir mesaj donmesi icin
 echo  $e->getMessage();
 //Eger olmayan bir database e baglanmaya calisirsak 
 //SQLSTATE[HY000] [1049] Unknown database 'testdb2' boyle bir hata aliiriz
}



/*
Bu sekilde veritabanimz da baglantimiz dogru sekilde olup olmadgini normal su an icinde buludngumz sayfayi localhostta acarsak eger biz olmayan bir veritabanina baaglanmaya calisirsak veya baglanti da hata olursa zaten localhosttaki sayfa da bize hata mesaji doner yok herhangi bir problem yok baglantimzi gerceklesmis ise o zaman localhosttaki sayfamizi actimgizda herhangi bir hata mesaji almayiz
Eger olmayan bir veritabanina baglanmya calisir isek ve ise tyr-catch ve PDOException sinifi ile hata yi yakalmaz isek asagidaki gibi bir hata yi ekranda goruruz
Fatal error: Uncaught PDOException: SQLSTATE[HY000] [1049] Unknown database 'testdb2' in C:\wamp64\www\PHP-works\pdodatabase\pdo-database-connection\connect.php:8 Stack trace: #0 C:\wamp64\www\PHP-works\pdodatabase\pdo-database-connection\connect.php(8): PDO->__construct('mysql:host=loca...', 'root', '') #1 C:\wamp64\www\PHP-works\pdodatabase\pdo-database-connection\index.php(4): require_once('C:\\wamp64\\www\\P...') #2 {main} thrown in C:\wamp64\www\PHP-works\pdodatabase\pdo-database-connection\connect.php on line 8

*/

?>