<?php 


header("X-x:xx-123");//Bu request headers a verilmis olacak ve  response headers ile de yine bu sayfaya istek atinca geri donmus olacak ordan gorebiiriz bunu
//print_r($_SERVER);
//$_SERVER DEGISKENI ILE BIZ BU UST BILGILERI GOREBILYORUZ
echo $_SERVER["HTTP_TOKEN"];
echo "<br>";
echo $_SERVER["HTTP_TEST"];

print_r($_SERVER);
/*

curl ile headers altina bu datalar gonderildigi icin burdan bu sekilde alabiliyrouz bu datalari
ademerbas1234
test123456

curl ile bu sekilde gonderiliyor bu icinde bulundgumuz siteye, baglanilarak 
ondan dolayi da biz burda bu datalari alabilyoruz
curl_setopt_array($curl,[
    CURLOPT_RETURNTRANSFER=>true,
    CURLOPT_HTTPHEADER=>[
       "Token:ademerbas1234",
       "Test:test123456"
       
    ]

]);
*/

?>