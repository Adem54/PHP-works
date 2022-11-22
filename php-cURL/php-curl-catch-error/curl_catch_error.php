<?php 

//curl de hata olusumunu yakalamak

//1-olmayan bir sayfaya istek atmak,curl ile olmaayan bir sayfaya bot atmak, yazmak


$curl=curl_init("http://aadafasdfasdfsad.net");

curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
//Biz kendimiz check yapmazsak kendisi hatayi basmiyor 
if(curl_exec($curl)==false): echo curl_error($curl);//mevcut hata yi curl_error u kullanarak hatalari kontrol edebilyoruz
//Bazen de site vardir ama anlik olarak sunucuya erisilemiyor da olabilir, istege response basarili donmeyebilir
//Could not resolve host: aadafasdfasdfsad.net
endif;
// $source=curl_exec($curl);

curl_close($curl);


?>