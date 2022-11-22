<?php 


$curl=curl_init("http://localhost/test/PHP-works/php-cURL/php-curl-cookies/cookie.php");
//cookie.php dosyamiza curl ile istek atiyoruz veya bot yaziyoruz

curl_setopt_array($curl,[
    CURLOPT_RETURNTRANSFER=>true,
    CURLOPT_COOKIE=>"test=Adem Erbas"
]);

$source=curl_exec($curl);

curl_close($curl);
echo $source;
//Warning: Undefined array key "test" in C:\Users\ae_netsense.no\utv\test\PHP-works\php-cURL\php-curl-cookies\cookie.php on line 4
//Cunku istek attigmz cookie.php de olmayan bir cookie yi ekrana basmaya calisiyor echo ile
//Biz curl ile istek attgimz adrese, cookie gonderebilyoruz CURLOPT_COOKIE ile DEGER OLARAK DA a=b&c=d seklinde kullaniyoruz ve a cookie adi b ise cookie degeri oluyor, c cookie adi, d cookie degeri seklinde, cookieleri birbirnden ayirmak icin de & ampersan isareti kullaniyoruz
//CURLOPT_COOKIE=>"test=Adem Erbas" ayarlarda , boyle bir cookie gonderince artik bizim istek attgimiz sayfa nin test isminde bir cookie yazdirmaya calismaisindan dolayi bize hata donmuyor bize bizim burda cookie de test cookie sine karsilik yazdimgiz Adem Erbas donuyyor
//Ama su farki ayirt edelim, biz curl bot istegi, requesti attgimiz sayfada istek attigmiz sayfaninkaynak kodlarini yazdirdip ekrana bastimgz icin, ve cookie olarak o sayfada ekrana basillmaya calisilan cookiyi gonderdigmiz icin artik hata  yerine bizim gonderdimgiz cookie degerini aliyoruz ama ayni sey, direk o sayfayi normal bir sekilde acinca gecerli olmyor cunku biz curl ile o sayfaya istek gonderince cookie gonderiyoruz, ama direk url den kendi kendine istek atinca tabi ki herhangi bir cookie gonderilmedigi icn , ayni hata yine aliniyor cookie.php de
?>