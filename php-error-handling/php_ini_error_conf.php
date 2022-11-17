<?php 

//php.ini file
//Yapilandirma,konfigurasyon dosyasidir
//Php ilk calismaya basladiginda ona gore calisiyor
//Bazi konfigurasyon ayarlarini php.ini dosyasindan yapmamiz gerekebiliyor
//php dosyamizda phpinfo(); fonksiyonunu cagirinca php ile ilgili tum ayarlarimizi gorebiliyoruz
// phpinfo();
//Burdan error u ararsak display_errors u on olarak goruyoruz demekki hatalari gosterme ayari acikmis
//php(); diye olmayan bir methodu calistirmaya calisir isek o zaman
//Fatal error: Uncaught Error: Call to undefined function php() in C:\Users\ae_netsense.no\utv\test\php-error-handling\error-handling1.php:10 Stack trace: #0 {main} thrown in C:\Users\ae_netsense.no\utv\test\php-error-handling\error-handling1.php on line 10
//bu sekilde bir hata mesaji aliyoruz cunku display_error hatalari gosterme ayarimiz acik oldugu icin bu hata mesajini alioruz
//php.ini dosyasini phpinfo() metodunu calistirarak gorebiliriz...ayrica da php_ini_loaded_file() methodunu calistirarak da bulabilirz
//echo php_ini_loaded_file();//C:\xampp\php\php.ini

error_reporting(E_ALL);
ini_set("display_errors",1);

/*
php.ino dosyamizi inceledigmz zaman, display errors ayarlarmizin on oldugunu gorebiliriz burasi off olsa idi tekrar on yapmamiz gerekebilirdi
Ayrica da php.ini de herhangi bir degisiklik yaparask bu degisikligi alabilmemiz icin apache i yi servere yeniden acip kapatmamiz gerekecektir
; display_errors
;   Default Value: On
;   Development Value: On
*/
//php.ini de yapacagimz degisiklikte cok dikkat li olmaliyiz..cunku php bu ayarlara gore calisaiyor

//HATA BASTIRMA OPERATORU @..HATAYI IGNORE ETMEMIZI SAGLAMA
//Basina @ koyarak fattal error olmayan hatalari php nin ignore etmesin saglayabiliriz
//Fattal error lar icin basina @ koymak ise yaramayacaktir
echo $_GET["test"];//Warning: Undefined array key "test" in C:\Users\ae_netsense.no\utv\test\php-error-handling\php_ini_error_conf.php on line 31
echo @$_GET["test"];//Bu sekilde kullaninca her hangi bir hata gormeyecegiz
//Ama @ kullanmak cok iyi bir practsie degildir cunku biz hatalari ignore etmek yerin onlari handle ederek cozecegiz ve onlarla nasil bas ederiz onun onlemmini alacagiz..Bunu kullanmak tavsiye edilmiyor..cok fazla kullanmayalim
?>