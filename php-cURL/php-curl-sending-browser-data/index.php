<?php 

/*

http://localhost/test/PHP-works/php-cURL/php-curl-sending-browser-data/
Su an icin de bulundgumuz sayfaya bir istek gonderildigi zaman, istek yapilan tarayiciiya inspect yaptgimiz zaman
network kismindan istek gelen php-curl-sending-browser-data/ adresimize tiklar ve ordan Header a gidersek o zaman orda en altta
User-Agent diye bir data goruruz, bu bizim tarayici bilgimizdir

Biz php tarafindan server tarafindan da tarayici bilgisini gormek istersek



User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Mobile Safari/537.36
*/

if(!isset($_SERVER["HTTP_USER_AGENT"])){
    die("Bot girisimi engellendi");
}
//Sistem bot girisimine karsi onlem almis oldu bu sekilde, SISTEM BU SEKILDE ISTEK GONDEREN KAYNAGIN BOT OLDUGUNU BU SEKILDE FARKEDEBILIYOR SISTEM
// DATASINI CEKMEK ISTEDGIMZ ADRESE BROWSER BILGISI BOT ATAN SITE TARAFINDAN GONDERILEMEDIGI ICIN BURDA DA DOGAL OALRAK BU ICINDE BULUNDUGMUZ SITE DE EKRANA USER_AGENT BILGILERINI BASTIGI ICIN BOT GONDEREN CUR-BROWSER.PHP DE BUNU ALAMIYOR CUNKU BAGLANMAYA CALIISTIGIMIZ SITE echo $_SERVER["HTTP_USER_AGENT"]; EKRANA BROWSER BILGISINI BASTIK ONU CURL ILE BURAYA BAGLANARAK ALABILIR MIYIZ DIYE AMA BU SEKILDE ALAMADIK O ZAMANDA YINE BIZIM BAGLANMYA CALISTGIMIZ ADRESS TE DE DEMEKKI IF(!ISSET($_SERVER["HTTP_USER_AGENT"])) ISE BOT GIRISIMI ENGELLENDI DIYE YAZABILIR, TARAYICI BILGISI OLMADAN ISTEK GONDEREN LER BOT DEMEKTIR GIBI BIR SONUC CIKARABILIRIZ BURDA 

echo $_SERVER["HTTP_USER_AGENT"];
//Farkli farkli tarayiicilardan girildiginde de tarayicilarin bilgisini bu sekilde alabildigmizi gorebiliriz
//Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Mobile Safari/537.36
//Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko/20100101 Firefox/107.0
//Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36 Edg/107.0.1418.42

?>