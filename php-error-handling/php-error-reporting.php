<?php 


//Error reporting ile hatalari raporlamak yani loglamak
//Hata raporlamayi tmaamen kapatmak istersek
//error_reporting(0);//Hatalari tamamen kapatiriz, gostermeyeiz
//Tum hatalari raporlamak istersek de E_ALL Veya -1 veririrz
//error_reporting(E_ALL);
//error_reporting(-1);
//Birden fazla parametre vererek birden fazla secenegi de kullanabilyoruz

//error_reporting(E_ERROR | E_WARNING | E_PARSE);

//TUM HATALARI ALMAK ISTEYIP BAZILARINI ISTISNA BIRAKMAK DA ISTEYEBILIRIZ
//error_reporting(E_ALL ^ E_NOTICE);//E_NOTICE HARIC TUM HATALARI GOSTER
//bizim hatalarimz php de nerde loglaniyor nerde tutuluyor
//hatlaarimizi biz
//error_reporting(E_ALL);
//Sadece fattal error ve warning ler loglansin demis oluyoruz
// error_reporting(E_ERROR | E_WARNING);
// error_reporting(E_ALL);
//error_reporting(E_ALL ^ E_WARNING );//E_WARNING HARIC TUM HATALARI GOSTER DEMIS OLURUZ

//Bu sekilde error_reporting vermek cok onelmidir bu sayede hatalarimiz php_error_log dosyasi icerisine hatalar satir satir yaziliyor
//Bu log dosyasini biz parse ederek ayristirarak, kendimize ozel bir loglama paneli yapabiliriz...
//log dosyalarina yaziliyor ve biz bu dosyalari ihtiyaca gore kullanabilirz

echo ini_get("error_log");//yazarak hata mesajlarimzin php de nerde loglandigini bulabilriz
//C:\xampp\php\logs\php_error_log

//  phpinfo();
//test();

// php.ini dosyas inde
// ; log_errors
// ;   Default Value: On
// ;   Development Value: On
// ;   Production Value: On
 //test();

//  myTest();
//  substr();

 /*
 Bizim loglama hatalarimiz i buraya yaziyor
 C:\xampp\apache\logs
 
 */


 myNewFunc();



?>