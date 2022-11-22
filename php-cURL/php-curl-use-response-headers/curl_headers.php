<?php 

//Biz hernangi bir php sayfasina , server php sayfasini browser da actimgiz zaman aslinda 
//bir nevi istek gondermis oluyoruz ki zaten inspect yapip netwerk kismini incelersek ordan 
//o uzerinde bulundgujmuz sayfayi yeniler ve o sayfaynin url ine tiklarsak orda headers diye bilgiler var 
//ve o bilgiler arasinda response headers bilgileri var
/*
Response Headers
Connection: Keep-Alive
Content-Length: 0
Content-Type: text/html; charset=UTF-8
Date: Mon, 21 Nov 2022 22:42:37 GMT
Keep-Alive: timeout=5, max=100
Server: Apache/2.4.54 (Win64) OpenSSL/1.1.1p PHP/8.1.10
X-Powered-By: PHP/8.1.10

Birde bizim tarayiciya girip de curl.headers.php ye girdigmiz anda tarayicinin bizim icin gonderdigi headers bilgileri var

Request Headers 
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/
/* *;q=0.8,application/signed-exchange;v=b3;q=0.9
Accept-Encoding: gzip, deflate, br
Accept-Language: en-US,en;q=0.9
Cache-Control: max-age=0
Connection: keep-alive
Host: localhost
Referer: http://localhost/test/PHP-works/php-cURL/php-curl-use-response-headers/
sec-ch-ua: "Google Chrome";v="107", "Chromium";v="107", "Not=A?Brand";v="24"
sec-ch-ua-mobile: ?1
sec-ch-ua-platform: "Android"
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Mobile Safari/537.36


Eger istersek kendimiz manuel olarak bir ust bilgi de olusturabiliyoruz,ve bunun icin fonksiyon olarak header kullaniyoruz
*/
header("Token:Adem123");
//Bunu ekledigmz zaman bizim bu requestt header a verdgimz datayi bize, response header icinde geri donecektir bunu da yine sayfayi inspect yapip response headers kisminda Token:Adem123 diye gorebiliriz cunku biz uzerinde bulundgumuz curl_header.php sayfasini aciyoruz ve de response u yine bu sayfaya gondermis oluyor, yani sayfa acildiginda gelen sonuc response dur biz response da gormus oluyoruz request header a gondergimiz header("Token:Adem123"); bilgisini 

$curl=curl_init("http://localhost/test/PHP-works/php-cURL/php-curl-use-response-headers/header.php");

curl_setopt_array($curl,[
    CURLOPT_RETURNTRANSFER=>true,
    CURLOPT_HEADER=>true,//bot attggimiz sitenin response headers  bilgilerini almamizi saglar
    CURLOPT_NOBODY=>true,//istek yaptimgz sitenin response headers in icerigi haric sadece ust bilgsini dondurecektir
    CURLOPT_HTTPHEADER=>[
       "Token:ademerbas1234",
       "Test:test123456"    
    ]
]);

//Biz karsi tarafa ustbilgi gondermek istiyoruz, ve ust bilgi gondermek icinde yukardaki gibi gonderebiliyoruz
//Bu gonderilen dataya gonderdigmiz taraf ta $_SERVER uzerinden erisilebiliyor bunu da print_r($_SERVER) i yazdirarak gorebiliriz
//BIZIM BU SEKILDE GONDERDIGMIZ HEADER BILGILERI $_SERVER ALTINDA
// HTTP_TOKEN: "ademerbas1234",
// HTTP_TEST: "test123456",
//BU SEKILDE GELIYOR, BURDAKI KEY LER ILE ERISEBILIRIZ
/*
neden token data gonderme isleminin uzerinde duruyoruz cunku normalde bazi get ve post-request ler php de server tarafindaki korumali datalara gonderiliyor ondan dolayi da server onlarin login olup olmadiklarini kontrol etmek icin, daha dogrusu giris li olup olmadiklarini kontrol icin token talep ediyordu o datalara erisebilmek ve orada post islemi, crud islemleri yapabilmek datalari alabilmek icin ve biz de bundan dolayi front-end tarafinda kullanci login oldugunda veya singup oldugunda yine backendden gelen token i saklayarak her requestt isleminde bunu header icerisinde server a token ile birlikte gonderiyor ve bu sekilde korumali datalar a erisebilme imkani buluyyordu 
normalde bunlari biz form icerisinde inputlara gizli olarak yazariz ama ajax islemlerinde biz orda headers paramtresinde bu token i yazabilyoruz ve ajax isteklerinde heades icerisine token yazarsak artik form icinde inputlara gizli oolrak yazmamiza gerek kalmamis olacak
Ajax ile header bilgisi ni, ve icinde token i gonderecegiz ve o datayi da almak icin server tarafinda $_SERVER["HTTP_TOKEN"] $_SERVER["HTTP_TEST"] YANI curl ile biz istedgimiz her turlu datayi headers altina gonderebiliyoruz bu sekilde
Netwerk deki response headers bizim istek attigmiz sayfanin bize dondurudgu bilgiler ve biz onlarada erisebiliyoruz,
ISTEK YAPTGIMZ SAYFANIN RESPONSE HEADER LARINA ERISMEK ISTIYORUZ, ONLARI ALMAK ISTIYORUZ O ZAMAN DA CURL SETOPT DA CURLOPT_HEADER I AYARLARDA EKLERIZ VE BIZ BU CURL SAYFASINDA ISTEK YAPTIGMIZ SAYFAYI ECHO YAPTGIMIZ ICIN ORAYA DA ZATEN RESPONSE OLARAK HEADER BILGILERI GELDIGI ICIN DIREK BIZ BURDAN ALABILECEGIZ O BILGILERI, ISTEK YAPGTIMIZ SAYFADA BIRSEY YAZMASA BILE BIZ DIREK RESPONSE HEADERS BILGILERINI ALMIS OLUYORUZ BURDAN
BOT YAZMADA HEADERS BILGILERI MUTHIS ONEMLI..

*/

$source=curl_exec($curl);

curl_close($curl);

echo $source;//Biz bot ile curl ile istek gondermis olduk, baglanmis olduk header.php ye ve de o sayfada ne varsa onu degiskenimize aktarip ekranimiza bastirmis olyoruz

?>