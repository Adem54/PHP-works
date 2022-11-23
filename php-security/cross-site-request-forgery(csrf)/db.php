<?php 
//TOKEN ILE SALDIRILARA KARSI ONLEM ALMAK, GUVENLIGI SAGLAMAK
//Once bir session oturumu baslatiriz, ki zaten baslatmis olmali idik mantik olarak da

session_start();
$db=new PDO("mysql:host=localhost;dbname=testdb;port=3306","root", "");

//Nasil token olustururuz?
//1-uniqid() ile her seferinde uniq bir token olusturabilirz
// echo uniqid();//637e7d53334df
//her seferinde uniq bir id olusturur
//ya da daha uzun ve guclu olmasini istersek 
//2-bin2hex(random_bytes(20))
// echo bin2hex(random_bytes(20));//30c2d8c0b19a2239076868ddd7584c41f83a6608

//Bir uniq id uretiririz ve bunu token key i ile session a kaydederiz 
//Burya data gonderen, istek gonderen veya form gonderen yani bizim degistirecegimiz data olan, about datasi ile ilgili nerden form gonderiliyorsa orasi bize aittir ve ordan da token a erisecek sekilde bu db.php sayfasinda olusturduk token i ve token olusturulmus olarak gidilecek o form sayfasina ve token da gonderiliyor ve bizde dogal olarak burda token kontrolu yaparak bir guvenlik saglariz eger token var ise bu gelen data bizim kendi mize ait olan sayfadan gelen bir about datasidir yok eger token yok ise o zaman bu bize saldiri girisimidir seklinde bir guvenlik kontrolu yapabiliirz
//Bu kodu bizim request methodu post ise calistirmamiz gerekiyor, request methodumuzu da biz $_SERVER uzerinen alabiliyoruz
//BIZIM BIR SAYFAMIZA YAPILAN REQUEST I ,VE REQUEST ILE ILGILI BIR COK BILGIYI BIZ $_SERVER UZERINDEN ALABILIYORUZ COK EFEKTIF BIR YONTEM....DIKKAT EDELIMMM...COK ILERI SEVIYE ISLEMLER YAPABILME IMKANINA SAHIBIZ BURDA,BUNU BU SEKILDE AYIRMAZSAK O ZAMAN BU SAYFAYI CALISTJRMAK ISTEYEN HER SSAYFA ICIN UNVALID CSRF TOKEN DIYEBILIR CUNKU BIZ ILK SAYFA ACILDIGINDA ONCE BIR SESSIN OLUSTURSUN ARDINDAN GELEBILCECK POST ISTEKLERINE KARSI KORUNMAK ISTIYOURZ 
//SURAYA DIKKAT EDELIM...BU KONTROL ISLEMINI OLUSTURDUGJMUZ $_SESSION["token"]=uniqid(); olsturma isleminin ustunde yazacagiz...burasi onemli, sayfa bizim sayfamizdan post etse bile kontrol oncesi yeni bir token olsuturp bu sefer kendi sayfamizdan gelse de bizim token imiz olup olmadigin kontrol edemyiz ondan dolayi token olsuturma isleminin ustunde kontrol yapacagiz
//Sayfamiza atak yapan yani ajax post istegi gonderen atak yapan site bize token gonderemedigi icin buraya takilarak datamiza erisememis oluyor ve burayi asamiyor..bunu gidip b.html saldiri yapan sayfa olarak senaryoda dusunduk o sayfa acikken sayfayi yenileyip networkden check edebilirz
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!isset($_POST["token"]) || $_POST["token"] != $_SESSION["token"]){
        die("Unvalid csrf token");
    }
}



$_SESSION["token"]=uniqid();
//Ve artik her sayfa yenilendiginde token im artiki otomaik olarak erisilebilir olacak, yani db.php yi kullandigmiz her sayfada 
//token imiz a session uzerinden erisilebilecek
?>