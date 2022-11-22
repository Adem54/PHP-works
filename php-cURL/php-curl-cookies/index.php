<?php

//Bir tane ornek login uygulamasi yapiyoruz
//once session imizi baslatiyoruz
session_start();
// session_destroy();//session imizi icerisinde eger deger var ise onu silmek icn kulllanilr daha oncden kullanirken eger session da data kalmis olablir o datalari silmek icin 1 kez session_destroy() u calistirmak gerekebiliyor
//Eger session da login diye bir deger yok ise, o zaman login_example.php  yi calistir yani girise izin vermiyor eger daha onceden giris yapilmadi ise ki  burda normal sartlarda credentials lar check edilir daha once giris yapildi ise data veritabanina kaydedilir ve session da da tutulur ve bundan sonra ki giris islemlerinde de kontrol edilerek ona gore kullaniciya korumali sayfalar, admin gibi acilir ya da login.php ye yonlendirilir kullanici 
if(!isset($_SESSION["login"])){
    require __DIR__."/login.php";
}else {
    require __DIR__."/home.php";
}
/*
Kullanicimiz index.php de su anda ve kullanici login.php ye yonlendiriliyor ilk olarak cunku session da login diye bir data  yok henuz ardinda da kullanici login sayfasinda girdigi datalari check ediliyor ve eger kullaniciin username ve passwordu databaseden cekilen data ile uyusuyorsa yani database de bu datalar mevcut ise tamam demekki bu kullanici uye kullanicmiz o zaman bu kullanici icin biz login session ini baslatabiliriz demektir ve login session i kullaniici icin baslatilinca, kullanici index.php ye  yonlendirilerek, tekrar kullanici if condition a geliyor ve bu sefer artik kulllanicinin session logini true oldugu icin kullanicinin home.php ye girilmesine izin verilmis oluyor

*/

?>